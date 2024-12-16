<?php 

class menuModel {

	private $conection;

	public function __construct() {	
	}

	/* Seteo conexion */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
    }
	
	public function listado(){
		$this->getConection();
		$sql = "SELECT * FROM menus where 1";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();	
	}

    /**Guarda nuevo meno */
    public function InsertMenu($nameM,$DescriptionM,$IdParent) /*Insert Peticion en DB* */
    {
		$nombre='';
		if($IdParent!='')
		{
			$actualNote = $this->getMenuById($IdParent);
			$nombre=$actualNote["nameM"];
		}
		try
        {    
            $this->getConection();            
            $sql      = "INSERT INTO `menus`(`nameM`, `DescriptionM`, `idParentM`,`nameParent`) VALUES (?,?,?,?)";
            $stmt       = $this->conection->prepare( $sql );
            $stmt->bindParam( 1, $nameM );
            $stmt->bindParam( 2, $DescriptionM );
            $stmt->bindParam( 3, $IdParent );
            $stmt->bindParam( 4, $nombre );
			if($stmt->execute())
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        catch ( Exception $ex )
        {   
            return FALSE;
        }
    }

		/* Save note */
	public function updateMenu($id,$nameMenu,$DescriptionM,$idParent,$nameParent)
	{
		$this->getConection();
		$sql      = "UPDATE menus SET nameM=?,DescriptionM=?,idParentM=?,nameParent=? WHERE id=?";          
        $stmt       = $this->conection->prepare( $sql );
        $stmt->bindParam(1, $nameMenu);
        $stmt->bindParam(2, $DescriptionM);
        $stmt->bindParam(3, $idParent);
        $stmt->bindParam(4, $nameParent);
        $stmt->bindParam(5, $id);
        if($stmt->execute()){
			return true;
		}
		else
		{
			return false;
		}		
	}

	public function updateNameParentMenu($idParent,$nameParent)
	{
		$this->getConection();
		$sql      = "UPDATE menus SET nameParent=? WHERE idParentM=?";          
        $stmt       = $this->conection->prepare( $sql );
        $stmt->bindParam(1, $nameParent);
        $stmt->bindParam(2, $idParent);
        if($stmt->execute()){
			return true;
		}
		else
		{
			return false;
		}		
	}

	public function deleteMenuById($id){
		$this->getConection();
		$sql = "DELETE FROM menus WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->bindParam(1, $id);
		return $stmt->execute();
	}
	
	public function listadoMenuexcludeId($id){
		$this->getConection();
		$sql      = "SELECT * FROM menus WHERE id!=? and idParentM!=?";
		$stmt       = $this->conection->prepare( $sql );
		$stmt->bindParam( 1, $id );
		$stmt->bindParam( 2, $id );
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
	}

	public function listadoMenuexclude($id){
		$this->getConection();
		$sql      = "SELECT * FROM menus WHERE id!=?";
		$stmt       = $this->conection->prepare( $sql );
		$stmt->bindParam( 1, $id );
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;

	}

	public function getStatusMenu($id){
		$this->getConection();
		$sql      = "SELECT * FROM menus WHERE idParentM=?";
		$stmt       = $this->conection->prepare( $sql );
		$stmt->bindParam( 1, $id );
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
	}

	public function getparentMenus(){
		$this->getConection();
		$sql="SELECT idParentM, nameParent FROM menus where idParentM!='' GROUP BY idParentM, nameParent";
		//$sql      = "SELECT distinc FROM menus WHERE idParentM!=''";
		$stmt       = $this->conection->prepare( $sql );
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
	}

	/* Get menu by id */
	public function getHijosById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM menus WHERE idParentM = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();
        $result=$stmt->fetchAll();
		return $result;
    }

	/* Get menu by id */
	public function getMenuById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM menus WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->bindParam(1, $id);
		$stmt->execute();
        return $stmt->fetch();
    }

}

?>