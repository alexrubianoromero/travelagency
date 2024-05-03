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
</head>
<body>
<div id="div_comisiones">

<h2>COMISIONES</h2>
<button id = "btn_comisiones_pendientes_pago">COMISIONES PENDIENTES DE PAGO</button>
<button id = "btn_comisiones_pagadas">COMISIONES PAGADAS</button>
<hr></hr>



<div id="div_muestre_comisiones" align="center">


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
					 $("#btn_comisiones_pendientes_pago").click(function(){

							var data =  'pagadas=' + '0';
							//data += '&placa=' + $("#placa").val();
							$.post('muestre_comisiones.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_comisiones").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#btn_comisiones_pagadas").click(function(){

							var data =  'pagadas=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('muestre_comisiones.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_comisiones").html(a);
								//alert(data);
							});	
						 });
					 /////////////////// 

});		////finde la funcion principal de script
		
</script>