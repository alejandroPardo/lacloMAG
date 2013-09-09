<?php
App::uses('AppController', 'Controller');
/**
 * PaperFiles Controller
 *
 * @property PaperFile $PaperFile
 */
class HomeController extends AppController {
	public $uses = array('Logbook', 'User','Magazine','MagazinePaper', 'News');

	function beforeFilter() {
		parent::beforeFilter();
    }
	public function index() {
		$this->layout = 'frontend';
		$news = $this->News->find('all', array('order' => array('News.created DESC')));
        $this->set('news', $news);
	}

	public function magazine(){
		$this->layout = 'magazine';
	}
	public function news($id=null){
		$this->layout = 'frontend';
		$this->News->id = $id;
        if (!$this->News->exists()) {
            $this->redirect(array("controller" => "home", "action" => "index")); 
        }
        $news = $this->News->find('first', array('conditions' => array('News.id' => $id)));

        $this->set('headline', $news['News']['headline']);
        $this->set('summary', $news['News']['summary']);
        $this->set('content', $news['News']['content']);
        $this->set('video', $news['News']['video_url']);
	}


}
