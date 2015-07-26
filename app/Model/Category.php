<?php

/**
 * Category Model
 * @author Jovanie Limbagan <vanilimbagan18@gmail.com>
 */
App::uses('AppModel', 'Model');

class Category extends AppModel {
	public $useTable = 'categories';	
	

	//validation
	public $validate = [
		'name' => [
			'required' => [
				'rule' => ['notEmpty'],
				'message' => 'Name is required'
			]
		],
	];
	
	/**
	 * generate settings for pager
	*/

	public function generateSettingsForPager($name){
		$conditions ['delete_flag']=0;
		if($name){
			$conditions['name LIKE'] = '%' . $name . '%';
		}
		$settings = [
			'fields' => 'id, user_id, name',
			'limit' => 30,
			'recursive' => -1,
			'order' => [
				'id' => 'asc'
			],
			'conditions' => $conditions
		];

		return $settings;
	
	}

	/**
	* get category data by id
	* @param string|int $id
	* @return array
	*/
	public function findById($id){
		return $this->find('first', [
			'fields' => 'id, name',
			'recursive' => -1,
			'conditions' => [
				'id' => $id,
				'delete_flag' => 0
			] 
		]);
	}
	
}