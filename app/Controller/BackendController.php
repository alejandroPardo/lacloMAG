<?php
App::uses('AppController', 'Controller');
/**
 * Backend Controller
 *
 * 
 */
class BackendController extends AppController {
	public $uses = array('Logbook', 'User', 'Paper', 'PaperAuthor', 'Author', 'PaperFile','Magazine','MagazinePaper','Evaluator', 'PaperEvaluator', 'News', 'MagazineFiles');
	public $userID;
	public $actualMag;

/**
 * beforeFilter method
 * Queries para completar los datos del layout
 * @return void
 */
	function beforeFilter() {
		parent::beforeFilter();
        $this->layout = 'backend';
        $this->set('username', $this->Auth->user('username'));
		$this->set('fullName', $this->Auth->user('first_name').' '.$this->Auth->user('last_name'));
		$this->set('firstName', $this->Auth->user('first_name'));

		if($this->Auth->user('role') == 'author'){
			$this->set('role', 'Autor');
			$this->userID = $this->Author->find('all', array(
			    'conditions' => array('user_id'=>$this->Auth->user('id')),
			    'fields' => array('id')
			));
			$this->userID = $this->userID['0']['Author']['id'];

			$markers = $this->Paper->PaperAuthor->find('count',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('SENT','ASSIGNED','ONREVISION','REJECTED','APPROVED'),
	  					'Author.id' => $this->userID
	  				),
	  			)
	  		);

			$papersPreviews = $this->Paper->PaperAuthor->find('count',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('UNSENT', 'REVIEW'),
	  					'Author.id' => $this->userID
	  				),
	  			)
	  		);
			if($papersPreviews>0){
				$this->set('papersPreviews', '!');
			} else {
				$this->set('papersPreviews', '0');
			}

			$this->set('pendingArticles', $markers);
		} else if($this->Auth->user('role') == 'editor'){
			$this->set('role', 'Editor');
			$papersPreviews = $this->Paper->find('count',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('SENT', 'UNPUBLISHED','ONREVISION','APPROVED'),
	  				),
	  			)
	  		);

	  		$newCount = $this->User->find('count',
	  			array(
	  				'conditions' => array(
	  					'User.role' => array('PREVIOUS'),
	  				),
	  			)
	  		);
	  		$newUsers = $this->User->find('all',
	  			array(
	  				'conditions' => array(
	  					'User.role' => array('PREVIOUS'),
	  				),
	  			)
	  		);

	  		$this->set('newCount', $newCount);
	  		$this->set('newUsers', $newUsers);

			$this->set('papersPreviews', $papersPreviews);

		} else if($this->Auth->user('role') == 'evaluator'){
			$this->set('role', 'Evaluador');
			$this->userID = $this->Evaluator->find('all', array(
			    'conditions' => array('user_id'=>$this->Auth->user('id')),
			    'fields' => array('id')
			));
			$this->userID = $this->userID['0']['Evaluator']['id'];

			$markers = $this->Paper->PaperEvaluator->find('count',
	  			array(
	  				'conditions' => array(
	  					'PaperEvaluator.status' => array('ASIGNED'),
	  					'Evaluator.id' => $this->userID
	  				),
	  			)
	  		);

			$papersPreviews = $this->Paper->PaperEvaluator->find('count',
	  			array(
	  				'conditions' => array(
	  					'PaperEvaluator.status' => array('ACCEPT'),
	  					'Evaluator.id' => $this->userID
	  				),
	  			)
	  		);
			$this->set('papersPreviews', $papersPreviews);
			$this->set('pendingArticles', $markers);
		}
    }

/**
 * index method
 * Redirecciona dependiendo del rol de usuario
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


/**
 * editor method
 * dashboard para el usuario con rol Editor
 * @return void
 */

	public function editor() {
		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		}
		$approved = $this->Paper->find('count',array('conditions' => array('Paper.status' => array('APPROVED', 'UNPUBLISHED'))));
  		$published = $this->Paper->find('count',array('conditions' => array('Paper.status' => array('PUBLISHED'))));
  		$rejected = $this->Paper->find('count',array('conditions' => array('Paper.status' => array('REJECTED'))));
  		$editing = $this->Paper->find('count',array('conditions' => array('Paper.status' => array('ASSIGNED', 'ONREVISION'))));
  		$sent = $this->Paper->find('count',array('conditions' => array('Paper.status' => array('SENT'))));
  		$review = $this->Paper->find('count',array('conditions' => array('Paper.status' => array('REVIEW'))));
  		$notifications = $this->Logbook->find('all',array('conditions' => array('Logbook.type' => 'NOTIFICATION','Logbook.user_id' => $this->Auth->user('id')),'order' => array('Logbook.created DESC'),));
  		$this->set('approved', $approved);
  		$this->set('published', $published);
  		$this->set('rejected', $rejected);
  		$this->set('editing', $editing);
  		$this->set('sent', $sent);
  		$this->set('review', $review);
  		$this->set('notifications', $notifications);
	}

/**
 * author method
 * dashboard para el usuario con rol Author
 * @return void
 */

	public function author() {
		if($this->Auth->user('role') != 'author'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		}
		$approved = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('APPROVED'),'Author.id' => $this->userID)));
  		$published = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('PUBLISHED'),'Author.id' => $this->userID)));
  		$rejected = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('REJECTED'),'Author.id' => $this->userID)));
  		$editing = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('ASSIGNED', 'ONREVISION', 'SENT'),'Author.id' => $this->userID)));
  		$unsent = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('UNSENT'),'Author.id' => $this->userID)));
  		$review = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('REVIEW'),'Author.id' => $this->userID)));
  		$notifications = $this->Logbook->find('all',array('conditions' => array('Logbook.type' => 'NOTIFICATION','Logbook.user_id' => $this->Auth->user('id')),'order' => array('Logbook.created DESC'),));
  		$this->set('approved', $approved);
  		$this->set('published', $published);
  		$this->set('rejected', $rejected);
  		$this->set('editing', $editing);
  		$this->set('unsent', $unsent);
  		$this->set('review', $review);
  		$this->set('total', $unsent+$editing+$rejected+$published+$approved);
  		$this->set('notifications', $notifications);
	}

/**
 * evaluator method
 * dashboard para el usuario con rol Evaluator
 * @return void
 */

	public function evaluator() {
		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		}
		$accepted = $this->Paper->PaperEvaluator->find('count',array('conditions' => array('PaperEvaluator.status' => array('ACCEPT'),'Evaluator.id' => $this->userID)));
  		$rejected = $this->Paper->PaperEvaluator->find('count',array('conditions' => array('PaperEvaluator.status' => array('REJECT'),'Evaluator.id' => $this->userID)));
  		$approved = $this->Paper->PaperEvaluator->find('count',array('conditions' => array('PaperEvaluator.status' => array('APPROVED'),'Evaluator.id' => $this->userID)));
  		$changes = $this->Paper->PaperEvaluator->find('count',array('conditions' => array('PaperEvaluator.status' => array('MINORCHANGE', 'AUTHORCHANGE', 'CORRECTED'),'Evaluator.id' => $this->userID)));
  		$denied = $this->Paper->PaperEvaluator->find('count',array('conditions' => array('PaperEvaluator.status' => array('DENIED'),'Evaluator.id' => $this->userID)));
  		$notifications = $this->Logbook->find('all',array('conditions' => array('Logbook.type' => 'NOTIFICATION','Logbook.user_id' => $this->Auth->user('id')),'order' => array('Logbook.created DESC'),));
  		$this->set('accepted', $accepted);
  		$this->set('rejected', $rejected);
  		$this->set('approved', $approved);
  		$this->set('changes', $changes);
  		$this->set('denied', $denied);
  		$this->set('total', $accepted+$rejected+$approved+$changes+$denied);
  		$this->set('notifications', $notifications);
	}

