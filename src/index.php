<?php
$controller = strtolower($_REQUEST['ctrl'] ?? 'home');
$action = $_REQUEST['act'] ?? 'index';
require './app/controllers/' . $controller . '.php';
$controllerObject = new $controller();
$controllerObject->$action();
