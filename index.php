<?php
include_once('Configuration.php');
include_once ('helpers/RolControl.php');
include_once('helpers/SessionControl.php');

$configuration = new Configuration();
$rol = new RolControl();
$session = new SessionControl();

$router = $configuration->getRouter();

$idRol = $session->get('idRol');

$module = isset($_GET['module']) ? $_GET['module'] : 'register';
$method = isset($_GET['action']) ? $_GET['action'] : 'view';

$rol->getAccessRol($idRol, $module, $method);

$router->route($module, $method);







