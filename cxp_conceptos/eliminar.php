<?php
session_start();
include('../valotablapc.php');



$sql_eliminar = "delete from $cxp_conceptos where id_concepto = '".$_REQUEST['id_hotel']."'   ";
$consulta_eliminar = mysql_query($sql_eliminar,$conexion);

echo '<br>Eliminado';
?>