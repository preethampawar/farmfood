<?php
App::uses('AppModel', 'Model');

class ShoppingCartProduct extends AppModel {
	
	public $belongsTo = array('Product', 'Category');
}