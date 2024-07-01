<?php
include("../../conexion/conexion.php"); // Conexion a la base de datos
$consulta = "select id, titulo, informacion, fecha_fin from avisos where tipo_informacion = 'recordatorio' and fecha_fin >= NOW() order by fecha_fin";

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
	<header>
		<nav class="contenedor-menu">
			<div>
				<li style="display:flex; align-items:center; "><a class="menus" href="index.php">
						<img src="img/inicio.png" style="height: 45px;">
						</svg>
					</a> </li>
				<li><a class="menus" href="noticias.php">
						NOTICIAS
					</a> </li>
				<li><a class="menus menus--select" href="recordatorios.php">
						AVISOS </a> </li>
				<li><a class="menus" href="materias.php">
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

	</header>


	<section class="container">


		<?php
		// Codigo para insertar los registros del "resultado_de_la_consulta" sobre la pagina.

		while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { // Mientras existan registros...
			$e = true;
			// ... recuperar sus campo y mostrarlos en la pagina
			$idI = $registro['id'];

			echo "
					<div class='contenido'>
						 
							<div class='titulo'> <h3>" . $registro['titulo'] . "</h3>  </div>
							<div class='titulo' style='float: right'> Fecha limite: " . $registro['fecha_fin'] . "</div>
						
						<div class='info_archivos'>
							<div class='info'> <p>" . $registro['informacion'] . "</p></div>
					
					";





			$sql = "select id, nombre from imagenes where ids = '" . $registro['id'] . "' and tipo = 'recordatorio'";
			$imagenes = mysqli_query($conexion, $sql);
			$total = mysqli_num_rows($imagenes);

			if ($total > 0) {
				echo "<div id='carrusel$idI' class='carrusel'>";

				$i = 0;
				while ($imagen = mysqli_fetch_array($imagenes)) {
					$nombre = $imagen['nombre'];
					if ($i == 0) {
						echo "
						<div style='overflow: hidden; max-height: 450px'>
							<img id='img$i' class='slide' src='../../imagenes/$nombre' style='height:auto; width: 100%'>
						</div>";
					} else {
						echo "
						<div>
							<img id='img$i' class='slide' src='../../imagenes/$nombre' style='display: none; width: 100%'>
						</div>";
					}
					$i++;
				}

				echo "

					<button type='button' class='btn-prev' data-carrusel-id='$idI' data-img-id='0' data-img-total='$i'><</button>
					<button type='button' class='btn-next' data-carrusel-id='$idI' data-img-id='0' data-img-total='$i'>></button>
				</div>";
			}

			$archivos = "select id, nombre, nombreunico from archivos where ids = '" . $registro['id'] . "' and tipo = 'recordatorio'";
			$resultado = mysqli_query($conexion, $archivos);
			$totalArchivos = mysqli_num_rows($resultado);

			if ($totalArchivos != 0) {
				echo "
							<div class='imagen_archivos'>";

				while ($archivo = mysqli_fetch_array($resultado)) {
					$nombreUnico = $archivo['nombreunico'];
					$nombreArchivo = $archivo['nombre'];
					echo "
							
								<div class='imagen_archivo'> 
							   	<img src='img/doc.png'/>
							   	<a style='float:left; height: 70px; margin-top: 23px'href='../../archivos/$nombreUnico'><div>$nombreArchivo</div>  </a> 
								</div>";
				}
				echo "
						 		<div style='clear: both;'> </div>
							</div>";
			}
			echo "
						</div	>
					</div>";
		}

		?>



	</section>
	</div>

</body>
<script>
	document.addEventListener("DOMContentLoaded", () => {

		let btn_prev = document.querySelectorAll('.btn-prev');
		let btn_next = document.querySelectorAll('.btn-next');
		let img_id_next = "";
		
		let btn;
		let carrusel_id;
		let total;
		let img_id;
		let img_actual;

		for (let i = 0; i < btn_prev.length; i++) {

			btn_prev[i].addEventListener('click', (e) => anteriorImg(e));
		}

		for (let i = 0; i < btn_prev.length; i++) {
			btn_next[i].addEventListener('click', (e) => siguienteImg(e));
		}

		imagens = document.querySelectorAll('.slide');
		for (let i = 0; i < imagens.length; i++) {
			if (imagens[i].clientHeight > imagens[i].clientWidth) {
				 imagens[i].style.width = 'auto';
				 imagens[i].style.height = '450px';
			} 
		}

		function siguienteImg(e) {
			getData(e);
			img_actual.style.display = "none";

			if (parseInt(img_id) + 1 == total) {
				img_id_next = "0";
			} else {
				img_id_next = (parseInt(img_id) + 1).toString();
			}
			document.querySelector("#carrusel" + carrusel_id + " #img" + img_id_next).style.display = "inline";
			btn.setAttribute('data-img-id', img_id_next);
		}

		function anteriorImg(e) {
			getData(e);
			img_actual.style.display = "none";

			if (parseInt(img_id) == 0) {
				img_id_next = (total-1).toString();
			} else {
				img_id_next = (parseInt(img_id) - 1).toString();
			}
			document.querySelector("#carrusel" + carrusel_id + " #img" + img_id_next).style.display = "inline";
			btn.setAttribute('data-img-id', img_id_next);
		}

		function getData(e){
			btn = e.target;
			carrusel_id = btn.getAttribute("data-carrusel-id");
		    total = btn.getAttribute("data-img-total");
		    img_id = btn.getAttribute("data-img-id");
		    img_actual = document.querySelector("#carrusel" + carrusel_id + " #img" + img_id);
		}
	})
</script>

</html>