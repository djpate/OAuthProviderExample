<?

function __autoload($name){
		require("../class/".$name.".class.php");
}

if(isset($_REQUEST['oauth_token'])){
	$request_token = Token::findByToken($_REQUEST['oauth_token']);
	if(is_object($request_token)&&$request_token->isRequest()){
		if(!isset($_POST['login'])){
		?>
			<form method=post>
				<label>Login : </label><input type="text" name="login" /><br />
				<input type="submit" value="Authenticate to this website" />
			</form>
		<? 
		} else {
			$user = User::exist($_POST['login']);
			if(is_object($user)){
				$request_token->setVerifier(Provider::generateVerifier());
				$request_token->setUser($user);
				header("location: ".$request_token->getCallback()."?&oauth_token=".$_REQUEST['oauth_token']."&oauth_verifier=".$request_token->getVerifier());
			} else {
				echo "User not found !";
			}
		}
	} else {
		echo "The specified token does not exist";
	}
} else {
	echo "Please specify a oauth_token";
}
