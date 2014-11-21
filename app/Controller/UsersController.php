<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * CakePHP UsersController
 * @author thanhtr
 */
App::import('Model', 'User');

class UsersController extends AppController {

	public $uses = ['User', 'Activity'];
	public $paginate = [
		'User' => ['limit' => User::LIMIT_PER_PAGES],
	];

	public function beforeFilter() {
		parent::beforeFilter();
		$this->CustomAuth->allow('add');
	}

	public function index() {
		$pageHeader = __('Dashboard');
		$key = $this->Activity->getKey();
		$action = $this->Activity->getAction();
		$userId = CustomAuthComponent::user('id');
		$this->paginate = ['limit' => Activity::LIMIT_PER_PAGES, 'order' => 'Activity.id desc', 'conditions' => ['Activity.user_id' => $userId]];
		$activities = $this->paginate('Activity');
		$this->set(compact('activities', 'key', 'action', 'pageHeader'));
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

	public function admin_view($id = null) {
		$user = null;
		$title = __('View User profile');
		if ($this->User->exists($id)) {
			$role = $this->User->getRole();
			$user = $this->User->read(null, $id);
		}
		$this->set(compact('role', 'title', 'user'));
	}

	public function edit($event = null) {
		$actionHeading = __("Edit profile");
		$actionSogan = __("Please input all fields");
		$this->set(compact('actionHeading', 'actionSogan'));
		$userId = $this->CustomAuth->user('id');
		switch ($event) {
			case 'password':
				if ($this->request->is('post')) {
					$this->User->id = $userId;
					if ($this->User->save($this->data, true)) {
						$this->CustomUtil->flash(__('Change password successfully !'), 'success');
					}
				}
				$this->render('change_password');
				break;
			default :
				if (!empty($this->data)) {
					$data_input = $this->data;
					$data_sql = $this->User->findById($userId);
					$data_compare = array_intersect($data_input['User'], $data_sql['User']);
					if (count($data_compare) == 3) {
						$this->CustomUtil->flash(__('Nothing to change !'), 'warning');
						$this->redirect(array('controller' => 'users', 'action' => 'edit'));
					} else {
						if ($this->User->save($this->data, true)) {
							$this->CustomUtil->flash(__('Edit Profile successfully !'), 'success');
							$this->redirect(array('controller' => 'users', 'action' => 'edit'));
						}
					}
				} else {
					$this->data = $this->User->read(null, $userId);
				}
				break;
		}
	}

	public function view() {
		$title = __('View Profile');
		$userId = CustomAuthComponent::user('id');
		$user = $this->User->read(null, $userId);
		$this->set(compact('title', 'user'));
	}

}
