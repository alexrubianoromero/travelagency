<?php
session_start();
include('../valotablapc.php');

$sql_boletas = "select * from $boletas  where 1=1 ";

if($_REQUEST['buscar_boleta'] != '' )
{
	$sql_boletas .= " and  id_boleta = '".$_REQUEST['buscar_boleta']."'   ";
}

$sql_boletas .= " order by id_boleta asc";


$consulta_boletas = mysql_query($sql_boletas,$conexion);





echo '<table class="table table-striped">';
echo '<thead>';

echo '</thead>';
echo '<thead>';
echo  '<th>NUMERO</th>';
echo  '<th>NOMBRE</th>';
echo '<tbody>';
while($boletas = mysql_fetch_assoc($consulta_boletas))
{


echo '<tr>';
   echo '<td>'.$boletas['no_boleta'].'</td>';
   if($boletas['id_cliente']>0)
   {
       $datos_cliente = consulta_assoc($tabla3,'idcliente',$boletas['id_cliente'],$conexion);
       echo '<td>'.$datos_cliente['nombre'].'</td>';
   }
   else
   {
   	echo '<td></td>';
   }
 

echo '</tr>';
}
echo '</tbody>';
echo '</table>';	

?>