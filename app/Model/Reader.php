<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Reader extends AppModel {
        public $name = 'Reader';
        public $belongsTo = 'User';
    }
?>