<?php
App::uses('AppController', 'Controller');

class ShoppingCartsController extends AppController {
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		// set shopping cart id in session (if shopping cart details are not set in session)
		if(!$this->Session->check('ShoppingCart.id')) {
			$this->ShoppingCart->create();
			
			if($this->Session->check('User.id')) {
				$this->ShoppingCart->set('user_id', $this->Session->read('User.id'));
			} else {
				$this->ShoppingCart->set('user_id', null);				
			}
			
			if($this->ShoppingCart->save()) {
				$shopping_cart_details = $this->ShoppingCart->read();
				$this->Session->write('ShoppingCart', $shopping_cart_details['ShoppingCart']);
			} else {
				if($this->request->isAjax()) {
					$response = $this->getResponse('error', 'Error! Connection problem.', null);
					echo json_encode($response);
					exit;
				} else {
					$this->errorMsg('Error! Connection problem.');
					$this->redirect($this->request->referer());
				}
			}
		}
	}
	
	public function add()
	{
		$this->layout = false;	
		$response = array();
		$shopping_cart_id = $this->Session->read('ShoppingCart.id');
		if($this->request->isPost()) {
			$data = $this->request->data;
			$data['ShoppingCartProduct']['shopping_cart_id'] = $shopping_cart_id;
			
			// check if product exists
			App::uses('Product', 'Model');
			$this->Product = new Product;
			$product_details = $this->Product->findById($data['ShoppingCartProduct']['product_id']);
			if(!empty($product_details)) {
				$data['ShoppingCartProduct']['category_id'] = $product_details['Product']['category_id'];
				
				// check if the product exists in the cart
				$cart_product = $this->ShoppingCart->checkIfProductIsInCart($shopping_cart_id, $product_details['Product']['id']);
				if(!empty($cart_product)) {
					// update product quantity
					$prev_qty = $cart_product['ShoppingCartProduct']['quantity'];
					$new_qty = $prev_qty + $data['ShoppingCartProduct']['quantity'];
					$cart_product['ShoppingCartProduct']['quantity'] = $new_qty;
					
					App::uses('ShoppingCartProduct', 'Model');
					$this->ShoppingCartProduct = new ShoppingCartProduct;
					if($this->ShoppingCartProduct->save($cart_product)) {
						$items_count = $this->ShoppingCart->getProductsCountInCart($shopping_cart_id);
						$qty_count = $this->ShoppingCart->getProductsQtyCountInCart($shopping_cart_id);
						$response = $this->getResponse('success', 'Success! Product added to shopping cart.', array('cart_items_count'=>$items_count, 'cart_qty_count'=>$qty_count)); 
					} else {
						$response = $this->getResponse('error', 'Error! Please retry again.', null); 
					}
					
				} else {
					// if new product then add product to shopping cart
					$new_product_in_cart = $this->ShoppingCart->addProductToCart($shopping_cart_id, $data['ShoppingCartProduct']['quantity'], $product_details['Product']['id'], $product_details['Product']['category_id']);
					if($new_product_in_cart) {
						$items_count = $this->ShoppingCart->getProductsCountInCart($shopping_cart_id);
						$qty_count = $this->ShoppingCart->getProductsQtyCountInCart($shopping_cart_id);
						$response = $this->getResponse('success', 'Success! Product added to shopping cart.', array('cart_items_count'=>$items_count, 'cart_qty_count'=>$qty_count)); 
					} else {
						$response = $this->getResponse('error', 'Error! Please try again.', null); 
					}
				}
				
			} else {
				$response = $this->getResponse('error', 'Error! Product not found.', null); 
			}
			
		} else {
			$response = $this->getResponse('error', 'Error! Invalid request.', null); 
		}
		
		$this->set('response', $response);
	}
	
	public function updateQuantity()
	{		
		$this->layout = false;	
		$response = array();
		$shopping_cart_id = $this->Session->read('ShoppingCart.id');
		if($this->request->isPost()) {
			App::uses('ShoppingCartProduct', 'Model');
			$this->ShoppingCartProduct = new ShoppingCartProduct;

			$data = $this->request->data;
			$data['ShoppingCartProduct']['shopping_cart_id'] = $shopping_cart_id;			
			
			// check if the product exists in the cart
			$cart_product = $this->ShoppingCartProduct->findById($data['ShoppingCartProduct']['id']);
			if(!empty($cart_product)) {
				// update product quantity				
				$cart_product['ShoppingCartProduct']['quantity'] = $data['ShoppingCartProduct']['quantity'];				
				
				if($this->ShoppingCartProduct->save($cart_product)) {
					$items_count = $this->ShoppingCart->getProductsCountInCart($shopping_cart_id);
					$qty_count = $this->ShoppingCart->getProductsQtyCountInCart($shopping_cart_id);
					$response = $this->getResponse('success', 'Success! Quantity updated.', array('cart_items_count'=>$items_count, 'cart_qty_count'=>$qty_count)); 
				} else {
					$response = $this->getResponse('error', 'Error! Please try again.', null); 
				}
				
			} else {				
				$response = $this->getResponse('error', 'Error! Invalid request.', null);
			}			
		} else {
			$response = $this->getResponse('error', 'Error! Invalid request.', null); 
		}
		
		$this->set('response', $response);
	}
	
	public function show()
	{
		$shopping_cart_id = $this->Session->read('ShoppingCart.id');
		$cart_items = $this->ShoppingCart->getCartProducts($shopping_cart_id);
		
		$total_amount = $this->ShoppingCart->getCartTotalAmount($shopping_cart_id);
		$qty_count = $this->ShoppingCart->getProductsQtyCountInCart($shopping_cart_id);
		$this->set(compact('cart_items', 'total_amount', 'qty_count'));
	}
	
	public function remove($shopping_cart_product_id)
	{
		App::uses('ShoppingCartProduct', 'Model');
		$this->ShoppingCartProduct = new ShoppingCartProduct;
		$this->ShoppingCartProduct->id = $shopping_cart_product_id;
		if($this->ShoppingCartProduct->delete()) {
			$this->successMsg('Success! Product has been removed from the cart.');
		} else {
			$this->successMsg('Error! Please try again.');			
		}
		$this->redirect($this->request->referer());			
	}
}
