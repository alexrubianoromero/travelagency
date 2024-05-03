<?php
include('../valotablapc.php');

$sql_cxp_proveedores = "select * from $cxp_proveedores order by id_cxp ";
$con_cxp_proveedores = mysql_query($sql_cxp_proveedores,$conexion);

echo '<table border ="1">  ';
echo '<tr>';
echo '<td>RESERVA</td>';
echo '<td>ID RESERVA</td>';
echo '<td>ID CXP</td>';
echo '<td>TOTAL_cxp</td>';
echo '<td>SALDO_CXP</td>';
echo '<td>SALDO_CALCULADO</td>';
echo '<td>SUMA_RECIBOS</td>';
echo '<td>DIFERENCIA</td>';

echo '</tr>';

while($cxp_proveedores123 = mysql_fetch_assoc($con_cxp_proveedores)){

   $sql_reserva = "select * from $reservas where id_reserva = '".$cxp_proveedores123['id_reserva']."'   ";
   $con_reserva = mysql_query($sql_reserva,$conexion);
   $arr_reserva = mysql_fetch_assoc($con_reserva);

	$sql_recibos = "select sum(valor)  as suma_recibos  from $recibos_proveedores 

	where id_cxp = '".$cxp_proveedores123['id_cxp']."'   ";

	$con_suma_recibos = mysql_query($sql_recibos,$conexion);
	$arr_suma = mysql_fetch_assoc($con_suma_recibos);

	$saldo_calculado = $cxp_proveedores123['valor_total'] - $arr_suma['suma_recibos'];

	$diferencia = $cxp_proveedores123['saldo'] - $saldo_calculado;
  if($diferencia != 0)
  {
  	
	echo '<tr>';
	echo '<td>'.$arr_reserva['no_reserva'].'</td>';
	echo '<td>'.$arr_reserva['id_reserva'].'</td>';
	echo '<td>'.$cxp_proveedores123['id_cxp'].'</td>';
	echo '<td>'.$cxp_proveedores123['valor_total'].'</td>';
	echo '<td>'.$cxp_proveedores123['saldo'].'</td>';
	echo '<td>'.$saldo_calculado.'</td>';
	echo '<td>'.$arr_suma['suma_recibos'].'</td>';
	echo '<td>'.$diferencia.'</td>';
	echo '</tr>';
	/*
	$sql_actualizar_saldo = "update $reservas set saldo_reserva   = '".$saldo_calculado."'   
	where id_reserva = '".$reservas123['id_reserva']."'  "; 
	//echo '<br>'.$sql_actualizar_saldo;
	
	$consulta_act = mysql_query($sql_actualizar_saldo,$conexion);
	*/
	
   }
}//fin de while 

echo '</table>';

?>