<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');


$sql_traer_ultima_reserva = "select contareservas from $tabla10    ";
$con_ultima = mysql_query($sql_traer_ultima_reserva,$conexion);
$arr_ultima = mysql_fetch_assoc($con_ultima);
$ultima_reserva = $arr_ultima['contareservas'];
$siguiente_reserva = $ultima_reserva + 1 ;


$id_usuario = $_SESSION['id_usuario']; 
/*
echo '<pre>';
print_r($_SESSION);
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
#div_nueva_reserva{
	position:absolute;
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

</style>
</head>
<body>
<div id="div_nueva_reserva">

   <div id="div_barra_secundaria">
   </div>	

<div id="izquierda">
 		
      <?php  include('pantalla_captura1_reservas.php') ?>

</div>
<div id="derecha">
	 <?php  include('pantalla_captura2_reservas.php') ?>
</div>	
<div id="div_boton_grabar" align="center">

    <button type ="submit" id="btn_grabar_reserva">Grabar Reserva</button>
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
					 $("#btn_nueva_reserva").click(function(){
							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('nueva_reserva.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_reservas").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					 $("#btn_grabar_reserva").click(function(){

					 	//////////////////////

					      if($("#identidad").val().length < 1)
					        { alert('digite identidad ');
					      $(identidad).focus();
					          return false;
					         }

					    
					      if($("#id_vendedor").val().length < 1)
					        { alert('Digite id_vendedor'); 
					        $(id_vendedor).focus();
					        return false;}

					      if($("#ciudad_asesor").val().length < 1)
					        { alert('Digite ciudad_asesor'); 
					        $(ciudad_asesor).focus();
					        return false;}

					      if($("#total").val().length < 1)
					        { alert('Digite total'); 
					        $(total).focus();
					        return false; }
					           if($("#tipo_venta").val().length < 1)
					        { alert('Digite tipo_venta'); 
					        $(tipo_venta).focus();
					        return false; }

					           if($("#id_estado").val().length < 1)
					        { alert('Digite _estado'); 
					        $(id_estado).focus();
					        return false; }

					           if($("#Sucursal").val().length < 1)
					        { alert('Digite Sucursal'); 
					        $(Sucursal).focus();
					        return false; }
					           if($("#id_tarifa").val().length < 1)
					        { alert('Digite id_tarifa'); 
					        $(id_tarifa).focus();
					        return false; }

					      


					           if($("#fecha_creacion").val().length < 1)
					        { alert('Digite fecha_creacion'); 
					        $(fecha_creacion).focus();
					        return false; }
					           if($("#pasajero_responsable").val().length < 1)
					        { alert('Digite pasajero_responsable'); 
					        $(pasajero_responsable).focus();
					        return false; }
					            if($("#moneda").val().length < 1)
					        { alert('Digite moneda'); 
					        $(moneda).focus();
					        return false; }
					             if($("#ciudad_venta").val().length < 1)
					        { alert('Digite ciudad_venta'); 
					        $(ciudad_venta).focus();
					        return false; }
					    

					           if($("#forma_pago").val().length < 1)
					        { alert('Digite forma_pago'); 
					        $(forma_pago).focus();
					        return false; }

					          if($("#titular").val().length < 1)
					        { alert('Digite titular'); 
					        $(titular).focus();
					        return false; }

 
            //////////////////////



					 	//////////////////////



							var data =  'id_cliente=' + $("#id_cliente").val();
							data += '&no_reserva=' + $("#no_reserva").val();
							data += '&id_vendedor=' + $("#id_vendedor").val();
							data += '&ciudad_asesor=' + $("#ciudad_asesor").val();
							data += '&total=' + $("#total").val();
							data += '&tipo_venta=' + $("#tipo_venta").val();
							data += '&id_estado=' + $("#id_estado").val();
							data += '&sucursal=' + $("#Sucursal").val();
							data += '&id_tarifa=' + $("#id_tarifa").val();
							data += '&fecha_creacion=' + $("#fecha_creacion").val();
							data += '&pasajero_responsable=' + $("#pasajero_responsable").val();
							data += '&moneda=' + $("#forma_pago").val();
							data += '&forma_pago=' + $("#moneda").val();
							data += '&ciudad_venta=' + $("#ciudad_venta").val();
							data += '&titular=' + $("#titular").val();


							$.post('grabar_reserva.php',data,function(a){
							//$(window).attr('location', '../index.php);
							  $("#div_muestre_reservas").html(a);
								//alert(data);
							});	
						 });
  //////////////////
         $("#identidad").keyup(function(e){
          //$("#cosito").html( $("#nombrepan").val() );
          if (e.which == 13)
          {
              
          	//alert('digito enter');	
          	/*
          		 var data1 ='identidad=' + $("#identidad").val();
              $.post('traer_datos_cliente.php',data1,function(b){
              		$("#div_barra_secundaria").html(b);
              });
				*/
              
              var data1 ='identidad=' + $("#identidad").val();
              $.post('traer_datos_cliente.php',data1,function(b){
                      
                  
                  $("#id_cliente").val(b[0].id_cliente);
                  $("#nombre_cliente").val(b[0].nombre);
                  
               //(data1);
              },
              'json');
               
              /////////////////////////
          }// fin del if    
         });//finde funcion 
        
      /////////////////////////////////

});		////finde la funcion principal de script
		
</script>