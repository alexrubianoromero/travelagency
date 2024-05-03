<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>

</style>
</head>
<body>

 <div id="div_fechas_informe_arriba">
 	<h3>INFORME RESUMIDO DE RESERVAS</h3>
   FECHA INICIAL <input type="date" id="fecha_in">
   FECHA FINAL <input type="date" id="fecha_fin">  
 
   <button id="btn_buscar_fechas">CONSULTAR</button>
   <br><br>
 </div>
  
  <div id ="div_muestre_informe_reservas">

  </div>	



</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">      
$(document).ready(function(){
	 /////////////////////////
					
					 ////////////////////////
					  $("#btn_buscar_fechas").click(function(){

							var data =  'fecha_in=' + $("#fecha_in").val();
							data += '&fecha_fin=' + $("#fecha_fin").val();
							//data += '&enviar_excel=' + $("#enviar_excel:checked").val();
							//$.post('nueva_reserva.php',data,function(a){
						    $.post('mostrar_informe_reservas_resumido_fechas.php',data,function(a){		
							//$(window).attr('location', '../index.php);
							$("#div_muestre_informe_reservas").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////

});		////finde la funcion principal de script
		
</script>
