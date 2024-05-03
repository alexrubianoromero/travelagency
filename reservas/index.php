<?php
session_start();
include('../valotablapc.php');
include('../herramientas/verificar_saldos.php');
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
#div_busqueda{
	position: relative;
	width: 200px;
	height: 200px;
	border: 1px solid black;
	display: inline;
	padding: 10px;
	
}
</style>
</head>
<body>
<input type = "hidden" id="id_empresa"   value = "<?php  echo  $_SESSION['id_empresa'] ?>" >
<div id="div_prueba_info">
</div>	
<div id="div_reservas" align="center">
<div id="div_reservas_arriba">
	<br>
<button id="btn_nueva_reserva">NUEVA RESERVA</button> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <div id="div_busqueda">   
	<input type="text" id="identi_titular" size = "7px" placeholder="Identidad" > 
	<input type="text" id="nombre_titular" size = "7px" placeholder="Nombre" >
	<input type="text" id="no_radicado_buscar" size = "7px" placeholder="Radicado" >
	<input type="date" id="fecha_in" size = "7px" placeholder="Fecha_Inicial" >
	<!--<input type="date" id="fecha_fin" size = "7px" placeholder="Fecha_Final" > -->


	<button id="btn_buscar">BUSCAR RESERVA</button>
   </div>
	<br><br>
	
</div>

<div id="div_muestre_reservas" align="center">
	
	<?php
       include('mostrar_reservas.php');
	?>
</div>	
</div>
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">      
$(document).ready(function(){
	 /////////////////////////
					 $("#btn_nueva_reserva").click(function(){

							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							//$.post('nueva_reserva.php',data,function(a){
						    $.post('pregunte_cliente.php',data,function(a){		
							//$(window).attr('location', '../index.php);
							$("#div_muestre_reservas").html(a);
							//$("#div_prueba_info").html(a);
							//div_prueba_info
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#btn_buscar").click(function(){

							var data =  'rol=' + '1';
							data += '&identi_titular=' + $("#identi_titular").val();
							data += '&nombre_titular=' + $("#nombre_titular").val();
							data += '&no_radicado_buscar=' + $("#no_radicado_buscar").val();
							data += '&fecha_in=' + $("#fecha_in").val();
							//data += '&fecha_fin=' + $("#fecha_fin").val();
							//$.post('nueva_reserva.php',data,function(a){
						    $.post('mostrar_reservas.php',data,function(a){		
							//$(window).attr('location', '../index.php);
							$("#div_muestre_reservas").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////

});		////finde la funcion principal de script
		
</script>