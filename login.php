<?
if(isset($_REQUEST['oauth_token'])){
	if(!isset($_POST['login'])){
	?>
		<form>
			<label>Login : </label><input type="text" name="login" /><br />
			<input type="submit" value="Authenticate to this website" />
		</form>
	<? 
	} else {
		
	}
	?>
}