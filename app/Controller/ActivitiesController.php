<?php

/**
* ActivitiesController
* @author Jovanie Limbagan <vanilimbagan18@gmail.com>
*/

class ActivitiesController extends AppController {

	public $uses = [
		'Activity'
	];
	
	/**
	* display all activities
	* search also activities by name
	*/

	public function index(){	
		$getData = $this->request->query;
		$name = isset($getData['name']) ? $getData['name'] : null;

		$this->paginate = $this->Activity->generateSettingsForPager($name);
		$activities = $this->paginate('Activity');

		$this->set('name', $name);
		$this->set('activities', $activities);
	}

	/**
	* add new activities
	*/
	 
	public function add() {
		if($this->request->is('post')){	
			$this->Activity->create();
			
			$this->request->data['Activity']['user_id'] = $this->Auth->user('id');
			if($this->Activity->save($this->request->data)){

				$this->Session->setFlash(__('The activity has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}

			$this->Session->setFlash(
				__('The activity could not be saved. Please, try again.'),
				'flash_fail'
			);
		}
	}
	
	/**
	* edit action group 
	* @param string|int $id
	*/
	public function edit($id = null) {

		if (!$id){
			return $this->redirect('/activities/');
		}

		$activities = $this->Activity->findById($id);

		if (!$activities){
			return $this->redirect('/activities/');
		}

		if($this->request->is('post') || $this->request->is('put')){
			$this->request->data['Activity']['user_id'] = $this->Auth->user('id');
			if($this->Activity->save($this->request->data)){
				$this->Session->setFlash(
					__('The activity has been saved'),
					'default', 'flash_success'
				);
				return $this->redirect(['action' => 'index']);
			}
			$this->Session->setFlash(
				__('The activity could not be saved. Please, try again.'),
				'default', 
				[
					'class' => 'alert alert-danger'
				]
			);
		}else{
			$this->request->data = $activities;
		}
	}
	
	/**
	* delete action group 
	* @param string|int $id
	*/
	public function delete() {
		if ($this->request->is('post') || $this->request->is('put')){
			$data['id'] = $this->request->data['Activity']['id'];
			$data['user_id'] = $this->Auth->user('id');
			$data['delete_flag'] = 1;
			$this->Activity->save($data);
			$this->Session->setFlash(
				__('Activity deleted'),
				'flash_success'
			);
			return $this->redirect('/activities/');
		} else {
			return $this->redirect('/activities/');
		}
	}
}