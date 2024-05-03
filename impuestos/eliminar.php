<?php
session_start();
include('../valotablapc.php');



$sql_eliminar = "delete from $impuestos where id_impuesto = '".$_REQUEST['id_hotel']."'   ";
$consulta_eliminar = mysql_query($sql_eliminar,$conexion);

echo '<br>Eliminado';
?>