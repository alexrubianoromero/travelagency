<?php
session_start();
include('../valotablapc.php');

function  consulta_assoc3($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$datos_reserva= consulta_assoc3($reservas,'no_reserva',$_REQUEST['radicado'],$conexion);
$datos_cliente= consulta_assoc3($tabla3,'idcliente',$datos_reserva['id_cliente'],$conexion);

echo '[{"nombre":"'.$datos_cliente['nombre'].'" ,
"id_reserva":"'.$datos_reserva['id_reserva'].'"

}]';


?>
