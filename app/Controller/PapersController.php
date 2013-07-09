<?php
App::uses('AppController', 'Controller');
/**
 * Papers Controller
 *
 * @property Paper $Paper
 */
class PapersController extends AppController {
    public $uses = array('Paper', 'PaperFile', 'User');

    public function index() {
    }

    public function createReport() {

        $data = $this->User->find('all');
        $this->set('data', $data);

        // grab the html that is rendered in the view
        $view = new View($this);
        $raw = $view->render('create_report');
        $raw = strstr($raw, '<!-- expense report -->'); // remove cake styling
        $raw = strstr($raw, '<!-- end report -->', true);

        // write to the database
        $db_data = array('PaperFile' => array(
          'name' => 'My Super Awesome PDF', // change this to something in a form
          'raw' => base64_encode($raw) // encode the data to save space
        ));

        // get an instance of the pdf controller
        $Pdf = ClassRegistry::init('PaperFile');

        $Pdf->create($db_data);
        $Pdf->save();

        $this->redirect(array("controller" => "backend", "action" => "index"));
    }

}
