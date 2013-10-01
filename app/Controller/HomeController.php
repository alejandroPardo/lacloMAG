<?php
App::uses('AppController', 'Controller');
/**
 * Home Controller
 *
 *
 */
class HomeController extends AppController {
	public $uses = array('Logbook', 'User','Magazine','MagazinePaper', 'News', 'PaperFile');

/**
 * beforeFilter method
 * 
 * @return void
 */

	function beforeFilter() {
		parent::beforeFilter();
    }

/**
 * index method
 * Datos de revistas y noticias
 * @return void
 */

	public function index() {
		$this->layout = 'frontend';
		$news = $this->News->find('all', array('order' => array('News.created DESC')));
        $this->set('news', $news);

        $actual = $this->Magazine->find('first', array('conditions' => array('Magazine.status' => 'ACTUAL')));
        $this->set('actual', $actual);
        $magazines = $this->Magazine->find('all', array('conditions' => array('Magazine.status' => 'ARCHIVED'), 'order' => 'Magazine.created DESC'));
		$this->set('magazines', $magazines);
	}

/**
 * magazine method
 * Muestra una revista en formato html
 * @return void
 */

	public function magazine($id = null){
		$this->layout = 'magazine';
		$this->MagazinePaper->Behaviors->load('Containable');
		$magazine = $this->Magazine->find('first', array('conditions' => array('Magazine.id' => $id)));
		if(!empty($magazine)){
			if($magazine['Magazine']['status'] != 'ONCONSTRUCTION'){
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
		  						'MagazinePaper.magazine_id' => $magazine['Magazine']['id']
		  				),
		  				'order' => array('MagazinePaper.order ASC'),
		  			)
		  		);
		  		$this->set('magazinePapers', $magazinePapers);
			} else {
				$this->Session->setFlash(__('La revista seleccionada es inválida.'));
	        	$this->redirect(array("controller" => "home", "action" => "index"));	
			}
		} else {
			$this->Session->setFlash(__('La revista seleccionada es inválida.'));
	        $this->redirect(array("controller" => "home", "action" => "index"));
		}
        $this->set('magazine', $magazine);
	}

/**
 * news method
 * Muestra una noticia en formato html
 * @return void
 */

	public function news($id=null){
		$this->layout = 'frontend';
		$this->News->id = $id;
        if (!$this->News->exists()) {
            $this->redirect(array("controller" => "home", "action" => "index")); 
        }
        $news = $this->News->find('first', array('conditions' => array('News.id' => $id)));

        $this->set('headline', $news['News']['headline']);
        $this->set('summary', $news['News']['summary']);
        $this->set('content', $news['News']['content']);
        $this->set('video', $news['News']['video_url']);
	}

/**
 * process method
 * Envia la solicitud de nuevo usuario
 * @return void
 */

	public function process(){
		if ($this->request->is('post')) {
			$user = $this->User->find('count', array('conditions' => array('User.username' => $this->data['email'])));
			if($user == 0){
				$data = array('username' => $this->data['email'], 'email' => $this->data['email'], 'password' => 'hbsdfkjgdskf5344454sdf4sdf4588', 'role' => 'PREVIOUS', 'first_name' => $this->data['name'], 'last_name' => $this->data['type']); 
				if($this->User->save($data)){
					$this->Session->setFlash(__('¡Se ha enviado exitosamente, espere un correo con la respuesta!'));
	            	$this->redirect(array("controller" => "home", "action" => "index"));
				} else {
					$this->Session->setFlash(__('No se ha podido enviar.'));
	            	$this->redirect(array("controller" => "home", "action" => "index"));
				}	
			} else {
				$this->Session->setFlash(__('El usuario con ese correo electrónico ya está a la espera de una solicitud, espere su respuesta.'));
	            $this->redirect(array("controller" => "home", "action" => "index"));
			}
			
        }
	}


}
