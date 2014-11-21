<?php

App::uses('AppModel', 'Model');

class User extends AppModel {

	const LIMIT_PER_PAGES = 10;
	const LIMIT_SEARCH_ITEMS = 20;

	public $actsAs = ['Multivalidatable', 'Containable'];
	public $hasMany = [
		'CourseMember' => ['dependent' => true],
		'UserSubject' => ['dependent' => true],
		'Activity' => ['order' => ['id' => 'desc'], 'dependent' => true]
	];
	public $validate = [
		'username' => [
			'valid' => [
				'rule' => 'alphaNumeric',
				'message' => 'Username must be alpha numberic'
			],
			'between' => [
				'rule' => ['between', 6, 32],
				'message' => 'Between %d to %d characters'
			],
			'isUnique' => [
				'rule' => 'isUnique',
				'message' => 'The username has already been taken.',
			]
		],
		'password' => [
			'rule' => ['minLength', 6],
			'message' => 'Minimum %d characters long'
		],
		'name' => [
			'notEmpty' => [
				'rule' => 'notEmpty',
				'message' => 'Full name required'
			]
		],
		'password_confirm' => [
			'rule' => 'passwordEqualValidation',
			'message' => 'Confirm password not correct',
		],
		'old_password' => [
			'rule' => 'checkPass',
			'message' => 'Old password not match'
		]
	];
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

	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = CustomAuthComponent::password($this->data[$this->alias]['password']);
		}
		return TRUE;
	}

	public function passwordEqualValidation() {
		return ($this->data[$this->alias]['password_confirm'] == $this->data[$this->alias]['password']);
	}

	public function getRole() {
		$role = [0 => __('Member'), 1 => __('Admin')];
		return $role;
	}

	public function checkPass() {
		$userId = CustomAuthComponent::user('id');
		$data_user = $this->findById($userId);
		$old_password = $this->data[$this->alias]['old_password'];
		if ($data_user['User']['password'] == CustomAuthComponent::password($old_password)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function getByCourseId($id = null) {
		$subQuery = "User.id IN(SELECT user_id FROM users_courses WHERE course_id ={$id})";
		$users = $this->find('all', ['conditions' => [$subQuery]]);
		return $users;
	}

}
