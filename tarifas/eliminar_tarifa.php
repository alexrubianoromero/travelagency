<?php
session_start();
include('../valotablapc.php');

$sql_eliminar_tarifa = "delete from $tarifas where id_tarifa = '".$_REQUEST['id_tarifa']."'    ";

$consulta_eliminar_tarifa = mysql_query($sql_eliminar_tarifa,$conexion);


echo '<br>ELIMINADO';

?>