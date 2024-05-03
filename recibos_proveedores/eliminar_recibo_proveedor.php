<?php

include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
  function  consulta_assoc__12($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$datos_recibo_cxp= consulta_assoc__12($recibos_proveedores,'id_recibo_proveedor',$_REQUEST['id_recibo_cxp'],$conexion);
$datos_cxp = consulta_assoc__12($cxp_proveedores,'id_cxp',$datos_recibo_cxp['id_cxp'],$conexion);


//echo 'saldo_actual_cxp='.$datos_cxp['saldo'];


//eliminar el recibo
$sql_eliminar_recibo = "delete from $recibos_proveedores    where id_recibo_proveedor  = '".$_REQUEST['id_recibo_cxp']."'  ";
$consulta_eliminar = mysql_query($sql_eliminar_recibo,$conexion);
//sumarle al saldo el valor del recibo 
$nuevo_saldo = $datos_cxp['saldo'] +  $datos_recibo_cxp['valor'];

$sql_actualizar_saldo_cxp = "update $cxp_proveedores  set saldo   = '".$nuevo_saldo."'   where    id_cxp = '".$datos_recibo_cxp['id_cxp']."'  ";
$consulta_actualizar = mysql_query($sql_actualizar_saldo_cxp,$conexion);
//echo '<br>'.$sql_eliminar_recibo;
//echo '<br>'.$sql_actualizar_saldo_cxp;

echo '<BR>RECIBO ELIMINADO<BR>';
?>