<?php
session_start();
include('../valotablapc.php');
$sql_grabar = "insert into $impuestos (nombre,id_destino,sencilla,doble,triple,nino,infante)

values(
'".$_REQUEST['nombre']."'
,'".$_REQUEST['id_destino']."'
,'".$_REQUEST['sencilla']."'
,'".$_REQUEST['doble']."'
,'".$_REQUEST['triple']."'
,'".$_REQUEST['nino']."'
,'".$_REQUEST['infante']."'

	);
";
echo  '<br>'.$sql_grabar;
$cons_grabar_producto = mysql_query($sql_grabar,$conexion);

?>
GRABACION REALIZADA
