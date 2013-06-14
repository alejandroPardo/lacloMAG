<?php
	App::uses('AuthComponent', 'Controller/Component');

    class User extends AppModel {

    	public function beforeSave($options = array()) {
			if (isset($this->data[$this->alias]['password'])) {
        		$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    		}
			return true; 
		}

    	public $validate = array(
    		'username' => array(
    			'required' => array(
    				'rule' => array('notEmpty'),
    				'message' => 'Se necesita un nombre de usuario'
    			)
    		),
    		'password' => array(
    			'required' => array(
    				'rule' => array('notEmpty'),
    				'message' => 'Se necesita una clave'
    			)
    		),
    		'role' => array(
    			'valid' => array(
    				'rule' => array('inList', array('admin', 'author', 'editor', 'reader')),
    				'message' => 'Introduzca un rol valido',
    				'allowEmpty' => false
    			)
    		)
    	);
    }
?>