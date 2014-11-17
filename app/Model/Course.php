<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Course
 * @author thanhtr
 */
class Course extends AppModel {

	const LIMIT_PER_PAGES = 10;
	const LIMIT_SEARCH_ITEMS = 20;
	const TOTAL_FIELDS_MODIFY = 2;

	public $hasMany = ['Subject' => ['dependent' => true]];
	public $validate = [
		'name' => [
			'notEmpty' => [
				'rule' => 'notEmpty',
				'message' => 'Enter course name'
			],
			'isUnique' => [
				'rule' => 'isUnique',
				'message' => 'This course has existed'
			]
		],
		'description' => [
			'rule' => 'notEmpty',
			'message' => 'Enter description'
		]
	];

	public function get() {
		$courses = $this->find('list');
		if (empty($courses)) {
			$courses += [-1 => __('Course not found')];
		}
		$courses += [0 => __('All Courses avaiables')];
		sort($courses);
		return $courses;
	}

}
