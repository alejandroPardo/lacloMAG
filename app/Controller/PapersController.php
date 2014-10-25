<?php
App::uses('AppController', 'Controller');
/**
 * Papers Controller
 *
 * @property Paper $Paper
 */
class PapersController extends AppController {
    public $uses = array('Paper', 'PaperFile', 'User', 'PaperAuthor', 'Logbook', 'RequestHandler', 'PaperEvaluator');

/**
 * createPaper method
 * guarda un artículo en la base de datos
 * @return void
 */

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
                                $subject="Se ha Enviado su Artículo";
                                $content="Su artículo ha sido enviado exitosamente a edición. Espere proximas noticias sobre el en su correo y en nuestra página web. ¡Gracias por enviar su artículo a LACLO Magazine!";
                                $receiverid=$this->Auth->user('id');
                                $this->sendEmail($subject, $content, $receiverid);
                                $this->Session->setFlash(__('¡El Artículo fue guardado exitosamente!'));
                                $this->redirect(array("controller" => "backend", "action" => "author"));
                            } else {   
                                $this->Session->setFlash(__('El Artículo no ha sido guardado, ocurrió un error'));
                                $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                            }
                        } else {
                            $this->Session->setFlash(__('El Artículo no ha sido guardado, ocurrió un error'));
                            $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                        }
                    } else {
                        $this->Session->setFlash(__('El Artículo no ha sido guardado, ocurrió un error'));
                        $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                    }
                } else {
                    $this->Session->setFlash(__('El Artículo no ha sido guardado, ocurrió un error'));
                    $this->redirect(array("controller" => "backend", "action" => "uploadArticle"));
                }
            } else {
                $evaluators = $this->PaperEvaluator->find('all', array(
                    'conditions' => array('paper_id'=>$this->data['preview'])
                ));
                if(!empty($evaluators)){
                    foreach ($evaluators as $evaluator) {
                        $evalData = array('id' => $evaluator['PaperEvaluator']['id'], 'status' => 'CORRECTED');
                        $this->PaperEvaluator->save($evalData);
                    }
                    if($this->data['send']=='Enviar'){
                        $data = array('name' => $this->data['name'], 'status' => 'SENT');
                        $data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha enviado el paper <strong>'. $this->data['name'].'</strong> a edición nuevamente.');
                    } else {
                        $data = array('name' => $this->data['name'], 'status' => 'REVIEW');
                        $data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha guardado el paper <strong>'. $this->data['name'].'</strong> en borrador.');
                    }
                }

                $paperFile = $this->PaperFile->find('first', array('conditions' => array('PaperFile.paper_id' => $this->data['preview'])));
                $data['id'] = $this->data['preview'];
                $this->Paper->save($data);

                $data2['id'] = $paperFile['PaperFile']['id'];
                $data2['name'] = $this->data['name'];
                $data2['raw'] = $this->data['content'];

                $this->PaperFile->save($data2);

                $this->Logbook->create();
                $this->Logbook->save($data4);

                $this->Session->setFlash(__('¡El Artículo fue guardado exitosamente!'));

                $this->redirect(array("controller" => "backend", "action" => "author"));
                
            }
        }
    }

/**
 * saveEvaluation method
 * guarda la evaluación un artículo en la base de datos
 * @return void
 */

    public function saveEvaluation() {
        if ($this->request->is('post')) {
            $paperEvaluator = $this->PaperEvaluator->find('first',
                array('conditions' => 
                    array('PaperEvaluator.id' => $this->data['evaluatorid'])
                )
            );
            $cadena=preg_replace("/\r\n+|\r+|\n+|\t+/i", '.s.e.p.', $this->data['editor']);
            if(empty($this->data['send'])){
                $data = array('id' => $this->data['evaluatorid'], 'comment' => $cadena, 'status' => $this->data['selection']);
                $dataNotification = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se han enviado las correcciones del paper <strong>'. $paperEvaluator['Paper']['name'].'</strong> al editor con status <strong>'. $this->data['selection'].'</strong>.');
                $this->Session->setFlash(__('¡Las correcciones del paper fueron enviadas exitosamente!'));
            } else {
                $data = array('id' => $this->data['evaluatorid'], 'comment' => $cadena, 'status' => 'ACCEPT');
                $dataNotification = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se han guardado las correcciones del paper <strong>'. $paperEvaluator['Paper']['name'].'</strong> en borrador');
                $this->Session->setFlash(__('¡Las correcciones del paper fueron guardadas exitosamente!'));
            }
            $this->PaperEvaluator->save($data);
            $this->Logbook->create();
            $this->Logbook->save($dataNotification);

            $this->redirect(array("controller" => "backend", "action" => "evaluator"));
        }
    }

/**
 * modifyPaper method
 * modifica un artículo en la base de datos
 * @return void
 */

    public function modifyPaper() {
        if ($this->request->is('post')) {
            $data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se han guardado los cambios del paper <strong>'. $this->data['name'].'</strong>.');

            $paperFile = $this->PaperFile->find('first', array('conditions' => array('PaperFile.paper_id' => $this->data['preview'])));

            $data2['id'] = $paperFile['PaperFile']['id'];
            $data2['raw'] = $this->data['content'];

            $this->PaperFile->save($data2);

            $this->Logbook->create();
            $this->Logbook->save($data4);

            $this->Session->setFlash(__('¡Los cambios fueron guardados!'));
            
            if($this->data['caller']=='mag'){
                $this->redirect(array("controller" => "backend", "action" => "viewCurrentMagEditor"));
            } else {
                $this->redirect(array("controller" => "backend", "action" => "inspectPaper", $this->data['preview']));
            }
        }
    }

/**
 * sendEmail method
 * envía correo con la notificación necesaria.
 * @return void
 */

    public function sendEmail($subject=null, $content=null, $receiverid=null) {
        if($subject==null || $content==null || $receiverid==null){
            return 0;
        }
        $emailReceiver = $this->User->find('first', array(
            'conditions' => array('id'=>$receiverid),
        ));

        //============Email================//
        /* SMTP Options */

        $this->Email->smtpOptions = array(
            'port'=>'465',
            'host' => 'ssl://smtp.gmail.com',
            'username'=>'laclomag@gmail.com',
            'password'=>'Laclo1234'
        );

        $this->Email->template = 'notification';
        $this->Email->from    = 'LACLO Magazine <laclomag@gmail.com>';
        $this->Email->to      = $emailReceiver['User']['first_name'].'<'.$emailReceiver['User']['email'].'>';
        $this->Email->subject = 'LACLO Magazine - '.$subject;
        $this->Email->sendAs = 'both';

        $this->Email->delivery = 'smtp';
        $this->set('ms', $content);
        $this->set('user', $emailReceiver['User']['first_name'].' '.$emailReceiver['User']['last_name']);
        $this->Email->send();
        $this->set('smtp_errors', $this->Email->smtpError);
        return 0;
    }

}
