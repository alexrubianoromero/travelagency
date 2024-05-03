<?php
session_start();
include('../valotablapc.php');

$sql_actualizar_tarifa = "update $tarifas  set 
id_hotel = '".$_REQUEST['id_hotel']."'
,id_destino = '".$_REQUEST['id_destino']."'
,sencilla = '".$_REQUEST['sencilla']."'
,doble = '".$_REQUEST['doble']."'
,triple = '".$_REQUEST['triple']."'
,nino = '".$_REQUEST['nino']."'
,infante = '".$_REQUEST['infante']."'
,vigencia = '".$_REQUEST['vigencia']."'
,plan = '".$_REQUEST['plan']."'

,impuestos_sencilla = '".$_REQUEST['impuestos_sencilla']."'
,impuestos_doble = '".$_REQUEST['impuestos_doble']."'
,impuestos_triple = '".$_REQUEST['impuestos_triple']."'
,impuestos_nino = '".$_REQUEST['impuestos_nino']."'
,impuestos_infante = '".$_REQUEST['impuestos_infante']."'


,cargos_sencilla = '".$_REQUEST['cargos_sencilla']."'
,cargos_doble= '".$_REQUEST['cargos_doble']."'
,cargos_triple = '".$_REQUEST['cargos_triple']."'
,cargos_nino = '".$_REQUEST['cargos_nino']."'
,cargos_infante = '".$_REQUEST['cargos_infante']."'




where id_tarifa = '".$_REQUEST['id_tarifa']."'
";

$consulta_actualizar_tarifa = mysql_query($sql_actualizar_tarifa,$conexion);

//include('mostrar_tarifas.php');
?>