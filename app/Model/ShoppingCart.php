<?php
App::uses('AppModel', 'Model');

class ShoppingCart extends AppModel {
	public $hasMany = array('ShoppingCartProduct');

	public function checkIfProductIsInCart($shopping_cart_id, $product_id)
	{
		App::uses('ShoppingCartProduct', 'Model');
		$this->ShoppingCartProduct = new ShoppingCartProduct;

		return $this->ShoppingCartProduct->find('first', array('conditions'=>array('ShoppingCartProduct.shopping_cart_id'=>$shopping_cart_id, 'ShoppingCartProduct.product_id'=>$product_id)));
	}

	public function addProductToCart($shopping_cart_id, $quantity, $product_id, $category_id)
	{
		$data['ShoppingCartProduct']['id'] = null;
		$data['ShoppingCartProduct']['shopping_cart_id'] = $shopping_cart_id;
		$data['ShoppingCartProduct']['quantity'] = $quantity;
		$data['ShoppingCartProduct']['product_id'] = $product_id;
		$data['ShoppingCartProduct']['category_id'] = $category_id;

		App::uses('ShoppingCartProduct', 'Model');
		$this->ShoppingCartProduct = new ShoppingCartProduct;

		if($this->ShoppingCartProduct->save($data)) {
			return $this->ShoppingCartProduct->read();
		} else {
			return false;
		}
	}

	public function getProductsCountInCart($shopping_cart_id)
	{
		$cart_items = $this->findById($shopping_cart_id);
		if(!empty($cart_items)) {
			return count($cart_items['ShoppingCartProduct']);
		}

		return 0;
	}
	
	public function getProductsQtyCountInCart($shopping_cart_id)
	{		
		$cart_items = $this->find('first', array('conditions'=>array('id'=>$shopping_cart_id), 'recursive'=>2));

		$qty_count = 0;
		if(!empty($cart_items)) {
			foreach ($cart_items['ShoppingCartProduct'] as $row) {
				$qty_count += $row['quantity'];
			}
		}
		return $qty_count;
		
	}

	public function getCartProducts($shopping_cart_id)
	{
		return $this->find('first', array('conditions'=>array('id'=>$shopping_cart_id), 'recursive'=>2));
	}

	public function getCartTotalAmount($shopping_cart_id)
	{		
		$cart_items = $this->find('first', array('conditions'=>array('id'=>$shopping_cart_id), 'recursive'=>2));

		$total_amt = 0;
		if(!empty($cart_items)) {
			foreach ($cart_items['ShoppingCartProduct'] as $row) {
				$total_amt += $row['Product']['selling_price'] * $row['quantity'];
			}
		}
		return $total_amt;
	}


}