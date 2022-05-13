<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    // Realizar Conexion a BD
    include ('conexion.php');
    // Realizar consulta SQL
    $consulta    = "select * from ciudades";
    echo ('<br>');
    echo ($consulta);
    $resultado   = mysqli_query($mysqli, $consulta);
    if (!$resultado){
       echo 'No pudo seleccionar la base de datos';
       exit;
     }
    // Recorer la tabla de 1 a 1
    // 1er Recorrido
    echo ('<br>');
    echo ('Primer recorrido');
    // Imprimir Resultados
    while ($filasql= mysqli_fetch_array($resultado)) {
      // Imprimir por Indice del Arreglo
      echo '<br>';
      echo $filasql[0].' ';
      echo $filasql[1].' ';
      echo $filasql[2].' ';
      echo '-';
      // Imprimir por Arreglo Asociado
      echo $filasql['id'].' ';
      echo $filasql['Nombre'].' ';
      echo $filasql['Territorio'].' ';
    }
    mysqli_close($mysqli);
?>
