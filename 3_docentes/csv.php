<?php
	
	session_start();//Se inicia una sesion
	if(!isset($_SESSION['user'])){// Verifica si existe la variable 'user' en el servidor
		//Si no existe entonce regresa al login
		header("location:login.html");
		exit;
	}

	$id = $_SESSION['id']; /* Recupera el "usuario" que inicio sesion.
								  'user' es una variable almacenada en el servidor. */
?>
<?php

   include("conexion.php");
   //session_start();

   //$id = $_session["id"];
  

   $sql_perfil =  "select * from usuarios where usuarios.id ='$id'";
  $resultado = mysqli_query($conexion,$sql_perfil);
   while($registro = mysqli_fetch_array($resultado)){
  echo $registro['id']." , ";
     echo $registro['nombre'] ." , ";
    echo $registro['usuario'] ." , ";
     echo $registro['contraseña'] ." , ";
     echo $registro['numtelefono'] ." , ";
   

     
   }
   header('content-Type: application/csv');
header('content-Disposition: attachment; filename=exportcsv.csv;');
?>
    