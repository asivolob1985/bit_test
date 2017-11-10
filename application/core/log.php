<?php

class log{

	public static function write($file, $text){
		$path = ROOT.'/application/logs/';
		$dateteme = date('d.m.Y / H:i:s');
		$full_path = $path.$file.'.php';
		$fp = fopen($full_path, "a");
		$start = 'start: '.$dateteme.'/ ';
		fwrite($fp, $start.$text. "\r\n");
		fclose($fp);

		return true;
	}
}