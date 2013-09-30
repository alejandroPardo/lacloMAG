<?php
App::uses('AppModel', 'Model');
/**
 * Paper Model
 *
 * @property PaperAuthor $PaperAuthor
 * @property PaperComment $PaperComment
 * @property PaperEvaluator $PaperEvaluator
 * @property PaperFile $PaperFile
 */
class Paper extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $actsAs = array('Containable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PaperAuthor' => array(
			'className' => 'PaperAuthor',
			'foreignKey' => 'paper_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PaperEvaluator' => array(
			'className' => 'PaperEvaluator',
			'foreignKey' => 'paper_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PaperFile' => array(
			'className' => 'PaperFile',
			'foreignKey' => 'paper_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'MagazinePaper' 
	);

}
