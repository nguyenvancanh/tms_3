<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP UserSubject
 * @author thanhtr
 */
class UserSubject extends AppModel {

	public $useTable = 'users_subjects';
	public $belongsTo = ['User', 'Subject'];

	public function get($param = null, $courseId = null, $type = 'user_id') {
		$subQuery = "UserSubject.subject_id IN (SELECT id FROM subjects WHERE course_id = {$courseId})";
		$findType = 'all';
		switch ($type) {
			case 'user_id':
				$conditions = ['UserSubject.user_id' => $param, $subQuery];
				break;
			case 'id':
				$findType = 'first';
				$conditions = ['UserSubject.id' => $param, $subQuery];
				break;
			default:
				$conditions = ['UserSubject.user_id' => $param, $subQuery];
				break;
		}
		$tasks = $this->find($findType, ['conditions' => $conditions]);
		return $tasks;
	}

	public function deleteByUserId($userId = null, $courseId = null) {
		$subQuery = "UserSubject.subject_id IN (SELECT id FROM subjects WHERE course_id = {$courseId})";
		$conditions = ['UserSubject.user_id' => $userId, $subQuery];
		return $this->deleteAll($conditions);
	}

}
