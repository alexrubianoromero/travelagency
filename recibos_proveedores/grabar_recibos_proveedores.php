<?php
session_start();
include('../valotablapc.php');

////////////////traer el numero actual de los egresos
$sql_empresa = "select * from $tabla10 ";
$consulta_empresa = mysql_query($sql_empresa,$conexion);
$datos_empresa = mysql_fetch_assoc($consulta_empresa);
$numero_actual_egreso =  $datos_empresa['contador_egresos'];
$siguiente_numero = $numero_actual_egreso + 1;

//////////////////////
/// se le coloca  el numero 2 en id_tipo_egreso porque 
/// el 2 es egreso de proveedores

////////////////verificar que no exista este recibo
////////////////para que no lo vaya a grabar varias veces
$sql_buscar_recibo = "select * from $recibos_proveedores  
where 
id_cxp = '".$_REQUEST['id_cxp']."' 
and fecha = '".$_REQUEST['fecha']."' 
and observaciones  = '".$_REQUEST['observaciones']."'
and valor = '".$_REQUEST['valor']."'
and id_forma_pago = '".$_REQUEST['id_forma_pago']."'
and id_usuario_creacion =  '".$_SESSION['id_usuario']."'
 ";
$con_buscar = mysql_query($sql_buscar_recibo,$conexion);
$filas_recibo = mysql_num_rows($con_buscar);
/////////////////////////////////////
if($filas_recibo < 1)
{	
			$sql_grabar = "insert into $recibos_proveedores    
			(id_cxp,fecha,observaciones,valor,id_tipo_egreso,id_forma_pago,no_egreso,id_usuario_creacion)

			values (
			'".$_REQUEST['id_cxp']."'
			,'".$_REQUEST['fecha']."'
			,'".$_REQUEST['observaciones']."'
			,'".$_REQUEST['valor']."'
			,'2'
			,'".$_REQUEST['id_forma_pago']."'
			,'".$siguiente_numero."'
			,'".$_SESSION['id_usuario']."'
			)";

			$grabar_recibo = mysql_query($sql_grabar,$conexion);

			//echo '<br>'.$sql_grabar.'<br>';
			//exit();
			////////////////////////////////////actualizar el contador en empresa
			$sql_actualizar_contador = "update $tabla10 set contador_egresos  = '".$siguiente_numero."'     ";
			$con_actu_contador = mysql_query($sql_actualizar_contador,$conexion);

			//afectar el saldo de la cuanta proveedor 
			///traer el saldo actual de la cuenta 
			$datos_cuenta_proveedor = consulta_assoc($cxp_proveedores,'id_cxp',$_REQUEST['id_cxp'],$conexion);
			$saldo_actual_cuenta =  $datos_cuenta_proveedor['saldo'];

			$nuevo_saldo = $saldo_actual_cuenta - $_REQUEST['valor'];

			$sql_actualizar_saldo = "update $cxp_proveedores  set saldo = '".$nuevo_saldo."'  
			where id_cxp  = '".$_REQUEST['id_cxp']."'   ";

			$con_actualizar = mysql_query($sql_actualizar_saldo,$conexion);
} // fin de if($filas_recibo < 1)			
/////////////////////////////////





////////////////////////////////
  function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
////////////////////////////////
?>