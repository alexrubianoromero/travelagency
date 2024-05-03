<?php
session_start();
include('../valotablapc.php');

$no_reserva= traer_algo_reserva123($reservas,$_REQUEST['id_reserva'],'no_reserva',$conexion);
$ancho="80%";
?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
	
<?php	
echo '<div id="div_ver_pasajeros" align="center">';
echo 'PASAJEROS RESERVA '.$_REQUEST['id_reserva'];
echo '<br><br>';
echo '<table border = "1" width="'.$ancho.'">';
echo '<tr>';
echo '<td>#PAX</td>';
echo '<td>APELLIDOS</td>';
echo '<td>NOMBRES</td>';
echo '<td># IDENTIFICACION</td>';
echo '<td>FECHA NACIMIENTO</td>';
echo '<td>AGREGAR
<input type="hidden" id="id_reserva" value="'.$_REQUEST['id_reserva'].'"> 
</td>';
echo '</tr>';
echo '<tr>';
echo '<td></td>';
echo '<td><input type="text" id="apellidos" class = "fila_llenar"></td>';
echo '<td><input type="text" id="nombres" class = "fila_llenar"></td>';
echo '<td><input type="text" id="identificacion" class = "fila_llenar"></td>';
echo '<td><input type="date" id="fecha_nacimiento" class = "fila_llenar"></td>';
echo '<td><button id="btn_agregar_pasajero">AGREGAR</button></td>';
echo '</tr>';
echo '</table>';
$id_reserva = $_REQUEST['id_reserva'];
echo '<br><br>';
echo 'PASAJEROS INCLUIDOS EN LA RESERVA';
echo '<div id="div_pasajeros_agregados" align="center">';

include('mostrar_pasajeros.php');
mostrar_pasajeros($id_reserva);
echo '</div>';
echo '</div>';

  function traer_algo_reserva123($tabla,$id_reserva,$campo,$conexion){
      $sql_reserva= "select * from $tabla where id_reserva = '".$id_reserva."'  ";
      //echo '<br>'.$sql_reserva;
      $con_reserva = mysql_query($sql_reserva,$conexion);
      $arr_reserva = mysql_fetch_assoc($con_reserva);
      $resultado = $arr_reserva[$campo];
      return  $resultado;
  }
?>
</body>
</html>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
<script  type="text/JavaScript">
$(document).ready(function(){
                         $("#btn_agregar_pasajero").click(function(){

							var data =  'id_reserva=' + $("#id_reserva").val();
							data += '&apellidos=' + $("#apellidos").val();
							data += '&nombres=' + $("#nombres").val();
							data += '&identificacion=' + $("#identificacion").val();
							data += '&fecha_nacimiento=' + $("#fecha_nacimiento").val();
							//alert(data);
							$.post('procesar_pasajeros.php',data,function(a){
							$("#div_pasajeros_agregados").html(a);
								//alert(data);
							});	

							$("#apellidos").val('');
							$("#nombres").val('');
							$("#identificacion").val('');
							$("#fecha_nacimiento").val('');

						 });

		///////////////////////////////
		$(".eliminar").click(function(){
							//alert('dasdasdasdas');
							var data =  'id_item_pasajero=' + $(this).attr('value');
							data += '&id_reserva=' + $("#id_reserva").val();
							$.post('eliminar_items_pasajeros.php',data,function(a){
								$("#div_pasajeros_agregados").html(a);
								//alert(data);
							});	
		});
		///////////////////////////////				 
 });
</script>