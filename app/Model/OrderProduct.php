<?php
App::uses('AppModel', 'Model');

class OrderProduct extends AppModel {
	public $hasMany = array('OrderProduct');
	public $belongsTo = array('Product');
	
	public function getOrderProducts($order_id)
	{
		return $this->find('first', array('conditions'=>array('id'=>$order_id), 'recursive'=>2));
	}
}