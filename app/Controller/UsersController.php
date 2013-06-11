<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	/*public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout');
    }*/
    function beforeFilter() {
        $this->layout = 'users';
        $this->Auth->allow('index', 'pepe', 'login', 'add');
    }


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('users', $this->User->find('all'));
		$log = $this->User->getDataSource()->getLog(false, false);
		debug($log);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
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
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


    public function login() {
       
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function pepe() {
    	//$this->layout = 'ajax'; // Or $this->RequestHandler->ajaxLayout, Only use for HTML
		//$this->autoLayout = false;
		$this->autoRender = false;
    	$userData = $this->Auth->user();
    	$response['passwordsha1'] = sha1('hbgasdigbasd44478446845GAJKDKXBGYklskugh'.$this->request->data['pass']);
    	$this->request->data['pass'] = sha1('hbgasdigbasd44478446845GAJKDKXBGYklskugh123');
        
        if($userData != null) {
            $response['success'] = true;
            $response['loggedIn'] = true;

        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {

                $response['success'] = true;
            } else {
                $response['success'] = false;
                $response['sha1'] = sha1('hbgasdigbasd44478446845GAJKDKXBGYklskugh123');
            }
            $log = $this->User->getDataSource()->getLog(false, false);
            $response['log'] = $log;
            $response['password'] = $this->request->data['pass'];
         	
            $this->header('Content-Type: application/json');

            
        }

        echo json_encode($response);


    }
}
