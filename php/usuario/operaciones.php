<?php
//API REST
switch ($_SERVER["HTTP_METHOD"]) {
	//mostrar los usuarios
	case 'GET':
		
		break;
	
	case "POST":
		if(!isset($_POST["_method"]))
		{
			//guardar los usuarios
			$arr = array(
					"nombre"=>$nombre,
					"apellidos"=>$apellidos,
					"email"=>$email,
					"password"=>$password,
					"sexo"=>$sexo,
					"fecha_nac"=>$fecha_nac
				);
		}
		else if ($_POST["_method"] == "PUT") 
		{
			//actualizar usuario
		}
		else if($_POST["_method"] == "DELETE")
		{
			//Eliminar usuario
		}
		break;
	
	default:
		echo "metodo no definido";
		break;
}



?>