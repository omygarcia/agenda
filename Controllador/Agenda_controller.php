<?php

class Agenda_controller
{
	public $metodo;
	public $agenda;

	public function __construct()
	{
		require_once "Modelo/agenda.php";
		//capturamos el metodo por que se nos envia la peticion
		$this->metodo = $_SERVER["REQUEST_METHOD"];
		if($this->metodo == "POST")
		{
			//como el metodo PUT y DELETE no existen lo guardamos en un input
			if(isset($_POST["_method"]))
			{
				$this->metodo = $_POST["_method"];
			}
		}

		//instanceamos la clase agenda
		//que es la que contiene todos los metodos para conexion a base de datos
		$this->agenda = new Agenda();
	}

	//mostramos la vista del login
	public function index()
	{
		include "vista/templates/head.php";
		include "vista/login.php";
		include "vista/templates/footer.php";
	}

	//muestra la vista registro
	public function registro()
	{
		include "vista/templates/head.php";
		include "vista/registro.php";
		include "vista/templates/footer.php";
	}

	//registra los datos del usuario
	public function registrar()
	{
		//verificamos que no nos manden peticiones desde un sitio que no sea el nuestro
		if($_POST["_token"] != Session::getToken())
		{
			if(!$this->_ajax())
				header("location:".BASE_URL."errors/token.php");
			else
			{
				header("HTTP/1.1 500 Internal Server");
				echo "Estas intentando acceder desde un sitio distinto";
				exit();
			}
		}
		else if($this->metodo != "POST")
		{
			//verificamos que nos enviaen una pericion con el metodo que solicitamos
			if(!$this->_ajax())
				header("location:".BASE_URL."errors/metodo.php");
			else
			{
				header("HTTP/1.1 500 Internal Server");
				echo "El metodo de peticion no es el correcto";
				exit();	
			}
		}
		$nombre = $_POST['txt_nombre'];
		$apellidos = $_POST['txt_apellidos'];
		$email = $_POST['txt_email'];
		$password = $_POST["txt_pw"];
		$repite_pw = $_POST["txt_repite_pw"];
		$sexo = $_POST['slp_sexo'];
		$fecha_nac = $_POST["fecha_nac"];
		$captcha = $_POST["txt_captcha"];

		$mensaje = "";
		$cabecera = 'HTTP/1.1 500 Internal Server';
		if($nombre == "")
		{
			$mensaje = "El campo nombre es obligatoro";
		}
		else if($apellidos == "")
		{
			$mensaje = "El campo apellido es obligatorio";
		}
		else if($email == "")
		{
			$mensaje = "El campo email es obligatorio";
		}
		else if(!preg_match('/^([A-Z0-9._%-]+)(\@)([A-Z0-9._%-]+)(\.)([A-Z0-9._%-]{2,4})$/i', $email))
		{
			$mensaje = "El campo email no tiene el formato correcto";
		}
		elseif ($this->agenda->unique_email($email)) 
		{
			$mensaje = "El correo ya se encuentra registrado";
		}
		else if($password == "")
		{
			$mensaje = "El campo password es obligatorio";
		}
		else if($repite_pw == "")
		{
			$mensaje = "El campo repite password es obligatorio";
		}
		else if($password != $repite_pw)
		{
			$mensaje = "El password no coincide";
		}
		else if(!isset($sexo) || $sexo == "")
		{
			$mensaje = "selecciona una opccion";
		}
		else if($sexo != "H" && $sexo != "M")
		{
			$mensaje = "Opción no valida";
		}
		else if($fecha_nac == "")
		{
			$mensaje = "El campo fecha es obligatorio";
		}
		else if ($captcha == "") 
		{
			$mensaje = "El campo captcha es obligatorio";
		}
		else if($captcha != Session::get("captcha"))
		{
			$mensaje = "El capcha no es correcto";
		}
		else
		{
			$arr = array(
					"nombre"=>$nombre,
					"apellidos"=>$apellidos,
					"email"=>$email,
					"password"=>sha1($password),
					"sexo"=>$sexo,
					"fecha_nac"=>$fecha_nac
				);

			if($this->agenda->registro($arr))
			{
				$mensaje = "Tu registro se realizo con exito!";
				$cabecera = "HTTP 200 OK";
			}
			else
			{
				$mensaje = "El usuario no se pudo registar";
			}
		}

		echo header($cabecera);
		echo $mensaje;
	}

