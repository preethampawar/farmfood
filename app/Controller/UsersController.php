<?php
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }
	
	public function add() {
		$this->layout = false;	
		
        if ($this->request->is('post')) {
			$data = $this->request->data;
            $this->User->create();
			$this->User->set($data);
			
			$errors = null;
			if ($this->User->save($data)) {	
				$user_info = $this->User->findById($this->User->id);
				$this->Session->write('User', $user_info['User']);					
				
				// send success email to user
				$user_info['User']['password'] = $data['User']['password'];
				$this->sendRegistrationSuccessEmail($user_info);
				
				$response = $this->getResponse('success', 'Registration successfull', null);
			} else {  
				if(isset($this->User->validationErrors['name'][0])) {
					$errors[] = $this->User->validationErrors['name'][0];
				}
				if(isset($this->User->validationErrors['email'][0])) {
					$errors[] = $this->User->validationErrors['email'][0];
				}
				if(isset($this->User->validationErrors['mobile'][0])) {
					$errors[] = $this->User->validationErrors['mobile'][0];
				}
				if(isset($this->User->validationErrors['password'])) {
					$errors[] = 'Password not valid';
				}
			}
			
			if(!empty($errors)) {
				$errors = implode(', ', $errors);
				$response = $this->getResponse('error', $errors, null);               
			}			
        } else {
			$response = $this->getResponse('error', 'Invalid request', null); 
		}
		$this->set('response', $response);
    }
	
	public function sendRegistrationSuccessEmail($user_info)
	{
		// send registration success email to user
		App::uses('CakeEmail', 'Network/Email');	
		$Email = new CakeEmail();
		$Email->template('registration', 'default')
			->emailFormat('both')
			->to($user_info['User']['email'], $user_info['User']['name'])
			->from('no-reply@enursery.in', 'Farm Food')
			->bcc('support@enursery.in', 'Support - Farm Food')
			->subject('Registration - Farm Food')
			->viewVars(array('user_info'=>$user_info));
		$Email->send();
	}
	
	public function login() {		
		$this->layout = false;
		
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$user_info = $this->User->findByEmail($data['User']['email']);
			
			if(!empty($user_info)) {
				if($user_info['User']['password'] == md5($data['User']['password'])) {
					$this->Session->write('User', $user_info['User']);
					$redirect_url = $this->request->referer();
					$response = $this->getResponse('success', 'Authentication successfull', array('redirect_url'=>$redirect_url));
				} else {
					$response = $this->getResponse('error', 'Authentication failed', null);
				}
			} else {
				$response = $this->getResponse('error', 'User does not exits', null);
			}
		} else {
			$response = $this->getResponse('error', 'Invalid request', null); 
		}
		$this->set('response', $response);
	}
	
	public function sendPasswordResetLink()
	{
		$this->layout = false;
		
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$user_info = $this->User->findByEmail($data['User']['email']);
			
			if(!empty($user_info)) {
				// get 1 week time frame
				$time_frame = date('Y-m-d', strtotime("+7 day"));
				$time_frame = strtotime($time_frame); // unix time stamp
				
				// create link
				$user_id = base64_encode($user_info['User']['id']);
				$user_email = base64_encode($user_info['User']['email']);
				$time_frame = base64_encode($time_frame);
				
				//save reset link
				$link = '/users/resetPassword/'.$user_id.'/'.$user_email.'/'.$time_frame;				
				$linkData['User']['id'] = $user_info['User']['id'];
				$linkData['User']['reset_link'] = $link;				
				if($this->User->save($linkData)) {				
					$this->sendPasswordResetLinkEmail($user_info, $link);
				} else {
					$response = $this->getResponse('error', 'Connection error.', null);
				}
			} else {
				$response = $this->getResponse('error', 'User does not exits', null);
			}
		} else {
			$response = $this->getResponse('error', 'Invalid request', null); 
		}
		$this->set('response', $response);
	}
	
	public function sendPasswordResetLinkEmail($user_info, $link)
	{
		// send reset password link email to user
		App::uses('CakeEmail', 'Network/Email');	
		$Email = new CakeEmail();
		$Email->template('reset_password_link', 'default')
			->emailFormat('both')
			->to($user_info['User']['email'], $user_info['User']['name'])
			->from('no-reply@enursery.in', 'Farm Food')
			->bcc('support@enursery.in', 'Support - Farm Food')
			->subject('Password Reset Link - Farm Food')
			->viewVars(array('user_info'=>$user_info, 'link'=>$link));
		$Email->send();
	}
	
	public function resetPassword($encoded_user_id, $encoded_user_email, $encoded_time_frame)
	{
		$request_link = $this->request->here;
		$user_id = base64_decode($encoded_user_id);
		$user_email = base64_decode($encoded_user_email);	
		$time_frame = base64_decode($encoded_time_frame);		
		$current_date = strtotime(date('Y-m-d'));
		
		$validation_error = false;
		$user_info = $this->User->findByEmail($user_email);
		if(!empty($user_info)) {
			if($current_date > $time_frame) {
				$validation_error = true;
				$this->errorMsg('Your password reset link has been expired.');
			}
			
			if($user_info['User']['reset_link'] != $request_link) {
				$validation_error = true;
				$this->errorMsg('Your request link is already processed. Please raise a new request for Password Reset.');
			}
			
		} else {
			$validation_error = true;	
			$this->errorMsg('Invalid User.');
		}
		
		if($validation_error) {
			$this->redirect('/');
		}
		
		if ($this->request->is('post')) {
			$data = $this->request->data;				
			
			if(empty($data['User']['password'])) {
				$this->errorMsg('Password field cannot be empty.');
			}
			else if($data['User']['password'] != $data['User']['confirm_password']) {
				$this->errorMsg('New Password and Confirm Password values do not match.');
			} else {
				$this->User->id = $user_info['User']['id'];
				$user_info['User']['password'] = $data['User']['password'];
				$user_info['User']['reset_link'] = null;
				
				if ($this->User->save($user_info)) {					
					// send success email to user
					$user_info['User']['password'] = $data['User']['password'];
					
					$this->sendPasswordResetSuccessEmail($user_info);
					
					$this->successMsg('Password reset successful.');
					$this->redirect('/');
				} else {
					if(isset($this->User->validationErrors['password'])) {							
						$this->errorMsg('Password not valid');
					}
				}				
			}
		}
		
	}
	
	public function changePassword()
	{
		if($this->Session->check('User.id')) {
			$user_data['User'] = $this->Session->read('User');
			
			if ($this->request->is('post')) {			
				$data = $this->request->data;
				$errors = array();
				
				if($user_data['User']['password'] != md5($data['User']['old_password'])) {					
					$errors[] = 'Old Password is not valid';
				}
				if(empty($data['User']['old_password'])) {
					$errors[] = 'Old Password field cannot be empty';
				}
				if(empty($data['User']['new_password'])) {
					$errors[] = 'New Password field cannot be empty';
				}
				if($data['User']['new_password'] != $data['User']['confirm_password']) {
					$errors[] = 'New Password and Re-enter Password field values do not match';					
				}
				
				if(empty($errors)) {
					
					$user_data['User']['password'] = $data['User']['new_password'];
					if($this->User->save($user_data)) {
						$this->Session->write('User.password', md5($user_data['User']['password']));
						//send password reset email
						$this->sendPasswordResetSuccessEmail($user_data);
						
						$response = $this->getResponse('success', 'Success! - Your password has been modified.', null);
					} else {
						$response = $this->getResponse('error', 'Error! - Connection problem.', null);
					}
				} else {
					$errors = implode(', ', $errors);
					$response = $this->getResponse('error', $errors, null); 
				}
				
			} else {
				$response = $this->getResponse('error', 'Error! - Invalid request', null);
			}
		} else {
			$response = $this->getResponse('error', 'Error! - Session expired. You need to sign in to change password.', null);			
		}
		$this->set('response', $response);
	}
	
	public function sendPasswordResetSuccessEmail($user_info)
	{
		// send reset password link email to user
		App::uses('CakeEmail', 'Network/Email');	
		$Email = new CakeEmail();
		$Email->template('reset_password_success', 'default')
			->emailFormat('both')
			->to($user_info['User']['email'], $user_info['User']['name'])
			->from('no-reply@enursery.in', 'Farm Food')
			->bcc('support@enursery.in', 'Support - Farm Food')
			->subject('Password Reset - Farm Food')
			->viewVars(array('user_info'=>$user_info));
		$Email->send();
	}
	
	public function contact()
	{
		if ($this->request->is('post')) {			
			$data = $this->request->data;
			$errors = array();
			if(empty($data['Message']['from_name'])) {
				$errors[] = 'Full name cannot be empty';
			}
			if(empty($data['Message']['from_email']) and (empty($data['Message']['from_mobile']))) {
				$errors[] = 'Email address or Moblie number is required';
			}
			if(empty($data['Message']['message'])) {
				$errors[] = 'Message field cannot be empty';
			}
			
			if(!empty($errors)) {
				$errors = implode(', ', $errors);
				$response = $this->getResponse('error', $errors, null);               
			} else {
				App::uses('Message', 'Model');
				$this->Message = new Message;
				
				if($this->Message->save($data)) {
					// send email to admin
					$this->sendContactEmail($data);					
					$response = $this->getResponse('success', 'Your message has been sent successfully', null);
				}
			}
		} else {
			$response = $this->getResponse('error', 'Invalid request', null);
		}
		$this->set('response', $response);
	}
	
	public function sendContactEmail($data)
	{
		// send reset password link email to user
		App::uses('CakeEmail', 'Network/Email');	
		$Email = new CakeEmail();
		$Email->template('contact_us_email', 'default')
			->emailFormat('both')
			->to('support@enursery.in', 'Support - Farm Food')
			->from('no-reply@enursery.in', 'Farm Food')
			->bcc('preetham.pawar@enursery.in', 'Preetham Pawar')
			->subject('Contact us - Farm Food')
			->viewVars(array('data'=>$data));
		$Email->send();
	}
	
	
	public function logout() {
		$this->Session->delete('User');
		$this->Session->destroy();
		$this->redirect('/');
	}
	// ---------------------------------------------------------------------------------------------------
	
	public function admin() {
		
	}
	
	


    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
    }

    

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}