<?php
	App::uses('AuthComponent', 'Controller/Component');

    class Magazine extends AppModel {
        public $name = 'Magazine';
        public $hasMany = array('MagazinePaper');
        public $hasOne = 'MagazineFile';
    
        public $validate = array(
        	'name' => array(
        		'alphaNumeric' => array(
        			'rule' => array('custom', '/^[a-z0-9 ]*$/i'), 
        			'allowEmpty' => false,
                    'message' => 'Caracteres alfanumericos solamente'
        		)
        	),
        	'title' => array(
        		'alphaNumeric' => array(
        			'rule' => array('custom', '/^[a-z0-9 ]*$/i'),
        			'allowEmpty' => false,
                    'message' => 'Caracteres alfanumericos solamente'
        		)
        	)
        );


    }
?>