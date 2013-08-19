<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class BackendController extends AppController {
	public $uses = array('Message', 'MappedMessage', 'Logbook', 'User', 'Paper', 'PaperAuthor', 'Author', 'PaperFile','Magazine','MagazinePaper','MagazineEditor','Evaluator', 'PaperEvaluator');
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

			$markers = $this->Paper->PaperAuthor->find('count',
	  			array(
	  				'conditions' => array(
	  					'PaperAuthor.status' => array('SENT','ASIGNED','REJECTED','APPROVED'),
	  					'Author.id' => $this->userID
	  				),
	  			)
	  		);

			$papersPreviews = $this->Paper->PaperAuthor->find('count',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('UNSENT'),
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
		} else if($this->Auth->user('role') == 'evaluator'){
			$this->set('role', 'Evaluador');
			$this->userID = $this->Evaluator->find('all', array(
			    'conditions' => array('user_id'=>$this->Auth->user('id')),
			    'fields' => array('id')
			));
			$this->userID = $this->userID['0']['Evaluator']['id'];
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
		$approved = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('APPROVED'),'Author.id' => $this->userID)));
  		$published = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('PUBLISHED'),'Author.id' => $this->userID)));
  		$rejected = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('REJECTED'),'Author.id' => $this->userID)));
  		$editing = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('ASSIGNED', 'ONREVISION', 'SENT'),'Author.id' => $this->userID)));
  		$unsent = $this->Paper->PaperAuthor->find('count',array('conditions' => array('Paper.status' => array('UNSENT'),'Author.id' => $this->userID)));
  		$notifications = $this->Logbook->find('all',array('conditions' => array('Logbook.type' => 'NOTIFICATION','Logbook.user_id' => $this->Auth->user('id')),'order' => array('Logbook.created DESC'),));
  		$this->set('approved', $approved);
  		$this->set('published', $published);
  		$this->set('rejected', $rejected);
  		$this->set('editing', $editing);
  		$this->set('unsent', $unsent);
  		$this->set('total', $unsent+$editing+$rejected+$published+$approved);
  		$this->set('notifications', $notifications);
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

	/****************
	/*
	/*	Common Role Functions
	/*
	/***************/	

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

	public function notifications() {
		$notifications = $this->Logbook->find('all',array('conditions' => array('Logbook.type' => 'NOTIFICATION','Logbook.user_id' => $this->Auth->user('id')),'order' => array('Logbook.created DESC'),));
  		$this->set('notifications', $notifications);
  		if(empty($notifications)){
  			$this->Session->setFlash(__('No tiene ninguna notificación en el sistema.'));
			$this->redirect(array("controller" => "backend", "action" => "author"));
  		}
	}

	/****************
	/*
	/*	Authors Functions
	/*
	/***************/

	public function createArticle(){
		$this->set('author', $this->userID);
		$paper = $this->Paper->PaperAuthor->find('count',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('UNSENT'),
	  					'Author.id' => $this->userID
	  				),
	  			)
	  		);
		if($paper>0){
			$paper3 = $this->Paper->PaperAuthor->find('first',
	  			array(
	  				'conditions' => array(
	  					'Paper.status' => array('UNSENT'),
	  					'Author.id' => $this->userID
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
		}
		if (!empty($paper2)) {
			$this->set('content', $paper2['PaperFile']['raw']);
			$this->set('name', $paper2['PaperFile']['name']);
			$this->set('preview', $paper3['Paper']['id']);
		} else {
			$this->set('content', '<h1>Bienvenido al Creador de Artículos LACLOmagazine</h1><p>En el menú superior puede agregar fotos, tablas, cambiar colores de letra y fondo en las letras, cambiar la alineación del texto, agregar lineas horizontales y sangrías.</p><blockquote><span style="color: rgb(119, 119, 119); font-style: italic; line-height: 1.45em; -webkit-text-stroke-color: transparent;">Puede utilizar citas textuales remarcadas con este estilo.</span></blockquote><p></p><ol><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent; color: rgb(85, 85, 85);">También</span><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent; color: rgb(85, 85, 85);">&nbsp;puede numerar&nbsp;</span><br></li><li><span style="color: rgb(85, 85, 85); line-height: 1.45em; -webkit-text-stroke-color: transparent;">su contenido.</span><br></li></ol><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;"><ul><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;">O agregarle una viñeta.</span><br></li><li><span style="line-height: 1.45em; -webkit-text-stroke-color: transparent;">Utilizar <b>negritas</b>, <i>cursivas</i> o <strike>letras tachadas.</strike></span></li></ul></span><p></p>');
			$this->set('name', '');
			$this->set('preview', '0');
		}
	}

	public function uploadArticle(){
		$this->set('user', $this->Auth);
	}

	public function pendingAuthor() {
		$papers = $this->Paper->PaperAuthor->find('all',
  			array(
  				'conditions' => array(
  					'Paper.status' => array('SENT','ASIGNED','REJECTED','APPROVED'),
  					'Author.id' => $this->userID
  				),
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
			$this->Session->setFlash(__('Usted no tiene ningun Artículo pendiente por revisión.'));
			$this->redirect(array("controller" => "backend", "action" => "author"));
		}
  	}


  	public function articleAuthor() {
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

  		//debug($papers);

		$this->set('papers', $papers);
		$this->set('paperFiles', $paperFiles);
		if(empty($papers)){
			$this->Session->setFlash(__('Usted no tiene ningun Artículo creado.'));
			$this->redirect(array("controller" => "backend", "action" => "author"));
		}
  	}

  	public function renderArticle(){
  		debug(intval($this->params['url']['file']));
  		
  	}

  	public function uploadImage() {
		$this->autoRender = false;

		// files storage folder
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
				'filelink' => '../files/'.$filename
			);
			
			echo stripslashes(json_encode($array));   
		    
		}
  	}

  	public function pdfToText($id=null){
  		include(APP.'Vendor'.DS.'pdf2text.php');
  		//$path = 'file:'.DS.DS.DS.APP.'webroot'.DS.'files'.DS.'Upload'.DS.$this->Auth->user('username').DS.$id.'.pdf';
  		$path = '..'.DS.'..'.DS.'files'.DS.'Upload'.DS.$this->Auth->user('username').DS.$id.'.pdf';
		$a = new PDF2Text();
		$a->setFilename($path); //grab the test file at http://www.newyorklivearts.org/Videographer_RFP.pdf
		$a->decodePDF();
		debug($path);
		debug($a);
		die(); 
  	}

	/****************
	/*
	/*	Editor Functions
	/*
	/***************/

  	public function viewArticlesEditor () {

  		$this->Paper->Behaviors->load('Containable');
  		$papers = $this->Paper->find('all',
  			array(
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
  				),
  			)
  		);

  		$this->set('papers', $papers);
  		//debug($papers);
  	}

  	public function viewPendingArticlesEditor() {
  		$this->Paper->Behaviors->load('Containable');
  		$papers = $this->Paper->find('all',
  			array(
  				'conditions' => array(
  					'Paper.status' => 'SENT'
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
  				),
  			)
  		);

  		$this->set('papers', $papers);
  		//debug($papers);

  	}

  	public function inspectPaper ($id) {
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
						'fields' => array('id','evaluator_id', 'status'),
						'Evaluator' => array(
							'fields' => array('id', 'user_id'),
							'User' => array(
  								'fields' => array('first_name','last_name')
  								)
  							)
						)
  				),
  			)
  		);
  		$this->set('paper', $paper);
  		

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

		$availableEvaluators = array();
		foreach ($evaluators as $evaluator) {
			if (empty($evaluator['PaperEvaluator'])) {
				array_push($availableEvaluators, $evaluator);	
			}
		}
  		$this->set('evaluators', $availableEvaluators);
  		$this->set('paperId', $id);
  		//debug($availableEvaluators);
  	}
  	public function addEvaluator($evaluatorId,$paperId) {
  		
  		$evaluatorData = array();
  		$evaluatorData['PaperEvaluator']['paper_id'] = $paperId;
  		$evaluatorData['PaperEvaluator']['evaluator_id'] = $evaluatorId;
	 
        $this->PaperEvaluator->create();

        if ($this->PaperEvaluator->save($evaluatorData)) {
            $this->Session->setFlash(__('El evaluador ha sido asignado'));
            $this->redirect(array(
				'action' => 'inspectPaper',
				$paperId
			));
        } else {
            $this->Session->setFlash(__('The article category could not be saved. Please, try again.'));
        }
		
  	}
 	
 	public function deleteEvaluator($evaluatorId,$paperId) {
		$this->PaperEvaluator->id = $evaluatorId;
        if (!$this->PaperEvaluator->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }

        if ($this->PaperEvaluator->delete()) {
            $this->Session->setFlash(__('Se ha eliminado la asignacion'));
            $this->redirect(array(
				'action' => 'inspectPaper',
				$paperId
			));
        }
        $this->Session->setFlash(__('No se ha eliminado la asignación, intente nuevamente.'));
        $this->redirect(array(
			'action' => 'inspectPaper',
			$paperId
		));  		
  	}

  	public function changeEvaluationType($paperId, $evaluationType) {
  		if (!$this->Paper->exists($paperId)) {
            throw new NotFoundException(__('Invalid Paper'));
        }
  		$this->Paper->read(null, $paperId);
		$this->Paper->set(array(
			'evaluation_type' => $evaluationType
		));

  		if ($this->Paper->save()) {
            $this->Session->setFlash(__('El Tipo de Evaluacion ha sido Cambiada'));
            $this->redirect(array(
				'action' => 'inspectPaper',
				$paperId
			));
        } else {
            $this->Session->setFlash(__('El tipo no pudo ser cambiado por favor intente nuevamente'));
            $this->redirect(array(
				'action' => 'inspectPaper',
				$paperId
			));
        }
  	}

	 public function addArticleToMag($paperId) {
  		if (!$this->Paper->exists($paperId)) {
            throw new NotFoundException(__('Invalid Paper'));
        }
  		$this->Paper->read(null, $paperId);
		$this->Paper->set(array(
			'status' => 'PUBLISHED'
		));

		if ($this->Paper->save()) {
            $this->Session->setFlash(__('El articulo ha sido agregado a la revista'));
            $this->redirect(array(
				'action' => 'index',
				$paperId
			));
        } else {
            $this->Session->setFlash(__('Hubo un error en la publicacion por favor intente nuevamente'));
            $this->redirect(array(
				'action' => 'inspectPaper',
				$paperId
			));
        }

  	}

  	public function viewCurrentMagEditor() {
  		$magazine = $this->Magazine->find('first',
  			array(
  				'conditions' => array(
  					/*'Magazine.status' => array('ACTUAL'),
  					'Editor.user_id' =>$this->Auth->user('id'),*/
  				),
  			)
  		);
  		//debug($magazine);
  		$this->set('magazine', $magazine);
  	}

  	public function viewArticlesArchiveEditor() {

  	}

  	/****************
	/*
	/*	Evaluator Functions
	/*
	/***************/

	public function pendingEvaluator(){
		$paper = $this->PaperFile->find('first', array('conditions' => array('PaperFile.id' => 13)));
		$this->set('paper', $paper['PaperFile']['raw']);
	}

	public function articleEvaluator() {
  		$papers = $this->Paper->PaperEvaluator->find('all',
  			array(
  				'conditions' => array(
  					'Evaluator.id' => $this->userID
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

  		//debug($papers);

		$this->set('papers', $papers);
		$this->set('paperFiles', $paperFiles);
		if(empty($papers)){
			$this->Session->setFlash(__('Usted no tiene ningun Artículo asignado.'));
			$this->redirect(array("controller" => "backend", "action" => "evaluator"));
		}
  	}
}
