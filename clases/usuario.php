<?php

class Usuario
{
	private $conn;

	public function __construct()
	{
		$this->conn = new mysqli("127.0.0.1","root","","agenda");
	}

	public function registro($user = array())
	{
		$consulta = "INSERT INTO tb_usuario(nombre,apellidos,email,pw,sexo,fecha_nac,tipo,activo) VALUES ()";
		if($this->conn->query($consulta))
		{
			if($this->conn->affected_rows > 0)
			{
				return $this->conn->insert_id;
			}
		}

		return false;
	}
}

?>