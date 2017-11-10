<?php

class Route {

	static function start() {
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';

		include_once ROOT . "/application/models/model_user.php";

		$routes = explode('/', $_SERVER['REQUEST_URI']);
		// получаем имя контроллера
		if (!empty($routes[1])) {
			$controller_name = $routes[1];
		}
		// получаем имя экшена
		if (!empty($routes[2])) {
			$action_name = $routes[2];
		}
		// добавляем префиксы
		$controller_name = 'Controller_' . $controller_name;
		$action_name = 'action_' . $action_name;
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name) . '.php';
		$controller_path = "application/controllers/" . $controller_file;
		if (file_exists($controller_path)) {
			include "application/controllers/" . $controller_file;
		}

		if (!class_exists($controller_name)) {
			print_r('Ошибка');
		} else {
			$controller = new $controller_name;
			$action = $action_name;

			if (method_exists($controller, $action)) {
				// вызываем действие контроллера
					$controller->$action();
			} else {
				print_r('Ошибка');
			}
		}
	}
}