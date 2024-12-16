<?php 


require_once 'models/db.php';

# Incluimos la clase de las rutas
require_once "routes.php";

# Instanciamos la clase rutas para extraer la ruta de la url.
$routes = new routesMenu();
$return = $routes->init();

# Escribimos por pantalla el resultado
print_r( $return);


