<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller
{

	function action_index()
	{
		$this->view->generate('main_view.php', 'template_view.php',
			array(
				'title' => 'Авторизация',
			)
		);
	}
}