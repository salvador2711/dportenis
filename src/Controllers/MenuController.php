<?php

namespace MyApp\Controllers;

use MyApp\Models\MenuModel;
use MyApp\Views\MenuView;
use MyApp\Models\config;

trait classtrait{
    public function updateMenu($id): void
    {
        
    }
}
class MenuController extends BaseController 
{
    use classtrait;
        
    private $model;


    public function __construct(MenuModel $model, MenuView $view)
    {
        parent::__construct(view: $view);
        $this->model = $model;

    }
    public function index()
    {
        $conf   = new config();
        $url = $conf->Url();
        
            
            if(isset($_GET['action']))
            {
                if($_GET['action']=='create')
                {
                    $this->crear(url: $url);
                }
                elseif($_GET['action']=='home')
                {
                    $this->menus(url: $url);
                }
                elseif($_GET['action']=='update')
                {
                    $id=$_GET["id"];
                    $this->updateMenu(id: $id,url: $url);
                }
                elseif($_GET['action']=='eliminar')
                {
                    $id=$_GET["id"];
                    $this->deleteMenu(id: $id,url: $url,flag: 0);
                }
                elseif($_GET['action']=='detalle')
                {
                    $id=$_GET["id"];
                    $this->detalleMenu(id: $id);
                }
                else
                {
                    $this->menus(url: $url);
                }


            }
            else
            {
                if(isset($_POST["action"]) && $_POST["action"]=="crearmenu")
                {
                    $vparentid=isset($_POST["parentId"]) ? $_POST["parentId"]:''; 
		            $name=isset($_POST["nameMenu"]) ? $_POST["nameMenu"]:'';
		            $description=isset($_POST["descriptionMenu"]) ? $_POST["descriptionMenu"]:'';	
		            $res=$this->model->InsertMenu(nameM: $name,DescriptionM: $description,IdParent: $vparentid);
                    $result =($res) ? 1:2; 
                    $this->guardarMenu(url: $url,flag: $result);
                }
                elseif(isset($_POST["action"]) && $_POST["action"]=="editar")
                {
                    $id=isset($_POST["id"]) ? $_POST["id"]:0;
                    $name=$_POST["nameMenu"];
                    $description=$_POST["descriptionMenu"];
                    $nombrePadre='';
                    $IdPadre='';
                    if(isset($_POST["parentId"]))
                    {
                        $arrPadre=explode(separator: '|',string: $_POST["parentId"]);
                        $IdPadre=$arrPadre[0];
                        $nombrePadre=$arrPadre[1];
                    }
                    $this->model->updateNameParentMenu(idParent: $id,nameParent: $name);
                    $res=$this->model->updateMenu($id,$name,$description,$IdPadre,$nombrePadre);
                    $result =($res) ? 1:2;
                    $this->editarMenu(id: $id,url: $url,flag: $result);
                }
                elseif(isset($_POST["action"]) && $_POST["action"]=="eliminarMenu")
                {
                    $idM=$_POST["id"];
                    $arraStaMenu=$this->model->getStatusMenu(id: $idM);//valida si el menu es padre
		            if(sizeof($arraStaMenu)>0)
		            {
			            $flag=2;
		            }
		            else
		            {
                        $res=$this->model->deleteMenuById(id: $idM);
			            $flag =($res)? 1:2;
		            }
                    $this->deleteMenuConfirm(id: $idM,url: $url,flag: $flag);
        
                }
                else
                {
                    $this->menus(url: $url);
                }
                
            }

    }
    public function crear($url){
        $menus = $this->model->getAllMenus();
        return $this->view->crearMenus($menus,$url,0);
    }

    public function guardarMenu($url,$flag){
        $menus = $this->model->getAllMenus();
        return $this->view->crearMenus($menus,$url,$flag);
    }

    public function menus($url)
    {
        $menus = $this->model->getAllMenus();
        return $this->view->getMenus($menus,$url);
    }

    public function listaMenus($id)
    {
		$arraStaMenu=$this->model->getStatusMenu($id);//valida si el menu es padre
		if(sizeof($arraStaMenu)>0)
		{
			$var=$this->model->listadoMenuexcludeId(id: $id);
		}
		else
		{
			$var=$this->model->listadoMenuexclude(id: $id);
		}
		return $var;
	}

    public function updateMenu($id,$url): void
    {
        $padres=$this->listaMenus(id: $id);
        $dataMenu=$this->model->getMenuById($id);
        $this->view->editar($dataMenu,$padres,$url,$id,0);
    }   

    public function editarMenu($id,$url,$flag)
    {
        $padres=$this->listaMenus(id: $id);
        $dataMenu=$this->model->getMenuById($id);
        $this->view->editar($dataMenu,$padres,$url,$id,$flag);
    }
    public function deleteMenu($id,$url,$flag): void
    {
        $dataMenu=$this->model->getMenuById(id: $id);
        $this->view->eliminar($dataMenu,$url,$id,$flag);
    }

    public function deleteMenuConfirm($id,$url,$flag): void
    {
        $this->view->eliminar([],$url,$id,$flag);
    }

    public function detalleMenu($id)
    {
        $dataMenu=$this->model->getMenuById(id: $id);
        $parents=$this->model->getparentMenus();
        $this->view->detalle($dataMenu,$parents);

    }

    





  
}