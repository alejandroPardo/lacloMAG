<?php
App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class PaperFilesController extends AppController {
    public $uses = array('Logbook', 'User', 'PaperFile', 'Author', 'PaperAuthor', 'Paper');

    function beforeFilter() {
        parent::beforeFilter();
    }

/**
 * view method
 * muestra un artículo
 * @return void
 */
	
	public function view($id = null) {
        $this->layout = 'cover';
        $paper = $this->PaperFile->find('first',
            array(
                'contain' => array(
                    'Paper' => array(
                        'fields' => array('id','name','created','evaluation_type'),
                        'PaperFile' => array(
                            'fields' => array('raw')
                        ),
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
                'conditions' => array(
                        'PaperFile.id' => $id
                )
            )
        );
        $paperAuthor = $this->Paper->find('first',
            array(
                'contain' => array(
                    'PaperAuthor' => array(
                        'fields' => array('paper_id', 'author_id'),
                        'Author' => array(
                            'User' => array(
                                'fields' => array('first_name', 'last_name')
                            )
                        )
                    )
                ),
                'conditions' => array(
                        'Paper.id' => $paper['Paper']['id']
                )
            )
        );


        $this->pdfConfig = array(
            'orientation' => 'portrait',
            'filename' => 'Paper' . $id,
            'download' => false,
            'no-outline',
            'margin' => array(
                'bottom' => 0,
                'left' => 0,
                'right' => 0,
                'top' => 0
            ),
            'pageSize' => 'Letter',
            'options' => array('')
        );

        //$html = $this->PaperFile->findById($id);
        if(substr($this->here,-4) == '.pdf'){
            if(substr(WWW_ROOT,1) == DS){  //OSX y LINUX
                $bodytag = str_replace("../../files", "FILE:".DS.DS.WWW_ROOT."files", $paper['PaperFile']['raw']);
            } else {  //WINDOWS
                $bodytag = str_replace("../../files", "FILE:".DS.DS.DS.WWW_ROOT."files", $paper['PaperFile']['raw']);
            }
        } else {
            $bodytag = $paper['PaperFile']['raw'];
        }

        $this->set('paper', $bodytag);
        $this->set('title', $paper['Paper']['name']);
        $this->set('author', $paperAuthor['PaperAuthor'][0]['Author']['User']['first_name'].' '.$paperAuthor['PaperAuthor'][0]['Author']['User']['last_name']);



        

        
	}
}
