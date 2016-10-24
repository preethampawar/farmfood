<?php
App::uses('AppModel', 'Model');

class Product extends AppModel {
	public $belongsTo = array('Category');
	
	public function updateStatus($productID, $status)
	{
		if(!empty($productID)) {
			$product_details = $this->findById($productID);
			if(!empty($product_details)) {
				$this->id = $productID;
				
				if($status == 'show') {
					$this->set('active', true);					
				} else {
					$this->set('active', false);					
				}
				if($this->save()) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}			
		} 
		return false;
	}
	
	public function getFeaturedProducts()
	{
		$this->bindModel(array('hasMany'=>array('Image')));
		$products = $this->find('all', array('conditions'=>array('Product.active'=>1, 'Product.featured'=>1), 'order'=>array('Product.name')));
		return $products;
	}
	
	public function getAllActiveProducts($categoryID = null)
	{		
		$this->bindModel(array('hasMany'=>array('Image')));
		
		if($categoryID) {
			$category_products = $this->find('all', array('conditions'=>array('Product.active'=>1, 'Product.category_id'=>$categoryID), 'order'=>array('Product.name')));
		} else {
			$category_products = $this->find('all', array('conditions'=>array('Product.active'=>1), 'order'=>array('Product.name')));
		}
		return $category_products;
	}
}