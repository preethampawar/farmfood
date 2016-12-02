<?php
class OrdersController extends AppController {

    public function beforeFilter() 
	{
        parent::beforeFilter();
		
		App::uses('ShoppingCart', 'Model');
		$this->ShoppingCart = new ShoppingCart;		
    }
	
	public function confirmUserDetails($type=null)
	{
		$user_details['User']['name'] = null;
		$user_details['User']['email'] = null;
		$user_details['User']['mobile'] = null;
		
		$showForm = false;
		
		if($this->Session->check('User.id')) {
			$this->Session->write('guest', false);
			$showForm = true;
			$user_details['User'] = $this->Session->read('User');
		} else {
			if($type == 'guest') {
				$showForm = true;
				$this->Session->write('guest', true);
			}
		}
		
		if($this->Session->check('ConfirmOrder.user_details')) {
			$user_details['User'] = $this->Session->read('ConfirmOrder.user_details');
		}
		
		$this->set(compact('user_details', 'showForm'));
	}
	
	public function saveOrderDetails()
	{
		if($this->request->isPost()) {
			$data = $this->request->data['Order'];
			
			// get delivery location details
			App::uses('DeliveryLocation', 'Model');
			$this->DeliveryLocation = new DeliveryLocation;
			$location_details = $this->DeliveryLocation->findById($data['delivery_location_id']);
			if(!empty($location_details)) {
				$data['location'] = $location_details['DeliveryLocation']['name'];
				$data['delivery_time'] = $location_details['DeliveryLocation']['delivery_time'];
				$data['free_delivery'] = $location_details['DeliveryLocation']['free_delivery'];					
			}
			
			// get user_id if user is logged in	
			$user_id = null;
			if($this->Session->check('User.id')) {
				$user_id = $this->Session->read('User.id');			
			}		
			$data['user_id'] = $user_id;
			
			// get cart details	
			$shopping_cart_id = $this->Session->read('ShoppingCart.id');
			$cart_details = $this->ShoppingCart->findById($shopping_cart_id);
			$data['total_amount'] = $this->ShoppingCart->getCartTotalAmount($shopping_cart_id);
			$data['discount_amount'] = $cart_details['ShoppingCart']['discount_amount'];
			$data['promo_code'] = $cart_details['ShoppingCart']['promo_code'];
			$data['shopping_cart_id'] = $shopping_cart_id;
			
			// set order to booked & confirmed status
			$data['transaction_date'] = date('Y-m-d');		
			$data['booked'] = true;
			$data['booked_date'] = date('Y-m-d');
			$data['confirmed'] = true;
			$data['confirmed_date'] = date('Y-m-d');
			
			// set order id
			$data['id'] = null;
			if($this->Session->check('Order.id')) {
				$data['id'] = $this->Session->read('Order.id');	
			}
			
			$order_info['Order'] = $data;
			if(!$this->Order->save($order_info)) {
				$this->errorMsg('Error! Please try again.');
				$this->redirect('/orders/confirmUserDetails');
			} else {
				$order_details = $this->Order->read();
				$this->Session->write('Order.id', $order_details['Order']['id']);
				
				$cart_products = $this->ShoppingCart->getCartProducts($shopping_cart_id);
				App::uses('OrderProduct', 'Model');
				$this->OrderProduct = new OrderProduct;
				foreach($cart_products['ShoppingCartProduct'] as $row) {
					$data = array();
					$data['OrderProduct']['id'] = null;
					$data['OrderProduct']['order_id'] = $order_details['Order']['id'];
					$data['OrderProduct']['quantity'] = $row['quantity'];
					$data['OrderProduct']['product_id'] = $row['product_id'];
					$data['OrderProduct']['category_id'] = $row['category_id'];
					$data['OrderProduct']['category_name'] = $row['Category']['name'];
					$data['OrderProduct']['product_name'] = $row['Product']['name'];
					$data['OrderProduct']['max_retail_price'] = $row['Product']['max_retail_price'];
					$data['OrderProduct']['selling_price'] = $row['Product']['selling_price'];
					$data['OrderProduct']['weight'] = $row['Product']['weight'];
					$this->OrderProduct->save($data);
				}
				
				// go to order confirmation page. skip sms verification.
				$this->successMsg('Success! Your order has been booked and confirmed.');
				
				// remove cart details and booking details from session.				
				$this->Session->delete('ShoppingCart');
				
				// send confirmation email
				$this->sendOrderConfirmationEmail($order_details['Order']['id']);
				
				$this->redirect('/orders/confirmBooking');
			}				
		} else {
			$this->errorMsg('Error! Invalid request.');
			$this->redirect('/');		
		}
	}

