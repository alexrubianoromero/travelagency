<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");

$sql_reservas = "select r.* from $recibos r ";

if(isset($_REQUEST['no_reserva_buscar']) && $_REQUEST['no_reserva_buscar'] != '' )
{
   $sql_reservas .= "inner join $reservas re on (re.id_reserva = r.id_reserva) ";
} 

$sql_where .= "1=1 ";

if(isset($_REQUEST['no_reserva_buscar']) && $_REQUEST['no_reserva_buscar'] != '' )
{
   $sql_reservas .= "and re.no_reserva = '".$_REQUEST['no_reserva_buscar']."'   ";
}

if(isset($_REQUEST['no_recibo_buscar']) && $_REQUEST['no_recibo_buscar'] != '' )
{
  $sql_reservas .= " and no_recibo =  '".$_REQUEST['no_recibo_buscar']."'  ";
}




$sql_reservas .=  "order by id_recibo desc  ";
$con_reservas = mysql_query($sql_reservas,$conexion);
//echo '<br>'.$sql_reservas;
//exit();
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
table{
  border-collapse: collapse;
}
td{
  padding: 5px;
}
</style>
</head>
<body>
<table class="formato_tabla">
  <thead>
<?php
 echo '<thead>';   
	echo '<tr>';
  echo '<td>FECHA</td>';
      echo '<td>NO RECIBO</td>';
      echo '<td>RESERVA</td>';
      echo '<td>CONTRATO</td>';
       echo '<td>IDENT CLIENTE</td>';
  		echo '<td>NOMBRE CLIENTE</td>';
      echo '<td>VALOR</td>';
      //echo '<td>VER DETALLE</td>';
     

  		echo '</tr>';
  echo '</thead>';   
    echo '<tbody>'; 
  while($reservas = mysql_fetch_assoc($con_reservas))
  {
  		  /////traer el contrato segun la reserva
    $datos_reserva123 = consulta_assoc_contrato('reservas','id_reserva',$reservas['id_reserva'],$conexion);

    $numero_contrato = $datos_reserva123['no_contrato'];


      $nombre_cliente  = traer_nombre($tabla3,$reservas['id_cliente'],$conexion);
      $identi_cliente  = traer_identi($tabla3,$reservas['id_cliente'],$conexion);
      $numero_reserva  = traer_numero_reserva('reservas',$reservas['id_reserva'],$conexion);

      //$nombre_vendedor = traer_nombre($tabla3,$reservas['id_vendedor'],$conexion);
      //$nombre_tarifa   = nombre_tarifa($productos,$reservas['id_tarifa'],$conexion);
      //$nombre_estado    = traer_estado($estados_reserva,$reservas['id_estado'],$conexion);

      echo '<tr>';
      echo '<td>'.$reservas['fecha'].'</td>';
      echo '<td>'.$reservas['no_recibo'].'</td>';
      echo '<td>'.$numero_reserva.'</td>';
      echo '<td>'.$numero_contrato.'</td>';
      echo '<td>'.$identi_cliente.'</td>';
      //echo '<td>'.$reservas['fecha_creacion'].'</td>';
  		echo '<td>'.$nombre_cliente.'</td>';
   
  		//echo '<td>'.$reservas['ciudad_venta'].'</td>';
  		//echo '<td>'.$nombre_tarifa.'</td>';
 
  		echo '<td align="right">'.$reservas['valor'].'</td>';
    
      
      

  		echo '</tr>';
  }//fin de while 
///////////////////////

  function  consulta_assoc_contrato($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
?>
</tbody>
</table>	

</div>
</body>
</html>