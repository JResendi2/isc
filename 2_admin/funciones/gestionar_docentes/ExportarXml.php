<?php
  error_reporting(-1);
  ini_set("display_errors", 1);
  include ("../../conexion/conexion.php");

  /* sacamos los posts de bd */
  $query = "SELECT * FROM profesores";

 if ($resultado = mysqli_query($conexion, $query)) 
  {
          /* creamos el array con los datos */
          $mascotas = array();
          $rowcount=mysqli_num_rows($resultado);
       
          if($rowcount >0)
                   while($animal = mysqli_fetch_assoc($resultado)) 
                      $mascotas[] = array('contenido'=>$animal);  // Arreglo de registros (objetos)
                           
  }                     
 
 header('Content-type: text/xml');
 echo "<?xml version='1.0' encoding='UTF-8'?>";
 echo "<mascotas>";
 foreach($mascotas as $index => $element) 
   if(is_array($element)) {  //campos de la tabla select
      foreach($element as $key => $value) {   // $key ->campo $value-> valor
              echo "<$key>";
              if(is_array($value)) {
                      foreach($value as $tag => $val) {
                         echo "<$tag>$val</$tag>";
                      }
              }
              echo "</$key>";
     }
    }
  echo "</mascotas>";
            
  mysqli_close($conexion);
?>