	public function usuario()
	{
		//implementamos segurida para que solo el usuario logeado
		//pueda acceder a esta pagina
		if(!isset($_SESSION["usuario"]))
		{
			header("location:".BASE_URL);
		}
		$p = 0;
		if(isset($_GET['p']))
		{
			$p = $_GET['p'];
			$p = ($p*5)-1;
		}

		$tareas = $this->agenda->listar($_SESSION["id_usuario"],$p,5);
		$paginacion = $this->agenda->listarTareas($_SESSION["id_usuario"]);
		include "vista/templates/head.php";
		include "vista/usuario.php";
		include "vista/templates/footer.php";
	}

	public function listar()
	{
		if(isset($_SESSION["id_usuario"]))
		{
			$p = 1;
			if(isset($_GET["p"]))
			{
				$p = $_GET["p"];
			}
			$p = ($p*5);
			$lista = $this->agenda->listar($_SESSION["id_usuario"],$p,5);
			echo json_encode($lista);
		}
		else
		{
			echo json_encode("");
		}
	}


	public function agregar()
	{
		//protegemos el acceso para usuarios aparatir del nivel1, verificamos el token y que la petición sea por POST
		$this->_middleware(1,true,"POST");

		$tarea = strip_tags($_POST['txt_tarea']);
		$descripcion = strip_tags($_POST["txt_descripcion"]);
		$mensaje = "";
		$cabecera = 'HTTP/1.1 500 Internal Server';
		if($tarea == "")
		{
			$mensaje = "El campo tarea es obligatorio";
		}
		else if (strlen($tarea)   < 3) 
		{
			$mensaje = "El campo tarea debe tener al menos 3 caracteres";
		}
		else if($descripcion == "")
		{
			$mensaje = "El campo descripción es obligatorio";	
		}
		else if (strlen($descripcion)   < 3) 
		{
			$mensaje = "El campo descripcion debe tener al menos 3 caracteres";
		}
		else
		{
			$arr = array(
				"id_usuario"=>$_SESSION["id_usuario"],
				"tarea"=>$tarea,
				"descripcion"=>$descripcion
				);
			if($this->agenda->agregaTarea($arr))
			{
				$cabecera = "HTTP: 200 OK";
				$mensaje ="la tarea se registro con exito!";
			}
			else
			{
				$mensaje = "No se pudo registrar la tarea";
			}
		}

		header($cabecera);
		echo $mensaje;

	}

	public function pendiente()
	{
		$this->_middleware(3,true,"PUT");
		
		$mensaje = "";
		$id = $_POST["id_tarea"];
		if($id != "" && is_numeric($id))
		{
			if($this->agenda->dejarPendienteTarea($_POST["id_tarea"]))
			{
				$mensaje = "la tarea queda pendiente";
			}
			else
			{
				$mensaje = "No se pudo modifica";
			}
		}

		echo $mensaje;
	}


	public function terminar_tarea()
	{
		$this->_middleware(3,true,"PUT");
		
		$mensaje = "";
		$id = $_POST["id_tarea"];
		if($id != "" && is_numeric($id))
		{
			if($this->agenda->terminarTarea($_POST["id_tarea"]))
			{
				$mensaje = "la tarea a terminado";
			}
			else
			{
				$mensaje = "No se pudo terminar la tarea";
			}
		}

		echo $mensaje;
	}


	public function eliminar_tarea()
	{
		$this->_middleware(3,true,"DELETE");
		$mensaje = "";
		$id = $_POST["id_tarea"];
		if($id != "" && is_numeric($id))
		{
			if($this->agenda->eliminarTarea($_POST["id_tarea"]))
			{
				$mensaje = "la tarea se elimino con exito!";
			}
			else
			{
				$mensaje = "No se pudo eliminar la tarea";
			}
		}

		echo $mensaje;
	}


	public function cargarTarea()
	{
		$id = $_POST['id_tarea'];
		if(isset($id) && is_numeric($id))
		{
			$tarea = $this->agenda->cargarTarea($id);
			echo json_encode($tarea);
		}

	}

