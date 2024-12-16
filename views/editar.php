<?php
include 'header.php';
?>
<div class="row">
	<?php
	if(isset($_GET["response"]) and $_GET["response"] === true){
		?>
		<div class="alert alert-success">
			Actualización exitosa
		</div>
		<?php
	}
	?>
    <form class="form" action="editarMenu" method="POST">
        <input type="hidden" name="id" value="<?php echo $dataMenu['id']; ?>" />
		
        <br>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-1">
			<label>Menú padre</label>
            </div>
            <div class="col-md-6">
			<select class="form-control" name="parentId">
                <option value="<?php echo $dataMenu["idParentM"].'|'.$dataMenu["nameParent"];?>"><?php echo $dataMenu["nameParent"];?></option>
                <?php for($i=0;$i<sizeof($listamenus);$i++){?>
                <option value="<?php echo $$listamenus[$i]["id"].'|'.$listamenus[$i]["nameM"];?>"><?php echo $listamenus[$i]["nameM"];?></option> 
                <?php } ?>
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
			<input class="form-control" type="text" name="nameMenu" maxlength="50" required value="<?php echo $dataMenu["nameM"]; ?>"/>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-1">
			<label>Descripción</label>
            </div>
            <div class="col-md-6">
			<textarea class="form-control" type="text" name="descriptionMenu" maxlength="250" required><?php echo $dataMenu["DescriptionM"]; ?></textarea>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3">
		<input type="submit" value="Guardar" class="btn btn-primary"/>
		<a class="btn btn-outline-danger" href="home">Regresar</a>
            </div>
        </div>
	</form>
</div>