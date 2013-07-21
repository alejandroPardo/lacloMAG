<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class BackendController extends AppController {
	public $uses = array('Message', 'MappedMessage', 'Logbook', 'User', 'Paper', 'PaperAuthor', 'Author', 'PaperFile');
	public $userID;

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
			$this->userID = $this->Author->find('all', array(
			    'conditions' => array('user_id'=>$this->Auth->user('id')),
			    'fields' => array('id')
			));
			$this->userID = $this->userID['0']['Author']['id'];

			$markers = $this->Paper->find('count', array('joins' => array(
			    array(
			        'table' => 'paper_authors',
			        'alias' => 'PaperAuthor',
			        'type' => 'inner',
			        'foreignKey' => 'paper_id',
			        'conditions'=> array('PaperAuthor.paper_id = Paper.id')
			    ),
			    array(
			        'table' => 'authors',
			        'alias' => 'Author',
			        'type' => 'inner',
			        'foreignKey' => 'author_id',
			        'conditions'=> array(
			            'Author.id' => $this->userID,
			        )
			    )
			), 'conditions' => array('OR' => array('Paper.status' => 5, 'Paper.status' => 4,'Paper.status' => 3)), 
			));
			$papersPreviews = $this->Paper->find('count', array('joins' => array(
			    array(
			        'table' => 'paper_authors',
			        'alias' => 'PaperAuthor',
			        'type' => 'inner',
			        'foreignKey' => 'paper_id',
			        'conditions'=> array('PaperAuthor.paper_id = Paper.id')
			    ),
			    array(
			        'table' => 'authors',
			        'alias' => 'Author',
			        'type' => 'inner',
			        'foreignKey' => 'author_id',
			        'conditions'=> array(
			            'Author.id' => $this->userID,
			        )
			    )
			), 'conditions' => array('OR' => array('Paper.status' => 0)), 
			));
			if($papersPreviews>0){
				$this->set('papersPreviews', '!');
			} else {
				$this->set('papersPreviews', '');
			}
			$this->set('pendingArticles', $markers);
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

	public function changeUserData(){

		if ($this->request->is('post')) {

			$this->request->data['id']  = $this->Auth->user('id');
			$userArray['User']['id'] =  $this->Auth->user('id');
			$userArray['User']['first_name'] =  $this->request->data['first_name'];
			$userArray['User']['last_name'] =  $this->request->data['last_name'];
			$userArray['User']['email'] = $this->request->data['email'];
			$this->User->id =$this->Auth->user('id');

			if ($this->User->save($userArray)) {
				
				$this->Session->write('Auth', $this->User->read(null, $this->Auth->User('id')));
	 			$this->redirect(array("controller" => "backend", "action" => "profile"));
	 		}
		}
	}
	public function changeUserPassword() {

		if ($this->request->is('post')) {
			
			if ($this->request->data['pass1'] != '' && $this->request->data['pass2'] != '') {
				
				$currentUser = $this->User->read(null, $this->Auth->User('id'));

				$currentPass = $currentUser['User']['password'];
				$currentFormPass = AuthComponent::password($this->request->data['pass1']);

				$newPass = $this->request->data['pass2'];
				$newPassConfirmed = $this->request->data['pass3'];
				
				if ($currentPass == $currentFormPass && $newPass == $newPassConfirmed) {	
					
					$userArray['User']['id'] =  $this->Auth->user('id');
					$userArray['User']['password'] = $this->request->data['pass2'];

					if ($this->User->save($userArray)) {
						$this->Session->setFlash(__('The user has been updated, please reenter your password'));
			 			$this->redirect(array("controller" => "backend", "action" => "logout"));
			 		}

				} else {
					$this->Session->setFlash(__('Datos Incorrectos'));
					$this->redirect(array("controller" => "backend", "action" => "profile"));
				}
			} else {
				$this->Session->setFlash(__('Faltan Datos'));
				$this->redirect(array("controller" => "backend", "action" => "profile"));

			}

		}
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
		$this->set('author', $this->userID);
		$paper = $this->Paper->find('first', array('joins' => array(
		    array(
		        'table' => 'paper_authors',
		        'alias' => 'PaperAuthor',
		        'type' => 'inner',
		        'foreignKey' => 'paper_id',
		        'conditions'=> array('PaperAuthor.paper_id = Paper.id')
		    ),
		    array(
		        'table' => 'authors',
		        'alias' => 'Author',
		        'type' => 'inner',
		        'foreignKey' => 'author_id',
		        'conditions'=> array(
		            'Author.id' => $this->userID,
		        )
		    )
		), 'conditions' => array('Paper.status' => 0), 
		));
		if (!empty($paper)) {
			$this->set('content', $paper['PaperFile']['0']['raw']);
			$this->set('name', $paper['PaperFile']['0']['name']);
			$this->set('preview', $paper['Paper']['id']);
		} else {
			$this->set('content', '<h1>Bienvenido al Creador de Artículos LACLOmagazine</h1><p>En el menú superior puede agregar fotos, tablas, cambiar colores de letra y fondo en las letras, cambiar la alineación del texto, agregar lineas horizontales y sangrías.</p><blockquote><span style="color: rgb(119, 119, 119); font-style: italic; line-height: 1.45em; -webkit-text-stroke-color: transparent;">Puede utilizar citas textuales remarcadas con este estilo.</span></blockquote><p></p><ol><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent; color: rgb(85, 85, 85);">También</span><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent; color: rgb(85, 85, 85);">&nbsp;puede numerar&nbsp;</span><br></li><li><span style="color: rgb(85, 85, 85); line-height: 1.45em; -webkit-text-stroke-color: transparent;">su contenido.</span><br></li></ol><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;"><ul><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;">O agregarle una viñeta.</span><br></li><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;">Utilizar <b>negritas</b>, <i>cursivas</i> o <strike>letras tachadas.</strike></span></li></ul></span><p></p>');
			$this->set('name', '');
			$this->set('preview', '0');
		}
	}

	public function uploadArticle(){
		$paper = $this->PaperFile->find('first', array('conditions' => array('PaperFile.id' => 12)));
		$this->set('paper', $paper['PaperFile']['raw']);
	}

	public function pendingAuthor() {
		
  	}

  	public function uploadImage() {
		$this->autoRender = false;

		// files storage folder
		$dir = APP.'webroot/files/';
		
		$_FILES['file']['type'] = strtolower($_FILES['file']['type']);
		 
		if ($_FILES['file']['type'] == 'image/png' 
		|| $_FILES['file']['type'] == 'image/jpg' 
		|| $_FILES['file']['type'] == 'image/gif' 
		|| $_FILES['file']['type'] == 'image/jpeg'
		|| $_FILES['file']['type'] == 'image/pjpeg')
		{
		    // setting file's mysterious name
		    $filename = md5(date('YmdHis')).'.jpg';
		    $file = $dir.$filename;
		    
		    // copying
		    copy($_FILES['file']['tmp_name'], $file);

		    // displaying file    
			$array = array(
				'filelink' => '../files/'.$filename
			);
			
			echo stripslashes(json_encode($array));   
		    
		}
  	}
}
