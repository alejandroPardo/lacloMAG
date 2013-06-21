<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Paper extends AppModel {
        public $name = 'Paper';
        public $hasMany = array('MagazinePaper', 'PaperEvaluator', 'PaperComment', 'PaperAuthor', 'PaperEditor');
        public $hasOne = 'PaperFile';
    }
?>