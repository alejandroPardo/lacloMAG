<?php
	App::uses('AuthComponent', 'Controller/Component');

    class PaperEvaluator extends AppModel {
        public $name = 'PaperEvaluator';
        public $belongsTo = array('Evaluator', 'Paper');
    }
?>