<?php
session_start();
include('../valotablapc.php');
$ancho_tabla = '95%';
$tamano_cuerpo = "12px";


 function  consulta_assoc_hot($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$datos_factura = consulta_assoc_hot($facturas_proforma,'id_factura',$_REQUEST['id_factura'],$conexion);
$datos_cxp = consulta_assoc_hot($cxp_proveedores,'id_cxp',$datos_factura['id_cxp'],$conexion);
$datos_proveedor = consulta_assoc_hot($tabla3,'idcliente',$datos_cxp['id_proveedor'],$conexion);
$datos_empresa = consulta_assoc_hot($tabla10,'id_empresa','300',$conexion);
?>

<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">

<script src="../js/jquery.js" type="text/javascript"></script>
<style>
#div_impresion_proforma{

	padding: 5px;
	border: 1px solid black;
}
</style>
</head>
<body>
<div id="div_impresion_proforma" align="center">	
<h2>FACTURA PROFORMA No <?php  echo $datos_factura['no_factura_proforma']  ?></h2>

<table border= "1"  width="<?php  echo $ancho_tabla; ?>" style="font-size:<?php echo $tamano_encabezado;?>" >
<tr>
  <td><?php echo $datos_empresa['razon_social']; ?> <br>
	  	Nit: 		<?php echo $datos_empresa['identi']; ?> <br>
	  	Direccion: <?php echo $datos_empresa['direccion']; ?> <br>
	  	Telefonos: <?php echo $datos_empresa['telefonos']; ?> <br></td>
  <td ><div align="center" id="div_imagen"><img src = "../logos/logo_proforma.png" width="50%" ></div></td>
</tr>	
</table>
<br><br>
<table border= "1"  width="<?php  echo $ancho_tabla; ?>" style="font-size:<?php echo $tamano_encabezado;?>" >
<tr>
	<td>Fecha: <?php echo $datos_factura['fecha']; ?></td>
</tr>	
</table>
<br><br>
<table border= "1"  width="<?php  echo $ancho_tabla; ?>" style="font-size:<?php echo $tamano_encabezado;?>" >
<tr>
  <td>Proveedor: <?php echo $datos_proveedor['nombre']; ?> <br>
	  	c.c: 		<?php echo $datos_proveedor['identi']; ?> <br>
	  	Direccion: <?php echo $datos_proveedor['direccion']; ?> <br>
	  	Telefonos: <?php echo $datos_proveedor['telefono']; ?> <br></td>

</tr>	
</table>
<br><br>
<table border= "1"  width="<?php  echo $ancho_tabla; ?>" style="font-size:<?php echo $tamano_encabezado;?>" >
<tr>
  <td>CONCEPTO:<BR>

	  </td>
</tr>	
</table>
<table border= "1"  width="<?php  echo $ancho_tabla; ?>" style="font-size:<?php echo $tamano_encabezado;?>" >
<tr>
  <td>VALOR CONTRATO: <?php echo number_format($datos_cxp['valor_total'], 0, ',', '.')  ?><BR>
VALOR FACTURA PROFORMA: <?php echo number_format($datos_factura['valor_proforma'], 0, ',', '.')  ?><BR>
	  </td>
</tr>	
</table>

<br><br>


</div>
</body>
</html>

