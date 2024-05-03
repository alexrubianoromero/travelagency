<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');

$fecha_hora_actual = date('Y-m-d H:i:s'); 
$sql_grabar = "insert into $historial_cambios  (id_reserva,observaciones,fechahora,id_usuario)  
values (
'".$_REQUEST['id_reserva']."'
,'".$_REQUEST['comentario']."'
,'".$fecha_hora_actual."'
,'".$_SESSION['id_usuario']."'
) ";

//echo '<br>'.$sql_grabar;
$con_grabar = mysql_query($sql_grabar,$conexion);
?>