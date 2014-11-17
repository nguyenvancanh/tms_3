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

	public $hasMany = ['Subject'];
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

}
