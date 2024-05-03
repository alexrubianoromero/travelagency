<?php
session_start();
include('../valotablapc.php');

$sql_modificar = "update $cxp_conceptos 
set nombre_concepto = '".$_REQUEST['nombre']."' 
 
 where id_concepto = '".$_REQUEST['id_hotel']."'  ";
//echo '<br>'.$sql_modificar;
$consulta_modif = mysql_query($sql_modificar,$conexion); 


echo 'MODIFICADO OK';



?>