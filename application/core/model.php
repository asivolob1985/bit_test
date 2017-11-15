<?php
defined('SYSPATH') or die('No direct script access.');

class Model extends Db
{
	public $_pdo;

	public function __construct()
	{
		$this->_pdo = Db::getInstance();
	}
}