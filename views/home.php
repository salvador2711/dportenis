<?php 
include 'header.php';
?>	
        <br>
        <br>
		    <a href="crearMenu" class="btn btn-outline-primary">Crear Menu</a>
		<br>
		<br>
        <?php
		if(sizeof($listamenu)>0){ ?>
			<table class="table table-striped" >
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Menu Padre</th>
					<th>Descripción</th>
                    <th>Acciones</th>
				
                </thead>
				<tbody>
				<?php 
		        for($i=0;$i<sizeof($listamenu);$i++)
                {
			    ?>
					<tr>
						<td class="idMenu"> <?php echo $listamenu[$i]['id'];?>
						</td>
						<td>						
							<a href="#" onclick="detalle($(this).parents('tr').find('td.idMenu').html());"><?php echo $listamenu[$i]['nameM'];?></a>
						</td>
						<td>
						            	
						<?php echo $listamenu[$i]['nameParent'];?></td>
                        
                        <td><?php echo $listamenu[$i]['DescriptionM'];?></td>
                        <td>  
							<div class="row">
								<div class="col-md-3">
									<form action="editar" method="POST">
										<input type="hidden" name="idM" value="<?php echo $listamenu[$i]['id'];?>">
										<input type="submit" class="btn btn-primary" value="Editar">
									</form>
								</div>
								<div class="col-md-1"></div>
								<div class="col-md-3">						
									<form action="eliminar" method="POST">
										<input type="hidden" name="idM" value="<?php echo $listamenu[$i]['id'];?>">
										<input type="submit" class="btn btn-danger" value="Eliminar">
									</form>
								</div>
							</div>
							
						</td>
						
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
            <?php } else {?>
            <h2> No existe menú agregue al menos uno<h2>
            <?php  } ?>
        <br><br>
		<div style="display: none;">
            <form method="post" action="detalle" id="form1">
    	        <input type="hidden" name="idMenu" id="idMenu">           
            </form>
        <div>
		<script type='text/javascript'>

	function detalle(id)
	{
		var regex = /(\d+)/g;
		var arrres=id.match(regex)
		document.getElementById('idMenu').value=arrres[0];
		var formulario = document.getElementById("form1");
		formulario.submit();
        
	}


</script>
	<?php include 'footer.php'; ?>

 
