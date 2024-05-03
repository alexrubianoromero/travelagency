<?php
session_start();
include('../valotablapc.php');

$sql_buscar = "
select * from $tabla3 where identi = '".$_REQUEST['identidad']."'";
$consu_cliente = mysql_query($sql_buscar,$conexion);
$datos123 = mysql_fetch_assoc($consu_cliente);

//echo '[{"id_codigo":"'.$datos123[0]['id_codigo'].'","descripcion":"'.$datos123[0]['descripcion'].'"   }]';
echo '[{"id_cliente":"'.$datos123['idcliente'].'",
"nombre":"'.$datos123['nombre'].'"
}]';

?>