/**
 * logout method
 * desloguearse del sistema
 * @return void
 */

	public function logout() {
		$this->redirect(array("controller" => "users", "action" => "logout"));
	}

	/****************
	/*
	/*	Common Functions
	/*
	/***************/	

/**
 * profile method
 * cambiar datos de usuario
 * @return void
 */

	public function profile(){
		$this->set('usernameProfile', $this->Auth->user('username'));
		$this->set('emailProfile', $this->Auth->user('email'));
		$this->set('roleProfile', $this->Auth->user('role'));
		$this->set('firstNameProfile', $this->Auth->user('first_name'));
		$this->set('lastNameProfile', $this->Auth->user('last_name'));
	}

/**
 * changeUserData method
 * guardar cambios de datos de usuario
 * @return void
 */

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

/**
 * changeUserPassword method
 * guardar password nuevo de usuario
 * @return void
 */

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
						$this->Session->setFlash(__('¡Se ha cambiado satisfactoriamente la contraseña!'));
			 			$this->redirect(array("controller" => "backend", "action" => "profile"));
			 		}
				} else {
					$this->Session->setFlash(__('Los datos introducidos son incorrectos. Intentelo Nuevamente.'));
					$this->redirect(array("controller" => "backend", "action" => "profile"));
				}
			} else {
				$this->Session->setFlash(__('Los datos introducidos están incompletos. Intentelo Nuevamente.'));
				$this->redirect(array("controller" => "backend", "action" => "profile"));
			}
		}
	}

/**
 * notifications method
 * mostrar todas las notificaciones de usuario
 * @return void
 */

	public function notifications() {
		$notifications = $this->Logbook->find('all',array('conditions' => array('Logbook.type' => 'NOTIFICATION','Logbook.user_id' => $this->Auth->user('id')),'order' => array('Logbook.created DESC'),));
  		$this->set('notifications', $notifications);
  		if(empty($notifications)){
  			$this->Session->setFlash(__('No tiene ninguna notificación en el sistema.'));
			$this->redirect(array("controller" => "backend", "action" => "index"));
  		}
	}

/**
 * sendEmail method
 * envía correo con la notificación necesaria.
 * @return void
 */

	public function sendEmail($subject=null, $content=null, $receiverid=null) {
		if($subject==null || $content==null || $receiverid==null){
			return 0;
		}
		$emailReceiver = $this->User->find('all', array(
		    'conditions' => array('id'=>$receiverid),
		));

		//============Email================//
        /* SMTP Options */

        $this->Email->smtpOptions = array(
            'port'=>'465',
            'host' => 'ssl://smtp.gmail.com',
            'username'=>'laclomag@gmail.com',
            'password'=>'Laclo1234'
        );

        $this->Email->template = 'notification';
        $this->Email->from    = 'LACLO Magazine <laclomag@gmail.com>';
        $this->Email->to      = $emailReceiver['User']['first_name'].'<'.$emailReceiver['User']['email'].'>';
        $this->Email->subject = 'LACLO Magazine - '.$subject;
        $this->Email->sendAs = 'both';

        $this->Email->delivery = 'smtp';
        $this->set('ms', $content);
        $this->set('user', $emailReceiver['User']['first_name'].' '.$emailReceiver['User']['last_name']);
        $this->Email->send();
        $this->set('smtp_errors', $this->Email->smtpError);
        return 0;
	}

	/****************
	/*
	/*	Authors Functions
	/*
	/***************/

/**
 * createArticle method
 * Inicializa el editor de texto para crear o modificar artículos
 * @return void
 */

	public function createArticle($id=null){
		if($this->Auth->user('role') != 'author'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			$this->set('author', $this->userID);
			if($id==null){
				$this->redirect(array("controller" => "backend", "action" => "createArticle/0"));
			} elseif($id=='0') {
				$this->set('content', '<h1>Bienvenido al Creador de Artículos LACLOmagazine</h1><p>En el menú superior puede agregar fotos, tablas, cambiar colores de letra y fondo en las letras, cambiar la alineación del texto, agregar lineas horizontales y sangrías.</p><blockquote><span style="color: rgb(119, 119, 119); font-style: italic; line-height: 1.45em; -webkit-text-stroke-color: transparent;">Puede utilizar citas textuales remarcadas con este estilo.</span></blockquote><p></p><ol><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent; color: rgb(85, 85, 85);">También</span><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent; color: rgb(85, 85, 85);">&nbsp;puede numerar&nbsp;</span><br></li><li><span style="color: rgb(85, 85, 85); line-height: 1.45em; -webkit-text-stroke-color: transparent;">su contenido.</span><br></li></ol><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;"><ul><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;">O agregarle una viñeta.</span><br></li><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;">Utilizar <b>negritas</b>, <i>cursivas</i> o <strike>letras tachadas.</strike></span></li></ul></span><p></p>');
				$this->set('name', '');
				$this->set('preview', '0');
			} else {
				$paper3 = $this->Paper->PaperAuthor->find('first',
		  			array(
		  				'conditions' => array(
		  					'Paper.id' => $id,
		  					'Author.id' => $this->userID,
		  					'Paper.status' => array('UNSENT', 'REVIEW')
		  				),
		  			)
		  		);
				$paper2 = $this->PaperFile->find('first',
		  			array(
		  				'conditions' => array(
		  					'PaperFile.paper_id' => array($paper3['Paper']['id']),
		  				),
		  			)
		  		);
				if (!empty($paper2)) {
					$this->set('content', $paper2['PaperFile']['raw']);
					$this->set('name', $paper2['PaperFile']['name']);
					$this->set('preview', $paper3['Paper']['id']);
				}
			}
		}
	}

/**
 * uploadArticle method
 * Muestra los artículos con cambios pendientes o pendientes por enviar a edición
 * @return void
 */

	public function uploadArticle(){
		if($this->Auth->user('role') != 'author'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			$papers = $this->Paper->PaperAuthor->find('all',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('UNSENT','REVIEW'),
	  					'Author.id' => $this->userID
	  				),
	  			)
	  		);
	  		$i=0;
	  		if(empty($papers)){
				$this->Session->setFlash(__('Usted no tiene ningun Artículo pendiente por enviar.'));
				$this->redirect(array("controller" => "backend", "action" => "author"));
			}
	  		foreach ($papers as $paper) {
	  			$evaluators[$i] = $this->PaperEvaluator->find('all', array(
				    'conditions' => array('paper_id'=>$paper['Paper']['id'])
				));
	  			$paperFiles[$i] = $this->PaperFile->find('all', array(
				    'conditions' => array('paper_id'=>$paper['Paper']['id']),
				    'fields' => array('id')
				));
				$i++;
	  		}
	  		$i=0;
	  		$evals = '<h1>Correcciones del Artículo</h1>';
	  		foreach ($evaluators as $evaluator) {
	  			if(empty($evaluator)){
	  				$evalsTable[$i] = 'No hay revisiones';
	  			} else {
	  				$index = 1;
	  				foreach ($evaluator as $eval) {
	  					$comms = str_replace('.s.e.p.', ' ', $eval['PaperEvaluator']['comment']);
	  					$evals .= '<h3>Comentario '.$index.': '.$comms.'</h3><br>';
	  					$index++;
	  				}
	  				$evalsTable[$i] = '<a href="#" class="evals"><span class="glyph info glyph-editor"></span></a>';
	  			}
	  			$i++;
	  		}
			$this->set('papers', $papers);
			$this->set('evalsTable', $evalsTable);
			$this->set('evals', $evals);
			$this->set('paperFiles', $paperFiles);	
		}
	}

