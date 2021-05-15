<?php

define('ROOT', dirname(dirname(__FILE__)));
require_once(ROOT . '/init.php');

$router = new Router();
$router->direct();