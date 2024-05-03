<?php
include('../valotablapc.php');
include('../funciones_summers.php');
$datos_recibo = consulta_assoc($recibos,'id_recibo',$_REQUEST['id_recibo'],$conexion);
$datos_cliente=  consulta_assoc($tabla3,'idcliente',$datos_recibo['id_cliente'],$conexion);
$no_reserva = traer_numero_reserva($reservas,$datos_recibo['id_reserva'],$conexion);
$datos_reserva=  consulta_assoc($reservas,'id_reserva',$datos_recibo['id_reserva'],$conexion);
$datos_cliente=  consulta_assoc($tabla3,'idcliente',$datos_recibo['id_cliente'],$conexion);
$nombre_usuario = traer_nombre_usuario($tabla16,$datos_recibo['id_usuario'],$conexion);
$ancho_tabla = "95%";
$tamano_letra = "12px";
?>
<!doctype html>
<html>
<head>
	<title></title>
	<style>
	   #div_ver_recibo{
	   display: none;
	</style>
</head>
<body>
<br>
<br>
<br>
<br>
<br>

<table width="728" border="0" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td width="8%">&nbsp;</td>
    <td width="8%">&nbsp;</td>
    <td width="47%">&nbsp;</td>
    <td width="25%">BOGOTA</td>
    <td width="12%"><?php  echo $datos_recibo['fecha'] ?></td>
  </tr>
</table>

<br>
<table width="724" border="0" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td width="153">&nbsp;</td>
    <td width="124"><?php echo $datos_cliente['nombre']; ?> </td>
    <td width="234">&nbsp;</td>
    <td width="195"><?php echo $datos_cliente['identi']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo $datos_cliente['direccion']; ?></td>
    <td>&nbsp;</td>
    <td><?php echo $datos_cliente['telefono_celular']; ?></td>
  </tr>
</table>
<br>
<br>
<br>
<table width="727" border="0" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td width="160"><div align="center"><?php echo $datos_reserva['no_reserva']; ?></div></td>
    <td width="467"><?php echo $datos_cliente['nombre']; ?></td>
    <td width="86"><?php echo $datos_reserva['total']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><?php echo $datos_reserva['total']; ?></td>
  </tr>
</table>

<p>&nbsp;</p>
</body>
</html>


