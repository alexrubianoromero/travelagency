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
$sql_cxp_proveedores = "select * from $reservas  where 1=1   ";  


if($_REQUEST['id_proveedor'] && $_REQUEST['id_proveedor'] !='')
{
	$sql_cxp_proveedores .=  " and id_vendedor = '".$_REQUEST['id_proveedor']."'   ";
}



if($_REQUEST['no_radicado'] && $_REQUEST['no_radicado'] !='')
{
	$sql_cxp_proveedores .=  " and no_reserva = '".$_REQUEST['no_radicado']."'   ";
}


if($_REQUEST['fecha_in'] && $_REQUEST['fecha_in'] !='')
{
	$sql_cxp_proveedores .=  " and fecha_creacion >= '".$_REQUEST['fecha_in']."'   ";
}

if($_REQUEST['fecha_fin'] && $_REQUEST['fecha_fin'] !='')
{
	$sql_cxp_proveedores .=  " and fecha_creacion <= '".$_REQUEST['fecha_fin']."'   ";
}



$sql_cxp_proveedores .= "  order by fecha_creacion desc ";

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


<?php



  echo '<table class="formato_tabla">';
 echo  '<thead>'; 
	 echo '<tr>';
      echo '<td>FECHA</td>';
      echo '<td>ASESOR</td>';
      echo '<td>RESERVA</td>';
      echo '<td>% COMISION</td>';
      echo '<td>VALOR_COMISION</td>';
  		echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      ////////////////////////
      

  while($reservas = mysql_fetch_assoc($con_cxp_proveedores))
  {
          
         
           $datos_asesor =  consulta_assoc($tabla3,'idcliente',$reservas['id_vendedor'],$conexion);
         


  		  echo '<tr>';
        echo '<td>'.$reservas['fecha_creacion'].'</td>';
        echo '<td>'.$datos_asesor['nombre'].'</td>';
        echo '<td>'.$reservas['no_reserva'].'</td>';
         echo '<td>'.$reservas['porcen_comision'].'</td>';

                   echo '<td align="right">'.$reservas['vr_comision'] .'</td>';
         
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
