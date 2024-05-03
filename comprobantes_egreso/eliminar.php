<?php
session_start();
include('../valotablapc.php');

//////////////////////

function  consulta_assoc_hot($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$recibo_proveedor = consulta_assoc_hot($recibos_proveedores,'id_recibo_proveedor',$_REQUEST['id_hotel'],$conexion);
$datos_cxp = consulta_assoc_hot($cxp_proveedores,'id_cxp',$recibo_proveedor['id_cxp'],$conexion);
/////////////////////

$sql_eliminar = "delete from $recibos_proveedores where id_recibo_proveedor = '".$_REQUEST['id_hotel']."'   ";
$consulta_eliminar = mysql_query($sql_eliminar,$conexion);


//// si se elimina se debe sumar el valor del recibo al saldo por pagar del proveedor 
//
$nuevo_saldo =  $datos_cxp['saldo'] +  $recibo_proveedor['valor'];
$sql_actualizar_saldo = "update $cxp_proveedores set saldo = '".$nuevo_saldo."'    where id_cxp= '".$recibo_proveedor['id_cxp']."'   ";
$con_saldo = mysql_query($sql_actualizar_saldo,$conexion);

echo '<br>Eliminado';
?>