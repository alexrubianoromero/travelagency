<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');
$fechapan =  time();


if(isset($_REQUEST['id_reserva'])  && $_REQUEST['id_reserva'] != '' )
{
	$no_reserva = $_REQUEST['id_reserva'];
}

else
{
	$no_reserva = '';
}

$recibo_actual= traer_numero_actual($tabla10,'contarecicaja',$conexion);
///echo 'recibo actual <br>'.$recibo_actual;
$siguiente_numero = $recibo_actual +1;
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
<style>
#div_nuevo_recibo{
	position: absolute;
	left:25%;
	width: 50%;
	height: 80%;
	border:1px solid black;
	padding: 10px;

}
label{
	position: absolute;
	text-align: left;
	left:10%;
	
}
input{
	position: absolute;
	left:45%;
	width: 35%

}
#btn_grabar_recibo{
	display:none;
}
</style>
</head>
<body>

<?php
if($_SESSION['id_empresa']<1)
{echo 'Su Sesion ha expirado debe salir e ingresar nuevamente al sistema';}	
else
{	

?>

<div id="div_nuevo_recibo">
<div id="control"></div>
<input type = "hidden" id="id_reserva">
<input type = "hidden" id="id_cliente">
<input type = "hidden" id="recibo_segun_reserva">

<input type = "hidden" id="id_usuario"  value = "<?php  echo $_SESSION['id_usuario']  ?>">


 
	<label for ="no_recibo"  >No recibo </label>
<br>
	<input type="text" id="no_recibo"  value = "<?php echo $siguiente_numero ?>" onfocus="blur();">	

	<br>

	<label for ="fecha"  >Fecha </label><br>
	<input type="text" id="fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?> onfocus="blur();" ><br>


	<label for ="no_reserva"  >No Reserva </label><br>
	<input type="text" id="no_reserva"  placeholder ="Digite No de  Reserva y enter" class="fila_llenar" size="7px"><br>

	<label for ="no_recibo_reserva"  >No Recibo de Reserva </label><br>
	<input type="text" id="no_recibo_reserva"  placeholder ="No Recibo" onfocus="blur();"  size="7px"><br>

	<label for ="nombre_cliente"  >Nombre Cliente </label><br>
	<input type="text" id="nombre_cliente" onfocus="blur();" ><br>

	<label for ="saldo_reserva"  >Saldo Reserva </label><br>
	<input type = "text" id="saldo_reserva" onfocus="blur();"><br>

	<label for ="efectivo"  >Efectivo</label><br>
	<input type = "text" id="efectivo" class="fila_llenar"><br>

	<label for ="consignacion"  >Consignacion /Transferencia /</label><br>
	<input type = "text" id="consignacion" class="fila_llenar"><br>

	<label for ="tarjeta"  >Tarjeta Debito/Credito</label><br>
	<input type = "text" id="tarjeta" class="fila_llenar"><br>

	<label for ="valor"  >Total Recibo </label><br>
	<input type="text" id="valor" class = "fila_llenar"  onfocus="blur();" ><br>


	<label for ="observaciones"  >Observaciones </label><br>
	<input type="text" id = "observaciones" class="fila_llenar" ><br><br>

	<button id="btn_calcular">Calcular Total Recibo</button>

	<button type="submit" id="btn_grabar_recibo">Grabar Recibo</button><br>


</div>
<?php
} // fin de si la sesion esta abierta
?>	
</body>
</html>	
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
					 $("#btn_grabar_recibo").click(function(){
					 		///colocar las validaciones 
					 		 if($("#no_reserva").val().length < 1)
					        { alert('digite no_reserva ');
					     	 $(no_reserva).focus();
					          return false;
					         }
					    
					      if($("#observaciones").val().length < 1)
					        { alert('Digite observaciones'); 
					        $(observaciones).focus();
					        return false;}

					         if($("#valor").val().length < 1)
					        { alert('Digite valor'); 
					        $(valor).focus();
					        return false;}


							var data =  'id_reserva=' + $("#id_reserva").val();
							data += '&no_recibo=' + $("#no_recibo").val();
							data += '&valor=' + $("#valor").val();
							data += '&observaciones=' + $("#observaciones").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&id_usuario=' + $("#id_usuario").val();
							data += '&id_cliente=' + $("#id_cliente").val();
							data += '&recibo_segun_reserva=' + $("#recibo_segun_reserva").val();
							data += '&efectivo=' + $("#efectivo").val();
							data += '&consignacion=' + $("#consignacion").val();
							data += '&tarjeta=' + $("#tarjeta").val();
							$.post('grabar_recibo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_recibos").html(a);
								//alert(data);
							});	
								var data =  'id_reserva=' + $("#id_reserva").val();
							$.post('mostrar_recibos.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_recibos").html(a);
								//alert(data);
							});	
			



						 }); //fin de btn grabar
					 ////////////////////////




					 ///////////////////////
		$("#no_reserva").keyup(function(e){
          //$("#cosito").html( $("#nombrepan").val() );
          if (e.which == 13)
          {
              //se deberia evaluar si es el primer recibo que se hace de esta reserva
              //si es el primero se deberia traer el valor de efectivo trasn y tarjeta 
              //para que los coloque el sistema utomaticamente 
          	//alert('digito enter');	
          		/*
          		 var data1 ='no_reserva=' + $("#no_reserva").val();
              $.post('traer_datos_reserva.php',data1,function(b){
              		$("#control").html(b);
              });
				
              */
              var data1 ='no_reserva=' + $("#no_reserva").val();
              $.post('traer_datos_reserva.php',data1,function(b){
                  $("#id_reserva").val(b[0].id_reserva);
                  $("#nombre_cliente").val(b[0].nombre);
                   $("#id_cliente").val(b[0].id_cliente);
                   $("#recibo_segun_reserva").val(b[0].recibo_segun_reserva);
                   $("#saldo_reserva").val(b[0].saldo_reserva);
                   
                   $("#efectivo").val(b[0].efectivo);
                   $("#consignacion").val(b[0].consignacion);
                   $("#tarjeta").val(b[0].tarjeta);
                   $("#no_recibo_reserva").val(b[0].recibo_segun_reserva);
                   $("#valor").val(b[0].valor_total);
                   
                  
               //(data1);
              },
              'json');
               
              /////////////////////////
          }// fin del if    
         });//finde funcion 
        
      /////////////////////////////////

       $("#btn_calcular").click(function(){

       				var suma = 0;

       				suma= parseInt($("#efectivo").val()) +  parseInt($("#consignacion").val()) + parseInt($("#tarjeta").val());

       				$("#valor").val(suma);

		     		$("#btn_grabar_recibo").css("display","inline");
					 		
					         
		 });//finde funcion 		         




      ////////////////////////////////btn_calcular

});		////finde la funcion principal de script
		
</script>