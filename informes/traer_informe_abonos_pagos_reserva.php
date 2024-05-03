<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');


$datos_reserva = consulta_assoc_reserva($reservas,'no_reserva',$_REQUEST['no_reserva'],$conexion);

$datos_cliente=  consulta_assoc($tabla3,'idcliente',$datos_reserva['id_cliente'],$conexion);
$datos_asesor=  consulta_assoc($tabla3,'idcliente',$datos_reserva['id_vendedor'],$conexion);
$datos_destino = consulta_assoc($destinos,'id_destino',$datos_reserva['ciudad_destino'],$conexion);
$datos_cxp_proveedores = consulta_assoc($destinos,'id_destino',$datos_reserva['ciudad_destino'],$conexion);
//echo '<br>'.$datos_reserva['id_reserva'];
$id_reserva = $datos_reserva['id_reserva'];

$sql_abonos_cliente = "select * from $recibos   where id_reserva = '".$id_reserva."' ";
$consulta_recibos = mysql_query($sql_abonos_cliente,$conexion);
//echo '<br>'.$sql_abonos_cliente;

$sql_buscar_cxp_proveedores = "select * from $cxp_proveedores   where id_reserva = '".$datos_reserva['id_reserva']."'  ";
$consulta_cxp_proveedores = mysql_query($sql_buscar_cxp_proveedores,$conexion);
//echo '<br>'.$sql_buscar_cxp_proveedores;


$sql_pagos_proveedores = "select  cxp.id_reserva,rp.* from $recibos_proveedores rp
inner join $cxp_proveedores  cxp  on (cxp.id_cxp  = rp.id_cxp)
where cxp.id_reserva = '".$id_reserva ."'
   ";

$consulta_pagos_proveedores =  mysql_query($sql_pagos_proveedores,$conexion);

//echo '<br>'.$sql_pagos_proveedores.'<br>';
$ancho_tabla= "100%";
?>


<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
#div_informe1{
  position:relative;
  top:0%;
  left: 2%;
  width: 95%;
  /*border:1px solid red;*/

}

#div_datos1{
  position:relative;
  top:0px;
  left: 0px;
  width: 40%;
  /* border:1px solid blue;*/
}


#div_datos2{
  position:absolute;
   top:15%;
  left: 41%;
  width: 55%;
  /* border:1px solid green;*/

}
</style>
</head>
<body>
<div id="div_informe1" >
 <h3>FORMATO CONTROL DE RESERVAS</h3> 
 <?php
echo '<div id = "div_datos1" >';
echo '<table border = "1" width="'.$ancho_tabla.'">';
echo '<tr>';
echo '<td>FECHA</td>';
echo '<td>'.$datos_reserva['fecha_creacion'].'</td>';
echo '</tr>';

echo '<tr>';
echo '<td>NIT</td>';
echo '<td>'.$datos_cliente['identi'].'</td>';
echo '</tr>';

echo '<tr>';
echo '<td>CLIENTE</td>';
echo '<td>'.$datos_cliente['nombre'].'</td>';
echo '</tr>';

echo '<tr>';
echo '<td>DIRECCION</td>';
echo '<td>'.$datos_cliente['direcion'].'</td>';
echo '</tr>';

echo '<tr>';
echo '<td>DESTINO</td>';
echo '<td>'.$datos_destino['nombre'].'</td>';
echo '</tr>';

echo '<tr>';
echo '<td>SEPARACION</td>';
echo '<td>'.$datos_reserva['vr_inicial'].'</td>';
echo '</tr>';

echo '</table>';
echo '</div>';
////////////////////////////////////////////////////
echo '<div id="div_datos2">';
echo 'NO RESERVA:'.$datos_reserva['no_reserva'].'<br>';
echo 'VALOR CONTRATO:'.$datos_reserva['total'].'<br>';
echo 'ASESOR COMERCIAL:'.$datos_asesor['nombre'].'<br>';
echo 'FECHA VIAJE:'.$datos_reserva['fecha_salida'].'<br>';
echo 'NO CUOTAS: '.$datos_reserva['no_cuotas'].'<br> ' ;
echo 'VALOR UNT CUOTA:'.$datos_reserva['vr_cuota_mensual'];
echo '</div>';





