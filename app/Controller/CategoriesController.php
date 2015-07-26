<?php

/**
* CategoriesController
* @author Jovanie Limbagan <vanilimbagan18@gmail.com>
*/

class CategoriesController extends AppController {

	public $uses = [
		'Category'
	];
	
	/**
	* display all categories
	* search also categories by name
	*/

	public function index(){	
		$getData = $this->request->query;
		$name = isset($getData['name']) ? $getData['name'] : null;

		$this->paginate = $this->Category->generateSettingsForPager($name);
		$categories = $this->paginate('Category');

		$this->set('name', $name);
		$this->set('categories', $categories);
	}

	/**
	* add new category
	*/
	 
	public function add() {
		if($this->request->is('post')){	
			$this->Category->create();
			
			$this->request->data['Category']['user_id'] = $this->Auth->user('id');
			if($this->Category->save($this->request->data)){

				$this->Session->setFlash(__('The category has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			}

			$this->Session->setFlash(
				__('The category could not be saved. Please, try again.'),
				'flash_fail'
			);
		}
	}
	
	/**
	* edit category 
	* @param string|int $id
	*/
	public function edit($id = null) {

		if (!$id){
			return $this->redirect('/categories/');
		}

		$categories = $this->Category->findById($id);

		if (!$categories){
			return $this->redirect('/categories/');
		}

		if($this->request->is('post') || $this->request->is('put')){
			$this->request->data['Category']['user_id'] = $this->Auth->user('id');
			if($this->Category->save($this->request->data)){
				$this->Session->setFlash(
					__('The category has been saved'),
					'default', 'flash_success'
				);
				return $this->redirect(['action' => 'index']);
			}
			$this->Session->setFlash(
				__('The category could not be saved. Please, try again.'),
				'default', 
				[
					'class' => 'alert alert-danger'
				]
			);
		}else{
			$this->request->data = $categories;
		}
	}
	
	/**
	* delete category 
	* @param string|int $id
	*/
	public function delete() {
		if ($this->request->is('post') || $this->request->is('put')){
			$data['id'] = $this->request->data['Category']['id'];
			$data['user_id'] = $this->Auth->user('id');
			$data['delete_flag'] = 1;
			$this->Category->save($data);
			$this->Session->setFlash(
				__('Category deleted'),
				'flash_success'
			);
			return $this->redirect('/categories/');
		} else {
			return $this->redirect('/categories/');
		}
	}
}