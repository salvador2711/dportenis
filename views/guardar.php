<?php
include 'header.php';
?>
<div class="row">
	<?php
	if(isset($_GET["response"]) and $_GET["response"] === true){
		?>
        <br>
        <br>
		<div class="alert alert-success">
			Operación exitosa 
		</div>
		<?php
	}
	?>
	<form class="form" action="guardarMenu" method="POST">
		<br>
        <br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-1">
			<label>Menú padre</label>
            </div>
            <div class="col-md-6">
			<select class="form-control" name="parentId">
                <option value="">Seleccione una opción</option>
                <?php foreach($listamenus as $DM){?>
                <option value="<?php echo $DM["id"];?>"><?php echo $DM["nameM"];?></option> 
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
		    <a class="btn btn-outline-danger" href="home">Regresar</a>
            </div>
        </div>
	</form>
</div>