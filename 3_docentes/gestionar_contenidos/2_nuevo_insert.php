<!--Este archivo inserta los datos, enviados desde el archivo "2_nuevo.html", en la base de datos-->

<?php 
	session_start();

	include("../conexion.php");

	//Se recuperan los datos del formulario
	$titulo = $_POST['txtTitulo'];
	$info = $_POST['txtInfo'];
	//$img = $_POST['txtImg']. " ";
	$id = $_SESSION['id'];

	//Se insertan los datos en la base de datos
	$insert = "insert into contenidos values(0, '$titulo', '$info', '$id')";
	mysqli_query($conexion,$insert);
	//Se regresa al archivo "1_tabla.php"
	header("location:1_tabla.php");
?>