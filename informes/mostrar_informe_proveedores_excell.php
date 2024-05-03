<?php
session_start();
include('../valotablapc.php');

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");

/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_cxp_proveedores = "select * from $cxp_proveedores  where 1=1   ";  

if($_REQUEST['id_proveedor'] && $_REQUEST['id_proveedor'] !='')
{
	$sql_cxp_proveedores .=  " and id_proveedor = '".$_REQUEST['id_proveedor']."'   ";
}


if($_REQUEST['id_concepto'] && $_REQUEST['id_concepto'] !='')
{
	$sql_cxp_proveedores .=  " and id_concepto = '".$_REQUEST['id_concepto']."'   ";
}



if($_REQUEST['fecha_in'] && $_REQUEST['fecha_in'] !='')
{
	$sql_cxp_proveedores .=  " and fecha >= '".$_REQUEST['fecha_in']."'   ";
}

if($_REQUEST['fecha_fin'] && $_REQUEST['fecha_fin'] !='')
{
	$sql_cxp_proveedores .=  " and fecha <= '".$_REQUEST['fecha_fin']."'   ";
}



$sql_cxp_proveedores .= "  order by fecha desc ";

//echo '<br>'.$sql_cxp_proveedores.'<br>';

$con_cxp_proveedores = mysql_query($sql_cxp_proveedores,$conexion);
?>

<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
 
 <!--<a href="mostrar_informe_resumido_fechas_excell.php?id_proveedor=<?php echo $_REQUEST['id_proveedor'] ?>&fecha_in=<?php echo $_REQUEST['fecha_in']; ?>&fecha_fin=<?php echo $_REQUEST['fecha_fin']; ?>&id_concepto=<?php echo $_REQUEST['id_concepto']; ?>"  > ENVIAR EXCEL</a>
-->
<br><br>
<?php



  echo '<table class="formato_tabla">';
 echo  '<thead>'; 
	echo '<tr>';
  echo '<td>FECHA</td>';
  echo '<td>PROVEEDOR</td>';
     echo '<td>CONCEPTO</td>';
      echo '<td>RESERVA</td>';
       echo '<td>VALOR_TOTAL</td>';
       echo '<td>ABONOS</td>';
  		echo '<td>SALDO</td>';
  		echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      ////////////////////////
      

  while($cxp_proveedores = mysql_fetch_assoc($con_cxp_proveedores))
  {
          
           $sql_suma_recibos = "select sum(valor) as valor  from $recibos_proveedores  where id_cxp = '".$cxp_proveedores['id_cxp']."'   ";
           $con_suma_recibos = mysql_query($sql_suma_recibos,$conexion);
           $arr_suma_recibos = mysql_fetch_assoc($con_suma_recibos);
           $datos_proveedor =  consulta_assoc($tabla3,'idcliente',$cxp_proveedores['id_proveedor'],$conexion);
           $datos_concepto =  consulta_assoc($cxp_conceptos,'id_concepto',$cxp_proveedores['id_concepto'],$conexion);
           $datos_reserva =  consulta_assoc($reservas,'id_reserva',$cxp_proveedores['id_reserva'],$conexion);
  		  echo '<tr>';
        echo '<td>'.$cxp_proveedores['fecha'].'</td>';
        echo '<td>'.$datos_proveedor['nombre'].'</td>';
        echo '<td>'.$datos_concepto['nombre_concepto'].'</td>';
          echo '<td>'.$datos_reserva['no_reserva'].'</td>';
          echo '<td align="right">'.$cxp_proveedores['valor_total'] .'</td>';
          echo '<td align="right">'.$arr_suma_recibos['valor'] .'</td>';
         echo '<td align="right">'.$cxp_proveedores['saldo'].'</td>';
  }	
echo '</tbody>';

////////////////////////////////

   function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
  /////////////////////////////

?>

</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
