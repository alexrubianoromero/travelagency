<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_grabar_cuenta = "insert into $cxp_proveedores 
(id_proveedor,concepto,fecha,valor_total,saldo,documento,destino,id_reserva,id_concepto)
values('".$_REQUEST['id_proveedor']."'
	,'".$_REQUEST['concepto']."'
	,'".$_REQUEST['fecha']."'
	,'".$_REQUEST['valor']."'
	,'".$_REQUEST['valor']."'
	,'".$_REQUEST['documento']."'
	,'".$_REQUEST['destino']."'
	,'".$_REQUEST['id_reserva']."'
	,'".$_REQUEST['id_concepto']."'
	)";
$con_grabar = mysql_query($sql_grabar_cuenta,$conexion);
?>