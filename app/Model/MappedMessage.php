<?php
	App::uses('AuthComponent', 'Controller/Component');

    class MappedMessage extends AppModel {
        public $name = 'MappedMessage';
        public $belongsTo = array('User', 'Message');
    }
?>