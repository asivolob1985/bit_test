<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("SYSPATH", $_SERVER['DOCUMENT_ROOT'].'/application');

require_once 'core/db.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/model.php';
require_once 'core/route.php';
require_once 'core/log.php';

Route::start();