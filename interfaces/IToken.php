<?php

	interface IToken{
		
		/* create a request token */
		public static function createRequestToken(IConsumer $consumer,$token,$tokensecret,$callback);
		
		/* returns an IToken instance if you can find a token in the db that matches $token otherwhise return false */
		public static function findByToken($token);
		
		/* returns true if this is a request token otherwise return false */
		public function isRequest();
		
		/* returns true if this is a access token otherwise return false */
		public function isAccess();
		
		/* return callback url */
		public function getCallback();
		
		/* return verifier */
		public function getVerifier();
		
		/* return type (1 for request - 2 for access) */
		public function getType();
		
		/* returns the token_secret */
		public function getSecret();
		
		/* returns the user associated with the access token */
		public function getUser();
		
		/* sets the verifier in the db*/
		public function setVerifier($verifier);
		
		/* sets the user in the db*/
		public function setUser(IUser $user);
		
	}

?>