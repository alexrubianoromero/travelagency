<?php
session_start();
include('../valotablapc.php');

$sql_modificar = "update $formas_pago_egresos 
set descripcion = '".$_REQUEST['nombre']."' 
 
 where id_forma_pago_egreso = '".$_REQUEST['id_hotel']."'  ";
//echo '<br>'.$sql_modificar;
$consulta_modif = mysql_query($sql_modificar,$conexion); 


echo 'MODIFICADO OK';



?>