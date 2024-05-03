<?php
session_start();
include('../valotablapc.php');
$sql_grabar = "insert into $tarifas (vigencia,plan,id_hotel,id_destino
	,sencilla
	,impuestos_sencilla
	,cargos_sencilla
	,doble
	,impuestos_doble
	,cargos_doble
	,triple
	,impuestos_triple
	,cargos_triple
	,nino
	,impuestos_nino
	,cargos_nino
	,infante
	,impuestos_infante
	,cargos_infante
	)

values(
'".$_REQUEST['vigencia']."'
,'".$_REQUEST['plan']."'
,'".$_REQUEST['id_hotel']."'
,'".$_REQUEST['id_destino']."'
,'".$_REQUEST['sencilla']."'
,'".$_REQUEST['impuestos_sencilla']."'
,'".$_REQUEST['cargos_sencilla']."'
,'".$_REQUEST['doble']."'
,'".$_REQUEST['impuestos_doble']."'
,'".$_REQUEST['cargos_doble']."'
,'".$_REQUEST['triple']."'
,'".$_REQUEST['impuestos_triple']."'
,'".$_REQUEST['cargos_triple']."'
,'".$_REQUEST['nino']."'
,'".$_REQUEST['impuestos_nino']."'
,'".$_REQUEST['cargos_nino']."'
,'".$_REQUEST['infante']."'
,'".$_REQUEST['impuestos_infante']."'
,'".$_REQUEST['cargos_infante']."'

	);
";
//echo  '<br>'.$sql_grabar;
$cons_grabar_producto = mysql_query($sql_grabar,$conexion);

?>
GRABACION REALIZADA
