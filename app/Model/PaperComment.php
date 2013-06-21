<?php
	App::uses('AuthComponent', 'Controller/Component');

    class PaperComment extends AppModel {
        public $name = 'PaperComment';
        public $belongsTo = array('Evaluator', 'Paper');
    }
?>