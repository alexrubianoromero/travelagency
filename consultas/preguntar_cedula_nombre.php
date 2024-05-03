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

CEDULA <input type="text" id="cedula1" name = "cedula1" placeholder="Digite Cedula">
NOMBRE <input type="text" id="nombre1" name = "nombre1" placeholder="Digite Nombre">
<button id="buscar1" >CONSULTAR</button>
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
	
					 $("#buscar1").click(function(){
					 	//alert('asdfdsfs');
							  data =  'nombre1=' + $("#nombre1").val();
							data += '&cedula1=' + $("#cedula1").val();

							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_personas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#muestre").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
});		////finde la funcion principal de script
		
</script>