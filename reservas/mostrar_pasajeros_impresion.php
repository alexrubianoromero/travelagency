<?php

function mostrar_pasajeros_impresion($id_reserva)
{
include('../valotablapc.php');
include('../funciones_summers.php');	
$ancho="80%";
$sql_pasajeros_reserva = "select * from $item_pasajeros_reserva  where id_reserva = '".$id_reserva."'  ";

//echo '<br>'.$sql_pasajeros_reserva;
$con_pasajeros = mysql_query($sql_pasajeros_reserva,$conexion);


$item= 1;
while($pasajeros = mysql_fetch_assoc($con_pasajeros))
{
  echo '<tr>';
  echo '<td align="center">'.$item.'</td>';
  echo '<td align="right">'.$pasajeros['apellidos'].'</td>';
   echo '<td align="right" >'.$pasajeros['nombres'].'</td>';
    echo '<td align="right" >'.$pasajeros['identificacion'].'</td>';
     echo '<td align="right" >'.$pasajeros['fecha_nacimiento'].'</td>';
  echo '</tr>';
  $item++;
}//FIN DE WHILE

}//fin de la funcion

?>

