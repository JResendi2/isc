<!--Este archivo solo contiene un formulario con los campos necesario para agregar un nuevo registro en
    la tabla "contenidos" -->

	<?php
	
	session_start();
	
	$id = $_SESSION['id']; /* Recupera el "usuario" que inicio sesion.
								  'user' es una variable almacenada en el servidor. */
?>
 <?php 
 	$id = $_GET['id'];
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ISC oficial</title>
		<link rel="stylesheet" type="text/css" href="../../0_diseno/css/estilos.css">
	</head>
	
	<body>
		<header>
			<img src="../../0_diseno/img/logo1.png" height="55" style="margin-right: 150px; float: left;">
			<img src="../../0_diseno/img/logo2.png" height="55">
		</header>

		<nav class="navegacion">
		<a class="navegacion-home" href="../../inicio_de_docentes.php">
			<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
				<path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
			</svg>
			Inicio
		</a>

		<h3>Nuevo tema para la materia</h3>
		<a class="navegacion-exit" href="../../logout.php">
			Cerrar sesion
		</a>
	</nav>

		<section>

			<form  enctype="multipart/form-data" action = "2_nuevo_insert.php" method="post">
			<div style="padding: 0 10px;">

			<table class="table-new">
					<tr>
						<td class="field">Titulo:</td>
						<td><input type = text name = "titulo" id="titulo" size = 40 required></td>
					</tr>
					<tr>
						<td class="field">Link:</td>
						<td><input type = text name = "link" id="link" size = 40 required></td>
					</tr>
					<tr>
						<td class="field">Descripcion:</td>
						<td><textarea rows="5" name = "descripcion" id="descripcion" required> </textarea></td>
					</tr>
					<tr>
						<td class="field">Archivos:</td>
						<td><input type = file name = "txtFile[]" id="txtFile" multiple></td>
					</tr>
				</table> <br><br>
			</div>

				<?php 
				 echo "
				 <input type=hidden name=id value = '$id'>";
 			
 				?>


				<div class="div-btn-new">
					<input class="btn-new" type = reset value = "Limpiar campos">
					<input class="btn-new" type="submit" value="Guardar" />
          		</div>
				<br><br><br>	
			</form>	
		</section>
	</body>
</html>