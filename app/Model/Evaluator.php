<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Evaluator extends AppModel {
        public $name = 'Evaluator';
        public $belongsTo = 'User';
        public $hasMany = array(
        'PaperEvaluator', 
    	);
    }
?>