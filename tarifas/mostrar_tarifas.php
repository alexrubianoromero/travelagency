<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $tarifas order by id_tarifa desc ";
$con_productos = mysql_query($sql_productos,$conexion);

?>
<html>
<head>
	<title></title>
  <meta charset ="UTF-8">
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<table class="formato_tabla">

<?php

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		
      echo '<thead>';
   echo '<tr>';
  echo '<td>VIGENCIA </td>';
  echo '<td>PLAN </td>';
    echo '<td>DESTINO </td>';
    echo '<td>HOTEL </td>';
    echo '<td> TIPO</td>';
    echo '<td> VALOR</td>';
    echo '<td>IMPUESTOS  </td>';
    echo '<td>NOCHE_ADICIONAL </td>';
    echo '<td>TOTAL</td>';
    echo '<td> MODIFICAR</td>';
    echo '<td> ELIMINAR</td>';
    echo '</tr>';
   echo '</thead>'; 



      $hotel = consulta_assoc44($hoteles,'id_hotel',$productos['id_hotel'],$conexion);
      $destino = consulta_assoc44($destinos,'id_destino',$productos['id_destino'],$conexion);

      //////////////////////suma total tarifa
      $total_sencilla = $productos['sencilla'] + $productos['cargos_sencilla']+$productos['impuestos_sencilla'];
      $total_doble = $productos['doble']+$productos['cargos_doble']+$productos['impuestos_doble'];
      $total_triple = $productos['triple']+$productos['cargos_triple']+$productos['impuestos_triple'];
      $total_nino  = $productos['nino']+$productos['cargos_nino']+$productos['impuestos_nino'] ;
      $total_infante = $productos['infante'] + $productos['cargos_infante']  + $productos['impuestos_infante'];
      //////////////////////////////////////////////
       
      echo '<tr>';
  		echo '<td>'.$productos['vigencia'].'</td>';
      echo '<td>'.$productos['plan'].'</td>';
      echo '<td>'.$destino['nombre'].'</td>';
      echo '<td>'.$hotel['nombre'].'</td>';
      echo '<td> SENCILLA</td>';

      echo '<td align="right">'.number_format($productos['sencilla'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['impuestos_sencilla'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['cargos_sencilla'], 0, ',', '.').'</td>';
       echo '<td align="right">'.number_format($total_sencilla, 0, ',', '.').'</td>';
       echo '<td><a href ="modificar_tarifa.php?id_tarifa='.$productos['id_tarifa'].'" >Modificar</a></td>';
      echo '<td><a href ="eliminar_tarifa.php?id_tarifa='.$productos['id_tarifa'].'" >Eliminar</a></td>';


       echo '</tr>';
       echo '<tr>';
       echo '<td></td>';
        echo '<td></td>';
         echo '<td></td>';
          echo '<td></td>';
           echo '<td>DOBLE</td>';
      echo '<td align="right">'.number_format($productos['doble'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['impuestos_doble'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['cargos_doble'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($total_doble, 0, ',', '.').'</td>';
       echo '</tr>';
       echo '<tr>';
 echo '<td></td>';
        echo '<td></td>';
         echo '<td></td>';
          echo '<td></td>';
           echo '<td>TRIPLE</td>';
      echo '<td align="right">'.number_format($productos['triple'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['impuestos_triple'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['cargos_triple'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($total_triple, 0, ',', '.').'</td>';
       echo '</tr>';

        echo '</tr>';
       echo '<tr>';
 echo '<td></td>';
        echo '<td></td>';
         echo '<td></td>';
          echo '<td></td>';
           echo '<td>NINO</td>';
      echo '<td align="right">'.number_format($productos['nino'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['impuestos_nino'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['cargos_nino'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($total_nino, 0, ',', '.').'</td>';
       echo '</tr>';

          echo '<tr>';
 echo '<td></td>';
        echo '<td></td>';
         echo '<td></td>';
          echo '<td></td>';
           echo '<td>INFANTE</td>';
      echo '<td align="right">'.number_format($productos['infante'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['impuestos_infante'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($productos['cargos_infante'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($total_infante, 0, ',', '.').'</td>';

      
  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>


<?php
  function  consulta_assoc44($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>