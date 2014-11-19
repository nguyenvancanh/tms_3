<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Subject
 * @author thanhtr
 */
class Subject extends AppModel {

	const LIMIT_PER_PAGES = 20;
	const LIMIT_SEARCH_ITEMS = 25;
	const TOTAL_FIELDS_MODIFY = 4;
	const STATUS_INPROGRESS = 0;
	const STATUS_DONE = 1;
	
	public $actsAs = ['Containable'];
	public $virtualFields = array(
		'search' => 'CONCAT(Subject.name, " ", Subject.introduction)'
	);
	public $hasMany = ['UserSubject' => ['dependent' => true]];
	public $belongsTo = ['Course'];
	public $validate = [
		'name' => [
			'rule' => 'notEmpty',
			'message' => 'Enter subject'
		],
		'introduction' => [
			'rule' => 'notEmpty',
			'message' => 'Enter introduction for this subject'
		],
		'score' => [
			'rule' => 'numeric',
			'message' => 'Determine the scores of subject'
		],
		'course_id' => [
			'rule' => 'existsCourse',
			'message' => 'Course does not exists'
		]
	];

	public function get($userId = null, $courseId = null) {
		$conditions = ["Subject.id IN (SELECT subject_id FROM users_subjects WHERE user_id = {$userId})"];
		if (!is_null($courseId)) {
			$conditions = [
				"Subject.id IN (SELECT subject_id FROM users_subjects WHERE user_id = {$userId})"
				. "AND Subject.course_id = {$courseId}"];
		}
		$subjects = $this->find('all', [
			'conditions' => $conditions
		]);
		return $subjects;
	}

}
