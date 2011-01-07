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
				$this->oauth->checkOAuthRequest("http://localhost/OAuthProviderExample/oauth",OAUTH_HTTP_METHOD_GET);
			} catch(OAuthException $E){
				print_r($_REQUEST);
				echo OAuthProvider::reportProblem($E);
				$this->oauth_error = true;
			}
			
			
			
		}
		
		public function checkConsumer($provider){
			error_log("ok1");
			$provider->consumer_secret = "secret";
			return OAUTH_OK;
		}
		
		public function checkToken($provider){
			error_log("ok3");
			return OAUTH_OK;
		}
		
		public function checkNonce($provider){
			error_log("ok2");
			return OAUTH_OK;
		}
		
	}
?>
