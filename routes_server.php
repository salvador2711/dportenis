<?php 
Class routesMenu
{

	public function init()
	{
        //valor por defecto del metodo
		if ( $_SERVER['REQUEST_URI'] == '/')
		{
			$method = "index";
		}
		else
		{
			// Recogemos la url para saber que metodo que nos estan pidiendo y lo ponemos en un array
			$request_uri = explode ("/", $_SERVER['REQUEST_URI']);
		}

		# Obtenemos el metodo que sera el primer parametro
		if ( isset( $request_uri[1]))
		{
			$method = ucfirst( $request_uri[1]);
		}
        else // metodo por default
        {
            $method="home";
        }

		# Ahora recogemos los parametros, que es todo lo que venga despues del metodo
		# y por si vienen multiples parametros los ponemos en un array
		#
		$params = [];
		if ( isset( $request_uri[2]))
		{
			for ( $i = 2; $i < count($request_uri); $i++)
			{
				$params[] = $request_uri[$i];
			}
		}

		# Cargamos la clase y el metodo que nos piden

		$dircontroller = "/controllers/menuController.php";

		# Si el fichero del controlador existe, lo cargamos y lo instanciamos.
		if ( file_exists( $dircontroller))
  	    {
			$class_controller = new menuController();

			# Si el metodo existe lo instanciamos y ejecutamos lo que tiene que hacer
			# pasandole los parametros que necesite.
			if ( method_exists( $class_controller, $method))
			{
				$return = $class_controller->{$method} ($params);
			}
			else
			{
				$return = "Method no encontrado";
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