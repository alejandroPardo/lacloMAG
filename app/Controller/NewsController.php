<?php
App::uses('AppController', 'Controller');
/**
 * NewsController Controller
 *
 * 
 */
class NewsController extends AppController {
    public $uses = array('Logbook', 'News');

/**
 * createNews method
 * guarda una noticia en la base de datos
 * @return void
 */

    public function createNews() {
        if ($this->request->is('post')) {
            $this->News->create();
            $data = array('headline' => $this->data['title'], 'summary' => $this->data['summary'], 'content' => $this->data['content'], 'status' => 'NEWS', 'author' => $this->Auth->user('ivd'), 'order' => date("F j"));
            $data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha creado la noticia <strong>'. $this->data['title'].'</strong>.');
            if($this->data['preview']==0){
                if ($this->News->save($data)) {
                    $this->Logbook->create();
                    if ($this->Logbook->save($data4)) {
                        $this->Session->setFlash(__('¡La Noticia fue guardada exitosamente!'));
                        $this->redirect(array("controller" => "backend", "action" => "index"));
                    } else {   
                        $this->Session->setFlash(__('La Noticia no ha sido guardada, ocurrió un error'));
                        $this->redirect(array("controller" => "backend", "action" => "index"));
                    }
                } else {
                    $this->Session->setFlash(__('La Noticia no ha sido guardada, ocurrió un error'));
                    $this->redirect(array("controller" => "backend", "action" => "index"));
                }
            } else {
                $news = $this->News->find('first', array('conditions' => array('News.id' => $this->data['preview'])));
                $data['id'] = $this->data['preview'];
                $this->News->save($data);

                $this->Logbook->create();
                $this->Logbook->save($data4);

                $this->Session->setFlash(__('¡El Paper fue guardado exitosamente!'));
                
                $this->redirect(array("controller" => "backend", "action" => "index"));
                
            }
        }
    }

/**
 * delete method
 * elimina una noticia en la base de datos
 * @return void
 */

    public function delete($id = null) {
        $this->News->id = $id;
        if (!$this->News->exists()) {
            throw new NotFoundException(__('Invalid article'));
        }
        $news = $this->News->find('first', array('conditions' => array('News.id' => $id)));
        if ($this->News->delete()) {
            $data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha eliminado la noticia <strong>'. $news['News']['headline'].'</strong>.');
            $this->Logbook->create();
            $this->Logbook->save($data4);

            $this->Session->setFlash(__('Se ha eliminado la noticia'));
            $this->redirect(array("controller" => "backend", "action" => "index"));
        }
        $this->Session->setFlash(__('No se ha eliminado la noticia, intente nuevamente.'));
        $this->redirect(array("controller" => "backend", "action" => "index"));      
    }

}
