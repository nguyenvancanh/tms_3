<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::import('Model', 'Report');

/**
 * CakePHP ReportsController
 * @author framgia
 */
class ReportsController extends AppController {

	public $uses = ['Report'];

	public function index($id) {
		
	}

	public function add() {
		$pageHeader = __('Report');
		$userId = $this->CustomAuth->user('id');
		if ($this->request->is('post') && !empty($this->data)) {
			$this->request->data['Report']['user_id'] = $userId;
			$this->Report->set($this->data);
			if ($this->Report->save($this->data, true)) {
				$this->CustomUtil->flash(__('Report have been sent'), 'success');
				return $this->redirect(['action' => 'add']);
			}
		}
		$this->set(compact('pageHeader'));
	}

}
