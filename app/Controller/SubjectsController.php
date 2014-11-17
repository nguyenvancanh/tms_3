<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::import('Model', 'Subject');

/**
 * CakePHP SubjectsController
 * @author thanhtr
 */
class SubjectsController extends AppController {

	public $uses = ['Subject', 'Course'];
	public $paginate = ['Subject' => ['limit' => Subject::LIMIT_PER_PAGES]];

	public function index() {
		
	}

	public function admin_index() {
		$pageHeader = __('Manage Subjects');
		$courses = $this->Course->get();
		if (isset($this->data) && !empty($this->data['Subject'])) {
			$courseId = $this->data['Subject']['course_id'];
			$keyword = $this->data['Subject']['keyword'];
			$pageHeader = __('Results for keyword ') . '<mark>' . $keyword . '</mark>';
			$conditions = ['Subject.search LIKE' => '%' . $keyword . '%'];
			if (empty($keyword)) {
				$pageHeader = __('All records');
			}
			if ($courseId != 0) {
				$pageHeader .=__(" in courses {$courses[$courseId]}");
				$conditions = [
					'Subject.search LIKE' => '%' . $keyword . '%',
					'Subject.course_id' => $courseId
				];
			}
		}
		$this->paginate = ['conditions' => isset($conditions) ? $conditions : null];
		$subjects = $this->paginate('Subject');
		$this->set([
			'pageHeader' => $pageHeader,
			'courses' => $courses,
			'subjects' => $subjects
		]);
	}

	public function admin_add() {
		$pageHeader = __('Add new subject');
		$courses = $this->Course->get();
		// unset index 0 of array courses to disable manager select all courses
		unset($courses[0]);
		if (isset($this->data) && !empty($this->data)) {
			$this->Subject->create();
			if ($this->Subject->save($this->data)) {
				$this->CustomUtil->flash(__('New subject have been successfully created!'), 'success');
				return $this->redirect(['controller' => 'subjects', 'action' => 'add', 'admin' => true]);
			}
		}
		$this->set([
			'pageHeader' => $pageHeader,
			'courses' => $courses
		]);
	}

	public function admin_edit($id = null) {
		$courses = $this->Course->get();
		$subject = $this->Subject->findById($id);
		// unset index 0 of array courses to disable manager select all courses
		unset($courses[0]);
		if (!$subject) {
			return $this->redirect('/');
		}
		if (isset($this->data) && !empty($this->data)) {
			$fieldsChanged = Subject::TOTAL_FIELDS_MODIFY - count(array_intersect($this->data['Subject'], $subject['Subject']));
			// Here check request data and old data if nothing is changed => not perform updates
			if ($fieldsChanged > 0) {
				$this->Subject->id = $id;
				if ($this->Subject->save($this->data, true)) {
					$this->CustomUtil->flash(__('Subject informations has been successfully saved!'), 'success');
				}
			} else {
				$this->CustomUtil->flash(__('Nothing to update. At least one field must be set for change!'), 'warning');
			}
		} else {
			$this->data = $subject;
		}
		$this->set([
			'pageHeader' => __("Edit subject # {$id}"),
			'subject' => $subject['Subject'],
			'courses' => $courses
		]);
	}

	public function admin_delete($id = null) {
		$this->autoRender = false;
		if ($this->Subject->exists($id)) {
			if ($this->Subject->delete($id, true)) {
				$this->CustomUtil->flash(__("Subject # {$id} has been successfully deleted !"), 'success');
			} else {
				$this->CustomUtil->flash(__("Can't delete subject # {$id}, please try again later !"), 'error');
			}
		} else {
			$this->CustomUtil->flash(__('Subject not found!'), 'error');
		}
		return $this->redirect(['controller' => 'subjects', 'action' => 'index', 'admin' => true]);
	}

}
