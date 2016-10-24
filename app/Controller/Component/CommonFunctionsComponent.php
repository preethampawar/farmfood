<?php
App::uses('Component', 'Controller');
class CommonFunctionsComponent extends Component {
    var $components = array('Session');
	
	/** Function to get Product Category info **/
	public function getProductCategoryInfo($productCategoryID=null) {	
		App::uses('ProductCategory', 'Model');
		$this->ProductCategory = new ProductCategory;
		
		if(!$productCategoryID) {
			return array();
		}
		else {
			$conditions = array('ProductCategory.id'=>$productCategoryID, 'ProductCategory.store_id'=>$this->Session->read('Store.id'));
			if($productCategoryInfo = $this->ProductCategory->find('first', array('conditions'=>$conditions))) {
				return $productCategoryInfo;
			}
		}
		return array();
	}
	
	/** Function to get Product info **/
	public function getProductInfo($productID=null, $categoryID=null) {
		App::uses('Product', 'Model');
		$this->Product = new Product;
		
		if(!$productID) {
			return array();
		}
		else {
			if($categoryID) {
				$conditions = array('Product.id'=>$productID, 'Product.product_category_id'=>$categoryID, 'Product.store_id'=>$this->Session->read('Store.id'));
			}
			else {
				$conditions = array('Product.id'=>$productID, 'Product.store_id'=>$this->Session->read('Store.id'));			
			}
			
			if($productInfo = $this->Product->find('first', array('conditions'=>$conditions))) {
				return $productInfo;
			}
		}
		return array();
	}
	
	
}