<?php
session_start();
//$fecha_hora_actual = date('Y-m-d H:i:s'); 
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');
include('../funciones_summers.php');
$idcliente_ven =  traer_idcliente($tabla3,$_REQUEST['identi_asesor'],$conexion);
$idcliente_director =  traer_idcliente($tabla3,$_REQUEST['identificacion_director_comercial'],$conexion);
$idcliente_cli =  traer_idcliente($tabla3,$_REQUEST['identidad_cliente'],$conexion);


///buscar el porcentaje de la comision de acuerdo al tipo de destino y calcular la comision 
//sobre el valor del contrato sin impuestos
$datos_tipo_destino = consulta_assoc($tipo_destino,'id_tipo_destino',$_REQUEST['id_tipo_destino'],$conexion);

$valor_comision = ($_REQUEST['total_sin_impuestos'] *  $datos_tipo_destino['comision'])/100;



///buscar en empresa el numero actual de reserva 
// sumarle uno 
//grabar reerrva con el siguietne numero 
//actualizar la tabla empresa son el numero correcto 

$sql_traer_ultima_reserva = "select contareservas from $tabla10    ";
$con_ultima = mysql_query($sql_traer_ultima_reserva,$conexion);
$arr_ultima = mysql_fetch_assoc($con_ultima);
$ultima_reserva = $arr_ultima['contareservas'];
$siguiente_reserva = $ultima_reserva + 1 ;


////////////////////////////////



$sql_grabar_reserva  = "insert into $reservas (no_contrato,no_reserva,id_vendedor,

	id_director_comercial,
	
	oficina,id_cliente,ciudad_origen,ciudad_destino,
	fecha_salida,fecha_regreso,cant_adultos,cant_ninos,cant_infantes,hotel_seleccionado,noches,id_tipo_vuelo,
	id_tipo_habitacion,id_tarifa,tours_incluidos,contacto_asistencia,email_contacto_asistencia,
	celular_contacto_asistencia,

	total,saldo_reserva,vr_inicial,no_cuotas,vr_cuota_mensual,

	vr_efectivo,vr_cons_trans,vr_tarjeta,

	id_tipo_venta,sucursal,id_forma_pago,id_estado,
	crucero,dias,id_usuario_registro,fecha_creacion,
	id_quien_recibe,id_quien_confirma,
	no_hab_sencillas,no_hab_dobles,no_hab_triples,no_hab_ninos,no_hab_infantes,
	id_tipo_destino,total_sin_impuestos,
	porcen_comision,vr_comision,porcentaje_cuota_inicial,no_contrato2
	)

values (
	'".$_REQUEST['no_contrato']."'
	,'".$_REQUEST['no_radicado']."'
	,'".$idcliente_ven."'
	,'".$idcliente_director."'
	,'".$_REQUEST['oficina']."'
	,'".$idcliente_cli."'
	,'".$_REQUEST['ciudad_origen']."'
	,'".$_REQUEST['ciudad_destino']."'
	,'".$_REQUEST['fecha_salida']."'
	,'".$_REQUEST['fecha_regreso']."'
	,'".$_REQUEST['cant_adultos']."'
	,'".$_REQUEST['cant_ninos']."'
	,'".$_REQUEST['cant_infantes']."'
	,'".$_REQUEST['hotel_seleccionado']."'
	,'".$_REQUEST['noches']."'
	,'".$_REQUEST['id_tipo_vuelo']."'
	,'".$_REQUEST['id_tipo_habitacion']."'

	,'".$_REQUEST['id_tarifa']."'
	,'".$_REQUEST['tours_incluidos']."'
	,'".$_REQUEST['contacto_asistencia']."'
	,'".$_REQUEST['email_contacto_asistencia']."'

	,'".$_REQUEST['celular_contacto_asistencia']."'
	,'".$_REQUEST['total']."'
	,'".$_REQUEST['total']."'
	,'".$_REQUEST['vr_inicial']."'
	,'".$_REQUEST['no_cuotas']."'
	,'".$_REQUEST['vr_cuota_mensual']."'


	,'".$_REQUEST['vr_efectivo']."'
	,'".$_REQUEST['vr_cons_trans']."'
	,'".$_REQUEST['vr_tarjeta']."'

	,'".$_REQUEST['id_tipo_venta']."'
	,'".$_REQUEST['sucursal']."'
	,'".$_REQUEST['id_forma_pago']."'
	,'".$_REQUEST['id_estado']."'
	,'".$_REQUEST['crucero']."'
	,'".$_REQUEST['dias']."'	
	,'".$_REQUEST['id_usuario_registro']."'	
	,'".$_REQUEST['fecha_creacion']."'	
	,'".$_REQUEST['id_quien_recibe']."'	
	,'".$_REQUEST['id_quien_confirma']."'	
	,'".$_REQUEST['no_hab_sencillas']."'	
	,'".$_REQUEST['no_hab_dobles']."'	
	,'".$_REQUEST['no_hab_triples']."'	
	,'".$_REQUEST['no_hab_ninos']."'	
	,'".$_REQUEST['no_hab_infantes']."'	
	,'".$_REQUEST['id_tipo_destino']."'	
	,'".$_REQUEST['total_sin_impuestos']."'	
	,'".$datos_tipo_destino['comision']."'	
	,'".$valor_comision."'	
	,'".$_REQUEST['porcentaje_cuota_inicial']."'
	,'".$_REQUEST['no_contrato']."'	
	);
";

//echo '<br>'.$sql_grabar_reserva;
$consulta_grabar_reserva = mysql_query($sql_grabar_reserva,$conexion);

