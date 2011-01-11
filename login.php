<?

function __autoload($name){
		require("class/".$name.".class.php");
}

if(isset($_REQUEST['oauth_token'])){
	$request_token = RequestToken::findByToken($_REQUEST['oauth_token']);
	if(is_object($request_token)){
		if(!isset($_POST['login'])){
		?>
			<form method=post>
				<label>Login : </label><input type="text" name="login" /><br />
				<input type="submit" value="Authenticate to this website" />
			</form>
		<? 
		} else {
			if(User::exist($_POST['login'])){
				$request_token->setVerifier(Provider::generateVerifier($_REQUEST['oauth_token']));
				header("location: ".$request_token->getCallback()."?&oauth_token=".$_REQUEST['oauth_token']."&verifier=".$request_token->getVerifier());
			}
		}
	} else {
		echo "The specified token does not exist";
	}
} else {
	echo "Please specify a oauth_token";
}