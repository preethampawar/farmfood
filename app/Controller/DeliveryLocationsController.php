<?php
class DeliveryLocationsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
    }
	
	public function admin_list()
	{
		$this->set('delivery_locations', $this->DeliveryLocation->find('all'));	
	}
	
	public function admin_add() 
	{	
        if ($this->request->is('post')) {
			$data = $this->request->data;
            $this->DeliveryLocation->create();
			$this->DeliveryLocation->set($data);
			
			if ($this->DeliveryLocation->save($data)) {
				$this->SuccessMsg('Location added successfully.');
			} else {
				$this->errorMsg('Could not save delivery location.');
			}
		}
		$this->redirect('/delivery_locations/admin_list');
    }
	
	function admin_edit($delivery_location_id)
	{
		if ($this->request->is('post') or $this->request->is('put')) {
			$data = $this->request->data;
            $this->DeliveryLocation->id = $delivery_location_id;
			
			if ($this->DeliveryLocation->save($data)) {
				$this->SuccessMsg('Location updated successfully.');
				$this->redirect('/delivery_locations/admin_list');
			} else {
				$this->errorMsg('Location could not be updated.');
			}
		}
		
		$this->set('delivery_location', $this->DeliveryLocation->findById($delivery_location_id));	
	}
	
	function admin_delete($delivery_location_id)
	{
		$this->DeliveryLocation->id = $delivery_location_id;
		if( $this->DeliveryLocation->delete() ) {
			$this->SuccessMsg('Location deleted successfully.');
		} else {
			$this->errorMsg('Location could not be deleted.');
		}
		$this->redirect('/delivery_locations/admin_list');
	}
	
}