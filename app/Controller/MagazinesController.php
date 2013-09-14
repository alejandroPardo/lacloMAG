<?php
App::uses('AppController', 'Controller');
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class MagazinesController extends AppController {
	public $uses = array('Logbook', 'User','Magazine','MagazinePaper', 'MagazineFiles');

	function beforeFilter() {
		parent::beforeFilter();
    }

	public function saveCover(){
		if ($this->request->is('post')) {
            $file = $this->data;
			if($this->data['send']=='Volver'){
				$this->redirect(array("controller" => "backend", "action" => "cover", $this->data['magazineid']));
			} else {
				$cover = "<div class='cover' style='background: #".$this->data['color']." !important;'><br/>
					<h3 style='color:#".$this->data['fontColor']." !important;'>".$this->data['edicion']."</h3><br/>
					<img src='/laclomag/img/bannercover.jpg'><h1 style='color:#".$this->data['fontColor']." 
					!important;'>".$this->data['title']."</h1><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
					<h2 style='color:#".$this->data['fontColor']." !important;'>".$this->data['desc']."</h2></div>";
				$data = array('magazine_id' => $this->data['magazineid'], 'file' => $cover, 'name' => $this->data['title'], 'type' => 'COVER', 'title' => $this->data['title'], 'edition' => $this->data['edicion'], 'color' => $this->data['color']);
				$data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha creado la portada de <strong>'. $this->data['title'].'</strong>.');
				$this->MagazineFiles->create();
				$this->MagazineFiles->save($data);
				$this->Logbook->create();
                $this->Logbook->save($data4);


                $this->Session->setFlash(__('¡La Portada de la revista fue guardada exitosamente!'));
                $this->redirect(array("controller" => "backend", "action" => "viewCurrentMagEditor"));
			}
        }
	}
}
	