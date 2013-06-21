<?php
	App::uses('AuthComponent', 'Controller/Component');

    class PaperEditor extends AppModel {
        public $name = 'PaperEditor';
        public $belongsTo = array('Editor', 'Paper');
    }
?>