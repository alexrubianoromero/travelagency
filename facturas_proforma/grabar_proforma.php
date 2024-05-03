<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
///traer el numero de  proforma de empreas 
$sql_empresa = "select * from $tabla10";
$con_empresa = mysql_query($sql_empresa,$conexion);
$arrr_empresa = mysql_fetch_assoc($con_empresa);

$siguiente_numero = $arrr_empresa['contador_preforma_facturas'] + 1;

$sql_grabar_proforma = "insert into $facturas_proforma 
(id_cxp,valor_proforma,anulado,estado,no_factura_proforma,id_tipo_proforma,fecha) 
values ('".$_REQUEST['id_cxp']."'
	,'".$_REQUEST['valor_proforma']."'
	,'0','0','".$siguiente_numero."','2','".$_REQUEST['fecha']."')
";
//echo '<br>'.$sql_grabar_proforma;
$con_grabar_proforma = mysql_query($sql_grabar_proforma,$conexion);
/////////////traer id de proforma 

$sql_max_id = "select max(id_factura) as maximo  from $facturas_proforma ";
$con_empresa_act = mysql_query($sql_max_id,$conexion);
$arr_maximo = mysql_fetch_assoc($con_empresa_act) ;
$maximo =  $arr_maximo['maximo'];
///actualizar contador empresa 
$sql_act = "update $tabla10 set contador_preforma_facturas  = '".$siguiente_numero."'  ";
$con_empresa_act = mysql_query($sql_act,$conexion);

//actualizar el numero en cxp_proveedrores 
$sql_act_cxp = "update $cxp_proveedores set id_factura_proforma  = '".$maximo ."'
where id_cxp = '".$_REQUEST['id_cxp']."'  ";
$con_empresa_act = mysql_query($sql_act_cxp,$conexion);

//echo '<br>'.$sql_act_cxp;

echo 'GRABACION EXITOSA';
?>