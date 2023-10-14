<?php
include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();

$module = isset($_GET['module']) ? $_GET['module'] : 'register';
$method = isset($_GET['action']) ? $_GET['action'] : 'view';

$router->route($module, $method);



