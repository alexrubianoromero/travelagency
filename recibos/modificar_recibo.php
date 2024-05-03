<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');
include('../funciones_summers.php');

$datos_recibo = consulta_assoc($recibos,'id_recibo',$_REQUEST['id_recibo'],$conexion);
$datos_reserva=  consulta_assoc($reservas,'id_reserva',$datos_recibo['id_reserva'],$conexion);
$datos_cliente=  consulta_assoc($tabla3,'idcliente',$datos_recibo['id_cliente'],$conexion);
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
<div id="div_actualizar_recibo">
<input type="hidden"  id= "id_recibo"  value = "<?php echo $_REQUEST['id_recibo']  ?>"  >
	<input type="hidden"  id= "id_reserva"  value = "<?php echo $datos_recibo['id_reserva']  ?>"  >	
	<input type="hidden"  id= "valor"  value = "<?php echo $datos_recibo['valor']  ?>"  >	
<h2>MODIFICACION DE RECIBOS </h2> 
<table  border = "1">
<tr>
<td>No Recibo</td>
<td><?php  echo $datos_recibo['no_recibo'];  ?></td>
</tr>	
<tr>
<td>Fecha</td>
<td><?php  echo $datos_recibo['fecha'];  ?></td>
</tr>	

<tr>
<td>No Reserva</td>
<td><?php  echo $datos_reserva['no_reserva'];  ?></td>
</tr>	
<tr>
<td>Nombre Cliente</td>
<td><?php  echo $datos_cliente['nombre'];  ?></td>
</tr>	
<tr>
<td>Efectivo</td>
<td>
<input type="text"  id="efectivo"  value ="
	<?php  echo $datos_recibo['efectivo'];  ?>"></td>
</tr>	
<tr>
<td>Consignacion</td>
<td>
<input type="text"  id="consignacion"  value ="
<?php  echo $datos_recibo['consignacion'];  ?>"</td>
</tr>	
<tr>
<td>Tarjeta</td>
<td>
<input type="text"  id="tarjeta"  value ="
<?php  echo $datos_recibo['tarjeta'];  ?>"</td>
</tr>	

</table>
<br><br>
<button id="btn_actualizar_recibo"> Actualizar Recibo  </button>
</div>
</body>
</html>


<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
					 $("#btn_actualizar_recibo").click(function(){

							var data =  'id_recibo=' + $("#id_recibo").val();
							data += '&id_reserva=' + $("#id_reserva").val();
							data += '&valor=' + $("#valor").val();
							data += '&efectivo=' + $("#efectivo").val();
							data += '&consignacion=' + $("#consignacion").val();
							data += '&tarjeta=' + $("#tarjeta").val();

							$.post('actualizar_recibo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_actualizar_recibo").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////

});		////finde la funcion principal de script
		
</script>