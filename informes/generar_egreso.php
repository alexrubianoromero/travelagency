<?php
session_start();
//$fecha_hora_actual = date('Y-m-d H:i:s'); 
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
//exit();
include('../valotablapc.php');

  function  consulta_assoc_crear($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$datos_reserva = consulta_assoc_crear($reservas,'id_reserva',$_REQUEST['id_reserva'],$conexion);



$datos_tipo_destino = consulta_assoc_crear($tipo_destino,'id_tipo_destino',$datos_reserva['id_tipo_destino'],$conexion);

$valor_comision = ($datos_reserva['total_sin_impuestos'] *  $datos_tipo_destino['comision'])/100;


///////////////////////averiguar el numero de egreso que sigue

$sql_traer_ultimo_no_egreso_grabado = "select contador_egresos as no_egreso from $tabla10  ";
$con_egreso = mysql_query($sql_traer_ultimo_no_egreso_grabado,$conexion);
$arr_egreso = mysql_fetch_assoc($con_egreso);
$siguiente_no_egreso = $arr_egreso['no_egreso'] + 1;

//////////////////////generar el egreso de la comision
///crear el egreso en la tagbla recibos_proveedores para el egreso de la comision 


$sql_crear_egreso = "insert into $recibos_proveedores (id_cxp,valor,fecha,id_tipo_egreso,
	no_egreso,id_forma_pago,id_usuario_creacion)
values ('".$_REQUEST['id_reserva']."','".$valor_comision."','".$datos_reserva['fecha_creacion']."','1',
'".$siguiente_no_egreso."','0','".$datos_reserva['id_usuario_registro']."'
	)";
$con_creacion_egreso = mysql_query($sql_crear_egreso);


//////////////////////////////////////////////////////////
/////actualizar el contador  de egresos en empresa
$sql_actualizar_contador = "update empresa set contador_egresos  = '".$siguiente_no_egreso."' ";
$con_actualizar_contador_egreso_empresa = mysql_query($sql_actualizar_contador,$conexion);
///////////////////////////////
echo 'GENERADO';

?>