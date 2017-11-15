<?php

require_once ROOT . "/config.php";

class Db
{

	protected $_pdo;

	public function __construct()
	{
		$this->_pdo = new PDO('mysql:dbname='.Config::$BD_NAME.';host='.Config::$HOST, Config::$USER, Config::$PASS);
	}
}
 
