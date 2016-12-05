<?php

class Agenda
{
	private $conn;

	public function __construct()
	{
		$this->conn = new mysqli(SERVER,USER,PW,DB);
	}

	public function listar($id_usuario,$inicio = 0,$limite = 5)
	{
		$consulta = "SELECT * FROM tb_usuario_tarea WHERE id_usuario=$id_usuario AND mareli=1 order by id_usuario_tarea DESC Limit $inicio,$limite";
		if($result = $this->conn->query($consulta))
		{
			if($result->num_rows > 0)
			{
				$arr = array();
				while ($row = $result->fetch_assoc()) {
					array_push($arr, $row);
				}
				return $arr;
			}
		}

		return false;
	}

	public function unique_email($email)
	{
		$consulta = "SELECT email FROM tb_usuarios WHERE email='$email'";
		if($result = $this->conn->query($consulta))
		{
			if($result->num_rows > 0)
			{
				return true;
			}
		}

		return false;
	}

	public function registro($arr = array())
	{
		$consulta = "INSERT INTO tb_usuarios(nombre,apellidos,email,pw,sexo,fecha_nac,tipo,activo) VALUES 
		(
			'".$arr["nombre"]."',
			'".$arr["apellidos"]."',
			'".$arr["email"]."',
			'".$arr["password"]."',
			'".$arr["sexo"]."',
			'".$arr["fecha_nac"]."',
			'1',
			'1'
		)";
		//echo $consulta;
		if($this->conn->query($consulta))
		{
			if($this->conn->affected_rows > 0)
			{
				return true;
			}
		}

		return false;
	}

	public function agregaTarea($arr)
	{
		$consulta = "INSERT INTO tb_usuario_tarea (id_usuario,tarea,descripcion,estado,mareli) VALUES (
			'".$arr["id_usuario"]."',
			'".$arr["tarea"]."',
			'".$arr["descripcion"]."',
			'iniciada',
			'1'
		)";
		//echo $consulta;
		if($this->conn->query($consulta))
		{
			if($this->conn->affected_rows > 0)
			{
				return true;
			}
		}

		return false;
	}

	public function editarTarea()
	{
		$consulta = "UPDATE tb_usuario_tarea SET tarea=,descripcion=,estado
		WHERE id_usuario_tarea=''";
		if($this->conn->query($consulta))
		{
			if($this->affected_rows > 0)
			{
				return true;
			}
		}

		return false;
	}

	public function eliminarTarea($id)
	{
		$consulta = "UPDATE tb_usuario_tarea SET mareli=0 WHERE id_usuario_tarea='$id'";
		if($this->conn->query($consulta))
		{
			if($this->conn->affected_rows > 0)
			{
				return true;
			}
		}

		return false;
	}

	public function terminarTarea($id)
	{
		$consulta = "UPDATE tb_usuario_tarea SET estado='terminado' WHERE id_usuario_tarea='$id'";
		if($this->conn->query($consulta))
		{
			if($this->conn->affected_rows > 0)
			{
				return true;
			}
		}

		return false;
	}

	public function dejarPendienteTarea($id)
	{
		$consulta = "UPDATE tb_usuario_tarea SET estado='pendiente' WHERE id_usuario_tarea='$id'";
		if($this->conn->query($consulta))
		{
			if($this->conn->affected_rows > 0)
			{
				return true;
			}
		}

		return false;
	}

	public function cargarTarea($id)
	{
		$consulta = "SELECT * FROM tb_usuario_tarea WHERE id_usuario_tarea='$id'";
		if($results = $this->conn->query($consulta))
		{
			if($results->num_rows > 0)
			{
				return $results->fetch_array();
			}
		}

		return false;	
	}

	public function modificarTarea($arr = array())
	{
		$consulta = "UPDATE tb_usuario_tarea SET 
		tarea='".$arr["tarea"]."',
		descripcion='".$arr["descripcion"]."',
		estado='".$arr["estado"]."'
		 WHERE id_usuario_tarea='".$arr["id"]."'";
		if($this->conn->query($consulta))
		{
			if($this->conn->affected_rows > 0)
			{
				return true;
			}
		}

		return false;
	}


	//login
	public function login($arr = array())
	{
		$consulta = "SELECT * FROM tb_usuarios WHERE email='".$arr["email"]."' AND pw='".$arr["pw"]."'";
		if($results = $this->conn->query($consulta))
		{
			if($results->num_rows > 0)
			{
				return $results->fetch_array();
			}
		}

		return false;
	}

	public function listarTareas($id)
	{
		$consulta = "SELECT * FROM tb_usuario_tarea WHERE id_usuario='".$id."' AND mareli=1";
		//echo $consulta;
		if($results = $this->conn->query($consulta))
		{
			if($results->num_rows > 0)
			{
				$tareas = array();
				while ($row = $results->fetch_array(MYSQLI_ASSOC)) {
					array_push($tareas, $row);
				}
				return $tareas;
			}
		}

		return false;
	}

}

?>