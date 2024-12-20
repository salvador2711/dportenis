<?php
namespace MyApp\Views;
use MyApp\Models\MenuModel;

class MenuView extends BaseView
{
    public function getMenus($menus,$url): void
    {
        MenuView::header();    
            echo    '<div class="container">';
            echo    '<br><a href="?action=create" class="btn btn-outline-primary">Crear Menu</a><br>';
            echo    '<h2>Listado de menus</h2>';
            if(sizeof(value: $menus)> 0)
            {
            echo    '<table class="table table-striped" >';
            echo    '<tr>';
            echo    '<th>Id</th>';
            echo    '<th>Nombre</th>';
            echo    '<th>Menu Padre</th>';
            echo    '<th>Descripción</th>';
            echo    '<th>Acciones</th>';
            echo    '</tr>';
            for($i=0;$i<sizeof(value: $menus);$i++){
                echo '<tr>';
                echo '<td class="idMenu"><a href=" ' . $url . '/?action=detalle&id=' . $menus[$i]['id'] . '">'. $menus[$i]['id'] .'</a> </td>';
                echo '<td >' . $menus[$i]['nameM'] . '</td>';
                echo '<td >' . $menus[$i]['nameParent'] . '</td>';
                echo '<td >' . $menus[$i]['DescriptionM'] . '</td>';
                echo '<td>
                    <a class="btn btn-success" href=" ' . $url . '/?action=update&id=' . $menus[$i]['id'] . '">actualizar</a> 
                    <a class="btn btn-danger" href=" ' . $url . '/?action=eliminar&id=' . $menus[$i]['id'] . '">eliminar</a>' . 
                    '</td>';
                echo '</tr>';
            }
            echo '</table>';
            }
            echo '</div>';
        
        MenuView::footer();
    }

    public function crearMenus($menus,$url,$flagCreate): void
    {
        MenuView::header(); 
        if($flagCreate==1)
        {
            echo    '<br>
                    <br>
                    <div class="alert alert-success">
                        Operación exitosa 
                    </div>';
        }   
        elseif($flagCreate==2)
        {
            echo    '<br>
            <br>
            <div class="alert alert-danger">
                No fue posible crear el usuario 
            </div>';

        }
        echo '<form class="form" action="'.$url.'./" method="POST">
            <br>
            <br>
            <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-1">
			<label>Menú padre</label>
            </div>
            <div class="col-md-6">
			<select class="form-control" name="parentId">
                <option value="">Seleccione una opción</option>';
        
            foreach($menus as $DM){
               echo '<option value="'. $DM["id"].'">'.$DM["nameM"].'</option>';
            }
        echo '
            </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-1">
			<label>Nombre</label>
            </div>
            <div class="col-md-6">
            <input type="hidden" value="crearmenu" name="action">
			<input class="form-control" type="text" name="nameMenu" maxlength="50" required />
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-1">
			<label>Descripción</label>
            </div>
            <div class="col-md-6">
			<textarea class="form-control" type="text" name="descriptionMenu" maxlength="250" required></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		    <a class="btn btn-outline-danger" href="?action=home">Regresar</a>
            </div>
        </div>
	</form>';
          
        
        MenuView::footer();
    }

