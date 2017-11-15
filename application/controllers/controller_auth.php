<?php
defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller
{

	public function action_index()
	{
		$model_user = new Model_User();

		$user = $model_user->is_auth();
		if ($user) {
			$this->view->generate('login.php', 'template_view.php',
				array(
					'title' => 'Страница пользователя',
					'user'  => $user,
				)
			);
		} else {
			$login = isset($_POST['login']) ? $_POST['login'] : '';
			$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
			$auth = $model_user->auth($login, $pass);
			if ($auth) {
				$this->view->generate('login.php', 'template_view.php',
					array(
						'title' => 'Страница пользователя',
						'user'  => $auth,
					)
				);
			} else {
				$this->view->generate('errors.php', 'template_view.php',
					array(
						'title' => 'Ошибка авторизации',
						'errors'  => ['Неверный логин и/или пароль'],
					)
				);
			}
		}

	}

	public function action_logout()
	{
		setcookie("id", '', time() - 3600, '/');
		setcookie("hash", '', time() - 3600, '/');
		header('Location: /');
	}

}