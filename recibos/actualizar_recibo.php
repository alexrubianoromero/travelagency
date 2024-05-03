<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');
include('../funciones_summers.php');

$datos_reserva=  consulta_assoc($reservas,'id_reserva',$_REQUEST['id_reserva'],$conexion);


$suma_recibo = $_REQUEST['efectivo'] + $_REQUEST['consignacion'] +  $_REQUEST['tarjeta'];
$diferencia_anterior_ahora   = $_REQUEST['valor']  -  $suma_recibo;
$sql_actualizar_recibo  = "update $recibos set 
efectivo = '".$_REQUEST['efectivo']."'
,consignacion = '".$_REQUEST['consignacion']."'
,tarjeta = '".$_REQUEST['tarjeta']."'
,valor = '".$suma_recibo."'
where id_recibo = '".$_REQUEST['id_recibo']."'
";

$consulta_actualizar_recibo = mysql_query($sql_actualizar_recibo,$conexion);

/*
echo '<br>valor anterior'.$_REQUEST['valor'];
echo '<br>valor nuevo'.$suma_recibo;
echo '<br>diferencia'.$diferencia_anterior_ahora;
echo '<br>'.$sql_actualizar_recibo;
*/
///actualizar el valor del saldo de la reserva 
$saldo_anterior_reserva = $datos_reserva['saldo_reserva'];
$nuevo_saldo_reserva = $saldo_anterior_reserva +  $diferencia_anterior_ahora;
/*
echo '<br>nuevo_saldo_anterior '.$saldo_anterior_reserva;
echo '<br>nuevo_saldo_reserva '.$nuevo_saldo_reserva;
*/
$sql_actualizar_saldo_reserva = "update $reservas set saldo_reserva = '".$nuevo_saldo_reserva."'   where id_reserva = '".$_REQUEST['id_reserva']."'  ";

$consulta_actualizar_saldo_reserva = mysql_query($sql_actualizar_saldo_reserva,$conexion);

?>
<h2>RECIBO ACTUALIZADO</h2>
<h2>SALDO RESERVA ACTUALIZADO</h2>