<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	public $uses = array('Admin', 'Author', 'Editor', 'Evaluator', 'Reader', 'User');
	var $components=array("Email","Session");
	var $helpers=array("Html","Form","Session");

    function beforeFilter() {
        $this->layout = 'users';
        $this->Auth->allow('add', 'verify', 'passForgot', 'forgetPwd', 'reset', 'changePwd');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		if($this->Auth->User()){
			$this->redirect('logout');
		} else {
			$this->redirect('login');
		}
	}

/**
 * login method
 *
 * @return void
 */
	public function login() {
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$user_id=$this->User->getLastInsertId();
				$this->User->id = $user_id;
				$role = $this->User->field('role'); // echo the name for row id 22
				if($role == 'admin'){
					$this->Admin->create();
					$this->Admin->saveField('user_id', $user_id);
				} else if($role == 'author'){
					$this->Author->create();
					$this->Author->saveField('user_id', $user_id);
				} else if($role == 'editor'){
					$this->Editor->create();
					$this->Editor->saveField('user_id', $user_id);
				} else if($role == 'evaluator'){
					$this->Evaluator->create();
					$this->Evaluator->saveField('user_id', $user_id);
				} else if($role == 'reader'){
					$this->Reader->create();
					$this->Reader->saveField('user_id', $user_id);
				}
				
				$this->Session->setFlash(__('The user has been saved '.$role));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * verify method
 *
 * verifies if user login data is correct
 * @return json response
 */
	public function verify(){
		$this->autoRender = false;
		if($this->request->is('post')){
			$this->Session->destroy();
			if($this->Auth->login()){
				$response['success'] = true;
				//$this->redirect($this->Auth->redirect());
				$this->User->id = $this->Auth->user('id'); // target correct record
        		$this->User->saveField('last_login', date(DATE_ATOM)); // save login time
			} else {
				$response['success'] = false;
				$this->Session->setFlash(__('Usuario invalido'));
			}
		}
		echo json_encode($response);
	}

/**
 * logout method
 *
 * logout and destroy user session
 * @return void
 */
	public function logout(){
		$this->redirect($this->Auth->logout());
	}

/**
 * redirect method
 *
 * redirects user after login depending on role
 * @return void
 */
	public function redirection(){
		$this->redirect($this->Auth->redirect());
	}

/**
 * passForgot method
 *
 * renders passforgot modal
 * @return 
 */
	public function passForgot(){
		$this->layout = false;
	}

/**
 * forgetpwd method
 *
 * verifies if user email data is correct and sends recovery token
 * @return json response
 */
	function forgetPwd(){
        $this->autoRender = false;
        $this->User->recursive=-1;
        if(!empty($this->data)){
			$email=$this->data['User']['email'];
            $fu=$this->User->find('first',array('conditions'=>array('User.email'=>$email)));
            if($fu){
            	//debug($fu);
                $key = Security::hash(String::uuid(),'sha512',true);
                $hash=sha1($fu['User']['username'].rand(0,100));
                $url = Router::url(array('controller'=>'users','action'=>'reset'), true).'/'.$key.'#'.$hash;
                $ms=$url;
                $ms=wordwrap($ms,1000);
                //debug($url);
                $fu['User']['tokenhash']=$key;
                $this->User->id=$fu['User']['id'];
                if($this->User->saveField('tokenhash',$fu['User']['tokenhash'])){
                    //============Email================//

                    /* SMTP Options */

                    $this->Email->smtpOptions = array(
                        'port'=>'465',
                        'host' => 'ssl://smtp.gmail.com',
                        'username'=>'laclomag@gmail.com',
                        'password'=>'Laclo1234'
                    );

                    $this->Email->template = 'resetpw';
                    $this->Email->from    = 'LACLO Magazine <laclomag@gmail.com>';
                    $this->Email->to      = $fu['User']['first_name'].'<'.$fu['User']['email'].'>';
                    $this->Email->subject = 'Cambio de Contraseña LACLO Magazine';
                    $this->Email->sendAs = 'both';

                    $this->Email->delivery = 'smtp';
                    $this->set('ms', $ms);
                    $this->set('user', $fu['User']['first_name']);
                    $this->Email->send();
                    $this->set('smtp_errors', $this->Email->smtpError);

                    $this->Session->setFlash(__('Check Your Email To Reset your password', true));
                    $response['success'] = true;

                    //============EndEmail=============//
                } else {
					$response['success'] = false;
                    $this->Session->setFlash("Error Generating Reset link");
                }
            } else {
            	$response['success'] = false;
                $this->Session->setFlash('Email does Not Exist');
            }
        }
        echo json_encode($response);
    }

/**
 * reset method
 *
 * verifies token
 * 
 */
	function reset($token=null){
	    $this->User->recursive=-1;
	    if(!empty($token)){
	    	$this->set('token', $token);
	        $u=$this->User->findBytokenhash($token);
	        if($u){

	        } else {
	            $this->Session->setFlash('Something bad.', 'default', array(), 'bad');
	        }
	    } else {
	        $this->redirect(array('action' => 'index'));
	    }
	}

/**
 * changePwd method
 *
 * changes user password 
 * @return json response
 */
	public function changePwd(){
		$this->autoRender = false;
        if(!empty($this->data)){
        	$token = $this->data['User']['tokenhash'];
			$u=$this->User->findBytokenhash($token);
			if($u){
				$this->User->id=$u['User']['id'];

	            $this->User->data=$this->data;
	            $this->User->data['User']['username']=$u['User']['username'];
	            $new_hash=sha1($u['User']['username'].rand(0,100));//created token
	            $this->User->data['User']['tokenhash']=$new_hash;
	            if($this->User->save($this->User->data)){
	            	$response['success'] = true;
	            	$this->Session->setFlash('Something good.', 'default', array(), 'good');
	            } else {
	            	$response['success'] = false;
	            }
			} else {
				$response['success'] = false;
			}
        } else {
        	$response['success'] = false;
        }
        echo json_encode($response);
	}
}