/**
 * pendingAuthor method
 * Muestra los artículos del autor pendientes por revisión
 * @return void
 */

	public function pendingAuthor() {
		if($this->Auth->user('role') != 'author'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			$this->PaperEvaluator->Behaviors->load('Containable');
			$papers = $this->Paper->PaperAuthor->find('all',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('SENT','ASIGNED','ONREVISION','REJECTED','APPROVED'),
	  					'Author.id' => $this->userID
	  				),
	  			)
	  		);
	  		$i=0;
	  		if(empty($papers)){
				$this->Session->setFlash(__('Usted no tiene ningun Artículo pendiente por revisión.'));
				$this->redirect(array("controller" => "backend", "action" => "author"));
			}
			$paperFiles=array();
			$paperEvaluators=array();

	  		foreach ($papers as $paper) {
	  			$paperFiles[$i] = $this->PaperFile->find('all', array(
				    'conditions' => array('paper_id'=>$paper['Paper']['id']),
				    'fields' => array('id')
				));
				$paperEvaluators[$i] = $this->PaperEvaluator->find('all',
		  			array(
		  				'conditions' => array(
		  					'PaperEvaluator.paper_id' => $paper['Paper']['id']
		  				),
		  				'contain' => array(
		  					'Evaluator' =>array(
		  						'fields' => array('id'),
		  						'User' => array(
		  							'fields' => array('first_name','last_name')
		  						)
		  					),
		  				)
		  			)
		  		);
				$i++;
	  		}
			$this->set('papers', $papers);
			$this->set('paperFiles', $paperFiles);
			$this->set('paperEvaluators', $paperEvaluators);
		}
  	}

/**
 * articleAuthor method
 * Muestra todos los artículos creados por el autor
 * @return void
 */

  	public function articleAuthor() {
  		if($this->Auth->user('role') != 'author'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$papers = $this->Paper->PaperAuthor->find('all',
	  			array(
	  				'conditions' => array(
	  					'Author.id' => $this->userID
	  				),
	  				'order' => array('Paper.created DESC'),
	  			)
	  		);
	  		$i=0;
	  		foreach ($papers as $paper) {
	  			$paperFiles[$i] = $this->PaperFile->find('all', array(
				    'conditions' => array('paper_id'=>$paper['Paper']['id']),
				    'fields' => array('id')
				));
				$i++;
	  		}

			$this->set('papers', $papers);
			$this->set('paperFiles', $paperFiles);
			if(empty($papers)){
				$this->Session->setFlash(__('Usted no tiene ningun Artículo creado.'));
				$this->redirect(array("controller" => "backend", "action" => "author"));
			}
		}
  	}

/**
 * uploadImage method
 * Sube al servidor una imagen desde el editor de artículos
 * @return void
 */

  	public function uploadImage() {
		$this->autoRender = false;

		// carpeta para guardarlos
		$dir = APP.'webroot'.DS.'files'.DS;
		
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
				'filelink' => '../../files/'.$filename
			);
			echo stripslashes(json_encode($array));   
		}
  	}

	/****************
	/*
	/*	Editor Functions
	/*
	/***************/

/**
 * addUser method
 * form para agregar nuevos usuarios
 * @return void
 */

	public function addUser($id=null) {
		if($this->Auth->user('role') == 'editor'){
			$user = null;
			if($id != '0'){
				$user = $this->User->find('first',array('conditions' => array('User.id' => $id)));
				if(empty($user)){
		  			$this->Session->setFlash(__('Ocurrió un error. Intentelo nuevamente.'));
					$this->redirect(array("controller" => "backend", "action" => "index"));
		  		}
			}
			$this->set('user', $user);
		} else {
			$this->redirect(array("controller" => "backend", "action" => "index"));
		}
	}

/**
 * addNewUser method
 * guarda nuevo usuario y le envía un correo para establecer contraseña
 * @return void
 */

	public function addNewUser($id=null) {
		$this->autoRender = false;
		if($this->Auth->user('role') == 'editor'){
			if ($this->request->is('post')) {
				if ($this->data['submit'] == "Aceptar Usuario") {
					$data = array('id' => $this->data['id'], 'username' => $this->data['username'], 'email' => $this->data['email'], 'role' => $this->data['role'], 'first_name' => $this->data['first_name'], 'last_name' => $this->data['last_name']);
					$this->User->save($data);
					
		           	$fu=$this->User->find('first',array('conditions'=>array('User.email'=>$this->data['email'])));

		           	if($fu['User']['role']=='evaluator'){
		           		$this->Evaluator->create();
						$data = array('user_id' => $fu['User']['id']);
						$this->Evaluator->save($data);
		           	} else {
		           		$this->Author->create();
						$data = array('user_id' => $fu['User']['id']);
						$this->Author->save($data);
		           	}


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

	                    $this->Email->template = 'newuser';
	                    $this->Email->from    = 'LACLO Magazine <laclomag@gmail.com>';
	                    $this->Email->to      = $fu['User']['first_name'].'<'.$fu['User']['email'].'>';
	                    $this->Email->subject = 'Solicitud de Ingreso LACLO Magazine';
	                    $this->Email->sendAs = 'both';

	                    $this->Email->delivery = 'smtp';
	                    $this->set('ms', $ms);
	                    $this->set('user', $fu['User']['first_name']);
	                    $this->set('username', $fu['User']['username']);
	                    $this->Email->send();
	                    $this->set('smtp_errors', $this->Email->smtpError);

	                    $this->Session->setFlash("El usuario se ha guardado exitosamente. Se le ha enviado un correo electronico para establecer su contraseña.");
	                    $this->redirect(array("controller" => "backend", "action" => "index"));

	                    //============EndEmail=============//
	                } else {
	                    $this->Session->setFlash("Ocurrio un error guardando el usuario");
	                    $this->redirect(array("controller" => "backend", "action" => "index"));
	                }
	            } elseif ($this->data['submit'] == "Agregar Usuario") {
		        	$this->User->create();
					$data = array('username' => $this->data['username'], 'password' => 'jbasd54asd7g8df65f468sd4f68sdf58654g', 'email' => $this->data['email'], 'role' => $this->data['role'], 'first_name' => $this->data['first_name'], 'last_name' => $this->data['last_name']);
					$this->User->save($data);

		        	$fu=$this->User->find('first',array('conditions'=>array('User.email'=>$this->data['email'])));

		        	if($fu['User']['role']=='evaluator'){
		           		$this->Evaluator->create();
						$data = array('user_id' => $fu['User']['id']);
						$this->Evaluator->save($data);
		           	} else {
		           		$this->Author->create();
						$data = array('user_id' => $fu['User']['id']);
						$this->Author->save($data);
		           	}

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

	                    $this->Email->template = 'newuser';
	                    $this->Email->from    = 'LACLO Magazine <laclomag@gmail.com>';
	                    $this->Email->to      = $fu['User']['first_name'].'<'.$fu['User']['email'].'>';
	                    $this->Email->subject = 'Solicitud de Ingreso LACLO Magazine';
	                    $this->Email->sendAs = 'both';

	                    $this->Email->delivery = 'smtp';
	                    $this->set('ms', $ms);
	                    $this->set('user', $fu['User']['first_name']);
	                    $this->set('username', $fu['User']['username']);
	                    $this->Email->send();
	                    $this->set('smtp_errors', $this->Email->smtpError);

	                    $this->Session->setFlash("El usuario se ha guardado exitosamente");
	                    $this->redirect(array("controller" => "backend", "action" => "index"));

	                    //============EndEmail=============//
	                }
		        } elseif ($this->data['submit'] == "Rechazar Usuario") {
		        	$this->User->id = $this->data['id'];
				    if (!$this->User->exists()) {
				        $this->Session->setFlash(__('Ocurrio un error.'));
			            $this->redirect(array("controller" => "backend", "action" => "index"));
					}
			        if ($this->User->delete()) {
			            $this->Session->setFlash(__('Se ha eliminado la petición de ingreso.'));
			            $this->redirect(array("controller" => "backend", "action" => "index"));
			        }
			        $this->redirect(array("controller" => "backend", "action" => "index"));
		        }
	        }
		} else {
			$this->redirect(array("controller" => "backend", "action" => "index"));
		}
	}

