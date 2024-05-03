<?php
session_start();
include('../valotablapc.php');

$traer_datos_reserva = "select * from $reservas where id_reserva =  '".$_REQUEST['id_reserva']."'  ";
$consulta_reserva = mysql_query($traer_datos_reserva,$conexion);
$arr_reserva = mysql_fetch_assoc($consulta_reserva);

$id_usuario = $_SESSION['id_usuario']; 
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$fechapan =  time();
////colocar un validacion que solo deje crear reserva cuando este activa la session 
if($_SESSION['id_empresa']<1)
{echo 'Su Sesion ha expirado debe salir e ingresar nuevamente al sistema';}	
else
{	
?>

<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
body{
background-color:#E6E6E6;
}
#div_nueva_reserva{
	position:absolute;
	top:2%;
	left:5%;

	width: 90%;
	height: 90%;
	border :1px solid black;
	background-color: #fff;

}

#izquierda{
	position:absolute;
	left:0px;
	bottom:10%;
	width: 50%;
	height: 80%;
	background-color: #fff;
	border :1px solid black;

}
#derecha{
	position:absolute;
	left:50%;
	bottom:10%;
	width: 50%;
	height: 80%;
	background-color: #fff;
	border :1px solid black;

}

#div_central{
	position: absolute;
	left:0%;
	bottom: 10%;
	width: 100%;
	height: 80%;
	border :1px solid black;
	background-color: #fff;
	overflow-x: hidden;
	overflow-y: auto; 
}
#div_boton_grabar{
	position:absolute;
	top: 90%;
	width: 99%;
	height: 10%;
	text-align: center;
	padding: 5px;
	background-color: orange;
	border :1px solid black;
	margin:0 auto;


}
#btn_grabar_reserva{
	
	font-size: 20px;
	padding: 5px;
}
#div_barra_superior{
	position:absolute;
	top:0%;
	left:0%;
	width: 99%;
	height:10%;
	background-color: orange;
	padding: 5px;
	text-align: center;
	font-size: 25px;
}
#div_barra_superior button{
	padding: 5px;
	font-size: 15px

}
#div_numero_reserva{
	position: absolute;
	left:0%;
	width: 30%;
	text-align: left;
}
</style>
</head>
<body>
<div id="div_nueva_reserva">

   <div id="div_barra_superior">
   	     <div id="div_numero_reserva">
   	     RESERVA No  <?php echo $arr_reserva['no_reserva'] ?>
   	     </div>
   	     <input type="hidden" id="id_reserva"  value = "<?php echo $_REQUEST['id_reserva'];  ?>">

   	     <button id = "btn_informacion_general">Informacion General</button>
   	     <button id = "btn_historial_cambios">Historial Cambios</button>
   	     <button id = "btn_historial_comentarios">Historial Comentarios</button>

   </div>	

<div id="div_central" align="center">
	  <?php include('mostrar_detalle_reserva.php');   ?>

</div>	
<div id="div_boton_grabar" align="center">
<!--
    <button type ="submit" id="btn_grabar_reserva">Grabar Reserva</button>
-->
</div>
</div>	
</body>
</html>
<?php
}  // fin de else de si no ha expirado la sesion 

?>


<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////


	 btn_informacion_general
	 $("#btn_informacion_general").click(function(){
							var data =  'id_reserva=' + $("#id_reserva").val();
							//data += '&placa=' + $("#placa").val();
							 $("#div_central").load("mostrar_detalle_reserva.php",data);
						 });
	 	/////////////////////////
					 $("#btn_historial_comentarios").click(function(){
							var data =  'id_reserva=' + $("#id_reserva").val()
							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_comentarios.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_central").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					 $("#btn_historial_cambios").click(function(){
							var data =  'id_reserva=' + $("#id_reserva").val()
							//data += '&placa=' + $("#placa").val();
							$.post('mostrar_historial_cambios.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_central").html(a);
								//alert(data);
							});	
						 });
        
      /////////////////////////////////

});		////finde la funcion principal de script
		
</script>