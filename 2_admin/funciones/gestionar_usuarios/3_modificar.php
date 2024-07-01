<!--Este archivo tiene el formulario necesario para crear una cuenta tipo docente-->

<?php
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verifica si existe la variable 'user' en el servidor
		//Si no existe entonce regresa al login
		header("location:../../login.html");
		exit;
	}

	include("../../conexion/conexion.php");

	$id = $_GET['id'];
		
	/****************************************************************** 
	| Formular la "consulta" para obtener los nombres de los docentes |
	***************************************************************/
	$sql = "select usuario, contraseña, usuarios.nombre, numtelefono, profesores.nombre from usuarios inner join profesores on profesores.id = usuarios.iddocente where usuarios.id = $id";
	$resultado_de_la_consulta = mysqli_query($conexion, $sql); // Ejecutar la consulta
	$registro = mysqli_fetch_array($resultado_de_la_consulta);

	$usuario = $registro['usuario'];
	$contraseña = $registro['contraseña'];
	$nombre = $registro['nombre'];;
	$telefono = $registro['numtelefono'];
	$docente = $registro['nombre'];


	
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>ISC oficial</title>
	<link rel='stylesheet' type='text/css' href='../../css/css/estilos.css'>
</head>

<body>
<nav>
		<u1 class='lista'>
			<li class='menus'><a href='../../funciones/gestionar_docentes/1_tabla.php'>
					<div>Docentes</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_materias/1_tabla.php'>
					<div>Materias</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_semestres/1_tabla.php'>
					<div>Semestres</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_sitios/1_tabla.php'>
					<div>Sitios webs</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_avisos/1_tabla.php'>
					<div>Avisos</div>
				</a> </li>
			<li class='menus'><a href='../../funciones/gestionar_usuarios/1_tabla.php'>
					<div>Usuarios</div>
				</a> </li>
			<li class='menus'><a href='../../logout.php'>

					<div>Salir</div>
				</a> </li>
			</u1>
			<img src="../../css/img/logo1.png" height="35">

	</nav>
		<section>
			<h2>Usuarios - Modificar</h2>
			<form action='2_nuevo_insert.php' method='post' id='formularios'>
			<table align='center'>
				<?php echo "
				<tr>
					<td>Usuario:</td>
					<td><input type = text name = 'usuario' size = 40 value = $usuario></td>
				</tr>
				<tr>
					<td>Contraseña:</td>
					<td><input type = password name = 'contraseña' size = 37 value = $contraseña></td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td><input type = text	name = 'nombre' size = 37 value = $nombre></td>
				</tr>
				<tr>
					<td>Numero de telefono:</td>
					<td><input type = text name = 'telefono' size = 37 value = $telefono></td>
				</tr>
				<tr>
					<td>Docente</td>
					<td><input type = text size = 37 value = $docente></td>
				</tr>";
				?>

			</table> <br><br>

			<h3>Materias que imparte</h3>
			<table border = '1'>
					<tr>
						<th> Semestre </th> 
						<th> Materia </th>	
					</tr>


					<?php 


					$sql = "select semestres.numero, materias.nombre from usuarios INNER join profesores on usuarios.iddocente = profesores.id INNER JOIN mat_sem_prof on profesores.id = mat_sem_prof.idprofesor INNER JOIN materias on materias.id = mat_sem_prof.idmateria INNER JOIN semestres on semestres.id = mat_sem_prof.idsemestre WHERE usuarios.id = $id ORDER by semestres.numero, materias.nombre";
					$resultado_de_la_consulta = mysqli_query($conexion, $sql); // Ejecutar la consulta

					/*************************************** 
					| Mostrar los registros de la consulta |
					***************************************/

					while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { // Mientras existan registros...
							/*
								mysqli_fetch_array()  -->  "Obtiene" un registro del objeto $resultado_de_la_consulta
								$registro             -->  "Almacena" el registro en forma de un vector o arreglo

								y mientras existan registros...
							*/

						// COPIAR LOS "CAMPOS" DE CADA REGISTRO.
						$semestre = $registro[0];
						$materia = $registro[1];

						//$user = $registro["usuario"];

						// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA DE LA PAGINA. <td>". $user. "</td>
						echo"
						<tr> 
							<td>". $semestre. "</td> 
							<td>". $materia. "</td> 
						</tr>";
							
				}?>
			</table>
		</form>	
	</section>
</body>
</html>
