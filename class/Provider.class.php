<?php

	class Provider{
		
		private $oauth;
		
		public function __construct(){
			
			try {
			/* create our instance */
			$this->oauth = new OAuthProvider();
			
			/* setup check functions */
			$this->oauth->consumerHandler(array($this,'checkConsumer'));
			$this->oauth->timestampNonceHandler(array($this,'checkNonce'));
			$this->oauth->tokenHandler(array($this,'checkToken'));
			
			/* If we are issuing a request token we need to disable checkToken */
			if(strstr($_SERVER['REQUEST_URI'],"oauth/request_token")){
				$this->oauth->isRequestTokenEndpoint(true); 
			}
			
			/* now that everything is setup we run the checks */
				$this->oauth->checkOAuthRequest();
			} catch(OAuthException $E){
				print_r($_REQUEST);
				echo OAuthProvider::reportProblem($E);
				$this->oauth_error = true;
			}
			
			
			
		}
		
		public function checkConsumer($provider){
			
			$return = OAUTH_CONSUMER_KEY_UNKNOWN;
			
			$aConsumer = Consumer::findByKey($provider->consumer_key);
			
			if(is_object($aConsumer)){
				if(!$aConsumer->isActive()){
					$return = OAUTH_CONSUMER_KEY_REFUSED;
				} else {
					$provider->consumer_secret = $aConsumer->getSecretKey();
					$return = OAUTH_OK;
				}
			}
			
			return $return;
		}
		
		public function checkToken($provider){
			return OAUTH_OK;
		}
		
		public function checkNonce($provider){
			return OAUTH_OK;
		}
		
	}
?>
