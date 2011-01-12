<?php
	if(isset($_POST['token'])){
		try {
			$oauth_client = new Oauth("key","secret");
			$oauth_client->enableDebug();
			$oauth_client->setToken($_POST['token'],$_POST['token_secret']);
			$oauth_client->fetch("http://localhost/OAuthProviderExample/oauth/api/user");
			echo "API RESULT : ".$oauth_client->getLastResponse();
		} catch (OAuthException $E){
			echo $E->debugInfo;
		}
	} else {
		?>
	<form method="post">
		Access token : <input type="text" name="token" value="<?=$_REQUEST['token'];?>" /> <br />
		Access token secret : <input type="text" name="token_secret" value="<?=$_REQUEST['token_secret'];?>" /> <br />
		<input type="submit" value="do An api call" />
	</form>
	<? }  ?>