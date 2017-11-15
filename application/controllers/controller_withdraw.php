<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Withdraw extends Controller
{

	public function action_index() {
		$model_user = new Model_User();
		$is_auth = $model_user->is_auth();
		if ($is_auth) {
			//пользователь авторизован, начинаем списание денег
			if ($model_user->withdraw()) {
				$this->view->generate('withdraw.php', 'template_view.php',
					array(
						'title' => 'Списание средств проведено успешно',
					)
				);
			} else {
				$this->view->generate('errors.php', 'template_view.php',
					array(
						'title'  => 'Ошибка списания средств',
						'errors' => ['Ошибка списания средств'],
					)
				);
			}
		}
	}

}