/**
 * viewArticlesEditor method
 * muestra todos los artículos recibidos por edición
 * @return void
 */

  	public function viewArticlesEditor() {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$this->Paper->Behaviors->load('Containable');
	  		$this->PaperAuthor->Behaviors->load('Containable');
	  		$this->paginate = array(
	  			'Paper' => array(
	  				'contain' => array(
		  				'PaperAuthor' =>array(
	  						'fields' => array('author_id'),
	  						'Author' => array(
	  							'fields' => array('id'),
	  							'User' => array(
	  								'fields' => array('first_name','last_name')
								)
							)
						),
						'MagazinePaper' => array(
							'fields' => array('id'),
							'Magazine' => array(
								'fields' => 'name'
							)
						), 
						'PaperFile' => array(
						
						), 
					),
					'conditions' => array('Paper.status' => array('SENT','ONREVISION', 'REJECTED', 'APPROVED', 'PUBLISHED', 'UNPUBLISHED')),
					'order' => array('Paper.created DESC'),
	  			)
	  		);

	  		$paperPaginate = $this->paginate('Paper');

			if(empty($paperPaginate)){
				$this->Session->setFlash(__('Aun no se ha recibido ningún artículo.'));
				$this->redirect(array("controller" => "backend", "action" => "editor"));
			}
	  		$this->set('papers', $paperPaginate);
	  	}
  	}

/**
 * viewPendingArticlesEditor method
 * muestra todos los artículos pendientes en edición
 * @return void
 */

  	public function viewPendingArticlesEditor() {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$this->Paper->Behaviors->load('Containable');
	  		$papers = $this->Paper->find('all',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('SENT','UNPUBLISHED','ONREVISION','APPROVED')
	  				),
	  				'contain' => array(
	  					'PaperAuthor' =>array(
	  						'fields' => array('author_id'),
	  						'Author' => array(
	  							'fields' => array('id'),
	  							'User' => array(
	  								'fields' => array('first_name','last_name')
	  								)
	  							)
	  						),
						'MagazinePaper' => array(
							'fields' => array('id'),
							'Magazine' => array(
								'fields' => 'name'
							)
						)
	  				)
	  			)
	  		);
	  		$this->set('papers', $papers);
	  		if(empty($papers)){
				$this->Session->setFlash(__('No hay ningún artículo pendiente por revisión.'));
				$this->redirect(array("controller" => "backend", "action" => "editor"));
			}
		}
  	}

 /**
 * inspectPaper method
 * permite inspeccionar artículo, evaluarlo o asignarlo a revista.
 * @return void
 */

  	public function inspectPaper($id) {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$paper = $this->Paper->find('first',
	  			array(
	  				'conditions' => array('Paper.id' => $id),
	  				'contain' => array(
	  					'PaperAuthor' =>array(
	  						'fields' => array('author_id'),
	  						'Author' => array(
	  							'fields' => array('id'),
	  							'User' => array(
	  								'fields' => array('first_name','last_name')
	  								)
	  							)
	  						),
						'MagazinePaper' => array(
							'fields' => array('id'),
							'Magazine' => array(
								'fields' => 'name'
							)
						),
						'PaperEvaluator'  => array(
							'fields' => array('id','evaluator_id', 'status', 'type', 'comment'),
							'Evaluator' => array(
								'fields' => array('id', 'user_id'),
								'User' => array(
	  								'fields' => array('first_name','last_name')
	  							)
	  						)
						), 
						'PaperFile' => array()
	  				),
	  			)
	  		);

	  		if($paper['Paper']['status'] != 'APPROVED'){
	  			$this->Session->setFlash(__('Para poder ver las correcciones de un evaluador debes asignar los dos evaluadores principales y un suplente.'));
	  		}
	  		$this->set('paper', $paper);

	  		if(empty($paper)){
				$this->Session->setFlash(__('El artículo no existe.'));
				$this->redirect(array("controller" => "backend", "action" => "index"));
			}
	  		
	  		$this->Evaluator->Behaviors->load('Containable');
			$evaluators = $this->Evaluator->find('all', array(
				'contain' => array(
					'PaperEvaluator' => array(
						'conditions' => array(
							'PaperEvaluator.paper_id ' => $id
						)
					),
					'User'
				)
			));

			$assignedPapers = array();
			$availableEvaluators = array();
			foreach ($evaluators as $evaluator) {
				$count = $this->PaperEvaluator->find('count', array(
		        	'conditions' => array('PaperEvaluator.evaluator_id' => $evaluator['Evaluator']['id'], 'PaperEvaluator.status' => array('ASIGNED', 'ACCEPT'))
		        ));
				if (empty($evaluator['PaperEvaluator'])) {
					array_push($assignedPapers, $count);
					array_push($availableEvaluators, $evaluator);	
				}
			}

			$principalCount = $this->PaperEvaluator->find('count', array(
	        	'conditions' => array('PaperEvaluator.paper_id' => $id, 'PaperEvaluator.type' => 'PRINCIPAL'),
	        ));

	        $surrogateCount = $this->PaperEvaluator->find('count', array(
	        	'conditions' => array('PaperEvaluator.paper_id' => $id, 'PaperEvaluator.type' => 'SURROGATE'),
	        ));

	  		$this->set('evaluators', $availableEvaluators);
	  		$this->set('assignedPapers', $assignedPapers);
	  		$this->set('principalCount', $principalCount);
	  		$this->set('surrogateCount', $surrogateCount);
	  		$this->set('paperId', $id);
	  	}
  	}

 /**
 * modifyArticle method
 * permite hacer cambios en el texto del artículo
 * @return void
 */

  	public function modifyArticle($id=null){
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			if(substr($id, -1) == '*'){
				list($id) = explode("*", $id);
				$caller = 'mag';
			} else {
				$caller = 'paper';
			}
			if($id==null){
				$this->Session->setFlash(__('Artículo Invalido.'));
				$this->redirect(array("controller" => "backend", "action" => "index"));
			} else {
				$paper3 = $this->Paper->PaperAuthor->find('first',
		  			array(
		  				'conditions' => array(
		  					'Paper.id' => $id
		  				),
		  			)
		  		);
				$paper2 = $this->PaperFile->find('first',
		  			array(
		  				'conditions' => array(
		  					'PaperFile.paper_id' => array($paper3['Paper']['id']),
		  				),
		  			)
		  		);
				if (!empty($paper2)) {
					$this->set('content', $paper2['PaperFile']['raw']);
					$this->set('name', $paper2['PaperFile']['name']);
					$this->set('preview', $paper3['Paper']['id']);
					$this->set('caller', $caller);
				}
			}
		}
	}

