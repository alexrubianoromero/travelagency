<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');




$id_usuario = $_SESSION['id_usuario']; 
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
//$fecha_hora_actual = date('Y-m-d H:i:s'); 
$fechapan =  time();

/*
$hoy = getdate();
print_r($hoy);
*/
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
#div_nueva_reserva{
	position:absolute;
	left:5%;
	width: 90%;
	height: 100%;
	border :1px solid black;
	background-color: #fff;

}
#div_boton_grabar123{
	position:absolute;
	bottom: 0%;
	width: 99%;
	height: 5%;
	text-align: center;
	padding: 5px;
	background-color: orange;
	border :1px solid black;
	margin:0 auto;


}
#btn_grabar_reserva{
	
	font-size: 20px;
	padding: 1px;
}
#div_central_reserva {
	position: absolute;
	left:0px;
	top:0%;
	width: 100%;
	height: 95%;
	border :1px solid black;
	background-color: #fff;
	overflow-y:auto; 

}
#div_buscar_asesor,  #div_buscar_cliente, #div_buscar_director {
	display:none;
	position:relative;
	width: 300px;
	height: 200px;
	background: grey;
	color: white;
	border: 1px solid black;
}
#div_buscar_asesor select{
color: black;
}
#div_buscar_cliente select{
color: black;
}
#div_buscar_director select{
color: black;
}


</style>
</head>
<body>
	<input type="hidden"  id="id_reserva"  value= "<? echo $_REQUEST['id_reserva']  ?>" >
<div id="div_anular_reserva">

		<div id="div_central_reserva">
		<?php  include('pantalla_anular_total.php') ?>

		</div>
		<div id="div_boton_grabar123" align="center">

    	<button  id="btn_anular_reserva123">Anular Reserva...</button>
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

	//iniciar_valores();			 
	$("#btn_anular_reserva123").click(function(){
						alert('anulo la reserva');
						
							var data =  'id_reserva=' + $("#id_reserva").val();
							//data += '&id_tipo_destino=' + $("#id_tipo_destino").val()
							$.post('anulacion_reserva.php',data,function(a){
							//$(window).attr('location', '../index.php);
							  $("#div_anular_reserva").html(a);
								//alert(data);
							});	
        			 
    });
  //////////////////
        
});		////finde la funcion principal de script

</script>