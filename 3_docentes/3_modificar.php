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
$id = $_GET['id']; // Recupera el 'id' del registro seleccionado desde el archivo "1_tabla.php"

// Consulta los campos perteneciente al id recuperado anteriormente
$consulta = "select nombre,usuario,contraseña,numtelefono from usuarios  where usuarios.id = '$id'";

$resultado_de_la_consulta = mysqli_query($conexion, $consulta);/* "mysqli_query" ejecuta la instruccion sql y el 
	                                                                   resultado se almacena en el "resultado_de_la_consulta" */
$registro = mysqli_fetch_array($resultado_de_la_consulta); /* "mysqli_fetch_array" obtiene el primer registro 
																   del "resultado_de_la_consulta" */

//Se recuperan todo los campos del "registro"
$nombre = $registro['nombre'];
$usuario = $registro['usuario'];
$contraseña = $registro['contraseña'];
$numtelefono = $registro['numtelefono'];
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ISC oficial</title>

	<link rel="stylesheet" type="text/css" href="0_diseno/css/estilos.css">


</head>
<script language=JavaScript>
	<!--
	window.defaultStatus = "modificar";

	function mensaje() {
		alert('verifica los datos a modificar');
	}

	function mensaje2() {
		alert('Salir');
	}
	-->
</script>

<body onload="mensaje();" onUnLoad="mensaje2();">

	<header>
		<img src="0_diseno/img/logo1.png" height="55" style="margin-right: 150px; float: left;">
		<img src="0_diseno/img/logo2.png" height="55">
	</header>

	<nav class="navegacion">
      <a class="navegacion-home" href="inicio_de_docentes.php">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
            <path d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
          </svg>
          Inicio
      </a>
  
      <h3>Agrega más información para la carrera</h3>
      <a class="navegacion-exit" href="logout.php">
        Cerrar sesion
      </a>
    </nav>

	<section>


		<form action="3_modificar_update.php" method="post">
			<div style="padding: 0 10px;">

				<table class="table-new">

					<?php
					echo '
					<tr>
						<td class="field">nombre:</td>
						<td><input type = text name = "nombre" size = 40 required value="' . $nombre . '"></td>
					</tr>
					<tr>
						<td class="field">usuario:</td>
						<td><input type = text  name = "usuario" size = 40 required value="' . $usuario . '"></td>
					</tr>
					<tr>
						<td class="field">contraseña:</td>
						<td><input type = text name = "contraseña" size = 40 required value="' . $contraseña . '"></td>
					</tr>
					<tr>
						<td class="field">numtelefono:</td>
						<td><input type = text name = "numtelefono" size = 40 required value="' . $numtelefono . '"></td>
					</tr>
				<input type=hidden name=id value = "' . $id . '">' ?>

				</table> <br><br>
			</div>

			<div class="div-btn-new">

				<input class="btn-new" type="button" name="imprimir" value="Imprimir" onclick="window.print();">
				<input class="btn-new" type="submit" value="Guardar">
			</div>
		</form>
	</section>


</body>

</html>