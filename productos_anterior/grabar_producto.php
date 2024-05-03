<?php
session_start();
include('../valotablapc.php');
$sql_grabar = "insert into $productos (nombre,tiquetes,alojamiento,alimentacion,traslado,
	asistencia_medica,impuestos,valor,id_tipo_alimentacion,id_tipo_habitacion,observaciones,
codigo_producto
	)

values(
'".$_REQUEST['nombre']."',
'".$_REQUEST['tiquetes']."',
'".$_REQUEST['alojamiento']."',
'".$_REQUEST['alimentacion']."',
'".$_REQUEST['traslado']."',
'".$_REQUEST['asistencia_medica']."',
'".$_REQUEST['impuestos']."',
'".$_REQUEST['valor']."',
'".$_REQUEST['id_tipo_alimentacion']."',
'".$_REQUEST['id_tipo_habitacion']."',
'".$_REQUEST['observaciones']."',
'".$_REQUEST['codigo_producto']."'
	);
";
//echo  '<br>'.$sql_grabar;
$cons_grabar_producto = mysql_query($sql_grabar,$conexion);

?>
GRABACION REALIZADA
