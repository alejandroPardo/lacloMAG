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
            $bodytag = str_replace("../files", "file:".DS.DS.WWW_ROOT."files", $html['PaperFile']['raw']);
        } else {
            $bodytag = str_replace("../files", "../../files", $html['PaperFile']['raw']);
        }
        $this->set('htm', $bodytag);
        /*'file:///Users/alejandropardo/Sites/LACLOmag/app/webroot/'
        //"../../files/c45bda5d241331c7675a8320ce80d067.jpg"
        //file:///Users/alejandropardo/Sites/lacloMAG/app/webroot/img/avatar.jpg*/
	}
}
