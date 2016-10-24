<?php
App::uses('AppModel', 'Model');

class Category extends AppModel {
	
	public function updateStatus($categoryID, $status)
	{
		if(!empty($categoryID)) {
			$category_details = $this->findById($categoryID);
			if(!empty($category_details)) {
				$this->id = $categoryID;				
				
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
	
	public function getAllActiveProducts($categoryID = null)
	{		
		$this->bindModel(array('hasMany'=>array('Product'=>array('conditions'=>array('Product.active'=>1), 'order'=>array('Product.priority', 'Product.name')))));
		
		if($categoryID) {
			$category_products = $this->find('all', array('conditions'=>array('Category.active'=>1, 'Category.id'=>$categoryID), 'order'=>array('Category.name')));
		} else {
			$category_products = $this->find('all', array('conditions'=>array('Category.active'=>1), 'order'=>array('Category.name')));			
		}
		
		return $category_products;
	}
}