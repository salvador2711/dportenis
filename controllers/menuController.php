<?php 

require_once './models/menu.php';

class menuController{
	public $view;
	public $menuObj;

	public function __construct() {
		$this->view = 'lista';
		$this->menuObj = new menuModel();
	}

    public function home()
    {
        $listamenu=$this->menuObj->listado();
        require_once("./views/home.php");
    }

    public function crearMenu(){
		$listamenus=$this->menuObj->listado();
	    require_once("./views/guardar.php");
    }

    public function guardarMenu()
    {
		$vparentid=isset($_POST["parentId"]) ? $_POST["parentId"]:''; 
		$name=isset($_POST["nameMenu"]) ? $_POST["nameMenu"]:'';
		$description=isset($_POST["descriptionMenu"]) ? $_POST["descriptionMenu"]:'';	
		$this->menuObj->InsertMenu($name,$description,$vparentid);
		$_GET["response"] = true;
        $listamenus=$this->menuObj->listado();
        require_once("./views/guardar.php");
	}

    public function editar()
    {
        $id=isset($_POST["idM"]) ? $_POST["idM"]:0;
        $dataMenu=$this->menuObj->getMenuById($id);
        $listamenus=menuController::listaMenus($id);
        require_once("./views/editar.php");
    }

	public function editarMenu(){
        $id=isset($_POST["id"]) ? $_POST["id"]:0;
        
		//$id=$_POST["id"];
		$name=$_POST["nameMenu"];
		$description=$_POST["descriptionMenu"];
		$nombrePadre='';
		$IdPadre='';
		if(isset($_POST["parentId"]))
        {
			$arrPadre=explode('|',$_POST["parentId"]);
			$IdPadre=$arrPadre[0];
			$nombrePadre=$arrPadre[1];
		}
		$this->menuObj->updateNameParentMenu($id,$name);
		$this->menuObj->updateMenu($id,$name,$description,$IdPadre,$nombrePadre);
		$_GET["response"] = true;
	    $dataMenu=$this->menuObj->getMenuById($id);
        $listamenus=menuController::listaMenus($id);
        require_once("./views/editar.php");
	}

    public function eliminar()
    { 
        
        $idM=$_POST["idM"];
        $dataMenu=$this->menuObj->getMenuById($idM);
        require_once("./views/eliminar.php");
    }

    public function detalle()
    {
        $idM=$_POST["idMenu"];
        $dataMenu=$this->menuObj->getMenuById($idM);
        $parents=$this->menuObj->getparentMenus();
        require_once("./views/detalle.php");
    }

    public function getHijos($id)
    {
        return $this->menuObj->getHijosById($id);
    }

    public function eliminarMenu()
    { 
        $idM=$_POST["idM"];
        $dataMenu=$this->menuObj->getMenuById($idM);
        $arraStaMenu=$this->menuObj->getStatusMenu($idM);//valida si el menu es padre
		if(sizeof($arraStaMenu)>0)
		{
			$_GET["response"] = '01';
		}
		else
		{
            $this->menuObj->deleteMenuById($idM);
			$_GET["response"] = '00';
		}
        require_once("./views/eliminar.php");
    }

    /* Listado de los menus */
	public function lista(){
		$this->view = 'lista';
		return $this->menuObj->listado();
	}
	
    public function listaMenus($id)
    {
		$arraStaMenu=$this->menuObj->getStatusMenu($id);//valida si el menu es padre
		if(sizeof($arraStaMenu)>0)
		{
			$var=$this->menuObj->listadoMenuexcludeId($id);
		}
		else
		{
			$var=$this->menuObj->listadoMenuexclude($id);
		}
		return $var;
	}
}

?>