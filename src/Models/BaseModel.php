<?php

namespace MyApp\Models;


class BaseModel extends DbConnectionModel
{
    protected $conn;

    public function __construct()
    {
        $dbConnection = DbConnectionModel::getInstance();
        $this->conn   = $dbConnection->getConnection();
    }

    
}