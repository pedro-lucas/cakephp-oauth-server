<?php

App::import('Vendor', 'oauth2-php/lib/OAuth2');

class OAuth2Base extends OAuth2 {
	
	public function __construct(IOAuth2Storage $storage, $config = array()) {
		$config = is_array($config) ? $config : array();
		$config[self::CONFIG_SUPPORTED_SCOPES] = 'all';
		$config[self::DEFAULT_ACCESS_TOKEN_LIFETIME] = 7200; // 2 hours
		$config[self::DEFAULT_REFRESH_TOKEN_LIFETIME] = 31536000; // 365 days
		parent::__construct($storage, $config);
	}
	
}

?>