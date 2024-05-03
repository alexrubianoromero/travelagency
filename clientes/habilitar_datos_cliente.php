<?php

include('../valotablapc.php');
//revisar que este cliente no tenga ligado ningun vehiculo 

$sql_revisar_ciente = "select  cli.identi,cli.nombre  from $tabla3 as cli 

where cli.idcliente = '".$_REQUEST['idcliente']."'
";

//echo '<br>'.$sql_revisar_ciente;

$consulta_revision = mysql_query($sql_revisar_ciente,$conexion);

$filas_revision = mysql_num_rows($consulta_revision);

if($filas_revision > 0)
{
$sql_anular_cliente = "update  $tabla3  set anulado = '0' where idcliente = '".$_REQUEST['idcliente']."'  ";
echo '<br>';
$consulta_anular= mysql_query($sql_anular_cliente,$conexion);
echo 'HABILITADO';
}

?>  