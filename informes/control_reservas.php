<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');

?>


<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
#div_informe_control_reservas{
  position:relative;
  width: 100%;
   /* border:1px solid orange;*/

}
</style>
</head>
<body>
INFORME CONTROL RESERVAS<BR><BR>
DIGITE EL NUMERO DEL RADICADO
<input type="text" id = "no_reserva" size ="7px" >
<input type = "hidden" id="id_reserva">
<br><br>
<div id="div_informe_control_reservas">

</div>	
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	///////////////////////////////
	$("#no_reserva").keyup(function(e){
          
          if (e.which == 13)
          {
             

          	 var data1 ='no_reserva=' + $("#no_reserva").val();
              $.post('traer_informe_abonos_pagos_reserva.php',data1,function(b){
                $("#div_informe_control_reservas").html(b);   
              
              });

           }// fin del if    
         });//finde funcion 

///////////////////////
				/*				 
		$("#no_reserva").keyup(function(e){
          
          if (e.which == 13)
          {
              
          
              var data1 ='no_reserva=' + $("#no_reserva").val();
              $.post('traer_datos_reserva.php',data1,function(b){
                  $("#id_reserva").val(b[0].id_reserva);
                  $("#nombre_cliente").val(b[0].nombre);
                   $("#id_cliente").val(b[0].id_cliente);
                   $("#recibo_segun_reserva").val(b[0].recibo_segun_reserva);
                   $("#saldo_reserva").val(b[0].saldo_reserva);
                  
               //(data1);
              },
              'json');
               
              /////////////////////////
          }// fin del if    
         });//finde funcion 
       */
	/////////////////////////////////////
	});
</script>