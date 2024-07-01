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
	$usuario = $_POST['usuario'];
	$contraseña1 = $_POST['contraseña1'];
	$contraseña2 = $_POST['contraseña2'];
	$nombre = $_POST['nombre'];;
	$telefono = $_POST['telefono'];
	$id_docente = $_POST['docente'];


	/****************************************************************************** 
	| Formular la "consulta" para insertar las "varibles" en la tabla "usuarios" |
	******************************************************************************/
	$insert = "select * from usuarios where usuario = '$usuario'";


	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	$resultado_de_la_consulta = mysqli_query($conexion,$insert);

	if($registro = mysqli_fetch_array($resultado_de_la_consulta)){
		// Si se cumple esta condicion entondes el usuario ya esta ocupado
		echo "<script> alert('El usuario no esta disponible'); </script>"; 
		echo "<meta http-equiv=\"refresh\" content=\"0;url=2_nuevo.php\"/> "; 
	}

	if($contraseña1 != $contraseña2){
		echo "<script> alert('Las contraseñas no coinciden'); </script>"; 
		echo "<meta http-equiv=\"refresh\" content=\"0;url=2_nuevo.php\"/> "; 
	}

	/****************************************************************************** 
	| Formular la "consulta" para insertar las "varibles" en la tabla "usuarios" |
	******************************************************************************/
	$insert = "insert into usuarios values(0, '$usuario', '$contraseña1', '$nombre', 'docente', '$telefono', '', '$id_docente')";
	

	/************************* 
	| Ejecutar la "consulta" |
	*************************/
	mysqli_query($conexion,$insert);
	

	/******************************************************************************* 
	| Despues de subir cualquier archivo, o no, se regresa al archivo "1_tabla.php"|
	*******************************************************************************/
	header("location:1_tabla.php");
?>