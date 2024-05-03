<?php

function mostrar_pasajeros($id_reserva)
{
include('../valotablapc.php');
include('../funciones_summers.php');	
$ancho="80%";
$sql_pasajeros_reserva = "select * from $item_pasajeros_reserva  where id_reserva = '".$id_reserva."'  ";

//echo '<br>'.$sql_pasajeros_reserva;
$con_pasajeros = mysql_query($sql_pasajeros_reserva,$conexion);
echo '<table border = "1" width="'.$ancho.'">';
echo '<tr>';
echo '<td>#PAX</td>';
echo '<td>APELLIDOS</td>';
echo '<td>NOMBRES</td>';
echo '<td># IDENTIFICACION</td>';
echo '<td>FECHA NACIMIENTO</td>';
echo '<td>ACCION</td>';
echo '</tr>';
$item= 1;
while($pasajeros = mysql_fetch_assoc($con_pasajeros))
{
  echo '<tr>';
  echo '<td>'.$item.'</td>';
  echo '<td>'.$pasajeros['apellidos'].'</td>';
   echo '<td>'.$pasajeros['nombres'].'</td>';
    echo '<td>'.$pasajeros['identificacion'].'</td>';
     echo '<td>'.$pasajeros['fecha_nacimiento'].'</td>';
     echo '<td><button type = "button" id = "eliminar" class="eliminar btn_especial" value = "'.$pasajeros['id_item_pasajero'].'" > Eliminar Pasajero</button></td>';
  echo '</tr>';
  $item++;
}
echo '</table>';
}//fin de la funcion

?>

