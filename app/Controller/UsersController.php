<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    function beforeFilter() {
        $this->layout = 'users';
        $this->Auth->allow('add', 'verify');
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive=0;
		$this->set('users', $this->paginate());
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

	public function login(){}


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
}
