<?php
	$oauth_client = new Oauth("key","secret");
	$oauth_client->enableDebug();
	try {
		$info = $oauth_client->getRequestToken("http://localhost/OAuthProviderExample/oauth/request_token?oauth_callback=http://localhost/");
		echo "to authenticate go to ".$info['authentification_url']."?oauth_token=".$info['oauth_token'];
	} catch(OAuthException $E){
		echo $E;
	}
?>
