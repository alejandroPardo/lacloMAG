<?php
App::uses('AppController', 'Controller');
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class HomeController extends AppController {
	public $uses = array('Logbook', 'User','Magazine','MagazinePaper');

	function beforeFilter() {
		parent::beforeFilter();
    }
	public function index() {
		$this->layout = 'frontend';
	}

	public function magazine(){
		$this->layout = 'magazine';
	}
}
