<?php


session_start();
define('ROOT', dirname(__FILE__));
require_once (ROOT . '/app/functions.php');

require_once (ROOT . '/app/View.php');
require_once (ROOT . '/config/conf.php');
require_once (ROOT . '/app/Router.php');
require_once (ROOT . '/app/DB.php');
require_once (ROOT . '/app/autoload.php');


$router = new Router();
$router->run();
