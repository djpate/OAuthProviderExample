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
			
			/* If we are issuing a request token we need to disable checkToken */
			if(strstr($_SERVER['REQUEST_URI'],"oauth/request_token")){
				$this->oauth->isRequestTokenEndpoint(true); 
			}
			
			/* now that everything is setup we run the checks */
				$this->oauth->checkOAuthRequest();
			} catch(OAuthException $E){
				echo OAuthProvider::reportProblem($E);
				$this->oauth_error = true;
			}
			
			
			
		}
		
		public function forceCallback(){
			$this->oauth->addRequiredParameter("oauth_callback");
		}
		
		public function generateRequestToken(){
			
			if($this->oauth_error){
				return false;
			}
			
			$token = sha1(OAuthProvider::generateToken(20,true));
			$token_secret = sha1(OAuthProvider::generateToken(20,true));
			
			$callback = $this->oauth->callback;
			
			Token::createRequestToken($this->consumer, $token, $token_secret, $callback);
		
			return "authentification_url=".$this->authentification_url."&oauth_token=".$token."&oauth_token_secret=".$token_secret."&oauth_callback_confirmed=true";
			
		}
		
		public function generateAccesstoken(){
			return "hello";
		}
		
		public function generateVerifier(){
			$verifier = sha1(OAuthProvider::generateToken(20,true));
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
					$this->consumer->addNonce($this->oauth->nonce);
					$provider->consumer_secret = $this->consumer->getSecretKey();
					$return = OAUTH_OK;
				}
			}
			
			return $return;
		}
		
		public function checkToken($provider){
			
			$token = Token::findByToken($provider->token);
			
			if(is_null($token)){ // token not found
				return OAUTH_TOKEN_REJECTED;
			} elseif($token->getType() == 1 && $token->getVerifier() != $provider->verifier){ // bad verifier for request token
				return OAUTH_VERIFIER_INVALID;
			} else {
				$provider->token_secret = $token->getSecret();
				return OAUTH_OK;
			}
			
		}
		
		/**
		 * Here we check the nonce & timestamp
		 * Basicly the timestamp has to been within the last 5 minutes (you can change that of course)
		 * And the nonce as to be unknown for a specified consumer to avoid replay attacks */
		public function checkNonce($provider){
			//TODO OAUTH_BAD_NONCE;
			if($this->oauth->timestamp < time() - 5*60){
				return OAUTH_BAD_TIMESTAMP;
			} else {
				return OAUTH_OK;
			}
		}
		
	}
?>
