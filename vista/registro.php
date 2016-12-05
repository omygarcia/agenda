<div id="success-add-user" class="alert alert-success hide">
	<!--<a href="#" class="close" data-dismiss="alert">&times;</a>-->
	<div id="mensaje-success"></div>
</div>
<div id="error-add-user" class="alert alert-danger hide">
	<!--<a href="#" class="close" data-dismiss="alert">&times;</a>-->
	<div id="mensaje-error"></div>
</div>
		<div class="form">
			<h3>Registrate</h3>
			<form id="form-registro-usuario" action="<?=BASE_URL;?>agenda/registrar" method="post">
				<input type="hidden" name="_token" value="<?=Session::generaToken();?>">
				<label for="">Nombre:</label>
				<input class="form-control" id="nombre" name="txt_nombre" type="text">
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
				<label>Introduce el codigo:</label><br />
				<img src="<?=BASE_URL;?>agenda/captcha" />
				<input type="text" id="captcha" name="txt_captcha" class="form-control" />
				<br />
				<input type="submit" class="btn btn-primary" value="Registrarse" onclick="registroUsuario();">
			</form>
		</div>
	</section>
	