<?php
App::uses('AppHelper', 'View/Helper');
class OrderHelper extends AppHelper
{
	var $helpers = array('Html', 'Session');
	
	public function getOrderStatus($row)
	{
		$order_status = 'Unknown';
		if($row['Order']['booked']) {
			$order_status = 'booked';
			if($row['Order']['confirmed']) {
				$order_status = 'confirmed';
				if($row['Order']['delivered']) {
					$order_status = 'delivered';
				} else if($row['Order']['cancelled']) {
					$order_status = 'cancelled';						
				}
				
				if($row['Order']['closed']) {
					$order_status = 'closed';						
				}
			}
		}
		return $order_status;
	}
}
?>