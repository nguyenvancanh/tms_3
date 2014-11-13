<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP User
 * @author thanhtr
 */
class User extends AppModel {

	public $actsAs = ['Multivalidatable'];
	public $validationSets = [
		'admin_edit' => [
			'name' => ['rule' => 'notEmpty', 'message' => 'Enter name of user'],
			'email' => [
				'required' => [
					'rule' => 'email',
					'message' => 'Must be a valid email address',
				],
				'isUnique' => [
					'rule' => 'IsUnique',
					'message' => 'Email is already in use !'
				]
			],
			'username' => [
				'notEmpty' => [
					'rule' => 'notEmpty',
					'message' => 'Enter account name'
				],
				'maxLength' => [
					'rule' => ['maxLength', 32],
					'message' => "Can't contain more than %d characters"
				],
				'isUnique' => [
					'rule' => 'IsUnique',
					'message' => 'Username is already in use !'
				]
			]
		],
		'admin_add' => [
			'name' => ['rule' => 'notEmpty', 'message' => 'Enter user name'],
			'username' => [
				'maxLength' => [
					'rule' => ['maxLength', 32],
					'message' => "Can't contain more than %d characters"
				],
				'notEmpty' => [
					'rule' => 'notEmpty',
					'message' => 'Enter account name'
				],
				'isUnique' => [
					'rule' => 'IsUnique',
					'message' => 'Username is already in use !'
				]
			],
			'password' => ['rule' => 'notEmpty', 'message' => 'Cannot use a blank password'],
			'password_confirm' => ['rule' => 'matchPasswords', 'message' => 'Passwords do not match!'],
			'email' => [
				'required' => [
					'rule' => 'email',
					'message' => 'Must be a valid email address',
				],
				'isUnique' => [
					'rule' => 'IsUnique',
					'message' => 'Email is already in use !'
				]
			]
		]
	];

	public function matchPasswords() {
		return $this->data[$this->alias]['password'] == $this->data[$this->alias]['password_confirm'];
	}

}
