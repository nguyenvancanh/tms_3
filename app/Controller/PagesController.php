<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public function index() {
		$pageHeader = __('Welcome to Training System');
		$introduction = __("You want to be a good programmer?");
		$this->set(compact('pageHeader', 'introduction'));
	}

}