    public function editar($dataMenu,$padres,$url,$id,$flagupdate): void
    {
        MenuView::header(); 
        if($flagupdate==1)
        {
            echo    '<br>
                    <br>
                    <div class="alert alert-success">
                        Operación exitosa 
                    </div>';
        }   
        elseif($flagupdate==2)
        {
            echo    '<br>
            <br>
            <div class="alert alert-danger">
                No fue posible actualizar el usuario 
            </div>';

        }
        if(sizeof(value: $dataMenu)>0)
        {
            echo 
            '<form class="form" action="'.$url.'./" method="POST">
                <br>
                <br>
                <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                <label>Menú padre</label>
                </div>
                <div class="col-md-6">
                    <select class="form-control" name="parentId">
                        <option value="'.$dataMenu["idParentM"].'|'.$dataMenu["nameParent"].'">'.$dataMenu["nameParent"].'</option>';
                        for($i=0;$i<sizeof($padres);$i++)
                        {
                            echo '<option value="'.$padres[$i]["id"].'|'.$padres[$i]["nameM"].'">'.$padres[$i]["nameM"].'</option>';
                        }
            echo '
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                <label>Nombre</label>
                </div>
                <div class="col-md-6">
                <input type="hidden" value="editar" name="action">
                <input type="hidden" name="id" value="'.$id.'" />
                <input class="form-control" type="text" value="'.$dataMenu['nameM'].'" name="nameMenu" maxlength="50" required />
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                <label>Descripción</label>
                </div>
                <div class="col-md-6">
                <textarea class="form-control" type="text" name="descriptionMenu" maxlength="250" required>'.$dataMenu['DescriptionM'].'</textarea>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
            <input type="submit" value="Guardar" class="btn btn-primary"/>
                <a class="btn btn-outline-danger" href="?action=home">Regresar</a>
                </div>
            </div>
            </form>';
        }
        else
        {
            echo '<div class="alert alert-info">
                        Id no encontrado regrese e intente nuevamente 
                    </div>';
        }
          
        
        MenuView::footer();
    }

    public function eliminar($dataMenu,$url,$id,$flagupdate): void
    {
        MenuView::header(); 
        if($flagupdate==1)
        {
            echo    '<br>
                    <br>
                    <div class="alert alert-success">
                        Operación exitosa 
                    </div>';
                    die(header("refresh: 2; ./"));
        }   
        elseif($flagupdate==2)
        {
            echo    '<br>
            <br>
            <div class="alert alert-danger">
                	No es posible eliminar este menú, ya que tiene submenus, elimine estos submenus o asignelos a otro menú,
            y posteriormente intentelo nuevamente.
		
            </div>';
            die(header("refresh: 6; ./"));

        }
        if(sizeof(value: $dataMenu)>0)
        {
            echo 
            '<form class="form" action="'.$url.'./" method="POST">
                <input type="hidden" value="eliminarMenu" name="action">
                
                <input type="hidden" name="id" value="'.$id.'" />
                <br>
                <div class="alert alert-warning">
			        <b>¿Confirmas que desea eliminar este menú?:</b>
			        <i>'.$dataMenu["nameM"].'</i>
		        </div>
                <br>
                <input type="submit" value="Eliminar" class="btn btn-primary"/>
		        <a class="btn btn-outline-danger" href="?action=home">Regresar</a>
            </form>';
        }
        else
        {
            echo '<div class="alert alert-info">
                        Id no encontrado regrese e intente nuevamente 
                    </div>';
        }
          
        
        MenuView::footer();
    }

    public function detalle($dataMenu,$parents): void
    {
        MenuView::header(); 
        MenuView::headerdetalle();
        $model= new MenuModel();
        
        if(sizeof(value: $parents)>0)
        {
            echo '<nav id="menu"><ul>';
                    foreach($parents as $p)
                    {
                        echo '<li><a href="#">'.$p["nameParent"];
                            $submenus=$model->getHijosById(id: $p["idParentM"]);    
                            if(sizeof($submenus)>0)
                            {
                                echo '<ul>';
                                foreach($submenus as $s)
                                {
                                    echo '<li><a href="#">'.$s["nameM"].'</a></li>';
                                }
                                echo '</ul>';
                            }
                        echo '</a></li>';
                    }
            echo '</ul></nav>';

        }

        echo '<br><br><br>';
	    echo '<h2>'.$dataMenu['DescriptionM'].'</h2>';
        echo '<br><br>';
        echo '<a class="btn btn-outline-danger" href="?action=home">Regresar</a>';       
   
        MenuView::footer();
    }

}