<?php

/**
* UnitsController
* @author Jovanie Limbagan <vanilimbagan18@gmail.com>
*/

class UnitsController extends AppController {

	public $uses = [
		'Unit'
	];
	
	/**
	* display all subcategory 1
	* search also subcategory 1 by name
	*/

	public function index(){	
		$getData = $this->request->query;
		$name = isset($getData['name']) ? $getData['name'] : null;

		$this->paginate = $this->Unit->generateSettingsForPager($name);
		$units = $this->paginate('Unit');

		$this->set('name', $name);
		$this->set('units', $units);
	}

	/**
	* add new subcategory 1
	*/
	 
	public function add() {
		if($this->request->is('post')){	
			$this->Unit->create();
			
			$this->request->data['Unit']['user_id'] = $this->Auth->user('id');
			if($this->Unit->save($this->request->data)){

				$this->Session->setFlash(__('The unit has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}

			$this->Session->setFlash(
				__('The unit could not be saved. Please, try again.'),
				'flash_fail'
			);
		}
	}
	
	/**
	* edit subcategory1 
	* @param string|int $id
	*/
	public function edit($id = null) {

		if (!$id){
			return $this->redirect('/units/');
		}

		$units = $this->Unit->findById($id);

		if (!$units){
			return $this->redirect('/units/');
		}

		if($this->request->is('post') || $this->request->is('put')){
			$this->request->data['Unit']['user_id'] = $this->Auth->user('id');
			if($this->Unit->save($this->request->data)){
				$this->Session->setFlash(
					__('The unit has been saved'),
					'default', 
					[
						'class' => 'alert alert-success'
					]
				);
				return $this->redirect(['action' => 'index']);
			}
			$this->Session->setFlash(
				__('The unit could not be saved. Please, try again.'),
				'default', 
				[
					'class' => 'alert alert-danger'
				]
			);
		}else{
			$this->request->data = $units;
		}
	}
	
	/**
	* delete unit 
	* @param string|int $id
	*/
	public function delete() {
		if ($this->request->is('post') || $this->request->is('put')){
			$data['id'] = $this->request->data['Unit']['id'];
			$data['user_id'] = $this->Auth->user('id');
			$data['delete_flag'] = 1;
			$this->Unit->save($data);
			$this->Session->setFlash(
				__('Unit deleted'),
				'flash_success'
			);
			return $this->redirect('/units/');
		} else {
			return $this->redirect('/units/');
		}
	}
}