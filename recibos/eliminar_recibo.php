<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$datos_recibo = consulta_assoc($recibos,'id_recibo',$_REQUEST['id_recibo'],$conexion);
$datos_cliente=  consulta_assoc($tabla3,'idcliente',$datos_recibo['id_cliente'],$conexion);
$no_reserva = traer_numero_reserva($reservas,$datos_recibo['id_reserva'],$conexion);
$datos_reserva=  consulta_assoc($reservas,'id_reserva',$datos_recibo['id_reserva'],$conexion);
$datos_cliente=  consulta_assoc($tabla3,'idcliente',$datos_recibo['id_cliente'],$conexion);
$nombre_usuario = traer_nombre_usuario($tabla16,$datos_recibo['id_usuario'],$conexion);

$datos_tarifa =  consulta_assoc($tarifas,'id_tarifa',$datos_reserva['id_tarifa'],$conexion);

$datos_hotel =  consulta_assoc($hoteles,'id_hotel',$datos_tarifa['id_hotel'],$conexion);
/*
echo '<pre>';
print_r($datos_hotel);
echo '</pre>';
*/

$datos_destino=  consulta_assoc($destinos,'id_destino',$datos_tarifa['id_destino'],$conexion);
$nombre_cliente  = traer_nombre($tabla3,$reservas['id_cliente'],$conexion);
      $identi_cliente  =          traer_identi($tabla3,$reservas['id_cliente'],$conexion);
      $numero_reserva  = traer_numero_reserva('reservas',$reservas['id_reserva'],$conexion);
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
<div id="div_eliminar_recibo">	
	<input type="hidden"  id= "id_recibo"  value = "<?php echo $_REQUEST['id_recibo']  ?>"  >
	<input type="hidden"  id= "id_reserva"  value = "<?php echo $datos_recibo['id_reserva']  ?>"  >
<h2>ELIMINAR </h2>
<BR><BR>
	Informacion Recibo 
<table class="formato_tabla">
  <thead>
<?php
	echo '<tr>';
      echo '<td>NO RECIBO..</td>';
      echo '<td>RESERVA</td>';
       echo '<td>IDENT CLIENTE</td>';
  		echo '<td>NOMBRE CLIENTE</td>';
      echo '<td>VALOR</td>';
      //echo '<td>VER DETALLE</td>';
   

  		echo '</tr>';
  echo '</thead>';   
    echo '<tbody>'; 
    echo '<tr>';
     echo '<td>'.$datos_recibo['no_recibo'].'</td>';
     echo '<td>'.$no_reserva['no_reserva'].'</td>';
     echo '<td>'.$datos_cliente['identi'].'</td>';
     echo '<td>'.$datos_cliente['nombre'].'</td>';
     echo '<td>'.$datos_recibo['valor'].'<input type="hidden" id = "valor" value="'.$datos_recibo['valor'].'"></td>';

    echo '</tr>';

    echo '</tbody>'; 

    echo '</table>';
?>
<br><br>
<button id="btn_eliminar_recibo">ELIMINAR RECIBO</button>
</div>
	</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
					 $("#btn_eliminar_recibo").click(function(){

							var data =  'id_recibo=' + $("#id_recibo").val();
							data += '&valor=' + $("#valor").val();
							data += '&id_reserva=' + $("#id_reserva").val();
							$.post('eliminacion_recibo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_eliminar_recibo").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////

});		////finde la funcion principal de script
		
</script>