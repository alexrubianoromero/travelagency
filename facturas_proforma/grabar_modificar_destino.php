<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '<pre>';
*/
$sql_modificar = "update $facturas_proforma 
set valor_proforma = '".$_REQUEST['valor_proforma']."' 
 
 where id_factura = '".$_REQUEST['id_factura']."'  ";
//echo '<br>'.$sql_modificar;
$consulta_modif = mysql_query($sql_modificar,$conexion); 


echo 'MODIFICADO OK';



?>