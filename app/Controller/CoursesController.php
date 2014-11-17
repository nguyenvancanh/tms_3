<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::import('Model', 'Course');

/**
 * CakePHP CoursesController
 * @author thanhtr
 */
class CoursesController extends AppController {

	public $uses = ['Course', 'Activity', 'User'];
	public $paginate = ['Course' => ['limit' => Course::LIMIT_PER_PAGES]];

	public function index() {
		
	}

	public function admin_index() {
		$pageHeader = __('Manage Courses');
		if (isset($this->data) && !empty($this->data['Course'])) {
			$keyword = $this->data['Course']['keyword'];
			if (!empty($keyword)) {
				$pageHeader = __('Results for keyword ') . '<mark>' . $keyword . '</mark>';
				$this->paginate = [
					'conditions' => ['Course.name LIKE' => '%' . $keyword . '%'],
					'limit' => Course::LIMIT_SEARCH_ITEMS
				];
			}
		}
		$courses = $this->paginate('Course');
		$this->set([
			'pageHeader' => $pageHeader,
			'courses' => $courses
		]);
	}

	public function admin_add() {
		$this->set('pageHeader', __('Add new course'));
		if (isset($this->data) && !empty($this->data)) {
			$this->Course->create();
			if ($this->Course->save($this->data)) {
				$this->CustomUtil->flash(__('New course have been successfully created!'), 'success');
				return $this->redirect(['controller' => 'courses', 'action' => 'add', 'admin' => true]);
			}
		}
	}

	public function admin_edit($id = null) {
		$course = $this->Course->findById($id);
		if (!$course) {
			return $this->redirect('/');
		}
		if (isset($this->data) && !empty($this->data)) {
			// Here check request data and old data if nothing is changed => not perform updates
			if (count(array_intersect($this->data['Course'], $course['Course'])) <= 1) {
				$this->Course->id = $id;
				if ($this->Course->save($this->data, true)) {
					$this->CustomUtil->flash(__('Course informations has been successfully saved!'), 'success');
				}
			} else {
				$this->CustomUtil->flash(__('Nothing to update. At least one field must be set for change!'), 'warning');
			}
		} else {
			$this->data = $course;
		}
		$this->set([
			'pageHeader' => __("Edit course # {$id}"),
			'course' => $course['Course']
		]);
	}

	public function admin_delete($id = null) {
		$this->autoRender = false;
		if ($this->Course->exists($id)) {
			if ($this->Course->delete($id, true)) {
				$this->CustomUtil->flash(__("Course # {$id} has been successfully deleted !"), 'success');
			} else {
				$this->CustomUtil->flash(__("Can't delete course # {$id}, please try again later !"), 'error');
			}
		} else {
			$this->CustomUtil->flash(__('Course not found!'), 'error');
		}
		return $this->redirect(['controller' => 'courses', 'action' => 'index', 'admin' => true]);
	}

}
