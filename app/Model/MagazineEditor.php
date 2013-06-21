<?php
	App::uses('AuthComponent', 'Controller/Component');

    class MagazineEditor extends AppModel {
        public $name = 'MagazineEditor';
        public $belongsTo = array('MagazineEditor', 'Editor');
    }
?>