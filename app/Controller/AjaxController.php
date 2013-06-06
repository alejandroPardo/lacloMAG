<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class AjaxController extends AppController {
	public $components = array('RequestHandler', 'Security');
	public $uses = array('User');

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
		$this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
		$this->autoLayout = false;
		$this->autoRender = false;
		if(isset($this->params['url']['username'])) {
    		$arg = $this->params['url']['username'];
    		$response['data'] = $arg;
    	}
  		if(isset($this->params['url']['password'])){
    		$arg2 = $this->params['url']['password'];
    		$response['data2'] = $arg2;
  		}


    	$response = array('success' => false);
		/*if(isset($this->data)){
			$response = array('success' => true, 'user' => $this->params['url']['username'];);
		} else{
			$response = array('success' => false);
		}


		if (!empty($this->data['username']) && !empty($this->data['password'])) {
			$response['success'] = true;*/
			/*if ($this->Auth->login($this->data)) {
				$response['success'] = true;
				$response['data'] = $this->data['User'];
			} else {
				$response['data'] = 'Username/password combo incorrect';
				$response['code'] = 0;
			}
		}*/

		$this->header('Content-Type: application/json');
		echo json_encode($response);
		return;
	}
}


