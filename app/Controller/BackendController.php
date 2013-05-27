<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class BackendController extends AppController {

	function beforeFilter() {
        $this->layout = 'backend';
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
	}
}


