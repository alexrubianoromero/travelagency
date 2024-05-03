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
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<input type = "hidden" id="id_empresa"   value = "<?php  echo  $_SESSION['id_empresa'] ?>" >

<div id="div_reservas" align="center">
<div id="div_reservas_arriba">
	<h3>RECIBOS</h3>
	<button id="btn_nuevo_recibo">NUEVO RECIBO</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" id="no_recibo_buscar" size="6px" placeholder="No Recibo"><button id="btn_buscar_numero_recibo" >BUSCAR NO RECIBO</button>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="text" id="no_reserva_buscar" size="6px" placeholder="No Reserva"><button id="btn_buscar_reserva_recibo" >BUSCAR NO RESERVA</button>
	<br><br>
</div>

<div id="div_muestre_recibos" align="center">
	
	<?php
       include('mostrar_recibos.php');
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
					 $("#btn_nuevo_recibo").click(function(){

							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('nuevo_recibo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_recibos").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#btn_buscar_numero_recibo").click(function(){

							var data =  'rol=' + '1';
							data += '&no_recibo_buscar=' + $("#no_recibo_buscar").val();
							$.post('mostrar_recibos.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_recibos").html(a);
								//alert(data);
							});	
						 });
					  ////////////////////////
					   $("#btn_buscar_reserva_recibo").click(function(){

							var data =  'rol=' + '1';
							data += '&no_reserva_buscar=' + $("#no_reserva_buscar").val();
							$.post('mostrar_recibos.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_recibos").html(a);
								//alert(data);
							});	
						 });




});		////finde la funcion principal de script
		
</script>