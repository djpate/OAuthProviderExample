<?
	class User{
		
		/* bogus function to mimic authentification */
		public static function exist($login){
			$pdo = Db::singleton();
			$check = $pdo->query("select id from user where login = '".$login."'");
			if($check->rowCount()==1){
				return true;
			} else {
				return false;
			}
		}
		
	}