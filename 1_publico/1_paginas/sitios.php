<?php
include("../../conexion/conexion.php"); // Conexion a la base de datos
$consulta = "select id, link, nombre, descripcion from sitiosweb"; 

$resultado_de_la_consulta = mysqli_query($conexion, $consulta); 
	//	"mysqli_query" 				-->   Ejecuta la instruccion sql
	//  "resultado_de_la_consulta"	-->	  Almacena lo que devuelve el metodo "mysqli_query"


?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ISC oficial</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">


</head>

<body>
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
				<li><a class="menus" href="materias.php">
						MATERIAS
					</a> </li>
				<li><a class="menus menus--select" href="sitios.php">
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

	</header>


	<section class="container">


			
			<?php 	
			// Codigo para insertar los registros del "resultado_de_la_consulta" sobre la pagina.

				while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { // Mientras existan registros...
					$e = true;
					// ... recuperar sus campo y mostrarlos en la pagina
					$idI = $registro['id'];


					$sql = "select id, nombre from imagenes where ids = '".$registro['id']."' and tipo = 'sitio'"; 
					$imagenes = mysqli_query($conexion, $sql);
					$total = mysqli_num_rows($imagenes);

					echo "
					<div class='contenido' style='display: flex; gap:2rem'>";

						if ($total == 1) {
							$imagen = mysqli_fetch_array($imagenes);
							echo "
							<div style='width: 100px;'>
								<img src='../imagenes/".$imagen['nombre']."' style=' width:100%;'>
							</div>";
						} else {
							echo "
							<div style='width: 100px;'>
								<img src='img/sitio.png' style=' width:100%;'>
							</div>";
							
						}
						

						echo " 
						<div class='info_archivos' style='width:100%; height: 100px;'>
							<div class='titulo'> <h3>". $registro['nombre']. "</h3>  </div>
							<div class='info'> <p>". $registro['descripcion']. "</p></div>
							<a href='". $registro['link']. "'><div>VISITAR</div> </a>
						</div>

					</div>";
				}

			?>
			


		</section>
	</div>

</body>

</html>