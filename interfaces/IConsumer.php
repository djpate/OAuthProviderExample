<?php

	interface IConsumer{
		
		/* return an instance of a IConsumer or throw an error on not found */
		public static function findByKey($key);
		
		/* Create in the DB a consumer with a given key & secret */
		public function create($key,$secret);
		
		/* Return if the consumer is active */
		public function isActive();
		
	}

?>
