<?php
session_start();
include('../valotablapc.php');

$sql_modificar = "update $destinos 
set nombre = '".$_REQUEST['nombre']."' 
 where id_destino = '".$_REQUEST['id_destino']."'  ";
//echo '<br>'.$sql_modificar;
$consulta_modif = mysql_query($sql_modificar,$conexion); 


echo 'MODIFICADO OK';



?>