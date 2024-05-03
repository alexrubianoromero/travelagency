<?php
session_start();
include('../valotablapc.php');



$sql_eliminar = "delete from $destinos where id_destino = '".$_REQUEST['id_destino']."'   ";
$consulta_eliminar = mysql_query($sql_eliminar,$conexion);

echo '<br>Eliminado';
?>