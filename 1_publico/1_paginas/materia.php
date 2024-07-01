<?php
	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php");


	/************************************************************************************************ 
	| Recuperar y almacena el id, del registro seleccionado, enviado desde el archivo "1_tabla.php" |
	************************************************************************************************/
	$id = $_GET['id'];


	/****************************************************************************************************** 
	| Formular la "consulta" para obtener el registro de la tabla "sitiosweb" donde el id sea igual a $id |
	******************************************************************************************************/
	$consulta = "select materias.nombre, clave, planestudios from materias where id = '$id'";


	/*************************************************************** 
	| Ejecutar la "consulta" y almacenar el "registro" que devuelve|
	***************************************************************/
	$resultado_de_la_consulta = mysqli_query($conexion, $consulta);
		/*
			mysqli_query()             -->  Ejecuta la consulta sql y devuelve un "resultado"
	        $resultado_de_la_consulta  -->  Almacena el "resultado"	
	    */


	/************************************************ 
	| Obtener el "registro" en forma de una arreglo |
	************************************************/
	$registro = mysqli_fetch_array($resultado_de_la_consulta);

	
	/********************************************** 
	| Copiar los campos del registro en variables |
	**********************************************/
	$nombre = $registro[0];
	$clave = $registro[1];
	$planestudios = $registro[2];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ISC oficial</title>

	<link rel="stylesheet" type="text/css" href="css/estilos.css">

</head>
<body leftmargin  = 275>
		<nav class="contenedor-menu">
		<div>
				<li style="display:flex; align-items:center; "><a class="menus" href="index.php">
					<img src="img/inicio.png" style="height: 45px;">
						</svg>
					</a> </li>
				<li><a class="menus" href="noticias.php">
						NOTICIAS
					</a> </li>
				<li><a class="menus" href="recordatorios.php">
						AVISOS </a> </li>
				<li><a class="menus menus--select" href="materias.php">
						MATERIAS
					</a> </li>
				<li><a class="menus" href="sitios.php">
						SITIOS WEBS
					</a> </li>
			</div>
			<div class="contenedor-menu-login">
				<img class="logo" src="img/logo1.png">
				<a class="option-login" href="../../login/index.html">
					Iniciar sesion
				</a>
			</div>
				

		</nav>
		<?php echo "
				<div class='menu_materia'  >
					$nombre -- $clave
				</div>";
				?>

		

		<section class="container">
			
			<?php

			$sql = "select id, titulo, descripcion, link from temas where idmateria = '$id'";
			$temas = mysqli_query($conexion, $sql);

			while ($tema = mysqli_fetch_array($temas)) { // Mientras existan registros...
					// ... recuperar sus campo y mostrarlos en la pagina
	
				echo "
					<div class='contenido'>
						 
							<div class='titulo'> <h3>". $tema['titulo']. "</h3>  </div>
						
						<div class='info_archivos'>
							<div class='info'> <p>". $tema['descripcion']. "</p></div>
					
					";

				if($tema['link'] != ""){
					echo "<a href = '".$tema['link']."'>".$tema['link']."</a>";
				}
					
					$archivos = "select id, nombre, nombreunico from archivos where ids = '".$tema['id']."' and tipo = 'tema'"; 
					$resultado = mysqli_query($conexion, $archivos);
					$totalArchivos = mysqli_num_rows($resultado);

					if($totalArchivos != 0){
							echo "
							<div class='imagen_archivos'>";

						while($archivo = mysqli_fetch_array($resultado)) { 
							$nombreUnico = $archivo['nombreunico'];
							$nombreArchivo = $archivo['nombre'];
							echo"
							
								<div class='imagen_archivo'> 
							   	<img src='img/doc.png'/>
							   	<a style='float:left; height: 70px; margin-top: 23px'href='../../archivos/$nombreUnico'><div>$nombreArchivo</div>  </a> 
								</div>";
							
						}
						echo"
						 		<div style='clear: both;'> </div>
							</div>";
					}
						echo"
						</div	>

					</div>";
				}

				?>

		</section>
	</body>
</html>