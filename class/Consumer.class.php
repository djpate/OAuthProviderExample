<?php

	require_once("../interfaces/IConsumer.php");
	
	/* this class is just for the example purpose
	 * It's badly written but it's just for POC 
	 */
	class Consumer implements IConsumer{
		
		private $id;
		private $key;
		private $secret;
		private $active;
		
		public static function findByKey($key){
			$consumer = null;
			$pdo = Db::singleton();
			$info = $pdo->query("select * from consumer where consumer_key = '".$key."'"); // this is not safe !
			if($info->rowCount()==1){
				$info = $info->fetch();
				$consumer = new Consumer();
				$consumer->setKey($key);
				$consumer->setSecret($info['consumer_secret']);
				$consumer->setActive($info['active']);
				$consumer->setId($info['id']);
			}
			return $consumer;
		}
		
		public static function create($key,$secret){
			
		}
		
		public function isActive(){
			return $this->active;
		}
		
		public function getSecretKey(){
			return $this->secret;
		}
		
		public function addRequestToken($token, $token_secret, $callback){
			$pdo = Db::singleton();
			$pdo->exec("insert into request_token (consumer_id,token,token_secret,callback_url) values (".$this->id.",'".$token."','".$token_secret."','".$callback."') ");
		}
		
		public function hasNonce($nonce){
			$pdo = Db::singleton();
			$check = $pdo->query("select count(*) as cnt from consumer_nonce where nonce = '".$nonce."' and consumer_id = ".$this->id)->fetch();
			if($check['cnt']==1){
				return true;
			} else {
				return false;
			}
		}
		
		public function addNonce($nonce){
			$pdo = Db::singleton();
			$check = $pdo->exec("insert into consumer_nonce (consumer_id,timestamp,nonce) values (".$this->id.",".time().",'".$nonce."')");
		}
		
		/* setters */
		
		public function setKey($key){
			$this->key = $key;
		}
		
		public function setSecret($secret){
			$this->secret = $secret;
		}
		
		public function setActive($active){
			$this->active = $active;
		}
		
		public function setId($id){
			$this->id = $id;
		}
		
	}
	
?>
