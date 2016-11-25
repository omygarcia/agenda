<?php

class Helper
{
	public static function getCaptcha($aleatorio)
	{
		//Crea una imagen
		$imagen = imagecreate(120, 35);
		//Color de la imagen
		$color = imagecolorallocate($imagen, 119,217,0);
		$colorText = imagecolorallocate($imagen, 255, 255, 255);
		//rellenar la imagen
		imagefill($imagen,50, 0,$color);
		//imprimir text en la imagen
		imagestring($imagen, 80, 30, 10, $aleatorio, $colorText);
		//imprimir imagen
		header("Content-type:image/png");
		imagepng($imagen);
	}

	public static function randomText($length) 
	{ 
		$key = "";
    	$pattern = array("1","2","3","4","5","6","7","8","9","0",
    	"a","b","c","d","e","f","g","h","i","j","k","L","m",
    	"n","o","p","q","r","s","t","u","v","w","x","y","z"); 
    	for($i = 0; $i < $length; $i++) 
    	{ 
    		$key .= $pattern[rand(0, 35)].""; 
    	}
    	return $key;
	}

}

?>