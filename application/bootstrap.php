<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("SYSPATH", $_SERVER['DOCUMENT_ROOT'].'/application');
define("LOGS_PATH", $_SERVER['DOCUMENT_ROOT'].'/application/logs');

require_once 'core/db.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/model.php';
require_once 'core/route.php';

Route::start();