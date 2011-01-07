<?php
	function __autoload($name){
		require("../class/".$name.".class.php");
	}
	
	$provider = new Provider();
	
?>
