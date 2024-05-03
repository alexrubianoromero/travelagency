<?php
session_start();
include('../valotablapc.php');



$sql_eliminar = "delete from $facturas_proforma where id_factura = '".$_REQUEST['id_factura']."'   ";
$consulta_eliminar = mysql_query($sql_eliminar,$conexion);

echo '<br>Eliminado';
?>