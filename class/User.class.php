<?
	require(dirname(__FILE__)."/../interfaces/IUser.php");
	
	class User implements IUser {
		
		private $id;
		private $login;
		private $pdo;
		
		/* bogus function to mimic authentification */
		public static function exist($login){
			$pdo = Db::singleton();
			$check = $pdo->query("select id from user where login = '".$login."'");
			if($check->rowCount()==1){
				$check = $check->fetch();
				return new User($check['id']);
			} else {
				return null;
			}
		}
		
		public function __construct($id = 0){
			$this->pdo = Db::singleton();
			if($id != 0){
				$this->id = $id;
				$this->load();
			}
		}
		
		private function load(){
			$info = $this->pdo->query("select * from user where id = ".$this->id)->fetch();
			$this->login = $info['login'];
		}

		public function getId(){
			return $this->id;
		}
		
		public function getLogin(){
			return $this->login;
		}
	}