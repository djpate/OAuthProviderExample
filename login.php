<?

function __autoload($name){
		require("class/".$name.".class.php");
}

if(isset($_REQUEST['oauth_token'])){
	$consumer = Consumer::findByRequestToken($_REQUEST['oauth_token']);
	if(is_object($consumer)){
		if(!isset($_POST['login'])){
		?>
			<form method=post>
				<label>Login : </label><input type="text" name="login" /><br />
				<input type="submit" value="Authenticate to this website" />
			</form>
		<? 
		} else {
			if(User::exist($_POST['login'])){
				$verifier = Provider::generateVerifier($consumer,$_REQUEST['oauth_token']);
			}
		}
	} else {
		echo "The specified token does not exist";
	}
} else {
	echo "Please specify a oauth_token";
}