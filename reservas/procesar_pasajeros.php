<?php
session_start();
include('../valotablapc.php');
//include('../funciones_summers.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_insertar_pasajero = "insert into $item_pasajeros_reserva 
(apellidos,nombres,identificacion,fecha_nacimiento,id_reserva)
values(
	'".$_REQUEST['apellidos']."'
	,'".$_REQUEST['nombres']."'
	,'".$_REQUEST['identificacion']."'
	,'".$_REQUEST['fecha_nacimiento']."'
	,'".$_REQUEST['id_reserva']."'
)";
$consulta_grabar_pasajero = mysql_query($sql_insertar_pasajero,$conexion);

include('mostrar_pasajeros.php');
mostrar_pasajeros($_REQUEST['id_reserva']);
?>

<script  type="text/JavaScript">
$(document).ready(function(){



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
		////////////////////////////////////////			 
 });
</script>