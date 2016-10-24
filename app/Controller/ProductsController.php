<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController {
	
	/**
	 * Show category wise products
	 *
	 * @param int $category_id	Selected category id. If empty then show all products
	 * @param string $category_name	Name of the selected category 	 
	 */
	public function showCategoryProducts($category_id=null, $category_name=null)
	{	
		$category_details = array();
		if($category_id) {
			App::uses('Category', 'Model');
			$this->Category = new Category;
			$category_details = $this->Category->findById($category_id);
		}
		$category_products = $this->Product->getAllActiveProducts($category_id);		
		$this->set(compact('category_products', 'category_details'));
	}
	
	/**
	 * Show product details
	 *
	 * @param int $category_id	Selected category id
	 * @param int $product_id	Selected product id
	 * @param string $product_name	Name of the selected product
	 */
	public function show($productID=null, $product_name=null)
	{
		if(empty($productID)) {
			$this->errorMsg('Error! Invalid request.');
			$this->redirect('/');
		}
		$this->Product->bindModel(array('hasMany'=>array('Image')));
		$product_details = $this->Product->findById($productID);
		if(empty($product_details)) {			
			$this->errorMsg('Product not found.');
			$this->redirect('/');
		}
		
		$this->set(compact('productID', 'product_details'));		
	}
	
	public function admin_list($categoryID = null)
	{		
		App::uses('Category', 'Model');
		$this->Category = new Category;		
		$categories = $this->Category->find('all', array('order'=>'Category.name asc'));
		
		if(!empty($categoryID)) {
			$products = $this->Product->find('all', array('conditions'=>array('Product.category_id'=>$categoryID)));
		} else {
			$products = $this->Product->find('all', array('order'=>'Product.name asc')); 
		}
		$this->set(compact('categories', 'products', 'categoryID'));
	}
	
	public function admin_add($categoryID = null)
	{
		App::uses('Category', 'Model');
		$this->Category = new Category;
		
		if($this->request->isPost()) {
			$data = $this->request->data;
			$errors = array();
			// form validation
			if(empty($data['Product']['name'])) {
				$errors[] = "Please enter the product name";
			}
			
			if(empty($errors)) {
				$this->Product->create();
				if($this->Product->save($data)) {
					$this->successMsg("Success! Product created successfully.");
					$this->redirect('/products/admin_edit/'.$this->Product->id);
				}
			} else {
				$errors = implode('<br>', $errors);	
				$this->errorMsg($errors);
			}
		}
		
		$categories_list = $this->Category->find('list', array('order'=>'Category.name asc'));
		$this->set(compact('categories_list', 'categoryID'));
	}
	
	public function admin_edit($productID)
	{
		App::uses('Category', 'Model');
		$this->Category = new Category;
		
		if(!empty($productID)) {
			if($this->request->isPut() or $this->request->isPost()) {
				$data = $this->request->data;
				$errors = array();
				// form validation
				if(empty($data['Product']['name'])) {
					$errors[] = "Please enter the product name";
				}
				
				if(empty($errors)) {
					$this->Product->id = $productID;
					if($this->Product->save($data)) {
						$this->successMsg("Success! Product updated successfully.");
						$this->redirect('/products/admin_list');
					}
				} else {
					$errors = implode('<br>', $errors);	
					$this->errorMsg($errors);
					$this->set('data', $data);
				}
			}
			
			$product_details = $this->Product->findById($productID);
			$categories_list = $this->Category->find('list', array('order'=>'Category.name asc'));			
			if(!empty($product_details)) {
				$this->request->data = $product_details;
				$this->set('product_details', $product_details);
				$this->set('categories_list', $categories_list);
			} else {
				$this->errorMsg("Error! Product not found.");
				$this->redirect('/products/admin_list');
			}
		} else {
			$this->errorMsg('Invalid request');
			$this->redirect('/');
		}
	}
	
	public function admin_change_status($productID, $status)
	{
		if(!empty($productID)) {
			if($this->Product->updateStatus($productID, $status)) {
				if($status == 'show') {
					$msg = 'Success! Product will be shown to all users.';						
				} else {
					$msg = 'Success! Product will be hidden to all users.';						
				}
				$this->successMsg($msg);
			} else {
				$this->errorMsg("Error! Product does not exist.");
			}
		} else {
			$this->errorMsg('Invalid request');
		}
		$this->redirect('/products/admin_list');
	}
	
	public function admin_images($productID)
	{
		$errorMsg = null;
		if(!empty($productID)) {
			
			$this->Product->bindModel(array('hasMany'=>array('Image')));
			$product_details = $this->Product->findById($productID);
			
			if(!empty($product_details)) {
				$this->set(compact('product_details'));
			} else {
				$errorMsg = "Error! Product does not exist.";
			}
		} else {
			$errorMsg = "Invalid request";
		}
		
		if($errorMsg) {
			$this->errorMsg('Invalid request');
			$this->redirect('/products/admin_list');
		}
	}
	
	public function admin_upload_images($productID) 
	{		
		set_time_limit(600);
		ini_set('upload_max_filesize', '8M');
		
		App::uses('Image', 'Model');
		$this->Image = new Image;
		
		$this->render = false;
		$errorMsg = array();	
		if(!empty($productID)) {
			$product_details = $this->Product->findById($productID);
			if(!empty($product_details)) {
				if($this->request->isPost()) {
					$data = $this->request->data;
					if(!empty($data['Product']['images'])) {
						if(count($data['Product']['images']) <= 5) {
							// do the validations first.
							foreach($data['Product']['images'] as $row) {							
								if(!$this->Image->isValidImageFile($row)) {
									// Check if image file is a actual image or fake image
									$errorMsg[] = "Error! Invalid image file selected";								
								} elseif (!$this->Image->isValidImageType($row)) {
									// Allow certain file formats. Only PNG and JPG are allowed.
									$errorMsg[] = "Error! Only JPG, JPEG & PNG files are allowed.";
								} elseif (!$this->Image->isValidImageSize($row)) {
									// Check allowed file size
									$errorMsg[] = "Error! Image size cannot be greater than 6 Mb.";
								}							
							}
							
							// if there are no errors then upload the image.
							if(empty($errorMsg)) {
								foreach($data['Product']['images'] as $row) {
									$image_id = $this->Image->saveImageFile($row, $product_details['Product']['name']);
									if($image_id) {
										$this->Image->id = $image_id;
										$this->Image->set('product_id', $product_details['Product']['id']);
										$this->Image->save();
									}
								}
								$this->successMsg("Success! Images uploaded successfully.");
								$this->redirect('/products/admin_images/'.$product_details['Product']['id']);
							}
						} else {
							$errorMsg[] = "Error! Only 5 images are allowed per request.";
						}
						
					} else {
						$errorMsg[] = "Error! No image selected.";
					}
				}
				
			} else {
				$errorMsg[] = "Error! Product does not exist.";
			}
		} else {
			$this->errorMsg("Error! Invalid request");
			$this->redirect('/products/admin_list');
		}
		
		if(!empty($errorMsg)) {
			$errorMsg = implode('<br>', $errorMsg);
			$this->errorMsg($errorMsg);
			$this->redirect('/products/admin_images/'.$productID);
		}
		exit;
	}
	
	function admin_deleteImage($imageID) {
		App::uses('Image', 'Model');
		$this->Image = new Image;
		
		$this->Image->deleteImage($imageID);
		$this->successMsg('Image Deleted Successfully', 'default', array('class'=>'success'));			
		
		$this->redirect($this->request->referer());		
	}
	
}
