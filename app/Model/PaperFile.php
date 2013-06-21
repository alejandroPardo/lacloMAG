<?php
	App::uses('AuthComponent', 'Controller/Component');

    class PaperFile extends AppModel {
        public $name = 'PaperFile';
        public $hasOne = 'Paper';
    }
?>