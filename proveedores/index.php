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
<div id="div_proveedores" align="center">
	CUENTAS PROVEEDORES<BR>
	<button id = "btn_crear_nueva_cuenta">CREAR CUENTA X PAGAR A PROVEEDOR RESERVA</button>
	RADICADO<input type = "text"  id = "buscar_radicado" placeholder = "No Y ENTER" class="fila_llenar" size="10px">
	<BR><br>
	<div id="div_muestre_cuentas_proveedores">
	<?php
		include('muestre_cuentas_proveedores.php');
	?>
	 	
	</div>
	<div id="div_pagos">
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
					 $("#btn_crear_nueva_cuenta").click(function(){

							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('nueva_cuentaxpagar.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_cuentas_proveedores").html(a);
								//alert(data);
							});	
						 });
	////////////////////////

 $("#buscar_radicado").keyup(function(e){
          //$("#cosito").html( $("#nombrepan").val() );
          if (e.which == 13)
          {
              
          	//alert('digito enter');	
          		
          		 var data1 ='buscar_radicado=' + $("#buscar_radicado").val();
              $.post('muestre_cuentas_proveedores.php',data1,function(b){
              		$("#div_muestre_cuentas_proveedores").html(b);
              });
			
			$("#div_pagos").html('');	
              
             
              /////////////////////////
          }// fin del if    
         });//finde funcion 
	     
	////////////////////////

	 $(".pagos").click(function(){
              //alert('dasdasdasdas');
              var data =  'id_cxp=' + $(this).attr('value');
              //data += '&id_reserva=' + $("#id_reserva").val();
              $.post('../recibos_proveedores/mostrar_recibos_proveedores.php',data,function(a){
                $("#div_pagos").html(a);
                //alert(data);
              }); 
    });
	////////////////////////

});		////finde la funcion principal de script
		
</script>