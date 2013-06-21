<?php
	App::uses('AuthComponent', 'Controller/Component');

    class PaperAuthor extends AppModel {
        public $name = 'PaperAuthor';
        public $belongsTo = array('Author', 'Paper');
    }
?>