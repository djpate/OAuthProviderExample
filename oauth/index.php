<?php
	function __autoload($name){
		require("../class/".$name.".class.php");
	}

	$provider = new Provider();
	
	if(strstr($_SERVER['REQUEST_URI'],"request_token")){
		$provider->setRequestTokenQuery();
		$provider->checkRequest();
		echo $provider->generateRequestToken();
	} else if(strstr($_SERVER['REQUEST_URI'],"access_token")){
		$provider->checkRequest();
		echo $provider->generateAccessToken();
	} else if(strstr($_SERVER['REQUEST_URI'],"create_consumer")){
		$consumer = Provider::createConsumer();
		?>
		<h1>New consumer</h1>
		<strong>Key : </strong> <?php echo $consumer->getKey()?><br />
		<strong>Secret : </strong> <?php echo $consumer->getSecretKey()?>
		<?
	} else if(strstr($_SERVER['REQUEST_URI'],"api/user")){
		/* this is a basic api call that will return the id of an authenticated user */
		$provider->checkRequest();
		try {
			echo $provider->getUser()->getId();
		} catch(Exception $E){
			echo $E;
		}
	}
	
?>
