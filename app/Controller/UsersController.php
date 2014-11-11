<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP UsersController
 * @author thanhtr
 */
class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->CustomAuth->allow('add');
	}

	public function index() {
		$pageHeader = __('Dashboard');
		$this->set('pageHeader', $pageHeader);
	}

	public function login() {
		$authRedirect = $this->CustomAuth->loginRedirect;
		$this->set('pageHeader', __('Login'));
		if (CustomAuthComponent::isLogged()) {
			$this->redirect($authRedirect);
		}
		if ($this->request->is('post')) {
			if ($this->CustomAuth->login()) {
				$this->redirect($authRedirect);
			} else {
				$this->CustomUtil->flash(__('Invalid username or password'), 'error');
			}
		}
	}

	public function logout() {
		if (CustomAuthComponent::isLogged()) {
			$this->CustomUtil->flash(__('You have successfully logged out!'), 'success');
		}
		$this->redirect($this->CustomAuth->logout());
	}

	public function add() {
		$this->set('title_for_layout', __('Register'));
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->CustomUtil->flash(__('Register successfully !'), 'success');
				$this->redirect(['controller' => 'users', 'action' => 'login']);
			}
		}
	}

}
