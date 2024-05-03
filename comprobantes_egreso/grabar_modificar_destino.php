<?php
session_start();
include('../valotablapc.php');

/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
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

if($_REQUEST['valor_anterior'] != $_REQUEST['valor'] )
{
	//traer saldo de la cxp
	$sql_saldo = "select saldo from $cxp_proveedores where id_cxp = '".$_REQUEST['id_cxp']."'  ";
	$con_saldo = mysql_query($sql_saldo,$conexion);
	$arr_saldo = mysql_fetch_assoc($con_saldo);
	$nuevo_saldo = $arr_saldo['saldo'] +  $_REQUEST['valor_anterior'] - $_REQUEST['valor'];

	$sql_actu_saldo = "update $cxp_proveedores set saldo = '".$nuevo_saldo."'   where id_cxp = '".$_REQUEST['id_cxp']."'  ";
	$con_act = mysql_query($sql_actu_saldo,$conexion);

//echo '<br>'.$sql_actu_saldo;
}


echo 'MODIFICADO OK';



?>