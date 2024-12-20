<?php

namespace MyApp\Models;
use \PDO;
use \PDOException;

class DbConnectionModel
{
    private static $instance = null;
    private $conn;

    
    private function __construct()
    {
        $dbUser     = 'root'; // Replace with your actual database user
        $dbPass = ''; // Replace with your actual database password
        
        try 
            {
                $this->conn = new PDO("mysql:host=localhost;dbname=dbmenus", username: $dbUser, password: $dbPass);
            } 
            catch ( PDOException $ex )
            {
                error_log("Error conexion DB".$ex->getMessage() );
                die ("Connection fallida: ");
            }
        
    }

    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    
}
