<?php
	$oauth_client = new Oauth("key","secret");
	$oauth_client->enableDebug();
	try {
		$oauth_client->getRequestToken("http://localhost/OAuthProviderExample/oauth/request_token");
	} catch(OAuthException $E){
		echo $E;
	}
?>
