<?php
session_start();
include('../valotablapc.php');

$sql_reservas = "select r.*,c.identi,c.nombre from $reservas r 
left outer  join $tabla3 c on (c.idcliente = r.id_cliente)
  where   1=1  and r.anulado = '0'  ";

if(isset($_REQUEST['identi_titular']) && $_REQUEST['identi_titular'] != '')
{
  $sql_reservas .= " and c.identi =  '".$_REQUEST['identi_titular']."' ";
}
if(isset($_REQUEST['nombre_titular']) && $_REQUEST['nombre_titular'] != '')
{
  $sql_reservas .= " and c.nombre like  '%".$_REQUEST['nombre_titular']."%' ";
}
if(isset($_REQUEST['no_radicado_buscar']) && $_REQUEST['no_radicado_buscar'] != '')
{
  $sql_reservas .= " and no_reserva =  '".$_REQUEST['no_radicado_buscar']."' ";
}

if(isset($_REQUEST['fecha_in']) && $_REQUEST['fecha_in'] != '')
{
  $sql_reservas .= " and fecha_creacion >=  '".$_REQUEST['fecha_in']."' ";
}
/*
if(isset($_REQUEST['fecha_fin']) && $_REQUEST['fecha_fin'] != '')
{
  $sql_reservas .= " and fecha_creacion <=  '".$_REQUEST['fecha_fin']."' ";
}
*/
$sql_reservas .= " order  by no_reserva desc ";


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
</head>
<body>
  <h3><a href = "mostrar_reservas_excell.php?consulta=<?php echo $sql_reservas; ?>" >Enviar Informe Excell</a></h3>
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
      echo '<td>ANULAR</td>';
      echo '<td>MODIFICAR</td>';
      echo '<td>PASAJEROS</td>';

      echo '<td>VER DETALLE</td>';
      echo '<td>IMPRIMIR</td>';

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
 
  		echo '<td align="right">'.number_format($reservas['total'], 0, ',', '.').'</td>';
      echo '<td align="right">'.number_format($reservas['saldo_reserva'], 0, ',', '.').'</td>';

      if($_SESSION['nivel_perfil']>=3)
      {
          echo '<td><a href="anular_reserva.php?id_reserva='.$reservas['id_reserva'].'" >Anular</a></td>';
          echo '<td><a href="modificar_reserva.php?id_reserva='.$reservas['id_reserva'].'" >Modificar</a></td>';
      }
      else
      {
          echo '<td></td><td></td>';
      }    

       echo '<td><a href="ver_pasajeros_reserva.php?id_reserva='.$reservas['id_reserva'].'" >Pasajeros</a></td>';
       
       echo '<td><a href="ver_detalle_reserva.php?id_reserva='.$reservas['id_reserva'].'" >Ver Mas</a></td>';
       echo '<td><a href="imprimir_reserva.php?id_reserva='.$reservas['id_reserva'].'" target="_blank" >Imprimir</a></td>';

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