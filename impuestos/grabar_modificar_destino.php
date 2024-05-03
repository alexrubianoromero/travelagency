<?php
session_start();
include('../valotablapc.php');

$sql_modificar = "update $impuestos 
set nombre = '".$_REQUEST['nombre']."' 
, id_destino = '".$_REQUEST['id_destino']."' 
, sencilla = '".$_REQUEST['sencilla']."' 
,doble = '".$_REQUEST['doble']."' 
, triple = '".$_REQUEST['triple']."' 
, nino = '".$_REQUEST['nino']."' 
, infante = '".$_REQUEST['infante']."' 


 where id_impuesto = '".$_REQUEST['id_impuesto']."'  ";
//echo '<br>'.$sql_modificar;
$consulta_modif = mysql_query($sql_modificar,$conexion); 


echo 'MODIFICADO OK';



?>