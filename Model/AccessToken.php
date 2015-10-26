<?php

App::uses('OAuthAppModel', 'OAuth.Model');
App::uses('User', 'Model');

/**
 * AccessToken Model
 *
 * @property Client $Client
 * @property User $User
 */
class AccessToken extends OAuthAppModel {

	public $name = 'AccessToken';
	public $useTable = 'access_tokens';
	
	const KEY_USER_ACCESS_TOKEN = "user.access.token:"; 

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'access_token';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'access_token';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'access_token' => array(
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
			'fields' => 'access_token',
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
	
	public function find($type = 'first', $queryData = array()) {
		if(is_array($queryData) && isset($queryData['conditions']['access_token'])) {
			$key = self::KEY_USER_ACCESS_TOKEN . $queryData['conditions']['access_token']; 
			$result = $this->getRedis()->get($key);
			if(!empty($result)) {
				return json_decode($result, true);
			}
			return false;
		}
		return parent::find($type, $queryData);
	}
	
	public function save($data = null, $validate = true, $fieldList = array()) {
		if(!empty($data) && is_array($data) && isset($data['AccessToken']['access_token'])) {
			
			$user = new User();
			$rs = $user->getUserBase($data['AccessToken']['user_id']);
			
			if(!is_array($rs)) {
				return false;
			}
			
			$data['User'] = $rs['User'];
			
			$key = self::KEY_USER_ACCESS_TOKEN . $data['AccessToken']['access_token'];
			
			$this->getRedis()->set($key, json_encode($data));
			$this->getRedis()->expire($key, OAuth2::DEFAULT_ACCESS_TOKEN_LIFETIME);
			
			return true;
			
		}
		return parent::save($data, $validate, $fieldList);
	}

}
