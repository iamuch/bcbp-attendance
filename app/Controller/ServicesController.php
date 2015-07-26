<?php

/**
* ServicesController
* @author Jovanie Limbagan <vanilimbagan18@gmail.com>
*/

class ServicesController extends AppController {

	public $uses = [
		'Service'
	];
	
	/**
	* display all services
	* search also services by name
	*/

	public function index(){	
		$getData = $this->request->query;
		$name = isset($getData['name']) ? $getData['name'] : null;

		$this->paginate = $this->Service->generateSettingsForPager($name);
		$services = $this->paginate('Service');

		$this->set('name', $name);
		$this->set('services', $services);
	}

	/**
	* add new service
	*/
	 
	public function add() {
		if($this->request->is('post')){	
			$this->Service->create();
			
			$this->request->data['Service']['user_id'] = $this->Auth->user('id');
			if($this->Service->save($this->request->data)){

				$this->Session->setFlash(__('The service has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}
				
			$this->Session->setFlash(
				__('The service could not be saved. Please, try again.'),
				'flash_fail'
			);
		}
	}
	
	/**
	* edit service 
	* @param string|int $id
	*/
	public function edit($id = null) {

		if (!$id){
			return $this->redirect('/services/');
		}

		$services = $this->Service->findById($id);

		if (!$services){
			return $this->redirect('/services/');
		}

		if($this->request->is('post') || $this->request->is('put')){
			$this->request->data['Service']['user_id'] = $this->Auth->user('id');
			if($this->Service->save($this->request->data)){
				$this->Session->setFlash(
					__('The service has been saved'),
					'default', 'flash_success'
				);
				return $this->redirect(['action' => 'index']);
			}
			$this->Session->setFlash(
				__('The service could not be saved. Please, try again.'),
				'default', 
				[
					'class' => 'alert alert-danger'
				]
			);
		}else{
			$this->request->data = $services;
		}
	}
	
	/**
	* delete service 
	* @param string|int $id
	*/
	public function delete() {
		if ($this->request->is('post') || $this->request->is('put')){
			$data['id'] = $this->request->data['Service']['id'];
			$data['user_id'] = $this->Auth->user('id');
			$data['delete_flag'] = 1;
			$this->Service->save($data);
			$this->Session->setFlash(
				__('Service deleted'),
				'flash_success'
			);
			return $this->redirect('/services/');
		} else {
			return $this->redirect('/services/');
		}
	}
}