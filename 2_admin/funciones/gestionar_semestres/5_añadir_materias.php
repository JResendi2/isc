<!--Este archivo inserta los datos, los cuales fueron enviados desde el archivo "2_nuevo.html", en la base de datos-->

<?php 

	/************************************* 
	| Verificar si alguien inicio sesion |
	*************************************/
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verefica si existe la variable 'user' en el servidor
		//Si no existe entonces no existe ninguna sesion activa por lo que regresa al login
		header("location:../../login.php");
		exit;
	}


	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../../conexion/conexion.php");


	/****************************************************************** 
	| Recuperar los datos del formulario y almacenarlos en "varibles" |
	******************************************************************/
	$id_semestre = $_POST['id'];
	$materias = $_POST['añadirMaterias'];



	if($materias != null){
		for ($i=0; $i < count($materias); $i++) { 
			$id_materia = $materias[$i];
			$id_docente = $_POST['docente_'.$id_materia]; // Es select de profesores de esa materia

			// Crear la reacion entre materias, semestres y docentes
			$sql = "insert into mat_sem_prof values('$id_semestre', '$id_materia', '$id_docente')";
			mysqli_query($conexion, $sql);
		
		}
	}

	/******************************************************************************* 
	| Despues de subir cualquier archivo, o no, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:3_modificar.php?id=$id_semestre");


?>