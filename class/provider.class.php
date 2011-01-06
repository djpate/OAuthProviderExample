<?php
	class Provider{
		
		private $oauth;
		
		public function __construct(){
			
			/* create our instance */
			$this->oauth = new OAuthProvider();
			
			/* setup check functions */
			$this->oauth->consumerHandler(array($this,'checkConsumer'));
			$this->oauth->timestampNonceHandler(array($this,'checkNonce'));
			$this->oauth->tokenHandler(array($this,'checkToken'));
			
			/* Set the request token url so we dont run checkToken() on a RequestToken */
			$this->oauth->setRequestTokenPath("/OAuthProviderExample/oauth/request_token");
			
			/* now that everything is setup we run the checks */
			try {
				$this->oauth->checkOAuthRequest();
			} catch(OAuthException $E){
				echo OAuthProvider::reportProblem($E);
				$this->oauth_error = true;
			}
			
			
		}
		
		private function checkConsumer(){
			return OAUTH_OK;
		}
		
		private function checkToken(){
			return OAUTH_OK;
		}
		
		private function checkNonce(){
			return OAUTH_OK;
		}
		
	}
?>
