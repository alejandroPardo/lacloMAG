<?php
App::uses('AppController', 'Controller');
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class FrontendController extends AppController {
	public $uses = array('Logbook', 'User','Magazine','MagazinePaper');

	function beforeFilter() {
		parent::beforeFilter();
        $this->layout = 'frontend';
    }
	public function index() {
		
	}
}
