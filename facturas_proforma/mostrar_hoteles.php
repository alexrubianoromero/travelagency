<?php
session_start();
include('../valotablapc.php');

$sql_productos = "select * from $facturas_proforma  ";
$con_productos = mysql_query($sql_productos,$conexion);



  function  consulta_assoc_dest($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<table class="formato_tabla">
  <thead>
<?php
	echo '<tr>';
  		echo '<td>No_Proforma</td>';
      echo '<td>Radicado</td>';
      echo '<td>Proveedor</td>';
        echo '<td>Valor</td>';
      echo '<td>Tipo</td>';
      echo '<td>Modificar</td>';
       echo '<td>Eliminar</td>';
       echo '<td>Imprimir</td>';
  
  		
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		
    $datos_cxp = consulta_assoc_dest($cxp_proveedores,'id_cxp',$productos['id_cxp'],$conexion);
    $datos_proveedores = consulta_assoc_dest($tabla3,'idcliente',$datos_cxp['id_proveedor'],$conexion);
    $datos_reserva = consulta_assoc_dest($reservas,'id_reserva',$datos_cxp['id_reserva'],$conexion);
      echo '<tr>';
  		echo '<td>'.$productos['no_factura_proforma'].'</td>';
      echo '<td>'.$datos_reserva['no_reserva'].'</td>';
      echo '<td>'.$datos_proveedores['nombre'].'</td>';
       echo '<td align="right">'.number_format($productos['valor_proforma'], 0, ',', '.').'</td>';  
      echo '<td>'.$productos['id_tipo_proforma'].'</td>'; 
      echo '<td>';
      echo '<a  href="modificar.php?id_factura='.$productos['id_factura'].'  ">Modificar</a>';
      echo '</td>';
      
       echo '<td>';
       echo '<a  href="eliminar.php?id_factura='.$productos['id_factura'].' ">Eliminar</a>';
      echo '</td>';
         echo '<td>';
       echo '<a  href="imprimir_proforma.php?id_factura='.$productos['id_factura'].' " target="_blank">Imprimir</a>';
      echo '</td>';
  		echo '</tr>';
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>