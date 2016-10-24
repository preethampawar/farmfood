<?php
App::uses('AppController', 'Controller');

class CategoriesController extends AppController {
	
	public function admin_add()
	{
		if($this->request->isPost()) {
			$referer = $this->request->referer();
			$data = $this->request->data;
			$errors = array();
			// form validation
			if(empty($data['Category']['name'])) {
				$errors[] = "Please enter the category name";
			}
			
			if(empty($errors)) {
				$this->Category->create();
				if($this->Category->save($data)) {
					$this->successMsg("Success! Category created successfully.");
				} else {
					$this->errorMsg("Error! Connection problem.");
				}
			} else {
				$errors = implode('<br>', $errors);	
				$this->errorMsg($errors);
			}
		} else {
			$this->errorMsg("Error! Invalid request");
		}
		$this->redirect($referer);
		
		$this->render =  false;
	}
	
	public function admin_edit($categoryID)
	{
		if($this->request->isPost()) {
			$referer = $this->request->referer();
			$data = $this->request->data;
			$errors = array();
			// form validation
			if(empty($data['Category']['name'])) {
				$errors[] = "Please enter the category name";
			}
			
			if(empty($errors)) {
				$this->Category->id = $categoryID;
				if($this->Category->save($data)) {
					$this->successMsg("Success! Category updated successfully.");
				} else {
					$this->errorMsg("Error! Connection problem.");
				}
			} else {
				$errors = implode('<br>', $errors);	
				$this->errorMsg($errors);
			}
		} else {
			$this->errorMsg("Error! Invalid request");
		}
		$this->redirect($referer);
		
		$this->render =  false;
	}
	
	public function admin_change_status($categoryID, $status)
	{
		if(!empty($categoryID)) {
			if($this->Category->updateStatus($categoryID, $status)) {
				if($status == 'show') {
					$msg = 'Success! Category will be shown to all users.';						
				} else {
					$msg = 'Success! Category will be hidden to all users.';						
				}
				$this->successMsg($msg);
			} else {
				$this->errorMsg("Error! Category does not exist.");
			}
		} else {
			$this->errorMsg('Invalid request');
		}
		$this->redirect('/products/admin_list');
	}
}
