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

	public $virtualFields = array(
		'search' => 'CONCAT(Subject.name, " ", Subject.introduction)'
	);
	public $belongsTo = ['Course'];
	public $hasMany = ['Task' => ['dependent' => true]];
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

}
