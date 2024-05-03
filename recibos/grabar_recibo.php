<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

include('../valotablapc.php');
include('../funciones_summers.php');

$sql_grabar_recibo = "insert into $recibos (no_recibo,id_reserva,valor,id_usuario,fecha,observaciones,id_cliente,
	contador_reserva,efectivo,consignacion,tarjeta)
values(
'".$_REQUEST['no_recibo']."'
,'".$_REQUEST['id_reserva']."'
,'".$_REQUEST['valor']."'
,'".$_REQUEST['id_usuario']."'
,'".$_REQUEST['fecha']."'
,'".$_REQUEST['observaciones']."'
,'".$_REQUEST['id_cliente']."'
,'".$_REQUEST['recibo_segun_reserva']."'
,'".$_REQUEST['efectivo']."'
,'".$_REQUEST['consignacion']."'
,'".$_REQUEST['tarjeta']."'
	);
";
//echo '<br>'.$sql_grabar_recibo;
$con_grabar_recibo = mysql_query($sql_grabar_recibo,$conexion);

///actualizar el contador de recibos en empresa 

$sql_actualizar = "update $tabla10  set contarecicaja = '".$_REQUEST['no_recibo']."'  ";
$con_actualizar = mysql_query($sql_actualizar,$conexion);



//////actualizar el saldo de la reserva 
///traer el saldo actual  de la reserva 

$saldo_reserva =traer_algo_reserva($reservas,$_REQUEST['id_reserva'],'saldo_reserva',$conexion);
$nuevo_saldo_reserva = $saldo_reserva -  $_REQUEST['valor'];
//
//echo 'saldo reserva <br>'.$saldo_reserva.'<br>';
//echo 'nuevo_saldo<br>'.$nuevo_saldo_reserva;
///////actualizar saldo reserva
$sql_actualizar_reserva = "update $reservas 
set saldo_reserva = '".$nuevo_saldo_reserva."' ,
contador_recibos = '".$_REQUEST['recibo_segun_reserva']."'  
where id_reserva = '".$_REQUEST['id_reserva']."'   ";

//echo '<br>'.$sql_actualizar_reserva;
$consulta_actualizar_reserva = mysql_query($sql_actualizar_reserva,$conexion);
//tener en cuenta si se hace alguna modificacion o anulacion 
?>