<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $productos  ";
$con_productos = mysql_query($sql_productos,$conexion);

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
  		echo '<td>TIQUETES</td>';
  		echo '<td>ALOJAMIENTO</td>';
  		//echo '<td>habitacion</td>';
  		echo '<td>TRASLADO</td>';
  		echo '<td>ASISTENCIA_MEDICA</td>';
  		echo '<td>IMPUESTOS</td>';
  		echo '<td>VALOR</td>';
  		
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		echo '<tr>';
  		echo '<td>'.$productos['nombre'].'</td>';
  		echo '<td>'.$productos['tiquetes'].'</td>';
  		echo '<td>'.$productos['alojamiento'].'</td>';
  		//echo '<td>'.$productos['habitacion'].'</td>';
  		echo '<td>'.$productos['traslado'].'</td>';
  		echo '<td>'.$productos['asistencia_medica'].'</td>';
  		echo '<td>'.$productos['impuestos'].'</td>';
  		echo '<td align="right">'.number_format($productos['valor'], 0, ',', '.').'</td>';

  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>