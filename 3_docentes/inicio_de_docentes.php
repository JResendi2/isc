<!--Este archivo muestra el menu de un usuario docente-->

<?php

session_start(); //Se inicia una sesion
if (!isset($_SESSION['user'])) { // Verifica si existe la variable 'user' en el servidor
	//Si no existe entonce regresa al login
	header("location: ../1_publico/1_paginas/index.php");

	exit;
}

$id = $_SESSION['id']; /* Recupera el "usuario" que inicio sesion.
								  'user' es una variable almacenada en el servidor. */
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ISC oficial</title>
	<link rel="stylesheet" type="text/css" href="0_diseno/css/estilos.css">
</head>
<script language=JavaScript>
	<!--
	function nueva() {
		var x;
		x = window.open("gestionar_sitios/1_tabla.php?id=<? $id; ?>", "Titulo", "toolbar=no,location=no,directories=no,status=no");
	}
	-->
</script>

<body>

	<header>
		<img src="0_diseno/img/logo1.png" height="55" style="margin-right: 150px; float: left;">
		<img src="0_diseno/img/logo2.png" height="55">

	</header>

	<nav class="navegacion">
		<a class="navegacion-home" href="#">
				<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
					<path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
				</svg>
				Inicio
		</a>

		<h3>Administración de docentes</h3>
		<a class="navegacion-exit" href="logout.php">
			Cerrar sesion
		</a>
	</nav>

	<section id="opciones">


		<div class="docentes-main">

			<div class="opcion">
				<a href="gestionar_contenidos/1_tabla.php">

				<div class="img">
					<img style="width: 75%;" src="0_diseno/img/school.png" alt="fs">
				</div>
				<p>
					Información de la carrera
				</p>
				</a>
			</div>

			<?php
			echo '
			<div class="opcion">
				<a href="3_modificar.php?id=' . $id . '">

				<div class="img">
					<img style="width: 75%;" src="0_diseno/img/person.png" alt="fs">
				</div>
				<p>
					Cuenta
				</p>
				</a>
			</div>
			'
			; ?>
			<?php
			echo '
			<div class="opcion">
				<a href="gestionar_materias/1_tabla.php?id=' . $id . '">

				<div class="img">
					<img style="width: 75%;" src="0_diseno/img/book.png" alt="fs">
				</div>
				<p>
					Sus Materias
				</p>
				</a>
			</div>
			'; ?>

			<?php
			echo '
			<div class="opcion">
				<a href="print.php">

				<div class="img">
					<img style="width: 75%;" src="0_diseno/img/print.png" alt="fs">
				</div>
				<p>
					Imprimir su información
				</p>
				</a>
			</div>
			' ?>

		</div>

		<?php




		echo '
		<div class="docentes-footer">
			<a  class="btn-reporte" href="exel.php?id=' . $id . '">
				Exportar información a Exel
			</a>
			<a class="btn-reporte"  href="csv.php?id=' . $id . '">
				Exportar información a CSV
			</a>
		</div>'
		; ?>


	</section>

	</div>

</body>

</html>