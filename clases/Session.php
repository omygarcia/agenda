<?php

class Session
{
	static $inactivo = 30;

	public static function generaToken()
	{
		$_SESSION["token"] = Helper::randomText(32);
		return $_SESSION["token"];
	}

	public static function getToken()
	{
		return $_SESSION["token"];
	}

	public static function flash($clave,$valor)
	{
		$_SESSION["time"] = (time()+Session::$inactivo);
		$_SESSION["flash"][$clave] = $valor;
	}

	public static function put($clave,$valor)
	{
		$_SESSION[$clave] = $valor;
	}

	public static function has($clave)
	{
		if(isset($_SESSION[$clave]) || isset($_SESSION["flash"][$clave]))
			return true;
		else
			return false;
	}

	public static function get($clave)
	{
		if(isset($_SESSION[$clave]))
		{
			return $_SESSION[$clave];
		}
		$flash = $_SESSION["flash"][$clave];
		//removemos la session cuando espire
		if($_SESSION["time"] < time())
			unset($_SESSION["flash"][$clave]);
		return $flash;
	}
}

?>