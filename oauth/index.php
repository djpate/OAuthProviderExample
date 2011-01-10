<?php
	function __autoload($name){
		require("../class/".$name.".class.php");
	}

	$provider = new Provider();
	
	if(strstr($_SERVER['REQUEST_URI'],"request_token")){
		echo $provider->generateRequestToken();
	}
	
?>
