<?php
session_start();
include('../valotablapc.php');

$sql_buscar = "
select * from $tabla3 where idcliente = '".$_REQUEST['idcliente123']."'";
$consu_cliente = mysql_query($sql_buscar,$conexion);
$datos1234 = mysql_fetch_assoc($consu_cliente);

//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"id_cliente":"'.$datos1234['idcliente'].'",
"nombre":"'.$datos1234['nombre'].'",
"identi":"'.$datos1234['identi'].'",
"direccion":"'.$datos1234['direccion'].'",
"email":"'.$datos1234['email'].'",
"telefono":"'.$datos1234['telefono'].'",
"telefono_celular":"'.$datos1234['telefono_celular'].'"

}]';

?>
