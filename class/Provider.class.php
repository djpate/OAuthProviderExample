<?php

	class Provider{
		
		private $oauth;
		private $consumer;
		private $oauth_error;
		private $authentification_url = "http://localhost/OAuthProviderExample/login.php";
		
		public function __construct(){
			
			try {
			/* create our instance */
			$this->oauth = new OAuthProvider();
			
			/* setup check functions */
			$this->oauth->consumerHandler(array($this,'checkConsumer'));
			$this->oauth->timestampNonceHandler(array($this,'checkNonce'));
			$this->oauth->tokenHandler(array($this,'checkToken'));
			
			/* force callback url */
			$this->oauth->addRequiredParameter("oauth_callback");
			
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
		
		public function generateRequestToken(){
			
			if($this->oauth_error){
				return false;
			}
			
			$token = sha1(OAuthProvider::generateToken(20,true));
			$token_secret = sha1(OAuthProvider::generateToken(20,true));
			
			$callback = $this->oauth->callback;
			
			$this->consumer->addRequestToken($token,$token_secret,$callback);
		
			return "authentification_url=".$this->authentification_url."&oauth_token=".$token."&oauth_token_secret=".$token_secret."&oauth_callback_confirmed=true";
			
		}
		
		public function generateVerifier($consumer,$request_token){
			$verifier = sha1(OAuthProvider::generateToken(20,true));
			$consumer->setVerifier($request_token,$verifier);
			return $verifier;
		}
		
		/* handlers */
		public function checkConsumer($provider){
			
			$return = OAUTH_CONSUMER_KEY_UNKNOWN;
			
			$aConsumer = Consumer::findByKey($provider->consumer_key);
			
			if(is_object($aConsumer)){
				if(!$aConsumer->isActive()){
					$return = OAUTH_CONSUMER_KEY_REFUSED;
				} else {
					$this->consumer = $aConsumer;
					$provider->consumer_secret = $this->consumer->getSecretKey();
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
