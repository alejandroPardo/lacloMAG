<?php
App::uses('AppController', 'Controller');
/**
 * Papers Controller
 *
 * @property Paper $Paper
 */
class PapersController extends AppController {
    public $uses = array('Paper', 'PaperFile', 'User', 'PaperAuthor', 'Logbook', 'RequestHandler', 'PaperEvaluator');

    public function index() {
    }

    public function createReport() {

        $paperID = intval($this->params['url']['file']);
        $paper = $this->PaperFile->find('first', array('conditions' => array('PaperFile.id' => $paperID)));
        $this->set('data', $paper);

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

    public function uploadPaper2() {

        if ($this->request->is('post')) {
            $file = $this->data['Paper']['file'];
            debug($file);
            die();

            $this->Paper->create();
            $data = array('name' => $this->data['Paper']['name']);
            if ($this->Paper->save($data)) {
                $this->PaperFile->create();
                $data = array('name' => $file['name']);
                if ($this->PaperFile->save($data)) {
                    $this->Session->setFlash(__('The PaperFile has been saved '));
                    $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));

                } else {
                    $this->Session->setFlash(__('The PaperFile has not been saved '));
                    $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                }
            }
        }
    }

    public function createPaper() {
        if ($this->request->is('post')) {
            $this->Paper->create();
            if($this->data['send']=='Enviar'){
                $data = array('name' => $this->data['name'], 'status' => 'SENT');
                $data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha enviado el paper <strong>'. $this->data['name'].'</strong> a edición.');
            } else {
                $data = array('name' => $this->data['name'], 'status' => 'UNSENT');
                $data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha guardado el paper <strong>'. $this->data['name'].'</strong> en borrador.');
            }
            if($this->data['preview']==0){
                if ($this->Paper->save($data)) {
                    $paperInserted = $this->Paper->getLastInsertID();
                    $this->PaperAuthor->create();
                    $data2 = array('paper_id' => $paperInserted, 'author_id' => $this->data['userid']);
                    if ($this->PaperAuthor->save($data2)) {
                        $this->PaperFile->create();
                        $data3 = array('paper_id' => $paperInserted, 'raw' => $this->data['content'], 'name' => $this->data['name'], 'type' => 'text/html', 'url' => 'DB');
                        if ($this->PaperFile->save($data3)) {
                            $this->Logbook->create();
                            if ($this->Logbook->save($data4)) {
                                $this->Session->setFlash(__('¡El Paper fue guardado exitosamente!'));
                                $this->redirect(array("controller" => "backend", "action" => "author"));
                            } else {   
                                $this->Session->setFlash(__('El Paper no ha sido guardado, ocurrió un error'));
                                $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                            }
                        } else {
                            $this->Session->setFlash(__('El Paper no ha sido guardado, ocurrió un error'));
                            $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                        }
                    } else {
                        $this->Session->setFlash(__('El Paper no ha sido guardado, ocurrió un error'));
                        $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                    }
                } else {
                    $this->Session->setFlash(__('El Paper no ha sido guardado, ocurrió un error'));
                    $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                }
            } else {
                $paperFile = $this->PaperFile->find('first', array('conditions' => array('PaperFile.paper_id' => $this->data['preview'])));
                $data['id'] = $this->data['preview'];
                $this->Paper->save($data);

                $data2['id'] = $paperFile['PaperFile']['id'];
                $data2['name'] = $this->data['name'];
                $data2['raw'] = $this->data['content'];

                $this->PaperFile->save($data2);

                $this->Logbook->create();
                $this->Logbook->save($data4);

                $this->Session->setFlash(__('¡El Paper fue guardado exitosamente!'));

                
                $this->redirect(array("controller" => "backend", "action" => "author"));
                
            }
        }
    }

    public function saveEvaluation() {
        if ($this->request->is('post')) {
            $bodytag = str_replace('\n', "chota", $this->data['editor']);
            debug($this->data);
            die();
            $paperEvaluator = $this->PaperEvaluator->find('first', 
                array('conditions' => 
                    array('PaperEvaluator.id' => $this->data['evaluatorid'])
                )
            );
            $status = "ACCEPT";
            if($this->data['selection'] == "Aprobado"){$status="APPROVE";} 
            else if($this->data['selection'] == "Rechazado"){$status="DENIED";}
            else if($this->data['selection'] == "El Editor necesita hacer cambios menores"){$status="MINORCHANGE";} 
            else if($this->data['selection'] == "El Autor necesita hacer cambios"){$status="AUTHORCHANGE";}

            if($this->data['send']=='Enviar'){
                $data = array('id' => $this->data['evaluatorid'], 'comment' => $this->data['editor'], 'status' => $status);
                $dataNotification = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se han enviado las correcciones del paper <strong>'. $paperEvaluator['Paper']['name'].'</strong> al editor con status <strong>'. $status.'</strong>.');
            } else {
                $data = array('id' => $this->data['evaluatorid'], 'comment' => $this->data['editor'], 'status' => 'ACCEPT');
                $dataNotification = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se han enviado las correcciones del paper <strong>'. $paperEvaluator['Paper']['name'].'</strong> en borrador');
            }
            $this->PaperEvaluator->save($data);
            $this->Logbook->create();
            $this->Logbook->save($dataNotification);

            $this->Session->setFlash(__('¡Las correcciones del paper fueron guardadas exitosamente!'));
            $this->redirect(array("controller" => "backend", "action" => "pendingEvaluator"));
        }
    }

}
