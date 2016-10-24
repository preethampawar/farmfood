<?php
class OrdersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

		$admin = false;
		if($this->Session->check('User')) {
			$admin = $this->Session->read('User.admin');
		} 
		
		App::uses('ShoppingCart', 'Model');
		$this->ShoppingCart = new ShoppingCart;
		if(!$admin) {
			
			// check if products exits in cart
			if($this->Session->check('ShoppingCart.id')) {
				$shopping_cart_id = $this->Session->read('ShoppingCart.id');
				$items_count = $this->ShoppingCart->getProductsCountInCart($shopping_cart_id);
				if($items_count < 1) {
					$this->errorMsg('Error! There are no products in your cart.');
					$this->redirect('/');
				}
			} else {
				if($this->action != 'confirmBooking') {
					$this->errorMsg('Error! Your shopping cart is empty.');
					$this->redirect('/');
				}
			}
			
			// Allowed actions
			if(($this->action != 'confirmUserDetails') and ($this->action != 'saveUserDetails') and ($this->action != 'confirmBooking')) {
				if(!$this->Session->check('ConfirmOrder')) {
					$this->redirect('/orders/confirmUserDetails');
				}
			}
			
			// set otp verification status to false.
			if(($this->action != 'verifyotp') and ($this->action != 'confirmOrder') and ($this->action != 'confirmBooking')) {
				$this->Session->write('otp_verified', false);
			}
		}
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
	
	public function saveUserDetails()
	{
		$response = array();
		if($this->request->isPost()) {
			$data = $this->request->data['Order'];
			
			$errorMsg = array();
			if(empty($data['name'])) {
				$errorMsg[] = 'Error! Please enter your name.';
			} 
			if(empty($data['mobile'])) {
				$errorMsg[] = 'Error! Please enter your mobile number.';				
			}
			
			$errorMsg = implode('<br>', $errorMsg);
			$response = $this->getResponse('error', $errorMsg, null);
			
			if(empty($errorMsg)) {
				$response = $this->getResponse('success', '', null);
				$this->Session->write('ConfirmOrder.user_details', $data);
			}
		} else {
			$response = $this->getResponse('error', 'Invalid request', null);			
		}
		$this->set('response', $response);
	}
	
	public function confirmAddress()
	{
		$user_details = array();
		$user_address['User']['address'] = null;
		$user_address['User']['delivery_location_id'] = null;
		
		if($this->Session->check('ConfirmOrder.address')) {
			$user_address['User'] = $this->Session->read('ConfirmOrder.address');
		}
		
		if($this->Session->check('ConfirmOrder.user_details')) {
			$user_details = $this->Session->read('ConfirmOrder.user_details');
		} else {
			$this->errorMsg('Error! User details not found.');
			$this->redirect('/orders/confirmUserDetails');
		}
		$this->set(compact('user_details', 'user_address'));
	}
	
	public function saveAddress()
	{
		$response = array();
		if($this->request->isPost()) {
			$data = $this->request->data['Order'];
			
			$errorMsg = array();
			if(empty($data['address'])) {
				$errorMsg[] = 'Error! Please enter your name.';
			} 
			if(empty($data['delivery_location_id'])) {
				$errorMsg[] = 'Error! Please select a location.';				
			} else {
				// get delivery location details
				App::uses('DeliveryLocation', 'Model');
				$this->DeliveryLocation = new DeliveryLocation;
				$location_details = $this->DeliveryLocation->findById($data['delivery_location_id']);
				if(!empty($location_details)) {
					$data['location'] = $location_details['DeliveryLocation']['name'];
					$data['delivery_time'] = $location_details['DeliveryLocation']['delivery_time'];
					$data['free_delivery'] = $location_details['DeliveryLocation']['free_delivery'];					
				} else {
					$errorMsg[] = 'Error! Delivery location could not be found.';
				}
			}
			
			if(empty($errorMsg)) {
				$this->Session->write('ConfirmOrder.address', $data);
				$response = $this->getResponse('success', '', null);
			} else {
				$errorMsg = implode('<br>', $errorMsg);
				$response = $this->getResponse('error', $errorMsg, null);
			}
		} else {
			$response = $this->getResponse('error', 'Invalid request', null);			
		}
		$this->set('response', $response);
	}
	
	public function confirmPaymentMethod()
	{
		$user_details = array();
		$user_payment_details['User']['payment_method'] = null;
		$user_payment_details['User']['message'] = null;
		
		if($this->Session->check('ConfirmOrder.user_details')) {
			$user_details = $this->Session->read('ConfirmOrder.user_details');
		} else {
			$this->errorMsg('Error! User details not found.');
			$this->redirect('/orders/confirmUserDetails');
		}
		
		if($this->Session->check('ConfirmOrder.address')) {
			$user_address = $this->Session->read('ConfirmOrder.address');
		} else {
			$this->errorMsg('Error! User address details not found.');
			$this->redirect('/orders/confirmAddress');
		}
		
		if($this->Session->check('ConfirmOrder.payment_details')) {
			$user_payment_details['User'] = $this->Session->read('ConfirmOrder.payment_details');
		}
		
		$this->set(compact('user_details', 'user_address', 'user_payment_details'));
	}
	
	public function savePaymentDetails()
	{
		$response = array();
		if($this->request->isPost()) {
			$data = $this->request->data['Order'];
			
			$errorMsg = array();
			if(empty($data['payment_method'])) {
				$errorMsg[] = 'Error! Select payment method.';
			}
			
			if(empty($errorMsg)) {
				$this->Session->write('ConfirmOrder.payment_details', $data);
				$response = $this->getResponse('success', '', null);
			} else {
				$errorMsg = implode('<br>', $errorMsg);
				$response = $this->getResponse('error', $errorMsg, null);
			}
		} else {
			$response = $this->getResponse('error', 'Invalid request', null);			
		}
		$this->set('response', $response);
	}
	
	public function bookOrder()
	{
		$user_details = array();
		$user_address = array();
		$user_payment_details = array();
		if($this->Session->check('ConfirmOrder.user_details')) {
			$user_details = $this->Session->read('ConfirmOrder.user_details');
		} else {
			$this->errorMsg('Error! User details not found.');
			$this->redirect('/orders/confirmUserDetails');
		}
		
		if($this->Session->check('ConfirmOrder.address')) {
			$user_address = $this->Session->read('ConfirmOrder.address');
		} else {
			$this->errorMsg('Error! User address details not found.');
			$this->redirect('/orders/confirmAddress');
		}
		
		if($this->Session->check('ConfirmOrder.payment_details')) {
			$user_address = $this->Session->read('ConfirmOrder.payment_details');
		} else {
			$this->errorMsg('Error! Payment details not found.');
			$this->redirect('/orders/confirmPaymentMethod');
		}
		
		$user_id = null;
		if($this->Session->check('User.id')) {
			$user_id = $this->Session->read('User.id');			
		}		
		// book order
		$data['Order']['id'] = null;			
		$data['Order']['user_id'] = $user_id;			
		$data['Order']['name'] = $this->Session->read('ConfirmOrder.user_details.name');
		$data['Order']['email'] = $this->Session->read('ConfirmOrder.user_details.email');
		$data['Order']['mobile'] = $this->Session->read('ConfirmOrder.user_details.mobile');			
		$data['Order']['address'] = $this->Session->read('ConfirmOrder.address.address');
		$data['Order']['delivery_location_id'] = $this->Session->read('ConfirmOrder.address.delivery_location_id');
		$data['Order']['location'] = $this->Session->read('ConfirmOrder.address.location');
		$data['Order']['delivery_time'] = $this->Session->read('ConfirmOrder.address.delivery_time');
		$data['Order']['free_delivery'] = $this->Session->read('ConfirmOrder.address.free_delivery');			
		$data['Order']['payment_method'] = $this->Session->read('ConfirmOrder.payment_details.payment_method');
		$data['Order']['message'] = $this->Session->read('ConfirmOrder.payment_details.message');		
		$data['Order']['shopping_cart_id'] = $this->Session->read('ShoppingCart.id');
		$data['Order']['transaction_date'] = date('Y-m-d');		
		$data['Order']['booked'] = true;
		$data['Order']['booked_date'] = date('Y-m-d');
		
		$cart_details = $this->ShoppingCart->findById($this->Session->read('ShoppingCart.id'));
		$data['Order']['total_amount'] = $this->ShoppingCart->getCartTotalAmount($this->Session->read('ShoppingCart.id'));
		$data['Order']['discount_amount'] = $cart_details['ShoppingCart']['discount_amount'];
		$data['Order']['promo_code'] = $cart_details['ShoppingCart']['promo_code'];
		
		if($this->Session->check('Order.id')) {
			$data['Order']['id'] = $this->Session->read('Order.id');	
		}
		
		if(!$this->Order->save($data)) {
			$this->errorMsg('Error! Please try again.');
			$this->redirect('/orders/confirmPaymentMethod');
		} else {
			$order_details = $this->Order->read();
			$cart_products = $this->ShoppingCart->getCartProducts($this->Session->read('ShoppingCart.id'));
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
			
			$this->Session->write('Order.id', $order_details['Order']['id']);
			
			// go to order confirmation page. skip sms verification.
			$this->successMsg('Success! Your order has been booked with us.');
			
			// remove cart details and booking details from session.
			$this->Session->delete('ConfirmOrder');
			$this->Session->delete('guest');
			$this->Session->delete('ShoppingCart');
			$this->Session->delete('otp');
			
			// send confirmation email
			$this->sendOrderConfirmationEmail($order_details['Order']['id']);
			
			$this->redirect('/orders/confirmBooking');
		}
		
		// send otp by sms/email
		// $otp = rand(1111,9999);	
		// $this->Session->write('otp', $otp);
		// $this->Session->write('otp_verified', false);
		
		$this->set(compact('user_details', 'user_address', 'user_payment_details'));
		debug($this->Session->read('otp'));
		//$this->sendSMS($mobile_numbers, $message);
	}
	
	public function confirmOrder()
	{		
		if($this->Session->check('otp_verified') and ($this->Session->read('otp_verified') == true)) {
			$data['Order']['id'] = $this->Session->read('Order.id');
			$data['Order']['confirmed'] = true;
			$data['Order']['confirmed_date'] = date('Y-m-d');
			
			if(!$this->Order->save($data)) {
				$this->errorMsg('Error! Please try again.');
				$this->redirect('/orders/bookOrder');
			} else {
				$this->errorMsg('Success! Order confirmed.');
				$this->redirect('/orders/details/'.$data['Order']['id']);				
			}
		} else {
			$this->errorMsg('Error! OTP not verified.');
			$this->redirect('/orders/confirmPaymentMethod');
		}
	}
	
	public function verifyotp()
	{
		$response = array();
		if($this->request->isPost()) {
			$data = $this->request->data;
			
			//-------------
			$errorMsg = array();
			if(empty($data['otp'])) {
				$errorMsg[] = 'Error! Please enter your OTP.';
			} else {
				if(!($this->Session->check('otp') and ($data['otp'] == $this->Session->read('otp')))) {
					$errorMsg[] = 'Error! Invalid OTP';
				}
			}
			
			if(empty($errorMsg)) {				
				$this->Session->write('otp_verified', true);				
				$session = $this->Session->read();
				$response = $this->getResponse('success', '', $session);
			} else {
				$errorMsg = implode('<br>', $errorMsg);
				$response = $this->getResponse('error', $errorMsg, null);
			}
		} else {
			$response = $this->getResponse('error', 'Invalid request', null);			
		}
		$this->set('response', $response);
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

	public function admin_list()
	{
		$orders = $this->Order->find('all', array('order'=>'Order.id desc'));
		$this->set(compact('orders'));
	}
	
	public function admin_order_details($order_id)
	{
		$order_details = $this->Order->find('first', array('conditions'=>array('Order.id'=>$order_id), 'recursive'=>1));
		$this->set(compact('order_details'));
	}
}







