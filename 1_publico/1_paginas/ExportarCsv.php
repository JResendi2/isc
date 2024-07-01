<?php
  error_reporting(-1);
  ini_set("display_errors", 1);
  include ("../0_conexion/conexion.php");

  /* sacamos las mascotas de bd */
  $query = "select * from  contenidos";

 if ($resultado = mysqli_query($conexion, $query)) 
  {
          /* creamos el array con los datos */
          $mascotas = array();
          $rowcount=mysqli_num_rows($resultado);
       
          if($rowcount >0)
                   while($animal = mysqli_fetch_assoc($resultado)) 
                      $mascotas[] = array('mascotas'=>$animal);  // Arreglo de registros (objetos)
                           
  }                     

       
  header("content-type:application/csv;charset=utf-8");
  header("Content-Disposition:attachment;filename=\"DatosCsv.csv\"");

  $ban = 1;
  foreach($mascotas as $index => $element)  // $index = indice del vector 0,1..
     if(is_array($element)) {  //Arreglo de los campos de la tabla select
      foreach($element as $key => $value)    // $key ->campo $value-> valor
         if(is_array($value)) {
            if ($ban == 1)
            {
              foreach($value as $tag => $val) 
                   echo "\"$tag\", ";
              
              $ban =0;
            }
            foreach($value as $tag => $val) {
                    echo "\"$val\",";
            }
        }
      }
                        
  mysqli_close($conexion);
?>