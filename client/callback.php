<?php
	if(isset($_REQUEST['oauth_token'])&&isset($_REQUEST['verifier'])){
		?>
			<form>
				<label>token</label>
				<input type="text" name="oauth_token" value="<?=$_REQUEST['oauth_token'];?>" /><br />
				<label>secret</label>
				<input type="text" name="oauth_token_secret" value="" />
				<span>This is not passed by url, a real client would have stored this somewhere, you can get it from the db</span>
				<br />
				<label>verifier</label>
				<input type="text" name="verifier" value="<?=$_REQUEST['verifier']?>" />
			</form>
		<?
	}
?>