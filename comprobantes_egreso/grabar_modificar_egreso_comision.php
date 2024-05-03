<?php
session_start();
include('../valotablapc.php');

/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';

exit();
*/
$sql_modificar = "update $recibos_proveedores
set fecha = '".$_REQUEST['fecha']."' 
, valor = '".$_REQUEST['valor']."' 
, id_forma_pago = '".$_REQUEST['id_forma_pago']."' 
, observaciones = '".$_REQUEST['observaciones']."' 

 where id_recibo_proveedor = '".$_REQUEST['id_hotel']."'  ";
//echo '<br>'.$sql_modificar;

$consulta_modif = mysql_query($sql_modificar,$conexion); 



/////////////////arreglar el saldo  en la cxp_proveedor
//debemos guardar el valor anterior y us es diferente al que introdujo el usuario 
//se debe generar  que se sume el valor  anterior y se reste el nuevo  al saldo de la cuenta por pagar



echo 'MODIFICADO OK';



?>