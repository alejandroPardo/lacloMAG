<?php
App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class PaperFilesController extends AppController {

	public function index() {
		
	}
	
	public function view($id = null) {
		$this->render = false;
        $this->PaperFile->id = $id;
        if (!$this->PaperFile->exists()) {
            throw new NotFoundException(__('Invalid invoice'));
        }
        $this->pdfConfig = array(
            'orientation' => 'portrait',
            'filename' => 'PaperFile_' . $id,
            'download' => true,
            'options' => array('')
        );

        $html = $this->PaperFile->findById($id);
        $this->set('htm', $html['PaperFile']['raw']);
	}
}
