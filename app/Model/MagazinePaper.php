<?php
	App::uses('AuthComponent', 'Controller/Component');

    class MagazinePaper extends AppModel {
        public $name = 'MagazinePaper';
        public $belongsTo = array('Magazine', 'Paper');
    }
?>