/////////////////////traer el id de la reserva 
$sql_maximo_id = "select max(id_reserva) as id from $reservas ";
$consulta_max_id = mysql_query($sql_maximo_id,$conexion);
$arr_id = mysql_fetch_assoc($consulta_max_id);
$maximo_id = $arr_id['id'];

////////////////////////////////////grabar liquidacion reserva

$sql_grabar_liquidacion_reserva = 
"
insert into $liquidacion_reserva  (
id_reserva,	
valor_por_pasajero_sencilla,valor_por_pasajero_doble,valor_por_pasajero_triple,valor_por_pasajero_nino,
valor_por_pasajero_infante,
impuestos_sencilla,impuestos_doble,impuestos_triple,impuestos_nino,impuestos_infante,
tours_adicionales_sencilla,tours_adicionales_doble,tours_adicionales_triple,tours_adicionales_nino,tours_adicionales_infante,

noches_adicionales_sencilla,noches_adicionales_doble,noches_adicionales_triple,noches_adicionales_nino,noches_adicionales_infante,

totalxpersona_sencilla,totalxpersona_doble,totalxpersona_triple,totalxpersona_nino,totalxpersona_infante,

cantidad_personas_sencilla,cantidad_personas_doble,cantidad_personas_triple,cantidad_personas_nino,cantidad_personas_infante,

totalxacomodacion_sencilla,totalxacomodacion_doble,totalxacomodacion_triple,totalxacomodacion_nino,totalxacomodacion_infante
	)
values(
'".$maximo_id."'
,'".$_REQUEST['valor_por_pasajero_sencilla']."','".$_REQUEST['valor_por_pasajero_doble']."'
,'".$_REQUEST['valor_por_pasajero_triple']."','".$_REQUEST['valor_por_pasajero_nino']."'
,'".$_REQUEST['valor_por_pasajero_infante']."'

,'".$_REQUEST['impuestos_sencilla']."','".$_REQUEST['impuestos_doble']."'
,'".$_REQUEST['impuestos_triple']."','".$_REQUEST['impuestos_nino']."'
,'".$_REQUEST['impuestos_infante']."'

,'".$_REQUEST['tours_adicionales_sencilla']."','".$_REQUEST['tours_adicionales_doble']."'
,'".$_REQUEST['tours_adicionales_triple']."','".$_REQUEST['tours_adicionales_nino']."'
,'".$_REQUEST['tours_adicionales_infante']."'

,'".$_REQUEST['noches_adicionales_sencilla']."','".$_REQUEST['noches_adicionales_doble']."'
,'".$_REQUEST['noches_adicionales_triple']."','".$_REQUEST['noches_adicionales_nino']."'
,'".$_REQUEST['noches_adicionales_infante']."'

,'".$_REQUEST['totalxpersona_sencilla']."','".$_REQUEST['totalxpersona_doble']."'
,'".$_REQUEST['totalxpersona_triple']."','".$_REQUEST['totalxpersona_nino']."'
,'".$_REQUEST['totalxpersona_infante']."'

,'".$_REQUEST['cantidad_personas_sencilla']."','".$_REQUEST['cantidad_personas_doble']."'
,'".$_REQUEST['cantidad_personas_triple']."','".$_REQUEST['cantidad_personas_nino']."'
,'".$_REQUEST['cantidad_personas_infante']."'

,'".$_REQUEST['totalxacomodacion_sencilla']."','".$_REQUEST['totalxacomodacion_doble']."'
,'".$_REQUEST['totalxacomodacion_triple']."','".$_REQUEST['totalxacomodacion_nino']."'
,'".$_REQUEST['totalxacomodacion_infante']."'

	)
"; 

//echo '<br>'.$sql_grabar_liquidacion_reserva.'<br>';
$consulta_grabar_liquidacion = mysql_query($sql_grabar_liquidacion_reserva,$conexion);

////////////////////actualizar la tabla de empresa el campo contador de reservas 
$sql_actualizar = "update $tabla10  set contareservas =    '".$siguiente_reserva."'    ";
$con_actualizar = mysql_query($sql_actualizar,$conexion);




///////////////////////averiguar el numero de egreso que sigue

$sql_traer_ultimo_no_egreso_grabado = "select contador_egresos as no_egreso from $tabla10  ";
$con_egreso = mysql_query($sql_traer_ultimo_no_egreso_grabado,$conexion);
$arr_egreso = mysql_fetch_assoc($con_egreso);
$siguiente_no_egreso = $arr_egreso['no_egreso'] + 1;

//////////////////////generar el egreso de la comision
///crear el egreso en la tagbla recibos_proveedores para el egreso de la comision 


$sql_crear_egreso = "insert into $recibos_proveedores (id_cxp,valor,fecha,id_tipo_egreso,
	no_egreso,id_forma_pago,id_usuario_creacion)
values ('".$maximo_id."','".$valor_comision."','".$_REQUEST['fecha_creacion']."','1',
'".$siguiente_no_egreso."','0','".$_REQUEST['id_usuario_registro']."'
	)";
$con_creacion_egreso = mysql_query($sql_crear_egreso);


//////////////////////////////////////////////////////////
/////actualizar el contador  de egresos en empresa
$sql_actualizar_contador = "update empresa set contador_egresos  = '".$siguiente_no_egreso."' ";
$con_actualizar_contador_egreso_empresa = mysql_query($sql_actualizar_contador,$conexion);
///////////////////////////////
?>
<h2>GRABACION DE RESERVA EXITOSA </h2>