	public function modificarTarea()
	{
		$this->_middleware(3,true,"PUT");

		$id = $_POST["txt_id_tarea_modal"];
		$tarea = strip_tags($_POST["txt_tarea_modal"]);
		$descripcion = strip_tags($_POST["txt_descripcion_modal"]);
		$estado = strip_tags($_POST["slp_estado_modal"]);
		$mensaje = "";

		if(!isset($id) && !is_numeric($id)) 
		{
			$mensaje = "el id no tiene formato correcto";
		}
		else
		{
			$arr = array(
				"id"=>$id,
				"tarea"=>$tarea,
				"descripcion"=>$descripcion,
				"estado"=>$estado
				);
			if($this->agenda->modificarTarea($arr))
			{
				$mensaje = "La tarea se modifico con exito";
			}
		}

		echo $mensaje;
	}


	public function login()
	{
		$email = addslashes($_POST["txt_email"]);
		$pw = sha1($_POST["txt_password"]);
		$arr = array(
			"email"=>$email,
			"pw"=>$pw
			);

		if(Session::has("intentos") && Session::get("intentos") > 2)
		{
			if($_POST["txt_captcha"] != Session::get("captcha"))
			{
				Session::flash("mensaje","El captcha es incorrecto");
				return header("location:".BASE_URL);
			}
		}

		if($row = $this->agenda->login($arr))
		{
			$_SESSION["id_usuario"] = $row["id_usuario"];
			$_SESSION["usuario"] = $row["nombre"];
			$_SESSION["sexo"] = $row["sexo"];
			$_SESSION["tipo"] = $row["tipo"];
			Session::put("intentos",0);
			header("location:".BASE_URL."agenda/usuario");
		}
		else
		{
			//verificamos los intentos para logearse
			if(Session::has("intentos"))
			{
				Session::put("intentos",Session::get("intentos")+1);
			}
			else
			{
				Session::put("intentos",1);
			}
			Session::flash("mensaje","La contraseña o el correo electronico no es correcto");
			header("location:".BASE_URL);
		}
		
	}

	public function logout()
	{
		unset($_SESSION["id_usuario"]);
		unset($_SESSION["usuario"]);
		unset($_SESSION["sexo"]);
		unset($_SESSION["tipo"]);
		header("location:".BASE_URL);
	}

	function captcha()
	{
		Session::put("captcha",Helper::randomText(4));
		Helper::getCaptcha(Session::get("captcha"));
	}


	public function imagen()
	{
		include "img/agenda.png";
	}

	public function estilos()
	{
		include "css/bootstrap.css";
	}

	public function _ajax()
	{
		if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    		//Es una petición AJAX
    		return true;
		}
		return false;
	}

	public function _middleware($tipo = 3,$token = true,$metodo = "POST")
	{
		//RESTRINGIMOS EL ACCESO A PERSONAS NO LOGEADAS
		//ADEMOS QUE SOLO PUEDE AGREGAR USUARIO DE TIPO MAYOR A 1
		if(!isset($_SESSION["usuario"]) || $_SESSION["tipo"] < $tipo)
		{	
			if(!$this->_ajax())
			{
				return header("location:".BASE_URL);
			}
			else
			{
				header('HTTP/1.1 500 Internal Server');
				echo "No tienes permisos apara acceder";
				exit();
			}
		}
		else if ($token == true) 
		{
			if(!isset($_POST["_token"]))
			{
				if(!$this->_ajax())
				{
					return header("location:".BASE_URL."errors/token");
				}
				else 
				{
					header('HTTP/1.1 500 Internal Server');
					echo "CROSS SITE REQUEST FALSE";
					exit();
				}
			}
			else if($_POST["_token"] != Session::getToken())
			{
				if(!$this->_ajax())
				{
					return header("location:".BASE_URL."errors/token");
				}
				else 
				{
					header('HTTP/1.1 500 Internal Server');
					echo "Token no valido";
					exit();
				}
			}
		}
		else if($this->metodo != $metodo)
		{
			//verificamos que nos envien una pericion con el metodo que solicitamos
			if(!$this->_ajax())
			{
				return header("location:".BASE_URL."errors/metodo");
			}
			else
			{
				header('HTTP/1.1 500 Internal Server');
				echo "el metodo de peticion no es valido";
				exit();
			}
		}

		return false;
	}


}
?>