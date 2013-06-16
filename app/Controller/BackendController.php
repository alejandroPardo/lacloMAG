<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class BackendController extends AppController {

	function beforeFilter() {
		parent::beforeFilter();
        $this->layout = 'backend';
    }
/**
 * dashboard method
 * shows 
 * @return void
 */
	public function dashboard() {
	}

	public function logout() {
		$this->redirect(array("controller" => "users", "action" => "logout"));
	}
}
