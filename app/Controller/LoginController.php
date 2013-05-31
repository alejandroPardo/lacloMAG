<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class LoginController extends AppController {
	public $components = array('RequestHandler', 'Security');

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



	public function verify() {
		function beforeFilter() {
			parent::beforeFilter();
			// Must be disabled or AJAX calls fail
			$this->Security->validatePost = false;

			if (!$this->RequestHandler->isAjax()) {
				$this->Security->blackHole($this, 'You are not authorized to process this request!');
			} else {
				if (strpos(env('HTTP_REFERER'), trim(env('HTTP_HOST'), '/')) === false) {
					$this->Security->blackHole($this, 'Invalid referrer detected for this request!');
				}
			}
	    }
		$this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
		$this->autoLayout = false;
		$this->autoRender = false;

		$response = array('success' => true, 'status' => true);

		$this->header('Content-Type: application/json');
		echo json_encode($response);
		return;

/*
		if (!empty($this->data['User']['username']) && !empty($this->data['User']['password'])) {
			if ($this->Auth->login($this->data)) {
				$response['success'] = true;
				$response['data'] = $this->data['User'];
			} else {
				$response['data'] = 'Username/password combo incorrect';
				$response['code'] = 0;
			}
		} else {
			$response['data'] = 'No username/password';
			$response['code'] = -1;
		}

		$this->header('Content-Type: application/json');
		echo json_encode($response);
		return;*/
}

}


