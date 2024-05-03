<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_eliminar_recibo = "delete from $recibos where id_recibo = '".$_REQUEST['id_recibo']."'  ";
//echo '<br>'.$sql_eliminar_recibo;
$consulta_eliminar = mysql_query($sql_eliminar_recibo,$conexion);

/////////////////
$datos_reserva=  consulta_assoc($reservas,'id_reserva',$_REQUEST['id_reserva'],$conexion);
//$datos_reserva=  consulta_assoc($reservas,'id_reserva',$datos_recibo['id_reserva'],$conexion);

//echo 'saldo reserva<br>' .$datos_reserva['saldo_reserva'];

////si el recibo se elimina se debe sumar este valor al saldo de la reserva 
$nuevo_saldo_reserva = $datos_reserva['saldo_reserva']  +   $_REQUEST['valor'];

$sql_actualizar_saldo_reserva = "update $reservas set saldo_reserva = '".$nuevo_saldo_reserva."'   
 where  id_reserva = '".$_REQUEST['id_reserva']."'  ";

//echo '<br>'.$sql_actualizar_saldo_reserva;

$consulta_actualizar_saldo_reserva = mysql_query($sql_actualizar_saldo_reserva,$conexion);

?>
<h2>RECIBO ELIMINADO  </h2>
<h2>SALDO RESERVA ACTUALIZADO  </h2>