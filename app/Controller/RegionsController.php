<?php

/**
* RegionsController
* @author Jovanie Limbagan <vanilimbagan18@gmail.com>
*/

class RegionsController extends AppController {

	public $uses = [
		'Region'
	];
	
	/**
	* display all region
	* search also region by name
	*/

	public function index(){	
		$getData = $this->request->query;
		$name = isset($getData['name']) ? $getData['name'] : null;

		$this->paginate = $this->Region->generateSettingsForPager($name);
		$regions = $this->paginate('Region');

		$this->set('name', $name);
		$this->set('regions', $regions);
	}

	/**
	* add new region
	*/
	 
	public function add() {
		if($this->request->is('post')){	
			$this->Region->create();
			
			$this->request->data['Region']['user_id'] = $this->Auth->user('id');
			if($this->Region->save($this->request->data)){

				$this->Session->setFlash(__('The region has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}

			$this->Session->setFlash(
				__('The region could not be saved. Please, try again.'),
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
			return $this->redirect('/regions/');
		}

		$regions = $this->Region->findById($id);

		if (!$regions){
			return $this->redirect('/regions/');
		}

		if($this->request->is('post') || $this->request->is('put')){
			$this->request->data['Region']['user_id'] = $this->Auth->user('id');
			if($this->Region->save($this->request->data)){
				$this->Session->setFlash(
					__('The region has been saved'),
					'default', 'flash_success'
				);
				return $this->redirect(['action' => 'index']);
			}
			$this->Session->setFlash(
				__('The region could not be saved. Please, try again.'),
				'default', 
				[
					'class' => 'alert alert-danger'
				]
			);
		}else{
			$this->request->data = $regions;
		}
	}
	
	/**
	* delete region 
	* @param string|int $id
	*/
	public function delete() {
		if ($this->request->is('post') || $this->request->is('put')){
			$data['id'] = $this->request->data['Region']['id'];
			$data['user_id'] = $this->Auth->user('id');
			$data['delete_flag'] = 1;
			$this->Region->save($data);
			$this->Session->setFlash(
				__('Region deleted'),
				'flash_success'
			);
			return $this->redirect('/regions/');
		} else {
			return $this->redirect('/regions/');
		}
	}
}