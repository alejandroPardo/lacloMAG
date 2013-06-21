<?php
	App::uses('AuthComponent', 'Controller/Component');

    class ReaderComment extends AppModel {
        public $name = 'ReaderComment';
        public $belongsTo = array('Reader', 'Magazine');
    }
?>