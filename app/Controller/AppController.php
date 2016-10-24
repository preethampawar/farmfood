<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $components = array(
        'Session',
		'CommonFunctions',
		'RequestHandler'
    );
	
	public $helpers = array('Html', 'Form', 'Session', 'Number', 'Text', 'Img', 'Order');

    public function beforeFilter() {
        
		// detect and authenticate admin requests		
		$action = $this->action;
		$tmp = explode('_', $action);
		if($tmp[0] ==  'admin') {
			$error_msg = null;
			
			// if user is not logged in
			if(!$this->Session->check('User')) {
				$error_msg = 'Error! Unauthorized access.';
			}		
			
			// if user is logged in and is not admin			
			if($this->Session->check('User')) {
				$admin = $this->Session->read('User.admin');				
				if(!$admin) {
					$error_msg = 'Error! Unauthorized access.';
				}
			} 
			
			if(!empty($error_msg)) {
				$this->errorMsg($error_msg);
				$this->redirect('/');
			} else {
				// if user is admin then load admin layout
				$this->layout = 'admin';
			}
		}
		
		if($this->request->isAjax()) {
			$this->layout = false;
		}
	}
	
	public function errorMsg($msg) {
		if($msg) {
			$this->Session->setFlash($msg, 'default', array('class' => 'alert alert-danger'));
		}
		return true;
	}
	public function noticeMsg($msg) {
		if($msg) {
			$this->Session->setFlash($msg, 'default', array('class' => 'alert alert-notice'));
		}
		return true;
	}
	public function successMsg($msg) {
		if($msg) {
			$this->Session->setFlash($msg, 'default', array('class' => 'alert alert-success'));
		}
		return true;
	}
	
	/** Function to generate json response */
	public function getResponse($status, $message=null, $data=null)
	{
		$response = array('response'=>array(
										'status'=>$status, 
										'message'=>$message, 
										'data'=>$data));
		return $response;
	}
	
	/**
	 * Function to send sms
	 *
	 * @param array $mobile_numbers contains array of mobile numbers to which msg is to be sent
	 * @param string contains message to be sent
	 *
	 * @return array
	 */
	
	public function sendSMS($mobile_numbers, $message)
	{
		//Your authentication key
		$authKey = "124803AeXGLZz757ee08da";

		//Multiple mobiles numbers separated by comma
		$mobileNumber = implode(',', $mobile_numbers);		

		//Sender ID,While using route4 sender id should be 6 characters long.
		$senderId = "eNursery";

		//Your message to send, Add URL encoding here.
		$message = urlencode($message);

		//Define route 
		$route = "4";
		//Prepare you post parameters
		$postData = array(
			'authkey' => $authKey,
			'mobiles' => $mobileNumber,
			'message' => $message,
			'sender' => $senderId,
			'route' => $route
		);

		//API URL
		$url="https://control.msg91.com/api/sendhttp.php";

		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
			//,CURLOPT_FOLLOWLOCATION => true
		));


		//Ignore SSL certificate verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


		$error = null;		
		//get response
		$output = curl_exec($ch);
		
		
		//Print error if any
		if(curl_errno($ch))
		{
			$error = 'error:' . curl_error($ch);
		}
		curl_close($ch);

		$response['error'] = $error;
		$response['output'] = $output;
		
		return $response;
	}
	
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
