<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Agenda</title>
	<meta name="viewport"  content="width=device-width,initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL;?>css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL;?>css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?=BASE_URL;?>css/agenda.css" />
</head>
<body>
<div class="container-fluid">
	<header>
		<img src="<?=BASE_URL;?>img/agenda.png" class="img-header" />
		<h3>registrate es gratis</h3>
	</header>
	<nav>
		<ul>
			<li><a href="<?=BASE_URL;?>">index</a></li>
			<li><a href="<?=BASE_URL;?>agenda/registro">registrarse</a></li>
			<?php if(isset($_SESSION["id_usuario"])){?>
			<li><a href="<?=BASE_URL;?>agenda/usuario">Bienvenido(a): <?=$_SESSION["usuario"]?><span class="caret"></span></a> 
				<ul class="sub-menu">
					<li>
						<a href="#"><img style="width:100%;" src="<?=BASE_URL;?>img/<?=Helper::silueta();?>" /></a> 
					</li>
					<li>
						<a href="<?=BASE_URL;?>agenda/logout">Cerrar Sesión</a> 
					</li>
				</ul>
			</li>
			<?php }?>
		</ul>
	</nav>
	<section id="contenido">
