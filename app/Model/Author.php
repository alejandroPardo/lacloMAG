<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Author extends AppModel {
        public $name = 'Author';
        public $belongsTo = 'User';
    }
?>