/**
 * modifyMagazine method
 * permite hacer cambios en el texto de la revista
 * @return void
 */

  	public function modifyMagazine($id=null){
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			if($id==null){
				$this->Session->setFlash(__('Revista Invalida.'));
				$this->redirect(array("controller" => "backend", "action" => "index"));
			} else {
				$magazine = $this->MagazinePaper->find('all',
		  			array(
		  				'conditions' => array(
		  					'magazine_id' => $id
		  				),
		  			)
		  		);
		  		$i=0;
		  		foreach ($magazine as $paper) {
		  			$paperFiles[$i] = $this->PaperFile->find('all', array(
					    'conditions' => array('paper_id'=>$paper['Paper']['id']),
					    'fields' => array('raw')
					));
					$i++;
		  		}
		  		$content='';
		  		foreach ($paperFiles as $paperFile) {
		  			$content.=$paperFile[0]['PaperFile']['raw'];
		  		}

				if (!empty($magazine)) {
					$this->set('content', $content);
					//$this->set('name', $paper2['PaperFile']['name']);
					$this->set('preview', $id);
				}
			}
		}
	}

 /**
 * acceptArticle method
 * permite cambiar el estado de un articulo
 * @return void
 */

	public function acceptArticle($id=null, $status=null){
		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			if($id == null || $status==null){
				$this->Session->setFlash(__('Artículo Invalido, intente nuevamente'));
				$this->redirect(array('action' => 'index'));
			}
			$evaluators = $this->PaperEvaluator->find('all', array(
	        	'conditions' => array('PaperEvaluator.paper_id' => $id, 'PaperEvaluator.status' => array('ASIGNED', 'ACCEPT'))
	        ));
	        
	        foreach ($evaluators as $evaluator) {
	        	$paperEvaluatorData = array('id' => $evaluator['PaperEvaluator']['id'], 'status' => 'EDITOR');
	        	$this->PaperEvaluator->save($paperEvaluatorData);
	        }

	        $paper = $this->Paper->find('first', array(
	        	'conditions' => array('Paper.id' => $id)
	        ));

			if($status=='APPROVED'){
				$this->Session->setFlash(__('Se ha Aceptado el articulo '.$paper['Paper']['name']));
				$data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha aceptado el articulo <strong>'. $paper['Paper']['name'].'</strong>.');
				$this->Logbook->save($data4);
			} elseif($status=='REJECTED'){
				$this->Session->setFlash(__('Se ha Rechazado el articulo '.$paper['Paper']['name']));
				$data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha rechazado el articulo <strong>'. $paper['Paper']['name'].'</strong>.');
				$this->Logbook->save($data4);
			} elseif($status=='REVIEW'){
				$this->Session->setFlash(__('Se ha Devuelto al autor el articulo '.$paper['Paper']['name']));
				$data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha devuelto el articulo <strong>'. $paper['Paper']['name'].'</strong>.');
				$this->Logbook->save($data4);
			}

	        $paperData = array('id' => $id, 'status' => $status);
	        $this->Paper->save($paperData);
	        
	        $this->redirect(array('action' => 'index'));
	    }
	}

 /**
 * addEvaluator method
 * permite agregar un evaluador al artículo
 * @return void
 */

  	public function addEvaluator($evaluatorId=null,$paperId=null,$evaluatorType=null) {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$evaluatorData = array();
	  		$evaluatorData['PaperEvaluator']['paper_id'] = $paperId;
	  		$evaluatorData['PaperEvaluator']['evaluator_id'] = $evaluatorId;
	  		$evaluatorData['PaperEvaluator']['type'] = $evaluatorType;

	        $this->PaperEvaluator->create();
	        if ($this->PaperEvaluator->save($evaluatorData)) {
	            $evaluator = $this->Evaluator->find('first', array(
	            	'conditions' => array('Evaluator.id' => $evaluatorId),
	            	'fields' => array('user_id')
	            ));

	            $paper = $this->Paper->find('first', array(
	            	'conditions' => array('Paper.id' => $paperId),
	            ));

	            $paperData = array('id' => $paperId, 'status' => 'ONREVISION');
	            $this->Paper->save($paperData);
				
				$data4 = array('user_id' => $evaluator['Evaluator']['user_id'], 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha asiginado el articulo '. $paper['Paper']['name'].' para evaluar</strong>.');
				$this->Logbook->save($data4);

	            $this->Session->setFlash(__('El evaluador ha sido asignado'));
	            $this->redirect(array(
					'action' => 'inspectPaper',
					$paperId
				));
	        } else {
	            $this->Session->setFlash(__('Ocurrió un error, intentelo nuevamente.'));
	        }
	    }
  	}

 /**
 * deleteEvaluator method
 * permite eliminar un evaluador del artículo
 * @return void
 */
 	
 	public function deleteEvaluator($paperEvaluatorId=null, $evaluatorId=null,$paperId=null) {
 		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	 		$this->PaperEvaluator->id = $paperEvaluatorId;
		    if (!$this->PaperEvaluator->exists()) {
	            throw new NotFoundException(__('Artículo Inválido'));
		    }
	        if ($this->PaperEvaluator->delete()) {
	            $this->Session->setFlash(__('Se ha eliminado la asignación'));
	            	
	            $evaluator = $this->Evaluator->find('first', array(
	            	'conditions' => array('Evaluator.id' => $evaluatorId),
	            	'fields' => array('user_id')
	            ));

	            $paper = $this->Paper->find('first', array(
	            	'conditions' => array('Paper.id' => $paperId),
	            	'fields' => array('Paper.name')
	            ));
				
				$data4 = array('user_id' => $evaluator['Evaluator']['user_id'], 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha removido el articulo '. $paper['Paper']['name'].' de su lista de evaluación</strong>.');
				$this->Logbook->save($data4);


	            $this->redirect(array(
					'action' => 'inspectPaper',
					$paperId
				));
	        }
	        $this->Session->setFlash(__('No se ha eliminado la asignación, intente nuevamente.'));
	        $this->redirect(array('action' => 'inspectPaper',$paperId));
		}	
  	}

 /**
 * changeEvaluationType method
 * permite cambiar el tipo de evaluación de un artículo
 * @return void
 */

  	public function changeEvaluationType($paperId=null, $evaluationType=null) {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		if (!$this->Paper->exists($paperId)) {
	            throw new NotFoundException(__('Artículo Invalido'));
	        }
	  		$this->Paper->read(null, $paperId);
			$this->Paper->set(array(
				'evaluation_type' => $evaluationType
			));

	  		if ($this->Paper->save()) {
	            $this->Session->setFlash(__('El Tipo de Evaluación ha sido Cambiada'));
	            
	            $paperEvaluators = $this->PaperEvaluator->find('all', array(
	            	'conditions' => array('PaperEvaluator.paper_id' => $paperId)
	            ));

	            foreach ($paperEvaluators as $paperEvaluator) {
	            	$data4 = array('user_id' => $paperEvaluator['Evaluator']['user_id'], 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'se ha cambiado el tipo de evaluación a tipo '. $evaluationType.' del paper '. $paperEvaluator['Paper']['name'].'</strong>.');
					$this->Logbook->save($data4);
	            }

	            $this->redirect(array(
					'action' => 'inspectPaper',
					$paperId
				));

	        } else {
	            $this->Session->setFlash(__('El tipo de evaluación no pudo ser cambiado por favor intente nuevamente'));
	            $this->redirect(array('action' => 'inspectPaper',$paperId));
	        }
	    }
  	}

 /**
 * addArticleToMag method
 * permite añadir un artículo a la revista en construcción
 * @return void
 */

 	public function addArticleToMag($paperId=null) {
 		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		if (!$this->Paper->exists($paperId)) {
	            throw new NotFoundException(__('Invalid Paper'));
	        }

			$magazine = $this->Magazine->find('first', array(
				'conditions' => array(
					'Magazine.status' => 'ONCONSTRUCTION'
				)
			));

			if(empty($magazine)){
				$this->Session->setFlash(__('No existe una revista En construcción, cree la misma primero.'));
	            $this->redirect(array('action' => 'newMag'));
			}

			$totalArticles = $this->MagazinePaper->find('count', array(
				'conditions' => array('MagazinePaper.magazine_id' => $magazine['Magazine']['id'])
			));

	  		$this->Paper->read(null, $paperId);
			$this->Paper->set(array(
				'status' => 'PUBLISHED'
			));

			$this->MagazinePaper->create();
			$this->MagazinePaper->set(array(
				'paper_id' => $paperId,
				'magazine_id' => $magazine['Magazine']['id'],
				'order' => $totalArticles + 1
			));

			if ($this->Paper->save() && $this->MagazinePaper->save()) {
	            $this->Session->setFlash(__('El articulo ha sido agregado a la revista'));
	            $this->redirect(array('action' => 'viewCurrentMagEditor'));
	        } else {
	            $this->Session->setFlash(__('Hubo un error en la publicacion por favor intente nuevamente'));
	            $this->redirect(array('action' => 'inspectPaper',$paperId));
	        }
	    }
  	}

 /**
 * removePaperfromMag method
 * permite quitar un artículo de la revista en construcción
 * @return void
 */

  	public function removePaperfromMag($magazinePaperId=null) {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			$this->MagazinePaper->id = $magazinePaperId;
			$magazinePaper = $this->MagazinePaper->find('first',array(
				'conditions' => array('MagazinePaper.id' => $magazinePaperId)
			));

			$this->Paper->read(null, $magazinePaper['MagazinePaper']['paper_id']);
			$this->Paper->set(array('status' => 'UNPUBLISHED'));

			if ($this->MagazinePaper->delete()) {
				if ($this->Paper->save()) {
					$this->Session->setFlash('El Artículo fue desasignado');
					$this->redirect(array('action' => 'viewCurrentMagEditor'));
				}
			} else {
				$this->Session->setFlash('Hubo un error eliminando el Artículo');
				$this->redirect(array('action' => 'viewCurrentMagEditor'));
			}
		}
  	}

 /**
 * removeCoverfromMag method
 * permite quitar la portada de la revista en construcción
 * @return void
 */

  	public function removeCoverfromMag($id = null) {
		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			$magazineFiles = $this->MagazineFiles->find('first',array(
				'conditions' => array('MagazineFiles.magazine_id' => $id, 'MagazineFiles.type' => 'COVER')
			));

			$this->MagazineFiles->id = $magazineFiles['MagazineFiles']['id'];

			if ($this->MagazineFiles->delete()) {
				$this->Logbook->create();
				$data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Usted ha eliminado la portada de la revista en construcción.');
				$this->Logbook->save($data4);
				$this->Session->setFlash('La portada de la revista fue eliminada.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Hubo un error eliminando la portada.');
				$this->redirect(array('action' => 'index'));
			}
  		}
  	}

 /**
 * viewCurrentMagEditor method
 * muestra los artículos asignados a la revista en construcción
 * @return void
 */

  	public function viewCurrentMagEditor() {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$this->Session->setFlash(__('Elige el orden de los artículos en la revista y crea la portada para poder publicarla.'));
	  		$this->MagazinePaper->Behaviors->load('Containable');
	  		$magazine = $this->Magazine->find('first',
	  			array(
	  				'conditions' => array(
	  					'Magazine.status' => array('ONCONSTRUCTION')
	  				),
	  			)
	  		);
	  		if ($magazine) {
		  		$magazineId = $magazine['Magazine']['id'];
		  		$magazinePapers = $this->MagazinePaper->find('all',
		  			array(
		  				'contain' => array(
		  					'Paper' => array(
		  						'fields' => array('id','name','created','evaluation_type'),
		  						'PaperAuthor' => array(
		  							'fields' => array('paper_id', 'author_id'),
		  							'Author' => array(
		  								'User' => array(
		  									'fields' => array('first_name', 'last_name')
		  								)
		  							)
		  						),'PaperFile' => array(
		  						)
		  					)
		  				),
		  				'conditions' => array(
		  						'MagazinePaper.magazine_id' => $magazineId
		  				),
		  				'order' => array('MagazinePaper.order ASC'),
		  			)
		  		);
		  		$magazineFile = $this->MagazineFiles->find('count',
		  			array(
		  				'conditions' => array(
		  						'MagazineFiles.magazine_id' => $magazineId,
		  						'MagazineFiles.type' => 'COVER'
		  				),
		  			)
		  		);

		  		$this->set('magazine', $magazine);
		  		$this->set('magazinePapers', $magazinePapers);
		  		$this->set('magazineFile', $magazineFile);
	  		}
	  		if(empty($magazine)){
				$this->Session->setFlash(__('Es necesario crear el próximo ejemplar.'));
				$this->redirect(array("controller" => "backend", "action" => "newMag"));
			}
			if(empty($magazinePapers)){
				$this->Session->setFlash(__('Debe asignar un artículo a la revista para poder editarla.'));
				$this->redirect(array("controller" => "backend", "action" => "index"));
			}
		}
  	}

 /**
 * viewArticlesArchiveEditor method
 * muestra el archivo de revistas anteriores
 * @return void
 */

  	public function viewArticlesArchiveEditor() {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$this->Magazine->Behaviors->load('Containable');
	  		$magazines = $this->Magazine->find('all',
	  			array(
	  				'contain' => array(
							'MagazineFile' => array(
								'fields' => array('magazine_id', 'title', 'edition'),
							),
							'MagazinePaper' => array(
								'Paper' => array(
		  						'fields' => array('id','name','created','evaluation_type',),
		  						'PaperAuthor' => array(
		  							'fields' => array('paper_id', 'author_id'),
		  							'Author' => array(
		  								'User' => array(
		  									'fields' => array('first_name', 'last_name')
		  								)
		  							)
		  						)
		  					)
		  				),
						),
	  				'conditions' => array(
	  						'Magazine.status' => array('ARCHIVED', 'ACTUAL')
	  				)
	  			)
	  		);
	  		$this->set('magazines', $magazines);
	  	}
  	}

 /**
 * newMag method
 * crea una nueva revista
 * @return void
 */

  	public function newMag() {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			if ($this->request->is('post')) {
				$magazine = $this->Magazine->find('first', array(
	  				'conditions' => array('status' => 'ACTUAL'),
	  				'fields' => 'Magazine.exemplary'
	  			));

	  			

	            $this->Magazine->create();
	            if($magazine){
	  				$data = array('name' => $this->data['name'], 'title' => $this->data['name'], 'exemplary' => $magazine['Magazine']['exemplary']+1, 'status' => 'ONCONSTRUCTION');
	  			} else {
	  				$data = array('name' => $this->data['name'], 'title' => $this->data['name'], 'exemplary' => 0, 'status' => 'ONCONSTRUCTION');
	  			}
	            //$data = array('name' => $this->data['name'], 'title' => $this->data['name'], 'exemplary' => $magazine['Magazine']['exemplary']+1, 'status' => 'ONCONSTRUCTION');
	            $data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha creado la revista <strong>'. $this->data['name'].'</strong>.');

	            if ($this->Magazine->save($data)) {
	            	$this->Logbook->create();
	            	$this->Logbook->save($data4);

					$this->Session->setFlash(__('Se creó la nueva revista <?php echo $this->data["name"];?>'));
					$this->redirect(array('action' => 'viewCurrentMagEditor'));
				} else {
					$this->Session->setFlash(__('Ocurrió un error, intentelo nuevamente.'));
					$this->redirect(array('action' => 'index'));
				}
			}
		}
  	}

 /**
 * reorderMagpapers method
 * ordena los artículos asignados a una revista
 * @return void
 */

  	public function reorderMagpapers() {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$newPaperOrders = $this->request->data;
	  		$orderedPapers = array();
	  		$unorderedPapers = array();
	  		
	  		foreach ($newPaperOrders as $paperMagId => $paperOrderValue) {
	  			if ($paperOrderValue !== '' && is_numeric($paperOrderValue)) {
	  				$orderedPapers[$paperMagId] = $paperOrderValue;
	  			} else {
	  				$unorderedPapers[$paperMagId] = $paperOrderValue;
	  			}
	  		}

	  		arsort($orderedPapers);
	  		$orderedPapers = array_reverse($orderedPapers, true); 

	  		foreach ($unorderedPapers as $unorderedPaper) {
	  			array_push($orderedPapers, $unorderedPaper);
	  		}

	  		$i=0;
	  		foreach ($orderedPapers as $orderedPaperId => $orderedPaperValue) {
	  			$this->MagazinePaper->id = $orderedPaperId;	
	  			$magPaper['MagazinePaper']['order'] = $i;
	  			$i++;

	  			if(!$this->MagazinePaper->save($magPaper)) { 
	 				$this->Session->setFlash(__('Error'));
					$this->redirect(array(
						'action' => 'viewCurrentMagEditor'
					)); 				
	  			}
	  		}

	  		$this->Session->setFlash(__('Orden Cambiado'));
			$this->redirect(array('action' => 'viewCurrentMagEditor'));
		}
  	}

 /**
 * publishMag method
 * publica revista nueva
 * @return void
 */

  	public function publishMag() {
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$magId = $this->request->data['magId'];
	  		$magazines = $this->Magazine->find('all',
	  			array(
	  				'conditions' => array(
	  					'Magazine.status' => 'ACTUAL'
	  				)
	  			)
	  		);

	  		if(!empty($magazines)){
	  			foreach ($magazines as $magazine) {
		  			$data = array('id' => $magazine['Magazine']['id'], 'status' => 'ARCHIVED');
					$this->Magazine->save($data);
		  		}
	  		}

	  		$this->Magazine->id = $magId;
	  		$mag['Magazine']['status'] = 'ACTUAL';

	  		if ($this->Magazine->save($mag)) {
	  			$this->Session->setFlash(__('Ya se ha publicado la revista'));
				$this->redirect(array('action' => 'viewCurrentMagEditor')); 
	  		}
	  	}
  	}

 /**
 * createNews method
 * form para crear noticia nueva
 * @return void
 */

  	public function createNews($id=null){
  		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			if($id==null){
				$this->redirect(array("controller" => "backend", "action" => "createNews/0"));
			} elseif($id=='0') {
				$this->set('content', '<h1>Contenido de la Noticia</h1><br><br><br>');
				$this->set('name', '');
				$this->set('headline', '');
				$this->set('preview', '0');
				$this->set('video', '');
			} else {
				$news = $this->News->find('first',
		  			array(
		  				'conditions' => array(
		  					'News.id' => $id,
		  				),
		  			)
		  		);
				if (!empty($news)) {
					$this->set('content', $news['News']['content']);
					$this->set('name', $news['News']['headline']);
					$this->set('preview', $news['News']['id']);
					$this->set('headline', $news['News']['summary']);
					$this->set('video', $news['News']['video_url']);
				}
			}
		}
	}

 /**
 * viewNews method
 * muestra todas las noticias creadas
 * @return void
 */

	public function viewNews(){
		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			$news = $this->News->find('all',
	  			array(
	  				'order' => array('News.created DESC'),
	  			)
	  		);
	  		$i=0;
	  		if(empty($news)){
				$this->Session->setFlash(__('No hay ninguna noticia creada.'));
				$this->redirect(array("controller" => "backend", "action" => "index"));
			}
			$this->set('news', $news);
		}
	}

 /**
 * cover method
 * formulario para crear la portada de la revista
 * @return void
 */

	public function cover($id=null){
		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			if($id==null){
				$this->Session->setFlash(__('Debe seleccionar una revista para cambiar la portada.'));
				$this->redirect(array("controller" => "backend", "action" => "index"));
			}

			$magazine = $this->Magazine->find('first', array('conditions' => array('Magazine.id' => $id)));
			if(empty($magazine)){
				$this->Session->setFlash(__('La revista seleccionada es inválida.'));
				$this->redirect(array("controller" => "backend", "action" => "index"));
			}

			if($magazine['Magazine']['status']!='ONCONSTRUCTION'){
				$this->Session->setFlash(__('La revista seleccionada es inválida.'));
				$this->redirect(array("controller" => "backend", "action" => "index"));
			}

			$this->set('magazine', $magazine);
		}
	}

 /**
 * previewCover method
 * formulario para visualizar la portada de la revista
 * @return void
 */

	public function previewCover($id=null){
		if($this->Auth->user('role') != 'editor'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			if ($this->request->is('post')) {
	            $file = $this->data;
	            $this->layout = 'backend';
	            $this->set('magazine', $this->data);
	        }
	    }
	}
	
  	/****************
	/*
	/*	Evaluator Functions
	/*
	/***************/

 /**
 * pendingEvaluator method
 * muestra los artículos pendientes para revisión
 * @return void
 */

	public function pendingEvaluator(){
		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			$this->PaperAuthor->Behaviors->load('Containable');
			$papers = $this->Paper->PaperEvaluator->find('all',
	  			array(
	  				'conditions' => array(
	  					'Evaluator.id' => $this->userID,
	  					'PaperEvaluator.status' => 'ACCEPT'
	  				),
	  				'order' => array('Paper.created DESC'),
	  			)
	  		);
	  		$i=0;
	  		if(empty($papers)){
				$this->Session->setFlash(__('Usted no tiene ningún Artículo aceptado para revisión.'));
				$this->redirect(array("controller" => "backend", "action" => "evaluator"));
			}
	  		foreach ($papers as $paper) {
	  			$paperFiles[$i] = $this->PaperFile->find('all', array(
				    'conditions' => array('paper_id'=>$paper['Paper']['id']),
				    'fields' => array('id')
				));
				$paperAuthors[$i] = $this->PaperAuthor->find('first',
		  			array(
		  				'conditions' => array(
		  					'PaperAuthor.paper_id' => $paper['Paper']['id']
		  				),
		  				'contain' => array(
		  					'Author' =>array(
		  						'fields' => array('id'),
		  						'User' => array(
		  							'fields' => array('first_name','last_name')
		  						)
		  					),
		  				)
		  			)
		  		);
				$i++;
	  		}

			$this->set('papers', $papers);
			$this->set('paperFiles', $paperFiles);
			$this->set('paperAuthors', $paperAuthors);
		}
	}

 /**
 * evaluatePaper method
 * area para evaluación de artículos.
 * @return void
 */

	public function evaluatePaper($id=null){
		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
			$paper = $this->PaperFile->find('first', array('conditions' => array('PaperFile.id' => $id)));
			$bodytag = $paper['PaperFile']['raw'];
			$paperEvaluator = $this->PaperEvaluator->find('first', 
	            array('conditions' => 
	                array('PaperEvaluator.paper_id' => $paper['PaperFile']['paper_id'], 'PaperEvaluator.evaluator_id' => $this->userID)
	            )
	        );

	        if(empty($paperEvaluator['PaperEvaluator']['comment'])){ 
	        	$this->set('comment', '\n\n======================\nAREA PARA CORRECCIONES\n======================\n\n\nAquí puede escribir todos los comentarios sobre la revisión del artículo a su derecha.');
	        } else {
	        	//$cadena = preg_replace("/\r\n+|\r+|\n+|\t+/i", '', $paperEvaluator['PaperEvaluator']['comment']);
	        	$cadena = str_replace('.s.e.p.', '\n', $paperEvaluator['PaperEvaluator']['comment']);
	        	$this->set('comment', $cadena);
	        }
			$this->set('paper', $bodytag);
			$this->set('evaluatorid', $paperEvaluator['PaperEvaluator']['id']);
		}
	}

 /**
 * articleEvaluator method
 * Muestra los artículos aceptados
 * @return void
 */

	public function articleEvaluator() {
		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$papers = $this->Paper->PaperEvaluator->find('all',
	  			array(
	  				'conditions' => array(
	  					'Evaluator.id' => $this->userID,
	  					'PaperEvaluator.status' => 'ACCEPT'
	  				),
	  				'order' => array('Paper.created DESC'),
	  			)
	  		);
	  		$i=0;
	  		foreach ($papers as $paper) {
	  			$paperFiles[$i] = $this->PaperFile->find('all', array(
				    'conditions' => array('paper_id'=>$paper['Paper']['id']),
				    'fields' => array('id')
				));
				$i++;
	  		}

			$this->set('papers', $papers);
			if($papers){
				$this->set('paperFiles', $paperFiles);
			}
			if(empty($papers)){
				$this->Session->setFlash(__('Usted no tiene ningún Artículo aceptado para revisión.'));
				$this->redirect(array("controller" => "backend", "action" => "evaluator"));
			}
		}
  	}

 /**
 * articleEvaluator method
 * Muestra los artículos por aceptar para revisión
 * @return void
 */

  	public function approvedEvaluator() {
  		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$papers = $this->Paper->PaperEvaluator->find('all',
	  			array(
	  				'conditions' => array(
	  					'Evaluator.id' => $this->userID,
	  					'PaperEvaluator.status' => 'ASIGNED'
	  				),
	  				'order' => array('Paper.created DESC'),
	  			)
	  		);
	  		$i=0;
	  		foreach ($papers as $paper) {
	  			$paperFiles[$i] = $this->PaperFile->find('all', array(
				    'conditions' => array('paper_id'=>$paper['Paper']['id']),
				    'fields' => array('id')
				));
				$author[$i] = $this->Paper->PaperAuthor->find('all',
		  			array(
		  				'conditions' => array(
		  					'Paper.id' => $paper['Paper']['id']
		  				)
		  			)
	  			);
	  			$user[$i] = $this->User->find('all', array(
				    'conditions' => array('id'=>$author[$i]['0']['Author']['user_id']),
				    'fields' => array('User.first_name', 'User.last_name')
				));
				$i++;
	  		}
	  		if(empty($papers)){
				$this->Session->setFlash(__('Usted no tiene ningún Artículo asignado sin aceptar.'));
				$this->redirect(array("controller" => "backend", "action" => "evaluator"));
			}
			$this->set('papers', $papers);
			$this->set('paperFiles', $paperFiles);
			$this->set('author', $user);
		}
  	}

