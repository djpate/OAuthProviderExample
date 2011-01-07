<?php

	require_once("../interfaces/IConsumer.php");
	
	/* this class is just for the example purpose
	 * It's badly written but it's just for POC 
	 */
	class Consumer implements IConsumer{
		
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
		
	}
	
?>
