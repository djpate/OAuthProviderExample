<?php
	$oauth_client = new Oauth("key","secret");
	try {
		$oauth_client->getRequestToken("http://89.159.5.199/OAuthProviderExample/oauth/request_token");
	} catch(OAuthException $E){
		echo $E;
	}
?>
