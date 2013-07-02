<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class BackendController extends AppController {
	public $uses = array('Message', 'MappedMessage', 'Logbook', 'User');

	function beforeFilter() {
		parent::beforeFilter();
        $this->layout = 'backend';
        $this->set('username', $this->Auth->user('username'));
		$this->set('fullName', $this->Auth->user('first_name').' '.$this->Auth->user('last_name'));
		$this->set('firstName', $this->Auth->user('first_name'));
		
		$messages = $this->MappedMessage->find('all', array(
		    'conditions' => array('MappedMessage.user_id' => $this->Auth->user('id')), //array of conditions
		    //'fields' => array('Model.field1', 'DISTINCT Model.field2'), //array of field names
		    'order' => array('MappedMessage.message_id'), //string or array defining order
		    //'group' => array('Model.field'), //fields to GROUP BY
		    //'limit' => n, //int
		    //'page' => n, //int
		    //'offset' => n, //int
		    //'callbacks' => true //other possible values are false, 'before', 'after'
		));
		$pendingMessages = $this->MappedMessage->find('count', array('conditions' => array('MappedMessage.is_read' => 0, 'MappedMessage.user_id' => $this->Auth->user('id'))));
    	$this->set('pendingMessages', $pendingMessages);
		$this->set('messages', $messages);

		if($this->Auth->user('role') == 'admin'){
			$this->set('role', 'Administrador');
		} else if($this->Auth->user('role') == 'author'){
			$this->set('role', 'Autor');
		} else if($this->Auth->user('role') == 'editor'){
			$this->set('role', 'Editor');
		} else if($this->Auth->user('role') == 'evaluator'){
			$this->set('role', 'Evaluador');
		}
    }

/**
 * dashboard method
 * shows 
 * @return void
 */
	public function index() {
		if($this->Auth->user('role') == 'admin'){
			$this->redirect('dashboard');
		} else if($this->Auth->user('role') == 'author'){
			$this->redirect('author');
		} else if($this->Auth->user('role') == 'editor'){
			$this->redirect('editor');
		} else if($this->Auth->user('role') == 'evaluator'){
			$this->redirect('evaluator');
		} else if($this->Auth->user('role') == 'reader'){
			$this->redirect(array("controller" => "frontend", "action" => "index"));
		} else {
			$this->redirect(array("controller" => "users", "action" => "logout"));
		}
	}

	public function dashboard() {
		if($this->Auth->user('role') != 'admin'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		}
	}

	public function editor() {
		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		}
	}

	public function author() {
		if($this->Auth->user('role') != 'author'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		}
	}

	public function evaluator() {
		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		}
	}

	public function logout() {
		$this->redirect(array("controller" => "users", "action" => "logout"));
	}

	public function demo(){
		$this->layout = 'demo';
	}

	public function profile(){
		$this->set('usernameProfile', $this->Auth->user('username'));
		$this->set('emailProfile', $this->Auth->user('email'));
		$this->set('roleProfile', $this->Auth->user('role'));
		$this->set('firstNameProfile', $this->Auth->user('first_name'));
		$this->set('lastNameProfile', $this->Auth->user('last_name'));
	}

	public function ajax(){
		$this->layout = false;
	}

	/****************
	/*
	/*	Authors Functions
	/*
	/***************/

	public function createArticle(){
		
	}

	public function uploadArticle(){
		
	}

	public function pendingAuthor() {
		
  	}

}
