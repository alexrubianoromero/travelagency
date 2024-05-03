<?php
session_start();
include('../valotablapc.php');

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<div id="div_productos1" align="center">
<h3>COMPROBANTES EGRESO </h3>
<!--<button id="btn_nuevo_producto">NUEVO EGRESO</button>-->
<br>*Para traer informacion por numero de radicado se debe sellecionar si es egreso de comision o de proveedor  <br>
No Radicado
<input type="text" id ="buscar_no_radicado" size="6px">
Tipo Egreso
<select id="buscar_id_tipo" >
   <?php

   colocar_select_general($tipos_recibos_proveedores,$conexion,'id_tipo_recibo','descripcion');
   ?>
</select> 	
Concepto 
<select id="buscar_id_concepto" >
   <?php

   colocar_select_general($cxp_conceptos,$conexion,'id_concepto','nombre_concepto');
   ?>
</select> 	
Inicial
<input type="date"  id="buscar_fecha_in"  >
Final
<input type="date"  id="buscar_fecha_fin"  >
<button id="filtrar_busqueda">FILTRAR_BUSQUEDA</button>   
<br><br>

<div id="div_muestre_productos" align="center">
	<?php
       include('mostrar_hoteles.php');
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
					 $("#btn_nuevo_producto").click(function(){
							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('nuevo_hotel.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_productos").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#vendedores").click(function(){
							var data =  'rol=' + '2';
							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_personas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#nuevo").click(function(){
							var data =  'nuevo=' + '';
							//data += '&placa=' + $("#placa").val();
							$.post('captura_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					 $("#filtrar_busqueda").click(function(){
							var data =  'buscar_id_tipo=' + $("#buscar_id_tipo").val();
							data += '&buscar_id_concepto=' + $("#buscar_id_concepto").val();
							data += '&buscar_fecha_in=' + $("#buscar_fecha_in").val();
							data += '&buscar_fecha_fin=' + $("#buscar_fecha_fin").val();
							data += '&buscar_no_radicado=' + $("#buscar_no_radicado").val();
							
							$.post('mostrar_hoteles.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_productos").html(a);
								//alert(data);
							});	
						 });


					 ///////////////////////


});		////finde la funcion principal de script
		
</script>

<?php

function colocar_select_general($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla   ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}


?>