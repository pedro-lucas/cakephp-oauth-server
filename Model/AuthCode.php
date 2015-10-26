<?php

App::uses('OAuthAppModel', 'OAuth.Model');

/**
 * AuthCode Model
 *
 * @property Client $Client
 * @property User $User
 */
class AuthCode extends OAuthAppModel {

	public $name = 'AuthCode';
	public $useTable = 'auth_codes';

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'code';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'code';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notempty' => array(
				'rule' => array('notblank'),
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
			),
		),
		'client_id' => array(
			'notempty' => array(
				'rule' => array('notblank'),
			),
		),
		'user_id' => array(
			'notempty' => array(
				'rule' => array('notblank'),
			),
		),
		'redirect_uri' => array(
			'notempty' => array(
				'rule' => array('notblank'),
			),
		),
		'expires' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

/*
	public $actsAs = array(
		'OAuth.HashedField' => array(
			'fields' => 'code',
		),
	);
*/

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Client' => array(
			'className' => 'OAuth.Client',
			'foreignKey' => 'client_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
