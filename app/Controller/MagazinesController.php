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

	public function saveCover($id=null){
		if ($this->request->is('post')) {
            $file = $this->data;
            debug($file);
            die();
        }
	}
}
	