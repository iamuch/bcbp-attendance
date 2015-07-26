<?php

/**
* ActionGroupsController
* @author Jovanie Limbagan <vanilimbagan18@gmail.com>
*/

class ActionGroupsController extends AppController {

	public $uses = [
		'ActionGroup'
	];
	
	/**
	* display all action groups
	* search also action groups by name
	*/

	public function index(){	
		$getData = $this->request->query;
		$name = isset($getData['name']) ? $getData['name'] : null;

		$this->paginate = $this->ActionGroup->generateSettingsForPager($name);
		$actionGroups = $this->paginate('ActionGroup');

		$this->set('name', $name);
		$this->set('actionGroups', $actionGroups);
	}

	/**
	* add new action groups
	*/
	 
	public function add() {
		if($this->request->is('post')){	
			$this->ActionGroup->create();
			
			$this->request->data['ActionGroup']['user_id'] = $this->Auth->user('id');
			if($this->ActionGroup->save($this->request->data)){

				$this->Session->setFlash(__('The action group has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}

			$this->Session->setFlash(
				__('The action group could not be saved. Please, try again.'),
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
			return $this->redirect('/actionGroups/');
		}

		$actionGroups = $this->ActionGroup->findById($id);

		if (!$actionGroups){
			return $this->redirect('/actionGroups/');
		}

		if($this->request->is('post') || $this->request->is('put')){
			$this->request->data['ActionGroup']['user_id'] = $this->Auth->user('id');
			if($this->ActionGroup->save($this->request->data)){
				$this->Session->setFlash(
					__('The action group has been saved'),
					'default', 'flash_success'
				);
				return $this->redirect(['action' => 'index']);
			}
			$this->Session->setFlash(
				__('The action group could not be saved. Please, try again.'),
				'default', 
				[
					'class' => 'alert alert-danger'
				]
			);
		}else{
			$this->request->data = $actionGroups;
		}
	}
	
	/**
	* delete action group 
	* @param string|int $id
	*/
	public function delete() {
		if ($this->request->is('post') || $this->request->is('put')){
			$data['id'] = $this->request->data['ActionGroup']['id'];
			$data['user_id'] = $this->Auth->user('id');
			$data['delete_flag'] = 1;
			$this->ActionGroup->save($data);
			$this->Session->setFlash(
				__('Action group deleted'),
				'flash_success'
			);
			return $this->redirect('/actionGroups/');
		} else {
			return $this->redirect('/actionGroups/');
		}
	}
}