<?php

// Front Controller

// отображение ошибок php
ini_set('display_errors',1);
error_reporting(E_ALL);

// Подключение файловой системы
define('ROOT', dirname(__FILE__));

date_default_timezone_set('Europe/Moscow');
setlocale(LC_ALL, 'ru_RU.UTF-8');

session_start();

require_once (ROOT.'/components/Router.php');
require_once (ROOT.'/components/Db.php');
require_once (ROOT.'/components/Autoload.php');
require_once (ROOT.'/security.php');


$router = new Router();
$router -> run();
