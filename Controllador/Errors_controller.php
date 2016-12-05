<?php

class Errors_controller
{
	public function noFound()
	{
		include "vista/errors/noFound.php";
	}

	public function noAutorizado()
	{
		include "vista/errors/noAutorizado.php";
	}

	public function token()
	{
		include "vista/errors/token.php";
	}

	public function metodo()
	{
		include "vista/errors/metodo.php";
	}
}


?>