<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Admin extends AppModel {
        public $name = 'Admin';
        public $belongsTo = 'User';
    }
?>