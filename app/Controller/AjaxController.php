<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class AjaxController extends AppController {
	public $components = array('RequestHandler', 'Security');

	function beforeFilter() {
		parent::beforeFilter();
		// Must be disabled or AJAX calls fail
		$this->Security->validatePost = false;

		if ($this->RequestHandler->accepts('json')) {
			if (strpos(env('HTTP_REFERER'), trim(env('HTTP_HOST'), '/')) === false) {
				$this->Security->blackHole($this, 'Invalid referrer detected for this request!');
			}
		} else {
			$this->Security->blackHole($this, 'You are not authorized to process this request!');

		}
    }



	public function verify() {
		$this->RequestHandler->ajaxLayout; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
		$this->autoLayout = false;
		$this->autoRender = false;
		$response['success'] = true;
		if ($this->request->is('ajax')) 
			return new CakeResponse(array('response' => json_encode($response))); 
		}
/*
		$response['success'] = true;

		$this->header('Content-Type: application/json');
		//echo json_encode($response);
		return json_encode($response);

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


