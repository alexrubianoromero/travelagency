<?php
session_start();
include('../valotablapc.php');

$sql_buscar = "
select * from $tarifas where id_tarifa = '".$_REQUEST['id_tarifa']."'";
$consu_cliente = mysql_query($sql_buscar,$conexion);
$datos123 = mysql_fetch_assoc($consu_cliente);
////////traer el nombre del hotel 
 $hotel = consulta_assoc_hotel($hoteles,'id_hotel',$datos123['id_hotel'],$conexion);


//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"id_tarifa":"'.$datos123['id_tarifa'].'",
"sencilla":"'.$datos123['sencilla'].'",
"doble":"'.$datos123['doble'].'",
"triple":"'.$datos123['triple'].'",
"nino":"'.$datos123['nino'].'",
"infante":"'.$datos123['infante'].'",
"hotel":"'.$hotel['nombre'].'",
"impuestos_sencilla":"'.$datos123['impuestos_sencilla'].'",
"impuestos_doble":"'.$datos123['impuestos_doble'].'",
"impuestos_triple":"'.$datos123['impuestos_triple'].'",
"impuestos_nino":"'.$datos123['impuestos_nino'].'",
"impuestos_infante":"'.$datos123['impuestos_infante'].'"
}]';

?>

<?php

  function  consulta_assoc_hotel($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
?>
