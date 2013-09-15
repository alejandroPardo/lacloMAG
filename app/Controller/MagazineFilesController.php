<?php
App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class MagazineFilesController extends AppController {

	public function index() {
		
	}
	
	public function view($id = null) {
        $this->layout = 'cover';
        $this->MagazineFile->id = $id;
        if (!$this->MagazineFile->exists()) {
            throw new NotFoundException(__('Invalid invoice'));
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

        $html = $this->MagazineFile->findById($id);
        
        if(substr($this->here,-4) == '.pdf'){
            if(substr(WWW_ROOT,1) == DS){  //OSX y LINUX
                $bodytag = str_replace("/laclomag/img", "FILE:".DS.DS.WWW_ROOT."img", $html['MagazineFile']['file']);
            } else {  //WINDOWS
                $bodytag = str_replace("/laclomag/img", "FILE:".DS.DS.WWW_ROOT."img", $html['MagazineFile']['file']);
            }
        } else {
            $bodytag = $html['MagazineFile']['file'];
        }
        $this->set('htm', $bodytag);
	}
}
