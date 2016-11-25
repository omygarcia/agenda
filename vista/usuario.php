<?php 
$token = Session::generaToken();
if($_SESSION["tipo"]>1){?>
<h3>Agregar Tareas</h3>
<form action="<?=BASE_URL;?>agenda/agregar" method="post">
	<input type="hidden" name="_token" value="<?=$token;?>">
	<label>tarea</label>
	<input type="text" name="txt_tarea" class="form-control" />
	<label>Descripción</label>
	<textarea name="txt_descripcion" class="form-control"></textarea>
	<input type="submit" value="Agregar" class="btn btn-warning" onclick="registrarTarea();" />
</form>
<?php }?>
<h3>Lista de tareas</h3>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Tarea</h4>
        </div>
        <div class="modal-body">
          	<form action="<?=BASE_URL;?>agenda/modificarTarea" method="post"> 
          		<input type="hidden" name="txt_id_tarea_modal" />
          		<input type="hidden" name="_token" value="<?=$token;?>" />
          		<input type="hidden" name="_method" value="PUT" />
          		<label>Tarea:</label><br>
          		<input type="text" name="txt_tarea_modal" class="form-control" />
          		<label>Descripción:</label><br>
          		<textarea name="txt_descripcion_modal" class="form-control"></textarea>
          		<label>Estado:</label>
          		<select name="slp_estado_modal" id="slp_estado_modal" class="form-control"> 
          			<option value="iniciada">Iniciada</option>
          			<option value="pendiente">Pendiente</option>
          			<option value="finalizada">Finalizada</option>
          		</select>
        </div>
        <div class="modal-footer">
        		<input type="submit" class="btn btn-primary" value="actualizar" onclick="actualizarTarea();" />
          	</form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <!-- fin modal -->

<table class="table">
	<thead> 
		<tr> 
			<th>id</th>
			<th>tarea</th>
			<th>descripcion</th>
			<th>estado</th>
			<th>Operaciones</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($tareas as $tarea){ ?>
		<tr> 
			<td><?=$tarea["id_usuario_tarea"];?></td>
			<td><?=$tarea["tarea"];?></td>
			<td><?=$tarea["descripcion"];?></td>
			<td><?=$tarea["estado"];?></td>
			<td>
				<?php if($_SESSION["tipo"] > 1){?> 
				<form action="<?=BASE_URL;?>agenda/editar" method="post">
				<input type="hidden" name="_token" value="<?=$token;?>" />
				<input type="hidden" name="id_tarea" value="<?=$tarea["id_usuario_tarea"];?>" />
				<input type="submit" value="Editar" class="btn btn-primary btn-block" onclick="cargarTarea(<?=$tarea["id_usuario_tarea"];?>);" />
				</form>
				<?php }?>
				<?php if($_SESSION["tipo"] == 3){?>
				<form action="<?=BASE_URL;?>agenda/eliminar_tarea" method="post">
				<input type="hidden" name="_token" value="<?=$token;?>" />
				<input type="hidden" name="_method" value="DELETE" />
				<input type="hidden" name="id_tarea" value="<?=$tarea["id_usuario_tarea"];?>" />
				<input type="submit" value="Eliminar" class="btn btn-danger btn-block" onclick="eliminarTarea(<?=$tarea["id_usuario_tarea"];?>);" />
				</form>
				<!-- dejar como pendiente -->
				<form action="<?=BASE_URL;?>agenda/pendiente" method="post">
				<input type="hidden" name="_token" value="<?=$token;?>" />
				<input type="hidden" name="_method" value="PUT" />
				<input type="hidden" name="id_tarea" value="<?=$tarea["id_usuario_tarea"];?>" />
				<input type="submit" value="pendiente" class="btn btn-success btn-block" />
				</form>
				<!-- terminar tarea -->
				<form action="<?=BASE_URL;?>agenda/terminar_tarea" method="post">
				<input type="hidden" name="_token" value="<?=$token;?>" />
				<input type="hidden" name="_method" value="PUT" />
				<input type="hidden" name="id_tarea" value="<?=$tarea["id_usuario_tarea"];?>" />
				<input type="submit" value="terminar" class="btn btn-info btn-block" />
				</form>
				<?php }?>
			</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>


	
	