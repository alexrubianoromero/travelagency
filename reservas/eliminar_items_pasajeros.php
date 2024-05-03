<?php
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$eliminar_pasajero = "delete from $item_pasajeros_reserva  where id_item_pasajero = '".$_REQUEST['id_item_pasajero']."'  ";
$consulta_eliminar = mysql_query($eliminar_pasajero,$conexion);

include('mostrar_pasajeros.php');
mostrar_pasajeros($_REQUEST['id_reserva']);
?>
<script  type="text/JavaScript">
$(document).ready(function(){

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