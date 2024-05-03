<?php
session_start();
include('../valotablapc.php');
$sql_grabar = "insert into $cxp_conceptos (nombre_concepto
	)

values(
'".$_REQUEST['nombre']."'
	);
";
//echo  '<br>'.$sql_grabar;
$cons_grabar_producto = mysql_query($sql_grabar,$conexion);

?>
GRABACION REALIZADA
