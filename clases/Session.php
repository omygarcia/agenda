<?php

class Session
{

	public static function generaToken()
	{
		$_SESSION["token"] = Helper::randomText(32);
		return $_SESSION["token"];
	}

	public static function getToken()
	{
		return $_SESSION["token"];
	}
}

?>