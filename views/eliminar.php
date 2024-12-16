<?php
include 'header.php';
?>
<div class="row">
	<?php
	if(isset($_GET["response"]))
    {
        if($_GET["response"]=='00'){

        ?>
		<div class="alert alert-success">
			Eliminación exitosa
		</div>
        
		<?php
        die(header("refresh: 2; home"));
        }
        else{
        ?>
        <div class="alert alert-danger">
			No es posible eliminar este menú, ya que tiene submenus, elimine estos submenus o asignelos a otro menú,
            y posteriormente intentelo nuevamente.
		</div>
        <?php
        die(header("refresh: 6; url=home"));
        }
        ?>

    <?php
	}
	?>
    <?php if(sizeof($dataMenu)>0){
    ?>
    <form class="form" action="eliminarMenu" method="POST">
        <input type="hidden" name="idM" value="<?php echo $idM; ?>" />
		
        <br>
        <div class="alert alert-warning">
			<b>¿Confirmas que desea eliminar este menú?:</b>
			<i><?php echo $dataMenu["nameM"]; ?></i>
		</div>
        <br>
        <input type="submit" value="Eliminar" class="btn btn-primary"/>
		<a class="btn btn-outline-danger" href="home">Regresar</a>
            </div>
        </div>
	</form>
    <?php } else
    {
        ?>

    <div class="alert alert-danger">
			Id no reconocido
		</div>
        <?php
        die(header("refresh: 6; url=home"));
    }?>
</div>