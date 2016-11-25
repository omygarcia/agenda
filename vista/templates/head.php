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
	<header>
		<img src="<?=BASE_URL;?>agenda/imagen" class="img-header" />
		<h3>registrate es gratis</h3>
	</header>
	<nav>
		<ul>
			<li><a href="<?=BASE_URL;?>">index</a></li>
			<li><a href="<?=BASE_URL;?>agenda/registro">registrarse</a></li>
			<?php if(isset($_SESSION["id_usuario"])){?>
			<li><a href="<?=BASE_URL;?>agenda/logout">Cerrar Sesion</a></li>
			<?php }?>
		</ul>
	</nav>
	<section id="contenido">
