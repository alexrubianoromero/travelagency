<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/

$sql_marcar_pago = "update $reservas set comision_pagada  = '1'   where id_reserva = '".$_REQUEST['id_reserva']."'  ";
$con_marcar_pago = mysql_query($sql_marcar_pago,$conexion);

echo '<a href ="imprimir_recibo.php?id_reserva='.$_REQUEST['id_reserva'].'" >IMPRIMIR RECIBO</a>';
?>