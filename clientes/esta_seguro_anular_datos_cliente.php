<?php
session_start();
include('../valotablapc.php');
include('../funciones.php');
  function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
$datos_persona = consulta_assoc($tabla3,'idcliente',$_REQUEST['idcliente'],$conexion);
?>
<html>
<head>
	<title></title>
	    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
   <meta name='viewport' content='width=device-width initial-scale=1'>
<meta name='mobile-web-app-capable' content='yes'>
<link rel='stylesheet' href='../css/bootstrap.min.css'>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src='../js/bootstrap.min.js'></script>
<style>

#div_anular{
	position: relative;
	width: 90%;
	border: 1px solid black;
	padding: 20px;
	border-radius: 15px;
}
#div_informacion{
	position: relative;
	width: 70%;
	background-color: #c0c0c0;
	font-size: 20px;
	color:white;
	border-radius: 15px;
}
</style>
</head>
<body>
<div id="div_abarca_todo" align="center">
	<br><br>
<div id="div_anular" align="center">	

<input type="hidden"  id="idcliente"   value="<?php   echo  $_REQUEST['idcliente']; ?>">
      <h1>ANULACION DE PERSONAS</H1>
    <div id="div_informacion">

    	<label>NOMBRE: <?php  echo $datos_persona['nombre']; ?></label>

    </div>

	<h2>ESTA SEGURO DE ANULAR ESTA PERSONA ?</H2>

<div class="row ">
	<div class = "col-md-2">
</div>
<div class = "col-md-3 ">
<button id="btn_si" class="btn btn-success btn-lg btn-block">SI</button>
</div>
<div class = "col-md-2">
</div>
<div class = "col-md-3">
<button id="btn_no" class="btn btn-warning btn-lg btn-block">NO</button>
</div>
<div class = "col-md-2">
</div>
</div>
</div>
</div>

</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">   
$(document).ready(function(){
			 //////////////////////////
			 //alert('sdfsdfdsd');
					  $("#btn_si").click(function(){
						    var data =  'idcliente=' + $("#idcliente").val();
							//data += '&cedula=' + $("#cedula").val();
						
							//data += '&placa=' + $("#placa").val();
							$.post('../clientes/anular_datos_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_abarca_todo").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////

					  $("#btn_no").click(function(){
						    //var data =  'idcliente=' + $("#idcliente").val();
							//data += '&cedula=' + $("#cedula").val();
						
							//data += '&placa=' + $("#placa").val();
							//$.post('../clientes/anular_datos_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							//$("#div_abarca_todo").html(a);
								//alert(data);
							//});	
					         location.href="../clientes/consultacliente_general.php";

						 });



});
</script>	