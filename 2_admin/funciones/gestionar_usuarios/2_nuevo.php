<!--Este archivo tiene el formulario necesario para crear una cuenta tipo docente-->

<?php
session_start(); //Se inicia una sesion
if (!isset($_SESSION['user'])) { // Verifica si existe la variable 'user' en el servidor
	//Si no existe entonce regresa al login
	header("location:../../login.html");
	exit;
}

include("../../conexion/conexion.php");

/****************************************************************** 
	| Formular la "consulta" para obtener los nombres de los docentes |
 ***************************************************************/
$sql = "select id, nombre from profesores";
$resultado_de_la_consulta = mysqli_query($conexion, $sql); // Ejecutar la consulta

$docentes = "";
/*************************************** 
	| Mostrar los registros de la consulta |
 ***************************************/
while ($registro = mysqli_fetch_array($resultado_de_la_consulta)) {

	$docente = $registro['nombre'];
	$docentes = $docentes . "<option value = '". $registro['id']. "' >  $docente </option>";
}


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
		<h3 class="subtitulo-new">Registra un nuevo usuario</h3>
		<form action='2_nuevo_insert.php' method='post' id='formularios'>
			<div style="padding: 0 10px;">

				<table class="table-new">
					<tr>
						<td>Usuario:</td>
						<td><input required type=text name='usuario' size=40></td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><input required type=password name='contraseña1' size=37></td>
					</tr>
					<tr>
						<td>Confirmar contraseña:</td>
						<td><input required type=password name='contraseña2' size=37></td>
					</tr>
					<tr>
						<td>Nombre:</td>
						<td><input required type=text name='nombre' size=37></td>
					</tr>
					<tr>
						<td>Numero de telefono:</td>
						<td><input required type=text name='telefono' size=37></td>
					</tr>
					<tr>
						<td>Elige el docente</td>
						<td>
							<?php echo "
						<select required name = 'docente'>
							$docentes
						</select>";
							?>
						</td>
					</tr>

				</table> <br><br>
			</div>
			<div class="div-btn-new">
				<input class="btn-new" type=submit value="Guardar">
				<input class="btn-new" type=reset value="Limpiar campos">
			</div>
		</form>
	</section>
</body>

</html>