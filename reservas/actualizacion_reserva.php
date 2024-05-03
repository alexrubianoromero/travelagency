<?php
session_start();
//$fecha_hora_actual = date('Y-m-d H:i:s'); 
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');
///include('../funciones_summers.php');

function  consulta_assoc12345($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

 function traer_idcliente($tabla,$identidad,$conexion){
      $sql_cliente= "select * from $tabla where identi = '".$identidad."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $identi = $arr_cliente['idcliente'];
      return  $identi;
  }


$datos_reserva = consulta_assoc12345($reservas,'id_reserva',$_REQUEST['id_reserva'],$conexion);
///al parecer se borra el numero del contrato cuando se actualiza entonces 
//poner una condicion si el no contrato que llega esta en blanco
//entonces se coloca el no_contrato2

//if()

$idcliente_ven =  traer_idcliente($tabla3,$_REQUEST['identi_asesor'],$conexion);
$idcliente_director =  traer_idcliente($tabla3,$_REQUEST['identificacion_director_comercial'],$conexion);
$idcliente_cli =  traer_idcliente($tabla3,$_REQUEST['identidad_cliente'],$conexion);


//$datos_reserva = consulta_assoc12345($tabla,$campo,$parametro,$conexion);
///buscar el porcentaje de la comision de acuerdo al tipo de destino y calcular la comision 
//sobre el valor del contrato sin impuestos
$datos_tipo_destino = consulta_assoc12345($tipo_destino,'id_tipo_destino',$_REQUEST['id_tipo_destino'],$conexion);

$valor_comision = ($_REQUEST['total_sin_impuestos'] *  $datos_tipo_destino['comision'])/100;

//,cant_adultos ,cant_ninos,cant_infantes,
//,id_tipo_habitacion = ,'".$_REQUEST['id_tipo_habitacion']."'
//,id_forma_pago = '".$_REQUEST['id_forma_pago']."'
$sql_actualizar_reserva = "  update $reservas  
set no_contrato = 	'".$no_contrato."'
,id_vendedor = '".$idcliente_ven."'
,id_director_comercial= '".$idcliente_director."'
,oficina = '".$_REQUEST['oficina']."'
,id_cliente = '".$idcliente_cli."'
,ciudad_origen = '".$_REQUEST['ciudad_origen']."'
,ciudad_destino = '".$_REQUEST['ciudad_destino']."'
,fecha_salida = '".$_REQUEST['fecha_salida']."'
,fecha_regreso = '".$_REQUEST['fecha_regreso']."'
,hotel_seleccionado ='".$_REQUEST['hotel_seleccionado']."'
,noches = '".$_REQUEST['noches']."'
,id_tipo_vuelo = '".$_REQUEST['id_tipo_vuelo']."'
,id_tarifa  ='".$_REQUEST['id_tarifa']."'
,tours_incluidos =  '".$_REQUEST['tours_incluidos']."'
,contacto_asistencia = '".$_REQUEST['contacto_asistencia']."'
,email_contacto_asistencia = '".$_REQUEST['email_contacto_asistencia']."'
,celular_contacto_asistencia =  '".$_REQUEST['celular_contacto_asistencia']."'
,total= '".$_REQUEST['total']."'
,saldo_reserva = '".$_REQUEST['total']."'
,vr_inicial = '".$_REQUEST['vr_inicial']."'
,no_cuotas = '".$_REQUEST['no_cuotas']."'
,vr_cuota_mensual = '".$_REQUEST['vr_cuota_mensual']."'
,vr_efectivo = '".$_REQUEST['vr_efectivo']."'
,vr_cons_trans = '".$_REQUEST['vr_cons_trans']."'
,vr_tarjeta = '".$_REQUEST['vr_tarjeta']."'
,id_tipo_venta = '".$_REQUEST['id_tipo_venta']."'
,sucursal = '".$_REQUEST['sucursal']."'

,id_estado = '".$_REQUEST['id_estado']."'
,crucero ='".$_REQUEST['crucero']."'
,dias ='".$_REQUEST['dias']."'
,id_usuario_registro ='".$_REQUEST['id_usuario_registro']."'	
,fecha_creacion = '".$_REQUEST['fecha_creacion']."'
,id_quien_recibe = '".$_REQUEST['id_quien_recibe']."'
,id_quien_confirma = '".$_REQUEST['id_quien_confirma']."'
,no_hab_sencillas ='".$_REQUEST['no_hab_sencillas']."'
,no_hab_dobles ='".$_REQUEST['no_hab_dobles']."'
,no_hab_triples = '".$_REQUEST['no_hab_triples']."'	
,no_hab_ninos = '".$_REQUEST['no_hab_ninos']."'
,no_hab_infantes = '".$_REQUEST['no_hab_infantes']."'	
,id_tipo_destino = '".$_REQUEST['id_tipo_destino']."'
,total_sin_impuestos = '".$_REQUEST['total_sin_impuestos']."'	
,porcen_comision = '".$datos_tipo_destino['comision']."'	
,vr_comision = '".$valor_comision."'	
,porcentaje_cuota_inicial = '".$_REQUEST['valor_porcentaje_cuota_inicial']."' 

where id_reserva =  '".$_REQUEST['id_reserva']."'
";

//echo '<br>'.$sql_actualizar_reserva;
/////////////////////////////////
$consulta_actualizar_reserva = mysql_query($sql_actualizar_reserva,$conexion);

//////////////////////////////
///actaulizar liquidacion reserva 

$sql_actualizar_liquidacion_reserva  =  "
update    $liquidacion_reserva set 
valor_por_pasajero_sencilla = '".$_REQUEST['valor_por_pasajero_sencilla']."'
,valor_por_pasajero_doble = '".$_REQUEST['valor_por_pasajero_doble']."'
,valor_por_pasajero_triple = '".$_REQUEST['valor_por_pasajero_triple']."'
,valor_por_pasajero_nino  =  '".$_REQUEST['valor_por_pasajero_nino']."'
,valor_por_pasajero_infante = '".$_REQUEST['valor_por_pasajero_infante']."'
,impuestos_sencilla = '".$_REQUEST['impuestos_sencilla']."'
,impuestos_doble  = '".$_REQUEST['impuestos_doble']."'
,impuestos_triple = '".$_REQUEST['impuestos_triple']."'
,impuestos_nino = '".$_REQUEST['impuestos_nino']."'
,impuestos_infante = '".$_REQUEST['impuestos_infante']."'

,tours_adicionales_sencilla = '".$_REQUEST['tours_adicionales_sencilla']."'

,tours_adicionales_doble = '".$_REQUEST['tours_adicionales_doble']."'

,tours_adicionales_triple = '".$_REQUEST['impuestos_triple']."'

,tours_adicionales_nino =  '".$_REQUEST['impuestos_nino']."'

,tours_adicionales_infante = '".$_REQUEST['tours_adicionales_infante']."'

,noches_adicionales_sencilla = '".$_REQUEST['noches_adicionales_sencilla']."'

,noches_adicionales_doble =  '".$_REQUEST['noches_adicionales_doble']."'

,noches_adicionales_triple = '".$_REQUEST['noches_adicionales_triple']."'

,noches_adicionales_nino = '".$_REQUEST['noches_adicionales_nino']."'
,noches_adicionales_infante = '".$_REQUEST['noches_adicionales_infante']."'
,totalxpersona_sencilla =  '".$_REQUEST['totalxpersona_sencilla']."'
,totalxpersona_doble = '".$_REQUEST['totalxpersona_doble']."'
,totalxpersona_triple = '".$_REQUEST['totalxpersona_triple']."'
,totalxpersona_nino  =  '".$_REQUEST['totalxpersona_nino']."'
,totalxpersona_infante = '".$_REQUEST['totalxpersona_infante']."'
,cantidad_personas_sencilla = '".$_REQUEST['cantidad_personas_sencilla']."'

,cantidad_personas_doble = '".$_REQUEST['cantidad_personas_doble']."'
,cantidad_personas_triple =  '".$_REQUEST['cantidad_personas_triple']."'
,cantidad_personas_nino = '".$_REQUEST['cantidad_personas_nino']."'
,cantidad_personas_infante =  '".$_REQUEST['cantidad_personas_infante']."'
,totalxacomodacion_sencilla = '".$_REQUEST['totalxacomodacion_sencilla']."'
,totalxacomodacion_doble =  '".$_REQUEST['totalxacomodacion_doble']."'
,totalxacomodacion_triple =  '".$_REQUEST['totalxacomodacion_triple']."'
,totalxacomodacion_nino  =  '".$_REQUEST['totalxacomodacion_nino']."'
,totalxacomodacion_infante = '".$_REQUEST['totalxacomodacion_infante']."'

where id_reserva = '".$_REQUEST['id_reserva']."' 
";
//echo '<br>'.$sql_actualizar_liquidacion_reserva;

$consulta_actualizar_liquidacion_reserva = mysql_query($sql_actualizar_liquidacion_reserva,$conexion);
echo '<br><h2>RESERVA ACTUALIZADA</h2>';
?>