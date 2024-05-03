<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_buscar = "
select r.id_reserva,c.nombre,c.idcliente,r.contador_recibos,r.saldo_reserva from $reservas r
inner join $tabla3 c on (c.idcliente = r.id_cliente) 
where r.no_reserva = '".$_REQUEST['no_reserva']."'";
//echo '<br>'.$sql_buscar;
$consu_cliente = mysql_query($sql_buscar,$conexion);
$datos123 = mysql_fetch_assoc($consu_cliente);

///sumarle uno al numero de recibo de la reserva
$recibo_segun_reserva = $datos123['contador_recibos'] +1;

//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"id_reserva":"'.$datos123['id_reserva'].'",
"nombre":"'.$datos123['nombre'].'",
"id_cliente":"'.$datos123['idcliente'].'",
"recibo_segun_reserva":"'.$recibo_segun_reserva.'",
"saldo_reserva":"'.$datos123['saldo_reserva'].'"
}]';

?>
