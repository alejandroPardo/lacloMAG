<?php
App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class PaperFilesController extends AppController {

/**
 * view method
 * muestra un artículo
 * @return void
 */
	
	public function view($id = null) {
        $this->PaperFile->id = $id;
        if (!$this->PaperFile->exists()) {
            throw new NotFoundException(__('Invalid invoice'));
        }
        $this->pdfConfig = array(
            'orientation' => 'portrait',
            'filename' => 'PaperFile_' . $id,
            'download' => false,
            'options' => array('')
        );

        $html = $this->PaperFile->findById($id);
        if(substr($this->here,-4) == '.pdf'){
            if(substr(WWW_ROOT,1) == DS){  //OSX y LINUX
                $bodytag = str_replace("../../files", "FILE:".DS.DS.WWW_ROOT."files", $html['PaperFile']['raw']);
            } else {  //WINDOWS
                $bodytag = str_replace("../../files", "FILE:".DS.DS.DS.WWW_ROOT."files", $html['PaperFile']['raw']);
            }
        } else {
            $bodytag = $html['PaperFile']['raw'];
        }
        $this->set('htm', $bodytag);
	}
}
