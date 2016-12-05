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

	public static function silueta()
	{
		$ruta = "";
		if(isset($_SESSION["sexo"]))
		{
			if($_SESSION["sexo"] == "H")
			{
				$ruta = "silueta-h.jpg";
			}
			else
			{
				$ruta = "silueta-m.jpg";
			}
		}
		return $ruta;
	}

	public static function pagination($arr = array())
	{
		$url = BASE_URL."agenda/usuario";
		$tamaño_pagina = 5;
		$pagina = (isset($_GET["p"]))?$_GET["p"]:null;
		if(!$pagina)
		{
			$inicio = 0;
			$pagina = 1;
		}
		else
		{
			$inicio = ($pagina-1)*$tamaño_pagina;
		}
		$total = count($arr);
		//print_r($arr);
		//echo $total;
		$total_paginas = ceil($total/$tamaño_pagina);


		if ($total_paginas > 1) 
		{
			echo '<ul class="pagination">';
   			if ($pagina != 1)
      			echo '<li><a href="'.$url.'&p='.($pagina-1).'" onclick="pagina('.($pagina-1).')">&laquo;</a></li>';
      		for ($i=1;$i<=$total_paginas;$i++) 
      		{
         		if ($pagina == $i)
            	//si muestro el índice de la página actual, no coloco enlace
            	echo "<li class='active'><a href='$url&p=".$pagina."' onclick='pagina(".$pagina.")' >".$pagina."</a></li>";
         		else
            	//si el índice no corresponde con la página mostrada actualmente,
            	//coloco el enlace para ir a esa página
            	echo '<li><a href="'.$url.'&p='.$i.'" onclick="pagina('.$i.')">'.$i.'</a></li>';
      		}
      		if ($pagina != $total_paginas)
         		echo '<li><a href="'.$url.'&p='.($pagina+1).'" onclick="pagina('.($pagina+1).')">&raquo;</a><li></ul>';
		}
	}

}

?>