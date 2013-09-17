<?php
App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
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

	public function view($id=null){
		$this->layout = 'cover';
        ini_set('memory_limit', '-1');

        $this->MagazinePaper->Behaviors->load('Containable');
        $magazine = $this->Magazine->find('first',
            array(
                'conditions' => array(
                    'Magazine.status' => array('ONCONSTRUCTION')
                ),
            )
        );
        $id = $magazine['MagazineFile']['id'];
        
        if ($magazine) {
            $magazineId = $magazine['Magazine']['id'];
            $magazinePapers = $this->MagazinePaper->find('all',
                array(
                    'contain' => array(
                        'Paper' => array(
                            'fields' => array('id','name','created','evaluation_type'),
                            'PaperFile' => array(
                                'fields' => array('raw')
                            )
                        )
                    ),
                    'conditions' => array(
                            'MagazinePaper.magazine_id' => $magazineId
                    ),
                    'order' => array('MagazinePaper.order ASC'),
                )
            );
        }

        $this->pdfConfig = array(
            'orientation' => 'portrait',
            'filename' => 'MagazineCover_' . $id,
            'download' => false,
            'no-outline',         // Make Chrome not complain
            'margin' => array(
                'bottom' => 0,
                'left' => 0,
                'right' => 0,
                'top' => 0
            ),
            'pageSize' => 'Letter',
            'options' => array('')
        );

        
        if(substr($this->here,-4) == '.pdf'){
            if(substr(WWW_ROOT,1) == DS){  //OSX y LINUX
                $cover = str_replace("/laclomag/img", "FILE:".DS.DS.WWW_ROOT."img", $magazine['MagazineFile']['file']);
            } else {  //WINDOWS
                $cover = str_replace("/laclomag/img", "FILE:".DS.DS.WWW_ROOT."img", $magazine['MagazineFile']['file']);
            }
        } else {
            $cover = $magazine['MagazineFile']['file'];
        }

        $papers=null;
        $index=0;
        foreach ($magazinePapers as $magazinePaper) {
            if(substr($this->here,-4) == '.pdf'){
                if(substr(WWW_ROOT,1) == DS){  //OSX y LINUX
                    $papers[$index] = str_replace("../../files", "FILE:".DS.DS.WWW_ROOT."files", $magazinePaper['Paper']['PaperFile']['0']['raw']);
                } else {  //WINDOWS
                    $papers[$index] = str_replace("../../files", "FILE:".DS.DS.DS.WWW_ROOT."files", $magazinePaper['Paper']['PaperFile']['0']['raw']);
                }
            } else {
                $papers[$index] = $magazinePaper['Paper']['PaperFile']['0']['raw'];
            }
            $index++;
        }

        $this->set('cover', $cover);
        $this->set('papers', $papers);
	}
}
	