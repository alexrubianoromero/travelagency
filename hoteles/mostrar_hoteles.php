<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $hoteles order by nombre ";
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
  		echo '<td>NOMBRE</td>';
        echo '<td>DESTINO</td>';
      echo '<td>MODIFICAR</td>';
       echo '<td>ELIMINAR</td>';
  
  		
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		
    $arr_destino = consulta_assoc_dest($destinos,'id_destino',$productos['id_destino'],$conexion);

      echo '<tr>';
  		echo '<td>'.$productos['nombre'].'</td>';
       echo '<td>'.$arr_destino['nombre'].'</td>';  
      
      echo '<td>';
      echo '<a  href="modificar.php?id_hotel='.$productos['id_hotel'].'&nombre='.$productos['nombre'].'  ">Modificar</a>';
      echo '</td>';
      
       echo '<td>';
       echo '<a  href="eliminar.php?id_hotel='.$productos['id_hotel'].' ">Eliminar</a>';
      echo '</td>';

  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>