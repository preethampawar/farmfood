<?php
class Order extends AppModel {
	public $belongsTo = array('ShoppingCart', 'User', 'DeliveryLocation');
	public $hasMany = array('OrderProduct');
}