	public function confirmBooking()
	{
		App::uses('ShoppingCart', 'Model');
		$this->ShoppingCart = new ShoppingCart;
		
		if($this->Session->check('Order.id')) {
			$order_id = $this->Session->read('Order.id');
			
			$order_details = $this->Order->findById($order_id);
			
			$shopping_cart_id = $order_details['Order']['shopping_cart_id'];
			$cart_items = $this->ShoppingCart->getCartProducts($shopping_cart_id);
		
			$total_amount = $this->ShoppingCart->getCartTotalAmount($shopping_cart_id);
			$qty_count = $this->ShoppingCart->getProductsQtyCountInCart($shopping_cart_id);			
			
			
		} else {
			$this->errorMsg('Error! You are not authorized to view this page');
			$this->redirect('/');
		}
		$this->set(compact('order_details', 'cart_items', 'total_amount', 'qty_count'));
	}
	
	public function sendOrderConfirmationEmail($order_id)
	{
		App::uses('ShoppingCart', 'Model');
		$this->ShoppingCart = new ShoppingCart;
		
		$order_details = $this->Order->findById($order_id);
		
		if(!empty($order_details)) {
			$to_email = $order_details['Order']['email'];
			$to_name = $order_details['Order']['name'];
			
			$shopping_cart_id = $order_details['Order']['shopping_cart_id'];
			$cart_items = $this->ShoppingCart->getCartProducts($shopping_cart_id);
			
			if(!empty($cart_items)) {
				$total_amount = $this->ShoppingCart->getCartTotalAmount($shopping_cart_id);
				$qty_count = $this->ShoppingCart->getProductsQtyCountInCart($shopping_cart_id);			
				
				if(!empty($to_email)) {
					App::uses('CakeEmail', 'Network/Email');	
					$Email = new CakeEmail();
					$Email->template('confirm_order_email', 'default')
						->emailFormat('both')
						->to($to_email, $to_name)
						->from('no-reply@enursery.in', 'Farm Food')
						->bcc('preetham.pawar@enursery.in', 'Preetham Pawar')
						->subject('Order Confirmed - Farm Food')
						->viewVars(array('order_details'=>$order_details, 'cart_items'=>$cart_items, 'total_amount'=>$total_amount, 'qty_count'=>$qty_count));
					$Email->send();
				}
			}
		}
	}

