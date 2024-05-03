<?php
session_start();
include('../valotablapc.php');
?>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<?php

echo '<div id="div_123_modificar"';
echo '<br><br>';
echo '<table border = "1" >';
echo '<tr>';
echo '<td> <input type="hidden" id="id_destino" value="'.$_REQUEST['id_destino'].'" ></td>';

echo '<tr>';
echo '<tr>';
echo '<td>NOMBRE <input type="text" id="nombre" value="'.$_REQUEST['nombre'].'" class="fila_llenar" ></td>';

echo '<tr>';
echo '<tr>';
echo '<td><button id="btn_grabar_modificar" >MODIFICAR</button></td>';

echo '<tr>';
echo '</table>';


/*
$sql_modificar = "update $destinos 
set nombre = '".$_REQUEST['nombre']."' 
 where id_destino = '".$_REQUEST['id_destino']."'  ";

$consulta_modif = mysql_query($sql_modificar,$conexion); 
*/

?>
</div>	
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////
           $("#btn_grabar_modificar").click(function(){
           	//alert('modificar destino');
           			
		              var data =  'nombre=' + $("#nombre").val();
		              data += '&id_destino=' + $("#id_destino").val();
		            
		              $.post('grabar_modificar_destino.php',data,function(a){
		              //$(window).attr('location', '../index.php);
		              $("#div_123_modificar").html(a);
		                //alert(data);
		              }); 
					
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>