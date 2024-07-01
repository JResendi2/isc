<?php
	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php"); 


	/************************************************************************** 
	| Formular la "consulta" para obtener el id y el nombre de los "docentes" |
	**************************************************************************/
	$consultar = "select id, nombre from profesores"; 
	$docentes = mysqli_query($conexion, $consultar);  // Ejecutar la "consulta"
	// Obtener el total de docentes
	$totalDocentes = mysqli_num_rows($docentes);


	// Obtener el total de materias
	$consultar = "select * from materias"; 
	$materias = mysqli_query($conexion, $consultar); 
	$totalMaterias = mysqli_num_rows($materias);

	ob_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>ISC oficial</title>
		<style type="text/css">
			h4{
				text-align: center;
				margin-bottom: 0px;
			}
			table{
				margin-top: 50px;
				clear: both;
				width: 100%;
			}
			tr{
				text-transform: uppercase;
				text-align: justify;
			}
		</style>

	</head>
	<body>
		<header>
			<h4>ADMINISTRACIÓN DE BASE DE DATOS: REPORTE GENERAL</h4>
			<div style="float: left;">REPORTE: MATERIAS_PROFESORES</div>
			<div style="float: right;">TOTAL DE PROFESORES: <?php echo $totalDocentes;?> </div>

			<div style="clear: both; ">MATERIAS: <?php echo $totalMaterias;?></div>
			<div style="text-align: center; margin-top: -50px;">CARRERA: SISTEMAS COMPUTACIONALES </div>
			<div style="float: right; margin-top: -50px;">PERIODO: 2019-2021</div>
		</header>

		<section>
				<table border = '1'>
					<tr>
						<th> Docentes </th> 
						<th> Materias </th>	
					</tr>
					<?php 
					while ($docente = mysqli_fetch_array($docentes)) { 
						// Por cada docente se va a...
			
						// Obtener el id y el nombre del docente.
						$id = $docente["id"];
						$nombreDocente = $docente["nombre"];

						// Formular la "consulta" para obtener todas las materias que imparte el docente
						$consultar = "select materias.nombre from materias inner join mat_sem_prof on materias.id = mat_sem_prof.idmateria where mat_sem_prof.idprofesor = $id"; 
						$materias = mysqli_query($conexion, $consultar);


						// Mostrar  el nombre del docente en la primera columna.
						echo"
						<tr> 
							<td>
								$nombreDocente
							</td>

							<td>";// Mostrar las materias del docente en la segunda columna
								while ($materia = mysqli_fetch_array($materias)) {
									$nombreMateria = $materia['nombre'];
									echo "
									$nombreMateria. <br>";
								}	
								echo "
							</td>
						</tr>";
					
					}?>
				</table>
				
		</section>
	</body>
</html>

<?php
	$html = ob_get_clean();

	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();

	$option = $dompdf->getOptions();
	$option->set(array('isRemoteEnabled' => true));
	$dompdf->loadHtml($html);

	$dompdf->render();

	$dompdf->setPaper('letter');

	$dompdf->stream("reportegenerado.pdf", array("Attachment" => false));
?>