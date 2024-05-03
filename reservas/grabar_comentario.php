<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');

$fechapan12 =  time();
$fechapan12 =  date ( "Y/m/j" , $fechapan12 );

$sql_grabar = "insert into $comentarios_reserva  (id_reserva,comentario,fecha,id_usuario)  
values (
'".$_REQUEST['id_reserva']."'
,'".$_REQUEST['comentario']."'
,'".$fechapan12."'
,'".$_SESSION['id_usuario']."'
) ";

//echo '<br>'.$sql_grabar;
$con_grabar = mysql_query($sql_grabar,$conexion);
?>