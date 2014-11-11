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
	}

}