echo '<br>';


//echo 'ABONOS REALIZADOS POR EL CLIENTE';

echo '<table border = "1"  width="'.$ancho_tabla.'">';
echo '<tr>';
echo '<td>NO_RECIBO</td>';
echo '<td>NO</td>';
echo '<td>FECHA</td>';
echo '<td>CONCEPTO</td>';
echo '<td>NO CONTRATO</td>';
echo '<td>VR CONTRATO</td>';
echo '<td>SALDO</td>';
echo '<td>FORMA PAGO</td>';
echo '<td>DESTINO</td>';


echo '</tr>';
$item = 1;
$suma= 0;
$saldo = $datos_reserva['total'];
 while($recibos = mysql_fetch_assoc($consulta_recibos))
{
$saldo = $saldo -   $recibos['valor'];
echo '<tr>';
echo '<td>'.$recibos['no_recibo'].'</td>';
echo '<td>'.$item.'</td>';
echo '<td>'.$recibos['fecha'].'</td>';
echo '<td>'.$recibos['observaciones'].'</td>';
echo '<td>'.$datos_reserva['no_contrato'].'</td>';
echo '<td align="right">'.$recibos['valor'].'</td>';
echo '<td align="right">'.$saldo.'</td>';
echo '<td>'.$recibos['forma_pago'].'</td>';
echo '<td>'.$datos_destino['nombre'].'</td>';
echo '</tr>';
$suma= $suma+$recibos['valor'];
$item ++;
}
echo '<tr>';
echo '<td></td>';
echo '<td></td>';

echo '<td></td>';
echo '<td></td>';

echo '<td>Total</td>';
echo '<td align="right">'.$suma.'</td>';
echo '<td></td>';
echo '<td></td>';

echo '</tr>';

echo '</table>';
?>


<br><br>


<?php
$suma= 0;
$item = 1;
echo 'CUENTAS X PAGAR PROVEEDORES';
echo '<table border = "1" width="'.$ancho_tabla.'">';
echo '<tr>';
echo '<td>NO</td>';
echo '<td>FECHA</td>';
echo '<td>PROVEEDOR</td>';
echo '<td>CONCEPTO</td>';
echo '<td>DOCUMENTO</td>';
echo '<td>VALOR</td>';
echo '<td>SALDO</td>';
echo '<td>FORMA PAGO</td>';
echo '<td>DESTINOS</td>';
echo '</tr>';

while($cxp = mysql_fetch_assoc($consulta_cxp_proveedores))
{

$datos_proveedor = consulta_assoc_reserva($tabla3,'idcliente',$cxp['id_proveedor'],$conexion);
$datos_concepto = consulta_assoc987($cxp_conceptos,'id_concepto',$cxp['id_concepto'],$conexion);
echo '<tr>';
echo '<td>'.$item.'</td>';
echo '<td>'.$cxp['fecha'].'</td>';
echo '<td>'.$datos_proveedor['nombre'].'</td>';

//echo '<td>'.$cxp['concepto'].'</td>';
//echo '<td>'.$cxp['concepto'].'</td>';
echo '<td>'.$datos_concepto['nombre_concepto'].'</td>';
echo '<td>'.$cxp['documento'].'</td>';
echo '<td align="right">'.$cxp['valor_total'].'</td>';
echo '<td align="right">'.$cxp['saldo'].'</td>';
echo '<td></td>';
echo '<td>'.$cxp['destino'].'</td>';

echo '</tr>';
$item ++;
}

echo '</table>';


//////////////////////////////////////////////////////////////

?>


</div>
<br><BR>
	
</body>
</html>	
<?php




  function  consulta_assoc987($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
  function  consulta_assoc_reserva($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' and anulado = '0'  ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   