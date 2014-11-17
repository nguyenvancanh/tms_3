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
App::import('Model', 'User');

class UsersController extends AppController {

	public $paginate = ['User' => ['limit' => User::LIMIT_PER_PAGES]];

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
			if ($this->User->save($this->data)) {
				$this->CustomUtil->flash(__('Register successfully !'), 'success');
				$this->redirect(['controller' => 'users', 'action' => 'login']);
			}
		}
	}

	public function admin_index() {
		$this->set('title_for_layout', __('Manager User'));
		$role = $this->User->getRole();
		if ($this->request->is('post') && isset($this->data['User']['keyword'])) {
			$keyword = $this->data['User']['keyword'];
			if (!empty($keyword)) {
				$conditions = "User.name LIKE '%$keyword%'";
			}
		}
		if ($this->request->is('post') && isset($this->data['User']['role'])) {
			$conditions = "User.is_admin =" . $this->data['User']['role'];
		}
		$this->paginate = [
			'conditions' => isset($conditions) ? $conditions : null,
			'limit' => User::LIMIT_SEARCH_ITEMS
		];
		$users = $this->paginate('User');
		$this->set(compact('users', 'role'));
	}

	public function admin_add() {
		$role = $this->User->getRole();
		$title = __('Create new User');
		$this->set(compact('role', 'title'));
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->CustomUtil->flash(__('Register successfully !'), 'success');
				$this->redirect(['controller' => 'users', 'action' => 'index', 'admin' => TRUE]);
			}
		}
	}

	public function admin_delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->CustomAuth->user('is_admin') && ($this->CustomAuth->user('id') != $id)) {
			if ($this->User->delete()) {
				$this->CustomUtil->flash(__('Delete successfully !'), 'success');
				$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
			} else {
				$this->CustomUtil->flash(__('Can not delete !'), 'error');
				$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
			}
		} else {
			$this->CustomUtil->flash(__('Only admin can delete!'), 'error');
			$this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
		}
	}

	public function admin_edit($id = null) {
		$role = $this->User->getRole();
		$title = __('Edit User profile');
		$this->set(compact('role', 'title'));
		$actionHeading = __("Edit user profile");
		$actionSogan = __("Please input all fields");
		$this->set(compact('actionHeading', 'actionSogan'));
		if (!empty($this->data)) {
			if ($this->User->save($this->data, TRUE)) {
					$this->CustomUtil->flash(__('Edit successfully !'), 'success');
					$this->redirect(array('controller' => 'users', 'action' => 'edit', $id, 'admin' => true));
			} else {
				$this->CustomUtil->flash(__('Can not save the change !'), 'error');
				}
		} else {
			$this->data = $this->User->read(null, $id);
		}
	}

}
