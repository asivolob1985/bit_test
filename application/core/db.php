<?php
defined('SYSPATH') or die('No direct script access.');

require_once ROOT . "/config.php";

class Db
{
	private static $pdo = null;

	private function __construct()
	{

	}

	public static function getInstance()
	{
		if (self::$pdo === null) {
			self::$pdo = new PDO('mysql:dbname='.Config::$BD_NAME.';host='.Config::$HOST, Config::$USER, Config::$PASS);
		}

		return self::$pdo;
	}
}
 
