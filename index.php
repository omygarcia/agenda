<?php 
session_start();
require_once "config.php";
require_once "clases/helper.php";
require_once "clases/Session.php";
if(!isset($_GET['controller']))
	$controller = "agenda";
else
	$controller = $_GET['controller'];
//setteamos la accion
if(isset($_GET["action"]))
	$action = $_GET["action"];
else
	$action = "index";
if(file_exists("controllador/".$controller."_controller.php"))
{
	require_once("controllador/".$controller."_controller.php");
	switch ($controller) {
		case 'agenda':
			$vista = new Agenda_controller();
			if($action == "index")
				$vista->index();
			else if($action == "registro")
				$vista->registro();
			else if($action == "registrar")
				$vista->registrar();
			else if($action == "login")
				$vista->login();
			else if($action == "usuario")
				$vista->usuario();
			else if($action == "logout")
				$vista->logout();
			else if($action == "agregar")
				$vista->agregar();
			else if($action == "eliminar_tarea")
			{
				$vista->eliminar_tarea();
			}
			else if($action == "terminar_tarea")
			{
				$vista->terminar_tarea();
			}
			else if($action == "pendiente")
			{
				$vista->pendiente();
			}
			else if($action == "editar")
			{
				$vista->cargarTarea();
			}
			else if($action == "modificarTarea")
			{
				$vista->modificarTarea();
			}
			else if($action=="imagen")
			{
				$vista->imagen();
			}
			else if($action=="estilos")
			{
				$vista->estilos();
			}
			break;
		default:
			//
			break;
		}
	}

?>