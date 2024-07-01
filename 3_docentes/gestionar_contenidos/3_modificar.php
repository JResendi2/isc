<!--Este archivo solo contiene un formulario con la informacion de un registro seleccionado desde 
    el archivo "1_tabla.php", permite modificar esa informacino.-->

<?php
	include("../conexion.php");
	$id = $_GET['id']; // Recupera el 'id' del registro seleccionado desde el archivo "1_tabla.php"

	// Consulta los campos perteneciente al id recuperado anteriormente
	$consulta = "select titulo, informacion, usuarios.usuario from contenidos inner join usuarios on contenidos.idusuario = usuarios.id where contenidos.id = '$id'";

	$resultado_de_la_consulta = mysqli_query($conexion, $consulta);/* "mysqli_query" ejecuta la instruccion sql y el 
	                                                                   resultado se almacena en el "resultado_de_la_consulta" */
	$registro = mysqli_fetch_array($resultado_de_la_consulta); /* "mysqli_fetch_array" obtiene el primer registro 
																   del "resultado_de_la_consulta" */

	//Se recuperan todo los campos del "registro"
	$titulo = $registro['titulo'];
	$info = $registro['informacion'];
    //$img = $registro['img'];
    $img = "";
	$user = $registro['usuario'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ISC oficial</title>

	<link rel="stylesheet" type="text/css" href="../0_diseno/css/estilos.css">


</head>
<body>

		<header>
				<img src="../0_diseno/img/logo1.png" height="55" style="margin-right: 150px; float: left;">
				<img src="../0_diseno/img/logo2.png" height="55">
		</header>

		<nav>
				
		</nav>

		<section>

			<h2>Contenidos principales</h2>

			<form action = "3_modificar_update.php" method="post" enctype="multipart/form-data">
			<table>

				<?php 
					/*En esta parte se agregan las variables, las que estan entre las lineas 16 y 20, en los 
					  elementos del formulario */

					echo '
					<tr>
						<td>Titulo:</td>
						<td><input type = text name = "txtTitulo" size = 40 required value="'.$titulo.'"></td>
					</tr>
					<tr>
						<td>Información:</td>
						<td><textarea name = "txtInfo" required>'.$info.'</textarea></td>
					</tr>
					<tr>
						<td>Imagen:</td>
						<td><input type = file name = "txtImg[]" multiple></td>
					</tr>
					<tr>
						<td>Creado por..</td>
						<td><input type = text name = "txtCreado" value="'.$user.'"></td>
					</tr>
				<input type=hidden name=id value = "'.$id.'">
				<input type=hidden name=img2 value = "'.$img.'">'?>
			</table> <br><br>

			
			<input type = submit value = "Guardar">
			<!--Este boton abre el archivo "3_modificar_update.php", y envia los datos del formulario hacia ese mismo archivo-->

			<input type = reset value = "Limpiar campos">


		</form>	
		</section>
		Ultima modificacion:
<script language="JavaScript">
<!--
document.write(document.lastModified)
// -->
</script>

</body>

</html>