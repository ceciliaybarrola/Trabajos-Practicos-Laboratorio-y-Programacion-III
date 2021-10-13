<?php

session_start();
if(!isset($_SESSION["DNIEmpleado"]))
	header("Location: login.html");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../javascript/funciones_ajax.js" ></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Document</title>
</head>
<body>
	<div align="center">
		<h1>Cecilia Ybarrola</h1>
		<hr>
	</div>
	<div align="left" class="container" id="divAlta" style="float: left;width: 40%; height:600px; overflow:auto;">		
		<?php
			include "alta_DB.php";
		?>
    </div>
    <div align="left" class="container" id="divMostrar" style="float: right;height:600px; width: 60%; overflow:auto;">  
		<?php
			include "mostrar_DB.php";
		?>
    </div>
	<div style=" width: 100%;text-align:left;padding-right: 50px;">
		<a href="cerrarSesion.php">Cerrar sesion.</a><br>
		<a href="index_BD.php">Alta Empleados</a>
	</div>
</body>
</html>