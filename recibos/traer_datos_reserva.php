<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_buscar = "
select r.id_reserva,c.nombre,c.idcliente,r.contador_recibos,r.saldo_reserva,r.vr_efectivo,r.vr_cons_trans,r.vr_tarjeta
from $reservas r
inner join $tabla3 c on (c.idcliente = r.id_cliente) 
where r.no_reserva = '".$_REQUEST['no_reserva']."'";
//echo '<br>'.$sql_buscar;
$consu_cliente = mysql_query($sql_buscar,$conexion);
$datos123 = mysql_fetch_assoc($consu_cliente);

///sumarle uno al numero de recibo de la reserva
$recibo_segun_reserva = $datos123['contador_recibos'] +1;


//verificar si es el primer recibo de esta reserva 

$sql_traer_recibos = "select * from $recibos where id_reserva = '".$datos123['id_reserva']."' ";
$consulta_recibos_reserva = mysql_query($sql_traer_recibos,$conexion);
$filas_recibos = mysql_num_rows($consulta_recibos_reserva);


$efectivo = 0;
$consignacion=0;
$tarjeta=0;

if($filas_recibos<1){
  $efectivo = $datos123['vr_efectivo'];
  $consignacion = $datos123['vr_cons_trans'];
   $tarjeta = $datos123['vr_tarjeta'];
   $total_recibo = $datos123['vr_efectivo'] +  $datos123['vr_cons_trans'] +  $datos123['vr_tarjeta'];
}//fin del if 


//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"id_reserva":"'.$datos123['id_reserva'].'",
"nombre":"'.$datos123['nombre'].'",
"id_cliente":"'.$datos123['idcliente'].'",
"recibo_segun_reserva":"'.$recibo_segun_reserva.'",
"saldo_reserva":"'.$datos123['saldo_reserva'].'",
"efectivo":"'.$efectivo.'",
"consignacion":"'.$consignacion.'",
"tarjeta":"'.$tarjeta.'",
"valor_total":"'.$total_recibo.'"
}]';
/*

*/
?>
