<?php
session_start();
include('../valotablapc.php');

$sql_traer_maximo_id = "select max(idcliente) as idcliente from $tabla3  where rol='2'   ";
$con_maximo_id = mysql_query($sql_traer_maximo_id,$conexion);
$arr_maximo = mysql_fetch_assoc($con_maximo_id);
//esto lo hice porque desde el programa llamado preguntas_asesor 
//en crear reserva hago el llamado pero me sale el id  simpre uno menos que el ultimo 
$maximo_mas_uno = $arr_maximo['idcliente']+1;

echo '[{"id_cliente":"'.$maximo_mas_uno.'"  }]';

?>

