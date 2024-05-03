<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
 function  consulta_assoc_cxp($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>

<?php


//////////////pasar la cxp a cxp_proveedores_elimnadas
$datos_cxp= consulta_assoc_cxp($cxp_proveedores,'id_cxp',$_REQUEST['id_cxp'],$conexion);

$sql_insertar_cxp_eliminada = "insert into $cxp_proveedores_eliminadas 
(id_cxp,id_proveedor,concepto,fecha, id_reserva, valor_total,saldo,documento,destino,id_usuario_eliminacion)

values ('".$datos_cxp['id_cxp']."'
,'".$datos_cxp['id_proveedor']."'
,'".$datos_cxp['concepto']."'
,'".$datos_cxp['fecha']."'
,'".$datos_cxp['id_reserva']."'
,'".$datos_cxp['valor_total']."'
,'".$datos_cxp['saldo']."'
,'".$datos_cxp['documento']."'
,'".$datos_cxp['destino']."'
,'".$_SESSION['id_usuario']."'
)";

//echo '<br>'.$sql_insertar_cxp_eliminada;
$consulta_copiar_cxp = mysql_query($sql_insertar_cxp_eliminada,$conexion);
//exit();

////elimianr cuenta 
$sql_eliminar_cxp = "delete from $cxp_proveedores   where id_cxp = '".$_REQUEST['id_cxp']."'  ";

$consulta_eliminar_cxp = mysql_query($sql_eliminar_cxp,$conexion);



//////borrar los recibos de pago a sociados a la cuenta 
$sql_eliminar_recibos_cxp  = "delete from $recibos_proveedores    id_cxp = '".$_REQUEST['id_cxp']."'  ";
$consulta_eliminar_cxp = mysql_query($sql_eliminar_recibos_cxp,$conexion);

//////////////////////////////
/*
echo '<br>'.$sql_eliminar_cxp;

echo '<br>'.$sql_eliminar_recibos_cxp;
*/

echo '<BR><BR>CUENTA POR PAGAR DE PROVEEDOR ELIMINADA<br><br>';

?>


</body>
</html>