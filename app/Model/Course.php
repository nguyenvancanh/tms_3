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
	const STATUS_DEFAULT = 0;
	const STATUS_FINISHED = 1;
	const STATUS_STARTED = 2;
	
	public $actsAs = ['Containable'];
	public $hasMany = [
		'Subject' => ['dependent' => true],
		'CourseMember' => ['dependent' => true]
	];
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
		ksort($courses);
		return $courses;
	}

	/**
	 * Get course by user id
	 * @param int $userId
	 * @param bool $joined default is false, set $joined = true to get all courses that user has been joined
	 * @return array $courses
	 */
	public function getByUserId($userId = null, $joined = false) {
		$conditions = ["Course.id NOT IN (SELECT course_id FROM users_courses WHERE user_id = {$userId})"];
		if ($joined) {
			$conditions = ["Course.id IN (SELECT course_id FROM users_courses WHERE user_id = {$userId})"];
		}
		$courses = $this->find('all', [
			'conditions' => $conditions
		]);
		return $courses;
	}

}
