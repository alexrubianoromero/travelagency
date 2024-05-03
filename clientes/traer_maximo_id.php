<?php
session_start();
include('../valotablapc.php');

$sql_traer_maximo_id = "select max(idcliente) as idcliente from $tabla3";
$con_maximo_id = mysql_query($sql_traer_maximo_id,$conexion);
$arr_maximo = mysql_fetch_assoc($con_maximo_id);

echo '[{"id_cliente":"'.$arr_maximo['idcliente'].'"  }]';

?>

