<?php

App::import('Component', 'Auth');

/**
 * CakePHP CustomAuthComponent
 * @author thanhtr
 */
class CustomAuthComponent extends AuthComponent {

	public $loginRedirect = ['controller' => 'users', 'action' => 'index'];
	public $logoutRedirect = ['controller' => 'pages', 'action' => 'index'];
	protected $_controller;

	public function initialize(\Controller $controller) {
		parent::initialize($controller);
		$this->_controller = $controller;
	}

	public static function isLogged() {
		return (bool) (self::user());
	}

}
