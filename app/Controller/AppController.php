<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

	public $components = ['CustomUtil', 'CustomAuth', 'Session'];
	public $layout = 'default';
	public $helpers = ['Html', 'Form', 'Js', 'Paginator'];

	public function __construct($request = null, $response = null) {
		parent::__construct($request, $response);
		$this->set('title_for_layout', __('Training System'));
	}

	public function beforeFilter() {
		$this->CustomAuth->allow('index', 'view');
		if (isset($this->request->params['admin']) && CustomAuthComponent::user('is_admin') != 1) {
			$this->redirect('/');
		}
	}

	public function afterFilter() {
		parent::afterFilter();
		$this->Session->delete('Message.notify');
	}

}
