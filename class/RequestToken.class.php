<?php
	class RequestToken{
		
		protected $id;
		protected $consumer;
		protected $token;
		protected $token_secret;
		protected $callback;
		protected $verifier;
		protected $pdo;
		
		public static function create(IConsumer $consumer,$token,$tokensecret,$callback){
			$pdo = Db::singleton();
			$pdo->exec("insert into request_token (consumer_id,token,token_secret,callback_url) values (".$consumer->getId().",'".$token."','".$tokensecret."','".$callback."') ");
		}
		
		public static function findByToken($token){
			$ret = null;
			$pdo = Db::singleton();
			$find = $pdo->query("select id from request_token where token = '".$token."'");
			if($find->rowCount()==1){
				$find = $find->fetch();
				$request_token = new RequestToken($find['id']);
				$ret = $request_token;
			}
			return $ret;
		}
		
		public function setVerifier($verifier){
			$this->pdo->exec("update request_token set verifier = '".$verifier."' where id = ".$this->id);
			$this->verifier = $verifier;
		}
		
		public function __construct($id=0){
			$this->pdo = Db::singleton();
			if($id != 0){
				$this->id = $id;
				$this->load();
			}
		}
		
		private function load(){
			$info = $this->pdo->query("select * from request_token where id = ".$this->id)->fetch();
			$this->token = $info['token'];
			$this->token_secret = $info['token_secret'];
			$this->consumer = new Consumer($info['consumer_id']);
			$this->callback = $info['callback_url'];
			$this->verifier = $info['verifier'];
		}
		
		public function getCallback(){
			return $this->callback;
		}
		
		public function getVerifier(){
			return $this->verifier;
		}
		
		
	}
?>