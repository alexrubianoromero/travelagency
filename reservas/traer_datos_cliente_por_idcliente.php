<?php
session_start();
include('../valotablapc.php');

$sql_buscar = "
select * from $tabla3 where idcliente = '".$_REQUEST['idcliente']."'";
$consu_cliente = mysql_query($sql_buscar,$conexion);
$datos123 = mysql_fetch_assoc($consu_cliente);

//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"id_cliente":"'.$datos123['idcliente'].'",
"identidad":"'.$datos123['identi'].'",
"nombre":"'.$datos123['nombre'].'",
"fijo":"'.$datos123['telefono'].'",
"celular":"'.$datos123['telefono_celular'].'",
"email":"'.$datos123['email'].'"
}]';

?>
