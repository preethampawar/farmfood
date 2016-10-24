<?php
App::uses('AppModel', 'Model');

class DeliveryLocation extends AppModel {

	public function getActiveLocations()
	{
		$conditions = array('DeliveryLocation.active'=>true);
		return $this->find('all', array('conditions'=>$conditions, 'order'=>array('DeliveryLocation.name')));
	}
	
	public function getFreeActiveLocations()
	{
		$conditions = array('DeliveryLocation.free_delivery'=>true, 'DeliveryLocation.active'=>true);
		return $this->find('all', array('conditions'=>$conditions, 'order'=>array('DeliveryLocation.name')));
	}
	
	public function getPaidActiveLocations()
	{
		$conditions = array('DeliveryLocation.free_delivery'=>false, 'DeliveryLocation.active'=>true);
		return $this->find('all', array('conditions'=>$conditions, 'order'=>array('DeliveryLocation.name')));
	}
}