<?php
include('../valotablapc.php');
include('../funciones_summers.php');
$datos_recibo = consulta_assoc($recibos,'id_recibo',$_REQUEST['id_recibo'],$conexion);
$datos_cliente=  consulta_assoc($tabla3,'idcliente',$datos_recibo['id_cliente'],$conexion);
$no_reserva = traer_numero_reserva($reservas,$datos_recibo['id_reserva'],$conexion);
$datos_reserva=  consulta_assoc($reservas,'id_reserva',$datos_recibo['id_reserva'],$conexion);
$datos_cliente=  consulta_assoc($tabla3,'idcliente',$datos_recibo['id_cliente'],$conexion);
$nombre_usuario = traer_nombre_usuario($tabla16,$datos_recibo['id_usuario'],$conexion);

$datos_vendedor = consulta_assoc($tabla3,'idcliente',$datos_reserva['id_vendedor'],$conexion);
$datos_director = consulta_assoc($tabla3,'idcliente',$datos_reserva['id_director_comercial'],$conexion);
$datos_tarifa =  consulta_assoc($tarifas,'id_tarifa',$datos_reserva['id_tarifa'],$conexion);

$datos_hotel =  consulta_assoc($hoteles,'id_hotel',$datos_tarifa['id_hotel'],$conexion);
$datos_empresa = consulta_assoc($tabla10,'id_empresa','300',$conexion);

$datos_liq_res = consulta_assoc($liquidacion_reserva,'id_reserva',$datos_recibo['id_reserva'],$conexion);
$numero_pasajeros = $datos_liq_res['cantidad_personas_sencilla'] 
+ $datos_liq_res['cantidad_personas_doble'] 
+ $datos_liq_res['cantidad_personas_triple'] 
+ $datos_liq_res['cantidad_personas_nino'] 
+ $datos_liq_res['cantidad_personas_infante'] ;

/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/

$datos_destino=  consulta_assoc($destinos,'id_destino',$datos_tarifa['id_destino'],$conexion);
$ancho_tabla = "95%";
$tamano_letra = "14px";
$ancho = "90%";


$sql_suma_recibos = "select sum(valor) as suma from $recibos where id_reserva = '".$datos_recibo['id_reserva']."' ";
$consulta_suma_recibos = mysql_query($sql_suma_recibos,$conexion);
$arr_suma_recibos = mysql_fetch_assoc($consulta_suma_recibos);

$saldo_reserva  = $datos_reserva['total'] -  $arr_suma_recibos['suma'];



?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
	<style>
	 
	</style>
</head>
<body>
<BR>
<div id="div_impresion_recibo" align="center">

<table width="<?php echo $ancho;  ?>" border="0"   style="font-size:<?php echo $tamano_letra; ?>"  cellspacing="2" cellpadding="1" >
  <tr>
    <td width="40%"><div align="center"><img src="../logos/summers.png" width="205" height="111" /></div></td>
    <td><div id="datos_empresa" align="center" ><?php echo  $datos_empresa['direccion'] ?><br>
      <?php echo  $datos_empresa['telefonos'] ?><br>
      <?php echo  $datos_empresa['identi'] ?><br>
      whatsapp 321 2813821
    </div></td>
    <td><div align="center">RECIBO DE CAJA No  
      <?php  echo $datos_recibo['no_recibo'] ?> 
          <br>
      CIUDAD: BOGOTA  <BR> 
      FECHA :
      <?php  echo $datos_recibo['fecha'] ?>  
    </div></td>
  </tr>
</table>
<table width="<?php echo $ancho;  ?>" border="1"   style="font-size:<?php echo $tamano_letra; ?>"  cellspacing="2" cellpadding="1" >
  <tr>
    <td>RECIBIDO DE: </td>
    <td><?php echo $datos_cliente['nombre']; ?></td>
    <td>NIT:</td>
    <td><?php echo $datos_cliente['identi']; ?></td>
  </tr>
  <tr>
    <td>DIRECCION</td>
    <td><?php echo $datos_cliente['direccion']; ?></td>
    <td>TELEFONO</td>
    <td><?php echo $datos_cliente['telefono_celular']; ?></td>
  </tr>
</table>
<table width="<?php echo $ancho;  ?>" border="1"   style="font-size:<?php echo $tamano_letra; ?>"  cellspacing="2" cellpadding="1" >
  <tr>
    <td>CONCEPTO</td>
  </tr>
</table>
<table width="<?php echo $ancho;  ?>" border="1"   style="font-size:<?php echo $tamano_letra; ?>"  cellspacing="2" cellpadding="1" >
  <tr>
    <td width="89"><div align="center">INFORMACION </div></td>
    <td width="115"><div align="center">CLIENTE</div></td>
    <td width="52"><div align="center">VALOR</div></td>
  </tr>
  <tr>
    <td></td>
    <td><?php echo $datos_cliente['nombre']; ?></td>
    <td align="right"><?php echo '$'.number_format($datos_recibo['valor'], 0, ',', '.'); ?></td>
  </tr>
  <tr>
    <td>Contrato  <?php echo $datos_reserva['no_contrato2'] ?></td>
    <td>Plan:  <?php echo $datos_tarifa['plan']; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Radicado <?php echo $datos_reserva['no_reserva'] ?></td>
    <td>Hotel <?php  echo $datos_hotel['nombre'];   ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Efectivo: <?php  echo $datos_recibo['efectivo'] ?></td>
    <td>Destino <?php echo $datos_destino['nombre'] ?> </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Consignacion: <?php  echo $datos_recibo['consignacion'] ?></td>
    <td>Fecha salida <?php echo $datos_reserva['fecha_salida'] ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Tarjeta: <?php  echo $datos_recibo['tarjeta'] ?></td>
    <td>Fecha Regreso <?php echo $datos_reserva['fecha_regreso'] ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Valor Reserva <?php echo $datos_reserva['total']   ?></td>
    <td>Saldo: <?php echo $saldo_reserva;  ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Pasajeros :  <?php   echo $numero_pasajeros;   ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><div align="right">TOTAL</div></td>
    <td align="right"><?php echo '$'.number_format($datos_recibo['valor'], 0, ',', '.'); ?></td>
  </tr>
</table>
<table width="<?php echo $ancho;  ?>" border="1"   style="font-size:<?php echo $tamano_letra; ?>"  cellspacing="2" cellpadding="1" >
  <tr>
    <td>ELABORADO:<BR><BR>
      <?php  echo $nombre_usuario; ?>
    </td>
    <td>APROBADO:<BR><BR><BR></td>
    <td>FIRMA Y SELLO BENEFICIARIO:<BR><BR><BR></td>
  </tr>
</table>
<?php  echo 'Asesor: '.$datos_vendedor['nombre'].'---Director: '.$datos_director['nombre']  ?>
</div>


</body>
</html>


