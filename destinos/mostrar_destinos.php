<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $destinos order by nombre ";
$con_productos = mysql_query($sql_productos,$conexion);

?>
<html>
<head>
	<title></title>
  <meta charser="UTF-8">
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<table class="formato_tabla">
  <thead>
<?php
	echo '<tr>';
  		echo '<td>NOMBRE </td>';
      echo '<td>MODIFICAR </td>';
      echo '<td>ELIMINAR </td>';
  
  		
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		echo '<tr>';
  		echo '<td>'.$productos['nombre'].'</td>';
      echo '<td>';
      echo '<a  href="modificar.php?id_destino='.$productos['id_destino'].'&nombre='.$productos['nombre'].'  ">Modificar</a>';
      echo '</td>';

       echo '<td>';
       echo '<a  href="eliminar.php?id_destino='.$productos['id_destino'].' ">Eliminar</a>';
      echo '</td>';

  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>