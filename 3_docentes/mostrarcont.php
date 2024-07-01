<!--Este archivo solo contiene un formulario con la informacion de un registro seleccionado desde 
    el archivo "1_tabla.php", permite modificar esa informacino.-->


<?php
session_start(); //Se inicia una sesion
if (!isset($_SESSION['user'])) { // Verifica si existe la variable 'user' en el servidor
	//Si no existe entonce regresa al login
	header("location:login.html");
	exit;
}

$id = $_SESSION['id']; /* Recupera el "usuario" que inicio sesion.
								  'user' es una variable almacenada en el servidor. */
?>
<?php
include("conexion.php");
//$id = $_GET['id']; // Recupera el 'id' del registro seleccionado desde el archivo "1_tabla.php"

$consulta1 = "select iddocente from usuarios where id = " . $id;
$res1  = mysqli_query($conexion, $consulta1);
$reg1 = mysqli_fetch_array($res1);

$id_docente = $reg1[0];

// Consulta los campos perteneciente al id recuperado anteriormente
$consulta = "select materias.nombre as materia,temas.titulo as titulo,
	 mat_sem_prof.idprofesor, profesores.nombre, usuarios.tipousuario FROM materias 
	 left JOIN temas ON temas.idmateria=materias.id 
	 left JOIN mat_sem_prof ON mat_sem_prof.idmateria=materias.id 
	 left JOIN profesores on profesores.id=mat_sem_prof.idprofesor 
	 left JOIN usuarios on usuarios.iddocente=profesores.id 
	 WHERE profesores.id = " . $id_docente;
$error = false;
$resultado_de_la_consulta = null;
try {
	$resultado_de_la_consulta = mysqli_query($conexion, $consulta);
} catch (\Throwable $th) {
	$error = true;
}



$materia = "";
$tema = "";
if ($error) {
	echo "Aun no tiene materias asignadas";
} else {
	echo '<table border = "1">
    <tr><th>MATERIA</th><th>TEMAS</th></tr>';

	while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) {

		if ($materia == $registro['materia']) {
			echo '<TR><TD>&nbsp;</TD>';
			if ($tema == $registro['titulo']) {
				echo '<TD>&nbsp;</TD> ';
				$tema = $registro['titulo'];
			} else {
				echo '<TD>' . $registro['titulo'] . '</TD>';
				$tema = $registro['titulo'];
			}
			//echo '<TR><TD>&nbsp;</TD><TD>' .$registro['titulo']. '</TD><TD>' .$registro['subtemas']. "</TD></TR>";
			$materia = $registro['materia'];
		} else {
			echo '<TR><TD>' . $registro['materia'] . '</TD><TD>' . $registro['titulo'] . "</TD></TR>";
			//echo '<TR><TD></TD><TD>' .$registro['titulo']. '</TD><TD>' .$registro['subtemas']. "</TD></TR>";
			$materia = $registro['materia'];
			$tema = $registro['titulo'];
		}


		// echo '<TR><TD>' .$registro['materia']. '</TD><TD>' .$registro['titulo']. '</TD><TD>' .$registro['subtemas']. "</TD></TR>";
		//printf("Materia: %s  Tema: %s   Subtema: %s", $registro[0], $registro[1], $registro[2]);  
	}
	echo "</table>";
}





?>