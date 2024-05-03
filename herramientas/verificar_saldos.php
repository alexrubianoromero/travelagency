<?php
include('../valotablapc.php');

$sql_reservas = "select * from $reservas where anulado = '0' ";
$con_reservas = mysql_query($sql_reservas,$conexion);
/*
echo '<table border ="1">  ';
echo '<tr>';
echo '<td>RESERVA</td>';
echo '<td>ID RESERVA</td>';
echo '<td>TOTAL</td>';
echo '<td>SALDO_RESERVA</td>';
echo '<td>SALDO_CALCULADO</td>';
echo '<td>SUMA_RECIBOS</td>';
echo '<td>DIFERENCIA</td>';

echo '</tr>';
*/
while($reservas123 = mysql_fetch_assoc($con_reservas)){
	$sql_recibos = "select sum(valor)  as suma_recibos  from $recibos where id_reserva = '".$reservas123['id_reserva']."'   ";
	$con_suma_recibos = mysql_query($sql_recibos,$conexion);
	$arr_suma = mysql_fetch_assoc($con_suma_recibos);

	$saldo_calculado = $reservas123['total'] - $arr_suma['suma_recibos'];

	$diferencia = $reservas123['saldo_reserva'] - $saldo_calculado;
  if($diferencia != 0)
  {
  	/*
	echo '<tr>';
	echo '<td>'.$reservas123['no_reserva'].'</td>';
	echo '<td>'.$reservas123['id_reserva'].'</td>';
	echo '<td>'.$reservas123['total'].'</td>';
	echo '<td>'.$reservas123['saldo_reserva'].'</td>';
	echo '<td>'.$saldo_calculado.'</td>';
	echo '<td>'.$arr_suma['suma_recibos'].'</td>';
	echo '<td>'.$diferencia.'</td>';
	echo '</tr>';
	*/
	$sql_actualizar_saldo = "update $reservas set saldo_reserva   = '".$saldo_calculado."'   
	where id_reserva = '".$reservas123['id_reserva']."'  "; 
	//echo '<br>'.$sql_actualizar_saldo;
	
	$consulta_act = mysql_query($sql_actualizar_saldo,$conexion);
	
	
   }
}//fin de while 
/*
echo '</table>';
*/



?>