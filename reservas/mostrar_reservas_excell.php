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
$consulta = $_REQUEST['consulta'];

$consulta = str_replace("\'", "'", $consulta);

//echo '<br>consulta<br>'.$consulta.'<br><br>';

/*
$frase= "frase de ejemplo saba la aspa \'mata   ";
$nueva_frase = str_replace("\'", "'", $frase);
echo '<br>nueva_frase<br><br><br>'.$nueva_frase;
exit();
*/

$con_reservas = mysql_query($consulta,$conexion);

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
  echo '<thead>';
	echo '<tr>';
  echo '<td>FECHA</td>';
      echo '<td>NO RESERVA</td>';
       echo '<td>IDEN CLIENTE</td>';
       //echo '<td>Fecha</td>';
  		echo '<td>NOMBRE CLIENTE</td>';
      echo '<td>ESTADO</td>';
  		//echo '<td>Vendedor</td>';
  		//echo '<td>Ciudad Venta</td>';
  		//echo '<td>Tarifa</td>';
  		echo '<td>VALOR RESERVA</td>';
      echo '<td>SALDO </td>';
      

  		echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

  while($reservas = mysql_fetch_assoc($con_reservas))
  {
  		$nombre_cliente   = traer_nombre123($tabla3,$reservas['id_cliente'],$conexion);
      $identi_cliente   = traer_identi($tabla3,$reservas['id_cliente'],$conexion);
      $nombre_vendedor  = traer_nombre123($tabla3,$reservas['id_vendedor'],$conexion);
      $nombre_tarifa    = nombre_tarifa($productos,$reservas['id_tarifa'],$conexion);
      $nombre_estado    = traer_estado($estados_reserva,$reservas['id_estado'],$conexion);

      echo '<tr>';
      echo '<td>'.substr($reservas['fecha_creacion'],0,10).'</td>';
      echo '<td>'.$reservas['no_reserva'].'</td>';
      echo '<td>'.$identi_cliente.'</td>';
      //echo '<td>'.$reservas['fecha_creacion'].'</td>';
  		echo '<td>'.$nombre_cliente.'</td>';
   
  		echo '<td>'.$nombre_estado.'</td>';
  		//echo '<td>'.$reservas['ciudad_venta'].'</td>';
  		//echo '<td>'.$nombre_tarifa.'</td>';
 
  		echo '<td align="right">'.$reservas['total'].'</td>';
      echo '<td align="right">'.$reservas['saldo_reserva'].'</td>';

     
  		echo '</tr>';
  }//fin de while 

  function traer_nombre123($tabla,$id_cliente,$conexion){
      $sql_cliente= "select * from $tabla where idcliente = '".$id_cliente."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $nombre = $arr_cliente['nombre'];
      return  $nombre;
  }

  function nombre_tarifa($tabla,$id_tarifa,$conexion){
      $sql_datos_tarifa = "select * from $tabla where id_producto =  '".$id_tarifa."'  ";
       $con_tarifa = mysql_query($sql_datos_tarifa,$conexion);
      $arr_tarifa = mysql_fetch_assoc($con_tarifa);
      $nombre = $arr_tarifa['nombre'];
      return  $nombre;
  }

    function traer_identi($tabla,$id_cliente,$conexion){
      $sql_cliente= "select * from $tabla where idcliente = '".$id_cliente."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $identi = $arr_cliente['identi'];
      return  $identi;
  }

  function traer_estado($tabla,$id_estado,$conexion){
      $sql_cliente= "select * from $tabla where id_estado = '".$id_estado."'  ";
      $con_cliente = mysql_query($sql_cliente,$conexion);
      $arr_cliente = mysql_fetch_assoc($con_cliente);
      $nombre = $arr_cliente['nombre'];
      return  $nombre;
  }

?>
</tbody>
</table>	

</body>
</html>