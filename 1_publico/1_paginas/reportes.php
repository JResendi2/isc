<?php

ob_start();

	include("../../conexion/conexion.php");

	$id = $_GET['id'];
	$consulta = "select id, numero, periodo from semestres where id = $id";
	$resultado_de_la_consulta = mysqli_query($conexion, $consulta);
	$registro = mysqli_fetch_array($resultado_de_la_consulta);

echo "
	<!DOCTYPE html>
	<html>
	<body>

		<h2 style='text-align: center; font-size: 20px; font-weight: bold; padding-top: 20px;'>Institulo Tecnologico Superior de Panuco.</h2>
		<h2 style='font-size: 17px; font-weight: bold; '>Ingenieria en sistemas computacionales.</h2>
		<h2 style='text-align: center; font-size: 20px; font-weight: bold; margin-buttom: 100px'>Materias del semestres.</h2>

	</body>
	


	
		<link rel='stylesheet' type='text/css' href='css/estilos.css'>
	<div class='contenido'>
	<div class='titulo' style='margin-top:40px'> <h3>Num. del semestre: ". $registro['numero']. "</h3>  </div>
		  <div class='titulo' style='float: right'> Periodo: ". $registro['periodo']. "</div>"; 

// ==== Ejecucion de la consulta del reporte ===
$sql = "select materias.id, materias.nombre, profesores.nombre from materias inner join mat_sem_prof on materias.id = mat_sem_prof.idmateria inner join profesores on profesores.id = mat_sem_prof.idprofesor where mat_sem_prof.idsemestre = ".$id;






$materias = mysqli_query($conexion, $sql);
$total = mysqli_num_rows($materias);

if($total>0){
						echo "
						<div style='padding-left:30px'>
						<div style='border: 1px solid; width: 666px; clear: both;'>
							<table width='500' cellpadding='8'>
							
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
								<td id = '". $materia[0]."'>". $materia[1]. "</td>
								<td>". $materia[2]. "</td>
							</tr>

							

							";
							if ($e) {
								$color = "#c1c7cb";
								$e = false;
							} else {
								$color = "lightgray";
								$e = true;
							}
							
			
						}
					}
					echo "
													</table>
								</div></div>
					</div></html>";


$html = ob_get_clean();
//echo $html;

///*
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$option = $dompdf->getOptions();
$option->set(array('isRemoteEnabled' => true));
$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->setPaper('letter');




$dompdf->stream("reportegenerado.pdf", array("Attachment" => false));
//*/
?>
