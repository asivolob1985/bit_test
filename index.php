<?php
session_write_close();
# Включаем показ ошибок
ini_set('display_errors', 1);

# Подключаем bootstrap файл
require_once 'vendor/autoload.php';
require_once 'application/bootstrap.php';
