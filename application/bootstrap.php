<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT']);

require_once 'core/db.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/log.php';

Route::start();