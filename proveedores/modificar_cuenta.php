<?php
include('../valotablapc.php');

$sql_modif = "update $cxp_proveedores    set
id_concepto = '".$_REQUEST['id_concepto']."'
,documento = '".$_REQUEST['documento']."'
,destino = '".$_REQUEST['destino']."'
where  id_cxp = '".$_REQUEST['id_cxp']."'

 ";
$con_modif = mysql_query($sql_modif,$conexion);

//echo '<br>'.$sql_modif;

echo '<br>MODIFICADO ';
?>