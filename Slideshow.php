<?php
App::uses('AppModel', 'Model');
/**
 * Slideshow Model
 *
 * @property Page $Page
 */
class Slideshow extends AppModel {

/**
 * Behaviors
 */
  public $actsAs = array(
		'Image' => array(
			'file_name' => array(
				'fileNameFormat' => '{ID}-{FILENAME}',
				'dir' => 'files/slideshow/original/',
				'resize' => array(
					'thumbnail' => array(
						'size' => '160x120',
						'resizeType' => 'crop',
						'dir' => 'files/slideshow/thumbnail/',
					),
					'slide' => array(
						'size' => '940x340',
						'resizeType' => 'crop',
						'dir' => 'files/slideshow/slide/',
					),
				)
			)
		)
	);

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'slideshow';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'file_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'page_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'display_order' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'is_active' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Page' => array(
			'className' => 'Page',
			'foreignKey' => 'page_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * getSlideshow method
 *
 * @param string $page_id
 * @return array
 */
	public function getSlideshow($page_id = null) {
		if ( $page_id ) {
			$slideshow = $this->find(
				'all', 
				array(
					'conditions' => array(
						'page_id' => $page_id, 
						'is_active' => 1
					), 
					'order' => array('display_order'),
					'recursive' => -1,
				)
			);
			return $slideshow;
		}
		return array();
	}
}
