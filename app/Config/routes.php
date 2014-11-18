<?php

$prefix = 'admin';

Router::connect('/', ['controller' => 'pages', 'action' => 'index']);
Router::connect('/dashboard', ['controller' => 'users', 'action' => 'index']);
Router::connect('/profile', ['controller' => 'users', 'action' => 'edit']);
Router::connect('/edit/:event', ['controller' => 'users', 'action' => 'edit'], ['pass' => ['event'], 'event' => '[a-z]+']);
Router::connect('/login', ['controller' => 'users', 'action' => 'login']);
Router::connect('/register', ['controller' => 'users', 'action' => 'add']);
Router::connect('/logout', ['controller' => 'users', 'action' => 'logout']);
Router::connect("/tasks/:view", ['controller' => 'tasks', 'action' => 'index'], ['pass' => ['view'], 'view' => '[a-z]+']);
Router::connect("/subjects/:view", ['controller' => 'subjects', 'action' => 'index'], ['pass' => ['view'], 'view' => '[a-z]+']);
Router::connect("/courses/:view", ['controller' => 'courses', 'action' => 'index'], ['pass' => ['view'], 'view' => '[a-z]+']);
Router::connect("/{$prefix}/:controller", [ 'prefix' => $prefix, "{$prefix}" => true]);
Router::connect("/{$prefix}/add/:event", ['controller' => 'courses', 'action' => 'add', "{$prefix}" => true], ['pass' => ['event'], 'event' => '[a-z]+']);
/**
 * Restful router
 */
Router::resourceMap([
	['action' => 'index', 'method' => 'GET', 'id' => false],
	['action' => 'view', 'method' => 'GET', 'id' => true],
	['action' => 'add', 'method' => 'POST', 'id' => false],
	['action' => 'edit', 'method' => 'PUT', 'id' => true],
	['action' => 'delete', 'method' => 'DELETE', 'id' => true],
	['action' => 'update', 'method' => 'POST', 'id' => true]
]);
Router::mapResources('users');
Router::mapResources('subjects');
Router::mapResources('tasks');
Router::mapResources('courses');
//map controller with prefix
Router::mapResources('users', ['prefix' => $prefix]);
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
