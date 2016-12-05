<?php
if(Session::has("mensaje"))
{
	printf("<div class='alert alert-danger'>".Session::get("mensaje")."<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
</div>");

}
?>
<form action="<?=BASE_URL;?>agenda/login" method="post">
	<label>E-Mail:</label>
	<input type="text" name="txt_email" placeholder="Introduce tu email" class="form-control" />
	<label>Password:</label>
	<input type="password" name="txt_password" placeholder="Introduce tu password" class="form-control" />
	<?php
		if(Session::has("intentos") && Session::get("intentos") > 2):
	?>
	<label>Demuestranos que no eres un robot:</label><br />
	<img src="<?=BASE_URL;?>agenda/captcha" />
	<input type="text" name="txt_captcha" placeholder="Introduce el codigo" class="form-control" />
	<br />
	<?php
		endif
	?>
	<input type="submit" value="ingresar" class="btn btn-warning" />
</form>