/**
 * currentEvaluator method
 * muestra todo el historial de artículos corregidos por el evaluador
 * @return void
 */

  	public function currentEvaluator() {
  		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$papers = $this->Paper->PaperEvaluator->find('all',
	  			array(
	  				'conditions' => array(
	  					'Evaluator.id' => $this->userID,
	  					'PaperEvaluator.status' => array('APPROVED', 'DENIED', 'MINORCHANGE', 'AUTHORCHANGE', 'CORRECTED')
	  				),
	  				'order' => array('Paper.created DESC'),
	  			)
	  		);
	  		$i=0;
	  		if(empty($papers)){
				$this->Session->setFlash(__('Usted aún no tiene ningún Artículo corregido.'));
				$this->redirect(array("controller" => "backend", "action" => "evaluator"));
			}
	  		foreach ($papers as $paper) {
	  			$paperFiles[$i] = $this->PaperFile->find('all', array(
				    'conditions' => array('paper_id'=>$paper['Paper']['id']),
				    'fields' => array('id')
				));
				$i++;
	  		}
			$this->set('papers', $papers);
			$this->set('paperFiles', $paperFiles);
		}
  	}

/**
 * acceptEvaluator method
 * el evaluador acepta el artículo para evaluarlo
 * @return void
 */

  	public function acceptEvaluator($id=null) {
  		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$this->PaperEvaluator->id = $id;
	        if (!$this->PaperEvaluator->exists()) {
	            throw new NotFoundException(__('Artículo Invalido'));
	        }
	        $papername = $this->Paper->PaperEvaluator->find('first',array('conditions' => array('PaperEvaluator.id' => $id)));
			$paper['PaperEvaluator']['id'] =  $id;
			$paper['PaperEvaluator']['status'] = 'ACCEPT';

			if ($this->PaperEvaluator->save($paper)) {
				$data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Usted ha aceptado evaluar el artículo <strong>'. $papername['Paper']['name'].'</strong>.');
				$this->Logbook->save($data4);
				$this->Session->setFlash(__('¡El Artículo fue aceptado exitosamente!.'));
	 			$this->redirect(array("controller" => "backend", "action" => "index"));
	 		}
	 	}
  	}

/**
 * denyEvaluator method
 * el evaluador rechaza el artículo para evaluarlo
 * @return void
 */

  	public function denyEvaluator($id=null) {
  		if($this->Auth->user('role') != 'evaluator'){
			$this->redirect(array("controller" => "users", "action" => "logout"));
		} else {
	  		$this->PaperEvaluator->id = $id;
	        if (!$this->PaperEvaluator->exists()) {
	            throw new NotFoundException(__('Artículo Invalido'));
	        }
	        $papername = $this->Paper->PaperEvaluator->find('first',array('conditions' => array('PaperEvaluator.id' => $id)));
			$paper['PaperEvaluator']['id'] =  $id;
			$paper['PaperEvaluator']['status'] = 'REJECT';

			if ($this->PaperEvaluator->save($paper)) {
				$data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Usted se ha negado a evaluar el artículo <strong>'. $papername['Paper']['name'].'</strong>.');
				$this->Logbook->save($data4);
				$this->Session->setFlash(__('Usted se nego a evaluar el artículo.'));
	 			$this->redirect(array("controller" => "backend", "action" => "index"));
	 		}
	 	}
  	}
}
