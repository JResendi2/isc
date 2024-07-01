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
header("content-Type: application/xls");
header("content-Disposition: attachment; filenamedoc_exportado.xls");
?>

<table>
 <tr>
  <th> id </th>
  <th> nombre </th>
  <th> usuario </th>
  <th> contraseña </th>
  <th> numtelefono </th>
</tr>
   <?php
   include("conexion.php");
  // session_start();

   //$id = $_session["id"];
  

   $sql_perfil = "select id,nombre,usuario,contraseña,numtelefono from usuarios  where usuarios.id = ".$id;
  
   $resultado = mysqli_query($conexion,$sql_perfil);
   while($registro = mysqli_fetch_array($resultado)){
   ?>

   <tr>
    <td><?php echo $registro[0] ?></td>
    <td><?php echo $registro[1] ?></td>
    <td><?php echo $registro[2] ?></td>
    <td><?php echo $registro[3] ?></td>
    <td><?php echo $registro[4] ?></td>
    </tr>

    <?php } ?>
    </table>




   