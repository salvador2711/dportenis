<?php



namespace MyApp\Models;
use \Exception;

interface Menudata
{
public function getAllMenus();
public function getMenuById($id);
public function InsertMenu($nameM, $DescriptionM,$IdParent);

}

class MenuModel extends BaseModel implements Menudata
{
    //protected $conn;
    public function __construct()
    {
        parent::__construct();
    }

    //public function listado(){
	public function getAllMenus(): array
    {
        $result=[];
        try
        {
            $sql = "SELECT * FROM menus where 1";
	    	$stmt = $this->conn->prepare(query: $sql);
            $stmt->execute();
		    $result = $stmt->fetchAll();
            if(sizeof( value: $result ) < 0) 
            {
                throw new Exception(message: "Sin resultados de consulta");
            }
        }
        catch(exception $exception)
        {
           error_log( message: "ErrorSQL:". $exception->getMessage() );
        }
        
        return $result;
	}

    public function InsertMenu($nameM,$DescriptionM,$IdParent): bool /*Insert Peticion en DB* */
    {
		$nombre='';
		if($IdParent!='')
		{
			$actualMenu = $this->getMenuById(id: $IdParent);
			$nombre=$actualMenu["nameM"];
		}
		try
        {    
            $sql      = "INSERT INTO `menus`(`nameM`, `DescriptionM`, `idParentM`,`nameParent`) VALUES (?,?,?,?)";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $nameM );
            $stmt->bindParam( param: 2, var: $DescriptionM );
            $stmt->bindParam( param: 3, var: $IdParent );
            $stmt->bindParam( param: 4, var: $nombre );
			if($stmt->execute())
            {
                return TRUE;
            }
            else
            {
                throw new Exception(message: "No se realizo el registro");
                return FALSE;
            }
        }
        catch ( Exception $exception )
        {   
            error_log( message: "ErrorSQL:". $exception->getMessage() );
            return FALSE;
        }
    }

    public function getMenuById($id): array
    {
        $result=[];
        try
        {
            $sql = "SELECT * FROM menus WHERE id = ?";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $id );
            $stmt->execute();
            $result=$stmt->fetch();
            if(sizeof( value: $result ) < 0) 
            {
                throw new Exception(message: "Sin resultados de consulta por Id");
            }
            return $result;
            
        }
        catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return [];
        }
    }

    public function getStatusMenu($id): array
    {
        $result=[];
        try
        {
    		$sql      = "SELECT * FROM menus WHERE idParentM=?";
	    	$stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $id );
            $stmt->execute();
	    	$result= $stmt->fetchAll();
            if(sizeof( value: $result ) < 0) 
            {
                throw new Exception(message: "Sin resultados de consulta de menu padres");
            }
            return $result;
        }
        catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return [];
        }
	}

    public function listadoMenuexcludeId($id): array
    {

		$result=[];
        try
        {
            $sql      = "SELECT * FROM menus WHERE id!=? and idParentM!=?";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $id );
            $stmt->bindParam( param:2, var: $id );
            $stmt->execute();
            $result=$stmt->fetchAll();
            if(sizeof( value: $result ) < 0) 
            {
                throw new Exception(message: "Sin resultados de consulta de menu padres");
            }
            return $result;
        }
        catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return [];
        }
	}

	public function listadoMenuexclude($id): array
    {
		$result=[];
        try
        {
            $sql      = "SELECT * FROM menus WHERE id!=?";
    		$stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $id );
            $stmt->execute();
		    $result=$stmt->fetchAll();
            if(sizeof( value: $result ) < 0) 
            {
                throw new Exception(message: "Sin resultados de consulta de menu padres");
            }
            return $result;
        }
        catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return [];
        } 
	}

    public function updateNameParentMenu($idParent,$nameParent): bool
	{
        try
        {
            $sql      = "UPDATE menus SET nameParent=? WHERE idParentM=?";          
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $nameParent );
            $stmt->bindParam( param:2, var: $idParent );
            if($stmt->execute()){
                return true;
            }
            else
            {
                throw new Exception(message: "No se actualizo el nombre del padre en la tabla");
            }	
        }
        catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return false;
        } 
	}

    public function updateMenu($id,$nameMenu,$DescriptionM,$idParent,$nameParent)
	{
        try
        {
            $sql      = "UPDATE menus SET nameM=?,DescriptionM=?,idParentM=?,nameParent=? WHERE id=?";          
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $nameMenu );
            $stmt->bindParam( param:2, var: $DescriptionM );
            $stmt->bindParam( param:3, var: $idParent );
            $stmt->bindParam( param:4, var: $nameParent );
            $stmt->bindParam( param:5, var: $id );
            
            if($stmt->execute()){
                return true;
            }
            else
            {
                throw new Exception(message: "No se actualizo el nombre del padre en la tabla");
            }
        }
        catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return false;
        } 		
	}

    public function deleteMenuById($id): bool
    {    
        try
        {
            $sql = "DELETE FROM menus WHERE id = ?";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $id );
            if($stmt->execute()){
                return true;
            }
            else
            {
                throw new Exception(message: "No se elimino el menu");
            }
        }
        catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return false;
        }
	}

    public function getparentMenus(): array{
        $result=[];
        try
        {
            $sql="SELECT idParentM, nameParent FROM menus where idParentM!='' GROUP BY idParentM, nameParent";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->execute();    
            $result=$stmt->fetchAll();
            if(sizeof( value: $result ) < 0) 
            {
                throw new Exception(message: "Sin resultados de consulta de menu padres");
            }
            return $result;
        }
        catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return [];
        }

	}

    public function getHijosById($id){

        $result=[];
        try
        {

		    $sql = "SELECT * FROM menus WHERE idParentM = ?";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->bindParam( param: 1, var: $id );
            $stmt->execute();
		    $result=$stmt->fetchAll();
            if(sizeof( value: $result ) < 0) 
            {
                throw new Exception(message: "Sin resultados de consulta de menu padres");
            }
            return $result;
        }
		catch ( Exception $exception )
        {
            error_log( message:"errorSQL". $exception->getMessage() );
            return [];
        }
    }
	





}
