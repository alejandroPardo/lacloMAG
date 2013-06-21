<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Magazine extends AppModel {
        public $name = 'magazine';
        public $hasMany = array('ReaderComment', 'MagazineEditor', 'MagazinePaper');
        public $hasOne = 'MagazineFile';
    }
?>