<?php 


error_reporting(error_level: E_ALL);
ini_set(option: 'ignore_repeated_errors', value: TRUE); 
ini_set(option: 'display_errors', value: false); 
ini_set(option: 'log_errors', value: TRUE); 
ini_set(option: 'error_log', value: 'logs/errors.log'); //Path

require_once 'vendor/autoload.php';
//error_reporting(1);
use MyApp\Controllers\MenuController;
use MyApp\Models\MenuModel;
use MyApp\Views\MenuView;

$menuCon = new MenuController(model: new MenuModel(), view: new MenuView());
$menuCon->mostrarFooter();
$menuCon->index();
$menuCon->mostrarFooter();

