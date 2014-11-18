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

	public $uses = ['Course', 'Activity', 'User', 'Subject', 'CourseMember', 'UserSubject'];
	public $paginate = [
		'Course' => ['limit' => Course::LIMIT_PER_PAGES],
		'User' => ['limit' => Course::LIMIT_PER_PAGES]
	];

	public function index($param = null) {
		$pageHeader = __('Choose Courses to join');
		$userId = CustomAuthComponent::user('id');
		$courses = $this->Course->getByUserId($userId);
		if (!is_null($param) && $param == 'joined') {
			$viewJoined = true;
			$pageHeader = __('Courses joined');
			$this->Course->bindModel(['hasMany' => ['CourseMember' => ['conditions' => ['CourseMember.user_id' => $userId]]]]);
			$courses = $this->Course->getByUserId($userId, true);
		}
		$this->set([
			'pageHeader' => $pageHeader,
			'courses' => $courses,
			'joined' => isset($viewJoined) ? true : false
		]);
	}

	public function add($id = null) {
		$this->autoRender = false;
		$userId = CustomAuthComponent::user('id');
		$courses = $this->Course->get();
		$redirectUrl = ['controller' => 'courses', 'action' => 'index'];
		if (!$this->Course->exists($id)) {
			return $this->redirect($redirectUrl);
		}
		$data = [
			'user_id' => $userId,
			'course_id' => $id
		];
		if ($this->CourseMember->save($data)) {
			$this->CustomUtil->flash(__("Now that you have been joined to course {$courses[$id]}"), 'success');
		}
		return $this->redirect($redirectUrl);
	}

	public function start($id = null) {
		$this->autoRender = false;
		$redirect = ['action' => 'index', 'joined'];
		$userId = CustomAuthComponent::user('id');
		if (!$this->Course->exists($id)) {
			return $this->redirect(['action' => 'index']);
		}
		$this->Subject->contain();
		$subjects = $this->Subject->findAllByCourseId($id);
		if (empty($subjects)) {
			$this->CustomUtil->flash(__("Currently unable to start this course, please try again later!"), 'warning');
			return $this->redirect($redirect);
		}
		$isExists = $this->UserSubject->get($userId, $id);
		if ($isExists) {
			$this->CustomUtil->flash(__('You have already started this course. View learning progress for more details.'), 'warning');
			return $this->redirect($redirect);
		}
		$data = null;
		foreach ($subjects as $key => $value) {
			$data[$key] = [
				'user_id' => $userId,
				'subject_id' => $value['Subject']['id']
			];
		}
		if ($this->UserSubject->saveMany($data)) {
			$this->CourseMember->updateAll(['status' => Course::STATUS_STARTED], ['user_id' => $userId, 'course_id' => $id]);
			$this->CustomUtil->flash(__('Course started successfully!'), 'success');
			return $this->redirect($redirect);
		}
	}

	public function view($id = null) {
		$courses = $this->Course->get();
		$pageHeader = __('All members in course ') . $courses[$id];
		$users = $this->User->getByCourseId($id);
		$this->paginate('User');
		$this->set(compact('pageHeader', 'users'));
	}

	public function delete($id = null, $param = null) {
		$this->autoRender = false;
		$userId = CustomAuthComponent::user('id');
		if (!$this->CourseMember->exists($id)) {
			return $this->redirect(['controller' => 'courses', 'action' => 'index']);
		}
		if ($this->CourseMember->delete($id, true)) {
			$course = $this->Course->findByName($param);
			$this->UserSubject->deleteByUserId($userId, $course['Course']['id']);
			$this->CustomUtil->flash(__("You have been leave the course {$param}"), 'success');
		}
		return $this->redirect(['controller' => 'courses', 'action' => 'index', 'joined']);
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

	public function admin_add($event = null, $id = null) {
		switch ($event) {
			case 'user':
				$title = __('Admin add user to the course');
				$courses = $this->Course->find('list');
				$users = $this->User->find('all');
				$role = $this->User->getRole();
				if ($this->request->is('post') && !empty($this->data['Course']['course_id'])) {
					$selectedCourse = $this->data['Course']['course_id'];
					if (!empty($selectedCourse)) {
						$this->Session->write('selectedCourse', $selectedCourse);
					}
				}
				if ($this->Session->check('selectedCourse')) {
					$courseId = $this->Session->read('selectedCourse');
					$users = $this->User->getByCourseId($courseId, FALSE);
					if ($this->User->exists($id)) {
						$memberCourse = ['user_id' => $id, 'course_id' => $courseId];
						$this->CourseMember->create();
						if ($this->CourseMember->save($memberCourse)) {
							$this->CustomUtil->flash("Add user # {$id} to course {$courses[$courseId]} successfully!", 'success');
							$this->redirect(['controller' => 'courses', 'action' => 'add', 'user', 'admin' => true]);
						}
					}
				}
				$this->set(compact('users', 'courses', 'title', 'role'));
				$this->render('admin_add_users');
				break;
			default :
				$this->set('pageHeader', __('Add new course'));
				if (isset($this->data) && !empty($this->data)) {
					$this->Course->create();
					if ($this->Course->save($this->data)) {
						$this->CustomUtil->flash(__('New course have been successfully created!'), 'success');
						return $this->redirect(['controller' => 'courses', 'action' => 'add', 'admin' => true]);
					}
				}
				break;
		}
	}

	public function admin_edit($id = null) {
		$course = $this->Course->findById($id);
		if (!$course) {
			return $this->redirect('/');
		}
		if (isset($this->data) && !empty($this->data)) {
			// Here check request data and old data if nothing is changed => not perform updates
			$fieldsChanged = Course::TOTAL_FIELDS_MODIFY - count(array_intersect($this->data['Course'], $course['Course']));
			if ($fieldsChanged > 0) {
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
