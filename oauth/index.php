<?php
	function __autoload($name){
		require("../class/".$name.".class.php");
	}

	$provider = new Provider();
	
	if(strstr($_SERVER['REQUEST_URI'],"request_token")){
		$provider->forceCallback();
		echo $provider->generateRequestToken();
	} else if(strstr($_SERVER['REQUEST_URI'],"access_token")){
		$provider->generateAccessToken();
	}
	
?>