	public function admin_list($status = null)
	{
		if(!$status) {
			$status = 'confirmed';
		}
		$status = strtolower($status);
		
		// booked order
		$conditions_booked = array('Order.booked'=>1, 'Order.confirmed'=>0, 'Order.delivered'=>0, 'Order.cancelled'=>0, 'Order.closed'=>0);
		$sort_order_booked = array('Order.booked_date DESC');
		$booked_count = $this->Order->find('count', array('conditions'=>$conditions_booked));
		
		// confirmed order
		$conditions_confirmed = array('Order.booked'=>1, 'Order.confirmed'=>1, 'Order.delivered'=>0, 'Order.cancelled'=>0, 'Order.closed'=>0);
		$sort_order_confirmed = array('Order.confirmed_date DESC');
		$confirmed_count = $this->Order->find('count', array('conditions'=>$conditions_confirmed));
		
		// delivered order
		$conditions_delivered = array('Order.booked'=>1, 'Order.confirmed'=>1, 'Order.delivered'=>1, 'Order.cancelled'=>0, 'Order.closed'=>0);
		$sort_order_delivered = array('Order.delivery_date DESC');
		$delivered_count = $this->Order->find('count', array('conditions'=>$conditions_delivered));

		// cancelled order
		$conditions_cancelled = array('Order.booked'=>1, 'Order.confirmed'=>1, 'Order.delivered'=>0, 'Order.cancelled'=>1, 'Order.closed'=>0);
		$sort_order_cancelled = array('Order.cancelled_date DESC');
		$cancelled_count = $this->Order->find('count', array('conditions'=>$conditions_cancelled));

		// closed order
		$conditions_closed = array('Order.closed'=>1);
		$sort_order_closed = array('Order.cancelled_date DESC');
		$closed_count = $this->Order->find('count', array('conditions'=>$conditions_closed));

		// unknown order
		$conditions_unknown = array('Order.booked'=>0, 'Order.confirmed'=>0, 'Order.delivered'=>0, 'Order.cancelled'=>0, 'Order.closed'=>0);
		$sort_order_unknown = array('Order.created DESC');
		$unknown_count = $this->Order->find('count', array('conditions'=>$conditions_unknown));
		
		switch($status) {
			case 'booked':
				$orders = $this->Order->find('all', array('conditions'=>$conditions_booked, 'order'=>$sort_order_booked));
				break;
			case 'confirmed':
				$orders = $this->Order->find('all', array('conditions'=>$conditions_confirmed, 'order'=>$sort_order_confirmed));
				break;
			case 'delivered':
				$orders = $this->Order->find('all', array('conditions'=>$conditions_delivered, 'order'=>$sort_order_delivered));
				break;
			case 'cancelled':
				$orders = $this->Order->find('all', array('conditions'=>$conditions_cancelled, 'order'=>$sort_order_cancelled));
				break;
			case 'closed':
				$orders = $this->Order->find('all', array('conditions'=>$conditions_closed, 'order'=>$sort_order_closed));
				break;
			case 'unknown':
				$orders = $this->Order->find('all', array('conditions'=>$conditions_unknown, 'order'=>$sort_order_unknown));
				break;
			default:
				// by default show confirmed orders

				break;
		}		
		
		$status = ucwords($status);		
		$this->set(compact('orders', 'status', 'booked_count', 'confirmed_count', 'delivered_count', 'cancelled_count', 'closed_count', 'unknown_count'));
	}
	
	public function admin_order_details($order_id)
	{
		$order_details = $this->Order->find('first', array('conditions'=>array('Order.id'=>$order_id), 'recursive'=>1));
		$this->set(compact('order_details'));
	}
	
	public function admin_order_edit($order_id)
	{
		$order_details = $this->Order->find('first', array('conditions'=>array('Order.id'=>$order_id), 'recursive'=>1));
		$this->set(compact('order_details'));
		
		if($this->request->isPost() or $this->request->isPut()) {
			$req_data = $this->request->data;
			switch($this->request->data['Order']['status']) {
				case 'booked';
					$data['Order']['booked'] = 1;
					$data['Order']['booked_date'] = date('Y-m-d');					
					$data['Order']['confirmed'] = 0;
					$data['Order']['delivered'] = 0;
					$data['Order']['cancelled'] = 0;
					$data['Order']['closed'] = 0;
					break;
				case 'confirmed';
					$data['Order']['booked'] = 1;
					$data['Order']['confirmed'] = 1;
					$data['Order']['confirmed_date'] = date('Y-m-d');
					$data['Order']['delivered'] = 0;
					$data['Order']['cancelled'] = 0;
					$data['Order']['closed'] = 0;
					break;
				case 'delivered';				
					$data['Order']['booked'] = 1;
					$data['Order']['confirmed'] = 1;
					$data['Order']['delivered'] = 1;
					$data['Order']['delivery_date'] = date('Y-m-d');
					$data['Order']['cancelled'] = 0;
					$data['Order']['closed'] = 0;
					break;
				case 'cancelled';	
					$data['Order']['cancelled'] = 1;
					$data['Order']['cancelled_date'] = date('Y-m-d');
					$data['Order']['closed'] = 0;
					break;
				case 'closed';
					$data['Order']['closed'] = 1;
					$data['Order']['closed_date'] = date('Y-m-d');
					break;
				case 'unknown';
					$data['Order']['booked'] = 0;
					$data['Order']['confirmed'] = 0;
					$data['Order']['delivered'] = 0;
					$data['Order']['cancelled'] = 0;
					$data['Order']['closed'] = 0;
					break;
					
			}
			
			$data['Order']['id'] = $order_id;			
			
			if($this->Order->save($data)) {
				$this->successMsg('Success! Order status updated.');
				$this->redirect('/orders/admin_order_edit/'.$order_id);
			} else {
				$this->errorMsg('Error! Please try again');
			}
		}
	}

}