<?php

App::uses('OAuthAppModel', 'OAuth.Model');

/**
 * RefreshToken Model
 *
 * @property Client $Client
 * @property User $User
 */
class RefreshToken extends OAuthAppModel {

	public $name = 'RefreshToken';
	public $useTable = 'refresh_tokens';
	
/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'refresh_token';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'refresh_token';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'refresh_token' => array(
			'notempty' => array(
				'rule' => array('notblank'),
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
			)
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
		'expires' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

/*
	public $actsAs = array(
		'OAuth.HashedField' => array(
			'fields' => 'refresh_token',
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
		)
	);

}
