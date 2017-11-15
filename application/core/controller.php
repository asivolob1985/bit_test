<?php
defined('SYSPATH') or die('No direct script access.');

abstract class Controller
{
	public $model;
	public $view;

	public function __construct()
	{
		$this->view = new View();
	}

	abstract function action_index();
}