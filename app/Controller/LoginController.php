<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class LoginController extends AppController {

	function beforeFilter() {
        $this->layout = 'login';
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
	}

	public function prueba() {
		$this->redirect(array('controller' => 'backend')); 
	}
}


