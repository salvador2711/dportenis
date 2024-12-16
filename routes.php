<?php 
Class routesMenu
{

	public function init()
	{
		$request_uri = explode ("/", $_SERVER['REQUEST_URI']);
	
		# Obtenemos el metodo que sera el primer parametro
		if ( isset($request_uri[2]) && $request_uri[2]!='')
		{
			$method = ucfirst( $request_uri[2]);
		}
        else // metodo por default
        {
            $method="home";
        }

		# Cargamos la clase y el metodo que nos piden

		$dircontroller = "controllers/menuController.php";

		# Si el fichero del controlador existe, lo cargamos y lo instanciamos.
		if ( file_exists( $dircontroller))
  	    {
			include_once $dircontroller;
			$class_controller = new menuController();

			# Si el metodo existe lo instanciamos y ejecutamos lo que tiene que hacer
			# pasandole los parametros que necesite.
			if ( method_exists( $class_controller, $method))
			{
				$return = $class_controller->{$method}();
			}
			else
			{
				$return = "Metodo no encontrado";
			}
  		}
		else
		{
			$return =  "Archivo no existe";
		}

		# Devolvemos el resultado.
		return($return);
	}

}

?>