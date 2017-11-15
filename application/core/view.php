<?php
defined('SYSPATH') or die('No direct script access.');

class View
{
	/*$content_view  - виды отображающие контент страниц;
	$template_view - общий для всех страниц шаблон;
	$data   -  массив, содержащий элементы контента страницы.
	 */
	public function generate($content_view, $template_view, $data = null)
	{

		if (is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}

		include 'application/views/' . $template_view;
	}
}