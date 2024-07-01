<?php
include("../../conexion/conexion.php"); // Conexion a la base de datos
$consulta = "select id, numero, periodo from semestres"; 

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
						 
							<div class='titulo'> <h3>Núm. del semestre: ". $registro['numero']. "</h3>  </div>
							<div class='titulo' style='float: right'> Periodo: ". $registro['periodo']. "</div>
						
						<div class='info_archivos' style='padding-top: 10px; padding-bottom: 10px; padding-left: 60px'>
						
					";





					$sql = "select materias.id, materias.nombre, profesores.nombre from materias inner join mat_sem_prof on materias.id = mat_sem_prof.idmateria inner join profesores on profesores.id = mat_sem_prof.idprofesor where mat_sem_prof.idsemestre = ".$registro['id']; 
					
					$materias = mysqli_query($conexion, $sql);
					$total = mysqli_num_rows($materias);
	
					if($total>0){
						echo "
							<table width='800' cellpadding='8'>
							
							<tr>
							
								<th>Nombre de la materia</th>
							
								<th>Docente de la materia</th>
							</tr>
							
						";
						
						$color = "lightgray";
						$e = true;

						while($materia = mysqli_fetch_array($materias)) { 
							echo "
							<tr style='background-color: $color'>
								<td style='cursor: pointer' id = '". $materia[0]."'>". $materia[1]. "</td>
								<td>". $materia[2]. "</td>
							</tr>

							<script languague='javascript'>
    								document.getElementById('". $materia[0]."').addEventListener('mouseover', 
    									function(){
    										document.getElementById('". $materia[0]."').style.backgroundColor = '#556370';
    										document.getElementById('". $materia[0]."').style.color = 'white';
    									},false);

    								document.getElementById('". $materia[0]."').addEventListener('mouseout', 
    									function(){
    										document.getElementById('". $materia[0]."').style.backgroundColor = '$color';
    										document.getElementById('". $materia[0]."').style.color = 'black';
    									},false);

    								document.getElementById('". $materia[0]."').addEventListener('click', 
    									function(){
    										var x;
	        								x = window.open('materia.php?id=". $materia[0]."' , '_self');
										},false);

							</script>

							";
							if ($e) {
								$color = "#c1c7cb";
								$e = false;
							} else {
								$color = "lightgray";
								$e = true;
							}
							
			
						}
					

						echo"
							</table> 
							<a href='reportes.php?id=".$registro['id']."'><button style='cursor: pointer' type='button' class='btreporte'>Generar reporte</button></a>
							</div>
						</div>";

					}  else{
						echo"
							<tr>
							
								<td>Sin materias asignadas</th>
							
							</tr>
							</table> 
							</div>
						</div>";
					}

				}

			?>
			


		</section>
	</div>

</body>

</html>