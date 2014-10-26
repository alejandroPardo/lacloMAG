<?php
App::uses('AppController', 'Controller');
App::uses('CakePdf', 'CakePdf.Pdf');
/**
 * MagazinesController Controller
 *
 * @property PaperFile $PaperFile
 */
class MagazinesController extends AppController {
	public $uses = array('Logbook', 'User','Magazine','MagazinePaper', 'MagazineFiles');

	function beforeFilter() {
		parent::beforeFilter();
    }

/**
 * saveCover method
 * guarda la portada de la revista
 * @return void
 */

	public function saveCover(){
		if ($this->request->is('post')) {
            $file = $this->data;
			if($this->data['send']=='Volver'){
				$this->redirect(array("controller" => "backend", "action" => "cover", $this->data['magazineid']));
			} else {
				$cover = "<div class='cover' style='background: #".$this->data['color']." !important;'><br/><img src='/laclomag/img/cc.png' class='creativecommons'>
					<h3 style='color:#".$this->data['fontColor']." !important;'>".$this->data['edicion']."</h3><br/>
					<img src='/laclomag/img/bannercover.jpg'><h1 style='color:#".$this->data['fontColor']." 
					!important;'>".$this->data['title']."</h1><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
					<h2 style='color:#".$this->data['fontColor']." !important;'>".$this->data['desc']."</h2><br/><br/><br/><br/><br/><br/></div>";
				$data = array('magazine_id' => $this->data['magazineid'], 'file' => $cover, 'name' => $this->data['title'], 'type' => 'COVER', 'title' => $this->data['title'], 'edition' => $this->data['edicion'], 'color' => $this->data['color']);
				$data4 = array('user_id' => $this->Auth->user('id'), 'ip' => $this->request->clientIp(), 'type' => 'NOTIFICATION', 'description' => 'Se ha creado la portada de <strong>'. $this->data['title'].'</strong>.');
				$this->MagazineFiles->create();
				$this->MagazineFiles->save($data);
				$this->Logbook->create();
                $this->Logbook->save($data4);


                $this->Session->setFlash(__('¡La Portada de la revista fue guardada exitosamente!'));
                $this->redirect(array("controller" => "backend", "action" => "viewCurrentMagEditor"));
			}
        }
	}

/**
 * view method
 * muestra una revista
 * @return void
 */

	public function view($id=null){
		$this->layout = 'cover';
        ini_set('memory_limit', '-1');
        $magazineFiles = $this->MagazineFiles->find('first',array(
            'conditions' => array('MagazineFiles.magazine_id' => $id, 'MagazineFiles.type' => 'COVER')
        ));
        $idCover=$magazineFiles['MagazineFiles']['id'];
        

        $this->MagazinePaper->Behaviors->load('Containable');
        $magazine = $this->Magazine->find('first',
            array(
                'conditions' => array(
                    'Magazine.id' => $id
                ),
            )
        );
        $id = $magazine['MagazineFile']['id'];
        
        if ($magazine) {
            $magazineId = $magazine['Magazine']['id'];
            $magazinePapers = $this->MagazinePaper->find('all',
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
                            'MagazinePaper.magazine_id' => $magazineId
                    ),
                    'order' => array('MagazinePaper.order ASC'),
                )
            );
        }

        $this->pdfConfig = array(
            'orientation' => 'portrait',
            'filename' => 'MagazineCover_' . $id,
            'download' => false,
            'no-outline',        
            'margin' => array(
                'bottom' => 10,
                'left' => 0,
                'right' => 0,
                'top' => 10
            ),
            'pageSize' => 'Letter',
            'options' => array('')
        );
        
        if(substr($this->here,-4) == '.pdf'){

            if(substr(WWW_ROOT,1) == DS){  //OSX y LINUX
                $cover = str_replace("/laclomag/img", "FILE:".DS.DS.WWW_ROOT."img", $magazine['MagazineFile']['file']);
            } else {  //WINDOWS
                $cover = str_replace("/laclomag/img", "FILE:".DS.DS.WWW_ROOT."img", $magazine['MagazineFile']['file']);
            }

        } else {
            $cover = $magazine['MagazineFile']['file'];
        }
        $cover .= '<div id="newContent"></div><div id="content">';

        $papers=null;
        $index=0;
        foreach ($magazinePapers as $magazinePaper) {
            if(substr($this->here,-4) == '.pdf'){
                if(substr(WWW_ROOT,1) == DS){  //OSX y LINUX
                    $papers[$index] = str_replace("../../files", "FILE:".DS.DS.WWW_ROOT."files", $magazinePaper['Paper']['PaperFile']['0']['raw']);
                } else {  //WINDOWS
                    $papers[$index] = str_replace("../../files", "FILE:".DS.DS.DS.WWW_ROOT."files", $magazinePaper['Paper']['PaperFile']['0']['raw']);
                }
            } else {
                $papers[$index] = $magazinePaper['Paper']['PaperFile']['0']['raw'];
            }
            $index++;
        }
       
    
        /*$footer = '</div>';
        $footer.='<div id="newContent">New Content</div>';
        $papers[$index-1] .='

        <script type="text/javascript">
          function arrangePaper() {

        var cover = document.getElementsByClassName("cover");
        cover[0].style["height"] = "1284px";
        
        var newPage = document.createElement("div");
       //newPage.style.height = "1284px";
        newPage.className = "newPage";

        var content = document.getElementById("content");
        var newContent = document.getElementById("newContent");

        var childObjects = content.children;
        var elementHeight;

        var accumulatedHeight = 0;
        var newElement;
        var counter = 1;

        for(var i = 0; i < childObjects.length; i++) {
            //console.log(childObjects[i]);

            if (childObjects[i].className.indexOf("title") > -1) {
                newElement = childObjects[i].cloneNode(true);
                newPage.appendChild(newElement);
            }

            if (childObjects[i].className.indexOf("redactor") > -1) {
                newElement = childObjects[i].cloneNode(true);
                newPage.appendChild(newElement);
                
            }

            if(counter % 2 == 0) {
                newContent.appendChild(newPage);
                newPage = document.createElement("div");
                //newPage.style.height = "1284px";
                newPage.className = "newPage";
                newContent.appendChild(newPage);
                newPage = document.createElement("div");
                //newPage.style.height = "1284px";
                newPage.className = "newPage";
            }

            
            

            counter++;
        }

        var contentHeight = content.clientHeight;
        while (content.firstChild) {
          content.removeChild(content.firstChild);
        }
<<<<<<< HEAD

       
        var numberPages = Math.round(contentHeight / 1284);
        var acumulatedPage = 2568;
        var span;
        span = document.createElement("span");
        span.textContent = numberPages;
        span.className = "totalPages";
        newContent.appendChild(span);

        for(var i=1; i <= numberPages; i++) {
            span = document.createElement("span");
            span.style.position = "absolute";
            span.style.top = acumulatedPage + "px";
            acumulatedPage += 1260;
            span.style.right = "100px";
            span.textContent = i;
            span.className = "pageNumber";
            newContent.appendChild(span);

        }

=======
>>>>>>> c947f545e5dd36672959164eefef818276b70af5
        
        }
        /*arrangePaper();
            </script>';*/
  
        $this->set('magazinePapers', $magazinePapers);
        $this->set('cover', $cover);
        $this->set('papers', $papers);
        $this->set('idCover', $magazineFiles['MagazineFiles']['id']);
        //$this->set('footer', $footer);
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
        $emailReceiver = $this->User->find('all', array(
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
	