		<div class="form">
			<h3>Registrate</h3>
			<form action="<?=BASE_URL;?>agenda/registrar" method="post">
				<input type="hidden" name="_token" value="<?=Session::generaToken();?>">
				<label for="">Nombre:</label>
				<input class="form-control" id="nombre" name="txt_nombre" type="text">
				<div id="error-nombre" class="alert alert-danger"></div>
				<br>
				<label for="">Apellidos:</label>
				<input class="form-control" name="txt_apellidos" type="text">
				<br>
				<label for="">E-Mail:</label>
				<input class="form-control" name="txt_email" type="text">
				<br>
				<label for="">Password:</label>
				<input class="form-control" name="txt_pw" type="password">
				<br>
				<label for="">Repite password:</label>
				<input class="form-control" name="txt_repite_pw" type="password">
				<br>
				<label for="">Sexo:</label><br />
				<select name="slp_sexo" class="form-control">
					<option value="">Selecciona una opción</option>
					<option value="H">Hombre</option>
					<option value="M">Mujer</option>
				</select>
				<br><br />
				<label for="">Fecha Nacimiento:</label>
				<input class="form-control" type="date" name="fecha_nac" value="01-01-1940" />
				<br>
				<input type="submit" class="btn btn-primary" value="Registrarse" onclick="validaFormRegistro();">
			</form>
		</div>
	</section>
	<script>

	function validaFormRegistro()
	{
		event.preventDefault();
		var nombre = document.getElementById("nombre").value;
		if(nombre == "")
		{
			document.getElementById("error-nombre").innerHTML="El campo nombre es requerido";
		}
		//alert(nombre);
		$("#nombre").val();
	}

	</script>
	