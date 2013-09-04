<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Magazine extends AppModel {
        public $name = 'Magazine';
        public $hasMany = array('ReaderComment', 'MagazineEditor', 'MagazinePaper');
        public $hasOne = 'MagazineFile';
    
        public $validate = array(
        	'name' => array(
        		'alphaNumeric' => array(
        			'rule' => 'alphaNumeric',
        			'allowEmpty' => false
        		)
        	),
        	'title' => array(
        		'alphaNumeric' => array(
        			'rule' => 'alphaNumeric',
        			'allowEmpty' => false
        		)
        	)
        );


    }
?>