<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $cxp_conceptos  ";
$con_productos = mysql_query($sql_productos,$conexion);



  function  consulta_assoc_dest($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<table class="formato_tabla">
  <thead>
<?php
	echo '<tr>';
  		echo '<td>ID_CONCEPTO</td>';
        echo '<td>CONCEPTO</td>';
      echo '<td>MODIFICAR</td>';
       echo '<td>ELIMINAR</td>';
  
  		
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		
    $arr_destino = consulta_assoc_dest($destinos,'id_destino',$productos['id_destino'],$conexion);

      echo '<tr>';
  		echo '<td>'.$productos['id_concepto'].'</td>';
       echo '<td>'.$productos['nombre_concepto'].'</td>';  
      
      echo '<td>';
      echo '<a  href="modificar.php?id_hotel='.$productos['id_concepto'].'&nombre='.$productos['nombre_concepto'].'  ">Modificar</a>';
      echo '</td>';
      
       echo '<td>';
       echo '<a  href="eliminar.php?id_hotel='.$productos['id_concepto'].' ">Eliminar</a>';
      echo '</td>';

  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>