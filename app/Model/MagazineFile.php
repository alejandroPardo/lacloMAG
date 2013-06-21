<?php
	App::uses('AuthComponent', 'Controller/Component');

    class MagazineFile extends AppModel {
        public $name = 'MagazineFile';
        public $belongsTo = 'Magazine';
    }
?>