<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Activity
 * @author thanhtr
 */
class Activity extends AppModel {

	const ACTION_DONE = 100;
	const ACTION_JOIN = 101;
	const ACTION_LEAVE = 102;
	const ACTION_START = 103;
	const HAD_ADDED = 200;
	const HAD_REMOVED = 201;
	const HAD_UNFINISH = 202;
	const SUBJECT = 1;
	const COURSE = 2;
	const LIMIT_PER_PAGES = 50;

	public $actsAs = ['Containable'];
	public $belongsTo = ['User'];

	public function write($userId = null, $actionId = null, $key = null, $content = null) {
		$this->create();
		$data = ['user_id' => $userId, 'action_id' => $actionId, 'key' => $key, 'content' => $content];
		return $this->save($data);
	}

	public function getAction() {
		$action = [
			self::ACTION_DONE => __("You've completed "),
			self::ACTION_JOIN => __("You've joined "),
			self::ACTION_START => __("You've started "),
			self::ACTION_LEAVE => __("You've left "),
			self::HAD_ADDED => __('You have been added '),
			self::HAD_REMOVED => __('You have been removed from '),
			self::HAD_UNFINISH => __('You have been reassigned learn '),
		];
		return $action;
	}

	public function getKey() {
		$key = [
			self::SUBJECT => __('task '),
			self::COURSE => __('course ')
		];
		return $key;
	}

	public function clean($userId = null) {
		return $this->deleteAll(['user_id' => $userId]);
	}

}
