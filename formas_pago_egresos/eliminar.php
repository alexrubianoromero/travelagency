<?php
session_start();
include('../valotablapc.php');



$sql_eliminar = "delete from $formas_pago_egresos where id_forma_pago_egreso = '".$_REQUEST['id_hotel']."'   ";
$consulta_eliminar = mysql_query($sql_eliminar,$conexion);

echo '<br>Eliminado';
?>