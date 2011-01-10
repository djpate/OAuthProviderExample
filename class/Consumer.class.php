<?php

	require_once(dirname(__FILE__)."/../interfaces/IConsumer.php");
	
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
			$info = $pdo->query("select id from consumer where consumer_key = '".$key."'"); // this is not safe !
			if($info->rowCount()==1){
				$info = $info->fetch();
				$consumer = new Consumer();
				$consumer->load($info['id']);
			}
			return $consumer;
		}
		
		public static function findByRequestToken($token){
			$consumer = null;
			$pdo = Db::singleton();
			$info = $pdo->query("select consumer_id from request_token where token = '".$token."'"); // this is not safe !
			if($info->rowCount()==1){
				$info = $info->fetch();
				$consumer = new Consumer();
				$consumer->load($info['consumer_id']);
			}
			return $consumer;
		}
		
		private function load($id){
			$pdo = Db::singleton();
			$info = $pdo->query("select * from consumer where id = '".$id."'")->fetch();
			$this->id = $id;
			$this->key = $info['consumer_key'];
			$this->secret = $info['consumer_secret'];
			$this->active = $info['active'];
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
		
		public function setVerifier($request_token,$verifier){
			$pdo = Db::singleton();
			$pdo->exec("update request_token set verifier = '".$verifier."' where consumer_id = ".$this->id." and token = '".$request_token."'");
		}
		
	}
	
?>
