<!--Este archivo muestra una tabla con todos los registros de la tabla "Sitios web"-->

<?php


	/************************************************************* 
	| Agregar el archivo que permite hacer la conexion con la BD |
	*************************************************************/
	include("../conexion.php"); 


	/**************************************************************************** 
	| Formular la "consulta" para obtener los registros de la tabla "sitiosweb" |
	****************************************************************************/
	$consultar = "select sitiosweb.id, sitiosweb.nombre, link, usuario from sitiosweb inner join usuarios on sitiosweb.idusuario = usuarios.id"; 
	

	/*************************************************************** 
	| Ejecutar la "consulta" y almacenar los registros que devuelva|
	***************************************************************/
	$resultado_de_la_consulta = mysqli_query($conexion, $consultar); 
		/*
			mysqli_query()             -->  Ejecuta la consulta sql y devuelve un "resultado"
	        $resultado_de_la_consulta  -->  Almacena el "resultado"	
	    */
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
			<h2>Sitios web</h2>
			<form action=4_delete.php method=post>
				<a href = '2_nuevo.html'>Nuevo registro</a> <!--Este enlace abre el archivo "2_nuevo.html" para agregar un nuevo "contenido"-->
				<table border = '1'>
					<tr>
						<th> Eliminar </th> 
						<th> Nombre </th>	
						<th> Link </th>	
						<th> Realizado por.. </th>	
						<th> Modificar </th>
					</tr>


					<?php 

					/*************************************** 
					| Mostrar los registros de la consulta |
					***************************************/

					while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) { 
							/*
								mysqli_fetch_array()  -->  "Obtiene" un registro del objeto $resultado_de_la_consulta
								$registro             -->  "Almacena" el registro en forma de un vector o arreglo

								y mientras existan registros...
							*/

						// COPIAR LOS "CAMPOS" DE CADA REGISTRO.
						$id = $registro["id"];
						$nombre = $registro["nombre"];
						$link = $registro["link"];
						$usuario = $registro["usuario"];

						// PEGAR LOS "CAMPOS" EN UNA FILA DE LA TABLA DE LA PAGINA.
						echo"
						<tr> 
							<td><input type=checkbox name=eliminar[] value=".$id." onclick='mover(this)'></td> 
							<td>". $nombre. "</td> 
							<td>". $link. "</td> 
							<td>". $usuario. "</td> 
							<td><a href='3_modificar.php?id=".$id."'> Modificar</a> </td>
						</tr>";
							/*	<input type=checkbox name=eliminar[] value=". $id.">
									input type=checkbox  -->	Agrega un checkbox por cada registro
									name=eliminar[]      --> 	"Crea un arreglo" llamado eliminar
									value=".$id."        -->	"Almacena en el arreglo" el id de cada registro, un
																id en cada espacio del arreglo.  
							*/
							/*	<a href='3_modificar.php?id=".$registro["id"]."'> Modificar</a>
									Agrega un enlace para cada registro. 
									El enlace abre el "archivo":  -->  "3_modificar.php"
									?id=".$id."	    			  -->  Envia una variable, con el id del registro que 
																       se ha presionado, hacia el mismo "archivo". 
							*/
					}?>
				</table>
				<input type=submit value=Eliminar >
					<!-- Este boton abre el "archivo "4_delete.php"
			     		 Envia el arrego "eliminar[]" hacia ese mismo "archivo""-->
			</form>	
		</section>
	</body>
</html>