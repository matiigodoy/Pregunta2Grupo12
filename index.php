<?php
include_once('Configuration.php');
$configuration = new Configuration();
$router = $configuration->getRouter();

$module = isset($_GET['module']) ? $_GET['module'] : 'register';
$method = isset($_GET['action']) ? $_GET['action'] : 'view';

// Define una variable $usuarioID y obtén el valor de 'idusuario' desde la URL
$usuarioID = isset($_GET['idusuario']) ? (int)$_GET['idusuario'] : 0; // 0 es un valor predeterminado

// Define los parámetros
$params = array($usuarioID);

// Llama al enrutador con los parámetros
$router->route($module, $method, $params);







