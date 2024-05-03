<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
?>
<html>
<head>
	<title></title>
	    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
#contenidos123{
	position: relative;
	width: 80%;
}
#div_aviso{
	position: absolute;
	top:36%;
	left:-14%;
	width: 200px;
	height: 100px;
	/*border:1px solid black;*/
	font-size: 30px;
}
</style>
</head>
<body>


<?php
echo '<div id="contenidos" align="center"">';
echo '<div id = "div_aviso">';
echo '<p id="p_aviso"></d>';
echo '</div>';
echo '<h3>CONSULTA GENERAL</h3>';
?>

<button id="clientes">Clientes</button>
<button id="vendedores">Asesores</button>
<button id="directores">Directores</button>
<button id="proveedores">Proveedores</button>
<button id="anulados">Anulados</button>
<button id="nuevo">Nuevo Ingreso</button>
<br><br>
<?php

echo '<div id = "muestre" align="center">';
include('mostrar_personas.php');
echo '</div>';

echo '</div>';
?>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
	 var aviso = 'GENERAL';
	 $("#p_aviso").text(aviso);
							$("#p_aviso").text(aviso);
					 $("#clientes").click(function(){
							var data =  'rol=' + '1';
							var aviso = 'CLIENTES';
							$("#p_aviso").text(aviso);

							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_personas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#vendedores").click(function(){
							var data =  'rol=' + '2';
							var aviso = 'ASESORES';
							$("#p_aviso").text(aviso);
							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_personas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#proveedores").click(function(){
							var data =  'rol=' + '3';
							var aviso = 'PROVEEDORES';
							$("#p_aviso").text(aviso);
							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_personas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					  ///////////////////////////
					   $("#directores").click(function(){
							var data =  'rol=' + '4';
							var aviso = 'DIRECTOR';
							$("#p_aviso").text(aviso);
							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_personas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					  ///////////////////////////
					   $("#anulados").click(function(){
							var data =  'anulado=' + '1';
							var aviso = 'Anulados';
							$("#p_aviso").text(aviso);
							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_personas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });




					 //////////////////////////
					  $("#nuevo").click(function(){
							var data =  'nuevo=' + '';
							var aviso = 'NUEVO';
							$("#p_aviso").text(aviso);
							//data += '&placa=' + $("#placa").val();
							$.post('captura_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////


});		////finde la funcion principal de script
		
</script>