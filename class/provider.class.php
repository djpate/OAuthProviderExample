<?php
	class Provider{
		
		private $oauth;
		
		public function __construct(){
			
			/* create our instance */
			$this->oauth = new OAuthProvider();
			
			/* setup check functions */
			$this->consumerHandler(array($this,'checkConsumer'));
			$this->timestampNonceHandler(array($this,'checkNonce'));
			$this->tokenHandler(array($this,'checkToken'));
			
			/* Set the request token url so we dont run checkToken() on a RequestToken */
			$this->setRequestTokenPath("/OAuthProviderExample/oauth/request_token");
			
			/* now that everything is setup we run the checks */
			try {
				$this->checkOAuthRequest();
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
