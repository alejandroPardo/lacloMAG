<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Editor extends AppModel {
        public $name = 'Editor';
        public $belongsTo = 'User';
    }
?>