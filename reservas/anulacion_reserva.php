<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/

$datos_reserva = consulta_assoc_reserva($reservas,'id_reserva',$_REQUEST['id_reserva'],$conexion);
$no_reserva_anulado = 'anu'.$datos_reserva['no_reserva'];
$cliente = 'anu'.$datos_reserva['id_cliente'];
$id_vendedor ='anu'.$datos_reserva['id_vendedor'];
$id_director_comercial ='anu'.$datos_reserva['id_director_comercial'];
$no_contrato ='anu'.$datos_reserva['no_contrato'];


$sql_anular_reserva = "update $reservas set anulado = '1'  
, no_reserva = '".$no_reserva_anulado."'
, id_cliente = '".$cliente."'
, id_vendedor = '".$id_vendedor."'
, id_director_comercial = '".$id_director_comercial."'
, no_contrato = '".$no_contrato."'
, no_contrato2 = '".$no_contrato."'
where id_reserva = '".$_REQUEST['id_reserva']."'  ";


//echo '<br>'.$sql_anular_reserva; 

$consulta_anular = mysql_query($sql_anular_reserva);

echo '<BR><h2>RESERVA ANULADA</h2>';



/////////////////////////////

  function  consulta_assoc_reserva($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>