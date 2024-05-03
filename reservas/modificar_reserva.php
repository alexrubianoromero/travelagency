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
#div_boton_grabar{
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
<div id="div_nueva_reserva">

		<div id="div_central_reserva">
		<?php  include('pantalla_modificar_total.php') ?>

		</div>
		<div id="div_boton_grabar" align="center">

    	<button type ="submit" id="btn_modificar_reserva">Modificar Reserva</button>
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

	iniciar_valores();
	///////////////////////////////
	      //////////////////////////////////
      $("#btn_realizar_calculos").click(function(){
      		//para realizar las sumas de valores 
      		var no_cuotas = $("#no_cuotas").val();
      		var valor_porcentaje_inicial = $("#valor_porcentaje_cuota_inicial").val();

      		  if($("#no_cuotas").val().length < 1)
					        { 
					        	alert('Digite no_cuotas'); 
					        	$(no_cuotas).focus();
		                    }
      		var valores_sencilla = parseInt($("#valor_por_pasajero_sencilla").val())
      								+ parseInt($("#impuestos_sencilla").val())
      								+ parseInt($("#tours_adicionales_sencilla").val())
      								+ parseInt($("#noches_adicionales_sencilla").val());

      		var valores_sencilla_sin_imp = parseInt($("#valor_por_pasajero_sencilla").val())
      								
      								+ parseInt($("#tours_adicionales_sencilla").val())
      								+ parseInt($("#noches_adicionales_sencilla").val());

            $("#totalxpersona_sencilla").val(valores_sencilla);
            var total_acomodacion_sencilla =  parseInt(valores_sencilla)  *  
            						parseInt($("#cantidad_personas_sencilla").val());	
             $("#totalxacomodacion_sencilla").val(total_acomodacion_sencilla);
              
             ////////////////////////// 
             var valores_doble = parseInt($("#valor_por_pasajero_doble").val())
      								+ parseInt($("#impuestos_doble").val())
      								+ parseInt($("#tours_adicionales_doble").val())
      								+ parseInt($("#noches_adicionales_doble").val());

      		var valores_doble_sin_imp = parseInt($("#valor_por_pasajero_doble").val())
      								+ parseInt($("#tours_adicionales_doble").val())
      								+ parseInt($("#noches_adicionales_doble").val());



            $("#totalxpersona_doble").val(valores_doble);
            var total_acomodacion_doble =  parseInt(valores_doble)  *  
            						parseInt($("#cantidad_personas_doble").val());	
             $("#totalxacomodacion_doble").val(total_acomodacion_doble);
             /////////////////////////////
              var valores_triple = parseInt($("#valor_por_pasajero_triple").val())
      								+ parseInt($("#impuestos_triple").val())
      								+ parseInt($("#tours_adicionales_triple").val())
      								+ parseInt($("#noches_adicionales_triple").val());

      		var valores_triple_sin_imp = parseInt($("#valor_por_pasajero_triple").val())
      								
      								+ parseInt($("#tours_adicionales_triple").val())
      								+ parseInt($("#noches_adicionales_triple").val());						
            $("#totalxpersona_triple").val(valores_triple);
            var total_acomodacion_triple =  parseInt(valores_triple)  *  
            						parseInt($("#cantidad_personas_triple").val());	
             $("#totalxacomodacion_triple").val(total_acomodacion_triple);
              /////////////////////////////
              var valores_nino = parseInt($("#valor_por_pasajero_nino").val())
      								+ parseInt($("#impuestos_nino").val())
      								+ parseInt($("#tours_adicionales_nino").val())
      								+ parseInt($("#noches_adicionales_nino").val());

      		 var valores_nino_sin_imp = parseInt($("#valor_por_pasajero_nino").val())
      								
      								+ parseInt($("#tours_adicionales_nino").val())
      								+ parseInt($("#noches_adicionales_nino").val());


            $("#totalxpersona_nino").val(valores_nino);
            var total_acomodacion_nino =  parseInt(valores_nino)  *  
            						parseInt($("#cantidad_personas_nino").val());	
             $("#totalxacomodacion_nino").val(total_acomodacion_nino);
              /////////////////////////////
              var valores_infante = parseInt($("#valor_por_pasajero_infante").val())
      								+ parseInt($("#impuestos_infante").val())
      								+ parseInt($("#tours_adicionales_infante").val())
      								+ parseInt($("#noches_adicionales_infante").val());

      		 var valores_infante_sin_imp = parseInt($("#valor_por_pasajero_infante").val())
      								+ parseInt($("#tours_adicionales_infante").val())
      								+ parseInt($("#noches_adicionales_infante").val());


            $("#totalxpersona_infante").val(valores_infante);
            var total_acomodacion_infante =  parseInt(valores_infante)  *  
            						parseInt($("#cantidad_personas_infante").val());	
             $("#totalxacomodacion_infante").val(total_acomodacion_infante);
            
             ////////////////sumar totales y colocar el valor total del contrato 
             var sumas_totales = parseInt(total_acomodacion_sencilla)
             		+ parseInt(total_acomodacion_doble)
             		+ parseInt(total_acomodacion_triple)
             		+ parseInt(total_acomodacion_nino)
             		+ parseInt(total_acomodacion_infante)
             $("#total").val(sumas_totales);		

             ///falta colocar un campo donde esten los valores sin impuestos 
             

             var suma_sin_impuestos = 
                    (parseInt(valores_sencilla_sin_imp) * parseInt($("#cantidad_personas_sencilla").val()))
                    +(parseInt(valores_doble_sin_imp) * parseInt($("#cantidad_personas_doble").val()))
                    +(parseInt(valores_triple_sin_imp) * parseInt($("#cantidad_personas_triple").val()))
                    +(parseInt(valores_nino_sin_imp) * parseInt($("#cantidad_personas_nino").val()))
                    +(parseInt(valores_infante_sin_imp) * parseInt($("#cantidad_personas_infante").val()))
           
             $("#total_sin_impuestos").val(suma_sin_impuestos);			

             //calcular la inicial y las cuotas 
              var valor_contrato = $("#total").val();
              var cuota_inicial = (parseInt(valor_contrato) * parseInt(valor_porcentaje_inicial))/100;
            
              var no_cuotas = $("#no_cuotas").val();
              var saldo_valor = parseInt(valor_contrato)-parseInt(cuota_inicial);
              if(no_cuotas==0)
              { valor_cuota =0;}
          	else{
              var valor_cuota = parseInt(saldo_valor)/no_cuotas;
                }
   			 //var inicial_format=	number_format(cuota_inicial, 0);
   			 //var valor_cuota_format =  number_format(valor_cuota, 0);
              $("#vr_inicial").val(cuota_inicial);
              $("#no_cuotas").val(no_cuotas);
              $("#vr_cuota_mensual").val(valor_cuota);
               // alert('valor cuota inicial '+ cuota_inicial +'no cuotas '+no_cuotas+'<br>cuota mensual'+ valor_cuota);


             ///calcular el valor de la comision 
  });//fin de btn_realizar_calculos 

		///////////////////////////////

    $("#id_tarifa").change(function(){
            var id_tarifa = $("#id_tarifa").val();  
              var data1 ='id_tarifa=' + id_tarifa;
                $.post('traer_datos_tarifa.php',data1,function(b){
                  
                    $("#valor_por_pasajero_sencilla").val(b[0].sencilla);
                    $("#valor_por_pasajero_doble").val(b[0].doble);
                    $("#valor_por_pasajero_triple").val(b[0].triple);
                     $("#valor_por_pasajero_nino").val(b[0].nino);
                      $("#valor_por_pasajero_infante").val(b[0].infante);
                       $("#hotel_seleccionado").val(b[0].hotel);

                    $("#impuestos_sencilla").val(b[0].impuestos_sencilla);
                    $("#impuestos_doble").val(b[0].impuestos_doble);
                    $("#impuestos_triple").val(b[0].impuestos_triple);
                    $("#impuestos_nino").val(b[0].impuestos_nino);
                    $("#impuestos_infante").val(b[0].impuestos_infante);
                },
                'json');
              //$("#div_buscar_director").css("display","none");  
          });
	////////////////////////////////


	/////////////////////////////////////////

	$("#btn_nueva_reserva").click(function(){
							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('nueva_reserva.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_reservas").html(a);
								//alert(data);
							});	
						 });
//////////////////////////////////////////////////////////
	$("#buscar_asesor").click(function(){
							$("#div_buscar_asesor").toggle("fast");
						});

	 /////////////////////////////
					 	 $("#buscar_asesor").keyup(function(e){

					     	var data =  'buscar_asesor=' + $("#buscar_asesor").val();
							
						  //$("#replica").val($("#mitexto").val());
							$.post('buscar_asesor.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#div_buscar_asesor").html(a);
													//alert(data);
							});	

	 
   						});
	/////////////////////////////////////

	//////////////////////////////////////
	 $("#btn_crear_asesor").click(function(){
	 						$("#div_crear_asesor").css("display","block");
							var data =  'rol=' + '2';
							//data += '&placa=' + $("#placa").val();
							$.post('../clientes/captura_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_crear_asesor").html(a);
								//alert(data);
							});	
						 });

	 /////////////////////////
	 	 $("#btn_cerrar_crear_asesor").click(function(){
	 						$("#div_crear_asesor").css("display","none");
						 });

	 /////////////////////////
	 $("#buscar_director").click(function(){
							$("#div_buscar_director").toggle("fast");
						});

	 /////////////////////////////
				 $("#buscar_director").keyup(function(e){
					     	var data =  'buscar_asesor=' + $("#buscar_director").val();
							
						  //$("#replica").val($("#mitexto").val());
							$.post('buscar_director.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#div_buscar_director").html(a);
													//alert(data);
							});	

	 
   			      });



	 /////////////////////////////

	$("#btn_crear_director").click(function(){
	 						$("#div_crear_director").css("display","block");
							var data =  'rol=' + '4';
							//data += '&placa=' + $("#placa").val();
							$.post('../clientes/captura_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_crear_director").html(a);
								//alert(data);
							});	
						 });

	 /////////////////////////
	 $("#btn_cerrar_crear_director").click(function(){
	 						$("#div_crear_director").css("display","none");
						 });
	  /////////////////////////
 $("#btn_crear_cliente").click(function(){
	 						$("#div_crear_cliente").css("display","block");
							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('../clientes/captura_cliente.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_crear_cliente").html(a);
								//alert(data);
							});	
						 });
////////////////////////////////////////////////////


$("#buscar_cliente").click(function(){
							$("#div_buscar_cliente").toggle("fast");
						});

	 /////////////////////////////
					 	 $("#buscar_cliente").keyup(function(e){
					     	var data =  'buscar_cliente=' + $("#buscar_cliente").val();
							
						  //$("#replica").val($("#mitexto").val());
							$.post('buscar_cliente.php',data,function(a){
												//$(window).attr('location', '../index.php);
								$("#div_buscar_cliente").html(a);
													//alert(data);
							});	

	 
   						});

//////////////////////////////////////////////////////////	


 $("#btn_cerrar_crear_cliente").click(function(){
	 						$("#div_crear_cliente").css("display","none");
 });

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
////////////////////////////////////////////////////////				 
$("#btn_modificar_reserva").click(function(){
					    //alert('dasdasdasd');
					 	//////////////////////
					 	/*
					 	 if($("#no_contrato").val().length < 1)
					        { alert('digite datos no_contrato ');
					      $(no_contrato).focus();
					          return false;
					         }

					         if($("#no_radicado").val().length < 1)
					        { alert('digite datos no  radicado ');
					      $(no_radicado).focus();
					          return false;
					         }




					        if($("#id_tipo_destino").val().length < 1)
					        { alert('digite datos destino nacional o internacional ');
					      $(id_tipo_destino).focus();
					          return false;
					         }  
					         
					 	 if($("#identi_asesor").val().length < 1)
					        { alert('digite datos asesor ');
					      $(identi_asesor).focus();
					          return false;
					         }

					          if($("#identificacion_director_comercial").val().length < 1)
					        { alert('digite datos identificacion_director_comercial ');
					      $(identificacion_director_comercial).focus();
					          return false;
					         }

					        ////////////////////////////
					       if($("#oficina").val().length < 1)
					        { alert('Digite oficina'); 
					        $(oficina).focus();
					        return false;}

					         if($("#identidad_cliente").val().length < 1)
					        { alert('Digite identidad_cliente'); 
					        $(identidad_cliente).focus();
					        return false; }

					         if($("#ciudad_origen").val().length < 1)
					        { alert('Digite ciudad_origen'); 
					        $(ciudad_origen).focus();
					        return false; }

					         if($("#ciudad_destino").val().length < 1)
					        { alert('Digite ciudad_destino'); 
					        $(ciudad_origen).focus();
					        return false; }



					         if($("#fecha_salida").val().length < 1)
					        { alert('Digite fecha_salida'); 
					        $(fecha_salida).focus();
					        return false; }

					         if($("#fecha_regreso").val().length < 1)
					        { alert('Digite fecha_regreso'); 
					        $(fecha_regreso).focus();
					        return false; }



					        if($("#cant_adultos").val().length < 1)
					        { alert('Digite cant_adultos'); 
					        $(cant_adultos).focus();
					        return false; }
					        if($("#cant_ninos").val().length < 1)
					        { alert('Digite cant_ninos'); 
					        $(cant_ninos).focus();
					        return false; }

					        if($("#cant_infantes").val().length < 1)
					        { alert('Digite cant_infantes'); 
					        $(cant_infantes).focus();
					        return false; }


					        if($("#hotel_seleccionado").val().length < 1)
					        { alert('Digite hotel_seleccionado'); 
					        $(hotel_seleccionado).focus();
					        return false; }

					         if($("#noches").val().length < 1)
					        { alert('Digite noches'); 
					        $(noches).focus();
					        return false; }
					         if($("#dias").val().length < 1)
					        { alert('Digite dias'); 
					        $(dias).focus();
					        return false; }

					        
					        if($("#id_tipo_vuelo").val().length < 1)
					        { alert('Digite id_tipo_vuelo'); 
					        $(id_tipo_vuelo).focus();
					        return false; }
					        
					        /////////////////////////////////////
					          if($("#no_hab_sencillas").val().length < 1)
					        { alert('Digite no_hab_sencillas'); 
					        $(no_hab_sencillas).focus();
					        return false; }

					          if($("#no_hab_dobles").val().length < 1)
					        { alert('Digite no_hab_dobles'); 
					        $(no_hab_dobles).focus();
					        return false; }

					          if($("#no_hab_triples").val().length < 1)
					        { alert('Digite no_hab_triples'); 
					        $(no_hab_triples).focus();
					        return false; }

					          if($("#no_hab_triples").val().length < 1)
					        { alert('Digite no_hab_triples'); 
					        $(no_hab_triples).focus();
					        return false; }

					          if($("#no_hab_ninos").val().length < 1)
					        { alert('Digite no_hab_ninos'); 
					        $(no_hab_ninos).focus();
					        return false; }

					           if($("#no_hab_infantes").val().length < 1)
					        { alert('Digite no_hab_infantes'); 
					        $(no_hab_infantes).focus();
					        return false; }

					        ///////////////////////////////////////////////
					       
					          if($("#id_tarifa").val().length < 1)
					        { alert('Digite id_tarifa'); 
					        $(id_tarifa).focus();
					        return false; }
					       
					         if($("#email_contacto_asistencia").val().length < 1)
					        { alert('Digite email_contacto_asistencia'); 
					        $(email_contacto_asistencia).focus();
					        return false; }

					        if($("#celular_contacto_asistencia").val().length < 1)
					        { alert('Digite celular_contacto_asistencia'); 
					        $(celular_contacto_asistencia).focus();
					        return false; }
					       

					        if($("#total").val().length< 1)
					        { alert('EL valor del contrato no puede ser cero'); 
					        $(total).focus();
					        return false; }

					         if($("#vr_inicial").val().length < 1)
					        { alert('Digite vr_inicial'); 
					        $(vr_inicial).focus();
					        return false; }

					          if($("#no_cuotas").val().length < 1)
					        { alert('Digite no_cuotas'); 
					        $(no_cuotas).focus();
					        return false; }

					          if($("#vr_cuota_mensual").val().length < 1)
					        { alert('Digite vr_cuota_mensual'); 
					        $(vr_cuota_mensual).focus();
					        return false; }

					           if($("#id_quien_recibe").val().length < 1)
					        { alert('Digite id_quien_recibe'); 
					        $(id_quien_recibe).focus();
					        return false; }


   							if($("#id_quien_confirma").val().length < 1)
					        { alert('Digite id_quien_confirma'); 
					        $(id_quien_confirma).focus();
					        return false; }

					          if($("#id_tipo_venta").val().length < 1)
					        { alert('Digite id_tipo_venta'); 
					        $(id_tipo_venta).focus();
					        return false; }

					           if($("#sucursal").val().length < 1)
					        { alert('Digite sucursal'); 
					        $(sucursal).focus();
					        return false; }

					        if($("#id_forma_pago").val().length < 1)
					        { alert('Digite id_forma_pago'); 
					        $(id_forma_pago).focus();
					        return false; }

					           if($("#id_estado").val().length < 1)
					        { alert('Digite id_estado'); 
					        $(id_estado).focus();
					        return false; }

					        */
					 	//////////////////////

							var data =  'identi_asesor=' + $("#identi_asesor").val();
							data += '&id_tipo_destino=' + $("#id_tipo_destino").val();
							data += '&fecha_creacion=' + $("#fechita").val();
							data += '&no_contrato=' + $("#no_contrato123").val();
							data += '&director_comercial=' + $("#director_comercial").val();
							data += '&cel_director_comercial=' + $("#cel_director_comercial").val();
							data += '&email_director_comercial=' + $("#email_director_comercial").val();
							data += '&director_general=' + $("#director_general").val();
							data += '&cel_director_general=' + $("#cel_director_general").val();
							data += '&email_director_general=' + $("#email_director_general").val();
							data += '&oficina=' + $("#oficina").val();

							data += '&identificacion_director_comercial=' + $("#identificacion_director_comercial").val();

							data += '&identidad_cliente=' + $("#identidad_cliente").val();
							
							data += '&ciudad_origen=' + $("#ciudad_origen").val();
							data += '&ciudad_destino=' + $("#ciudad_destino").val();
							data += '&fecha_salida=' + $("#fecha_salida").val();
							data += '&fecha_regreso=' + $("#fecha_regreso").val();
							data += '&cant_adultos=' + $("#cant_adultos").val();
							data += '&cant_ninos=' + $("#cant_ninos").val();
							data += '&cant_infantes=' + $("#cant_infantes").val();
							data += '&hotel_seleccionado=' + $("#hotel_seleccionado").val();
							data += '&noches=' + $("#noches").val();
							data += '&dias=' + $("#dias").val();

							data += '&id_tipo_vuelo=' + $("#id_tipo_vuelo").val();

							data += '&id_tipo_habitacion=' + $("#id_tipo_habitacion").val();
							
							data += '&id_tarifa=' + $("#id_tarifa").val();
							data += '&tours_incluidos=' + $("#tours_incluidos").val();
							data += '&contacto_asistencia=' + $("#contacto_asistencia").val();
							data += '&email_contacto_asistencia=' + $("#email_contacto_asistencia").val();
							data += '&celular_contacto_asistencia=' + $("#celular_contacto_asistencia").val();
							data += '&total=' + $("#total").val();
							data += '&vr_inicial=' + $("#vr_inicial").val();
							data += '&no_cuotas=' + $("#no_cuotas").val();
							data += '&vr_cuota_mensual=' + $("#vr_cuota_mensual").val();

							data += '&vr_efectivo=' + $("#vr_efectivo").val();
							data += '&vr_cons_trans=' + $("#vr_cons_trans").val();
							data += '&vr_tarjeta=' + $("#vr_tarjeta").val();

							data += '&id_tipo_venta=' + $("#id_tipo_venta").val();
							data += '&sucursal=' + $("#sucursal").val();
							data += '&id_forma_pago=' + $("#id_forma_pago").val();
							data += '&id_estado=' + $("#id_estado").val();
							data += '&crucero=' + $("#crucero").val();
							data += '&id_usuario_registro=' + $("#id_usuario_registro").val();
							data += '&id_quien_recibe=' + $("#id_quien_recibe").val();
							data += '&id_quien_confirma=' + $("#id_quien_confirma").val();
							data += '&no_hab_sencillas=' + $("#no_hab_sencillas").val();
							data += '&no_hab_dobles=' + $("#no_hab_dobles").val();
							data += '&no_hab_triples=' + $("#no_hab_triples").val();
							data += '&no_hab_ninos=' + $("#no_hab_ninos").val();
							data += '&no_hab_infantes=' + $("#no_hab_infantes").val();
							///////////////////////////////////////////////////////////
							data += '&valor_por_pasajero_sencilla=' + $("#valor_por_pasajero_sencilla").val();
							data += '&valor_por_pasajero_doble=' + $("#valor_por_pasajero_doble").val();
							data += '&valor_por_pasajero_triple=' + $("#valor_por_pasajero_triple").val();
							data += '&valor_por_pasajero_nino=' + $("#valor_por_pasajero_nino").val();
							data += '&valor_por_pasajero_infante=' + $("#valor_por_pasajero_infante").val();


							data += '&impuestos_sencilla=' + $("#impuestos_sencilla").val();
							data += '&impuestos_doble=' + $("#impuestos_doble").val();
							data += '&impuestos_triple=' + $("#impuestos_triple").val();
							data += '&impuestos_nino=' + $("#impuestos_nino").val();
							data += '&impuestos_infante=' + $("#impuestos_infante").val();

							data += '&tours_adicionales_sencilla=' + $("#tours_adicionales_sencilla").val();
							data += '&tours_adicionales_doble=' + $("#tours_adicionales_doble").val();
							data += '&tours_adicionales_triple=' + $("#tours_adicionales_triple").val();
							data += '&tours_adicionales_nino=' + $("#tours_adicionales_nino").val();
							data += '&tours_adicionales_infante=' + $("#tours_adicionales_infante").val();

							data += '&noches_adicionales_sencilla=' + $("#noches_adicionales_sencilla").val();
							data += '&noches_adicionales_doble=' + $("#noches_adicionales_doble").val();
							data += '&noches_adicionales_triple=' + $("#noches_adicionales_triple").val();
							data += '&noches_adicionales_nino=' + $("#noches_adicionales_nino").val();
							data += '&noches_adicionales_infante=' + $("#noches_adicionales_infante").val();

							data += '&cantidad_personas_sencilla=' + $("#cantidad_personas_sencilla").val();
							data += '&cantidad_personas_doble=' + $("#cantidad_personas_doble").val();
							data += '&cantidad_personas_triple=' + $("#cantidad_personas_triple").val();
							data += '&cantidad_personas_nino=' + $("#cantidad_personas_nino").val();
							data += '&cantidad_personas_infante=' + $("#cantidad_personas_infante").val();

							data += '&totalxacomodacion_sencilla=' + $("#totalxacomodacion_sencilla").val();
							data += '&totalxacomodacion_doble=' + $("#totalxacomodacion_doble").val();
							data += '&totalxacomodacion_triple=' + $("#totalxacomodacion_triple").val();
							data += '&totalxacomodacion_nino=' + $("#totalxacomodacion_nino").val();
							data += '&totalxacomodacion_infante=' + $("#totalxacomodacion_infante").val();
							data += '&total_sin_impuestos=' + $("#total_sin_impuestos").val();
							data += '&id_reserva=' + $("#id_reserva").val();
							data += '&valor_porcentaje_cuota_inicial=' + $("#valor_porcentaje_cuota_inicial").val();

							/*
							data += '&titular=' + $("#titular").val();
							
							*/

							$.post('actualizacion_reserva.php',data,function(a){
							//$(window).attr('location', '../index.php);
							  $("#div_central_reserva").html(a);
								//alert(data);
							});	
							//mostrar las reservas la ultima arriba 
							/*
							$.post('mostrar_reservas.php',data,function(a){
							//$(window).attr('location', '../index.php);
							  $("#div_muestre_reservas").html(a);
								//alert(data);
							});	
							*/
							
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
                  $("#celular_cliente").val(b[0].telefono_celular);
                  $("#direccion_cliente").val(b[0].direccion);
                  $("#fijo_cliente").val(b[0].telefono);
                  $("#email_cliente").val(b[0].email);
                  
               //(data1);
              },
              'json');
               
              /////////////////////////
          }// fin del if    
         });//finde funcion 
        
      /////////////////////////////////
      /*
        $("#total").keyup(function(e){
          //$("#cosito").html( $("#nombrepan").val() );
          if (e.which == 13)
          {
              var valor_contrato = $("#total").val();
              var cuota_inicial = (parseInt(valor_contrato) * 30)/100;
              var no_cuotas = $("#no_cuotas").val();
              var saldo_valor = parseInt(valor_contrato)-parseInt(cuota_inicial);
              var valor_cuota = parseInt(saldo_valor)/no_cuotas;
   			 //var inicial_format=	number_format(cuota_inicial, 0);
   			 //var valor_cuota_format =  number_format(valor_cuota, 0);
              $("#vr_inicial").val(cuota_inicial);
              $("#no_cuotas").val(no_cuotas);
              $("#vr_cuota_mensual").val(valor_cuota);

               
              /////////////////////////
          }// fin del if    
         });//f
*/
      //////////////////////////////////


      /*
      $("#btn_realizar_calculos").click(function(){
      		//para realizar las sumas de valores 
      		var no_cuotas = $("#no_cuotas").val();

      		  if($("#no_cuotas").val().length < 1)
					        { 
					        	alert('Digite no_cuotas'); 
					        	$(no_cuotas).focus();
		                    }
      		var valores_sencilla = parseInt($("#valor_por_pasajero_sencilla").val())
      								+ parseInt($("#impuestos_sencilla").val())
      								+ parseInt($("#tours_adicionales_sencilla").val())
      								+ parseInt($("#noches_adicionales_sencilla").val());

      		var valores_sencilla_sin_imp = parseInt($("#valor_por_pasajero_sencilla").val())
      								
      								+ parseInt($("#tours_adicionales_sencilla").val())
      								+ parseInt($("#noches_adicionales_sencilla").val());

            $("#totalxpersona_sencilla").val(valores_sencilla);
            var total_acomodacion_sencilla =  parseInt(valores_sencilla)  *  
            						parseInt($("#cantidad_personas_sencilla").val());	
             $("#totalxacomodacion_sencilla").val(total_acomodacion_sencilla);
              
             ////////////////////////// 
             var valores_doble = parseInt($("#valor_por_pasajero_doble").val())
      								+ parseInt($("#impuestos_doble").val())
      								+ parseInt($("#tours_adicionales_doble").val())
      								+ parseInt($("#noches_adicionales_doble").val());

      		var valores_doble_sin_imp = parseInt($("#valor_por_pasajero_doble").val())
      								+ parseInt($("#tours_adicionales_doble").val())
      								+ parseInt($("#noches_adicionales_doble").val());



            $("#totalxpersona_doble").val(valores_doble);
            var total_acomodacion_doble =  parseInt(valores_doble)  *  
            						parseInt($("#cantidad_personas_doble").val());	
             $("#totalxacomodacion_doble").val(total_acomodacion_doble);
             /////////////////////////////
              var valores_triple = parseInt($("#valor_por_pasajero_triple").val())
      								+ parseInt($("#impuestos_triple").val())
      								+ parseInt($("#tours_adicionales_triple").val())
      								+ parseInt($("#noches_adicionales_triple").val());

      		var valores_triple_sin_imp = parseInt($("#valor_por_pasajero_triple").val())
      								
      								+ parseInt($("#tours_adicionales_triple").val())
      								+ parseInt($("#noches_adicionales_triple").val());						
            $("#totalxpersona_triple").val(valores_triple);
            var total_acomodacion_triple =  parseInt(valores_triple)  *  
            						parseInt($("#cantidad_personas_triple").val());	
             $("#totalxacomodacion_triple").val(total_acomodacion_triple);
              /////////////////////////////
              var valores_nino = parseInt($("#valor_por_pasajero_nino").val())
      								+ parseInt($("#impuestos_nino").val())
      								+ parseInt($("#tours_adicionales_nino").val())
      								+ parseInt($("#noches_adicionales_nino").val());

      		 var valores_nino_sin_imp = parseInt($("#valor_por_pasajero_nino").val())
      								
      								+ parseInt($("#tours_adicionales_nino").val())
      								+ parseInt($("#noches_adicionales_nino").val());


            $("#totalxpersona_nino").val(valores_nino);
            var total_acomodacion_nino =  parseInt(valores_nino)  *  
            						parseInt($("#cantidad_personas_nino").val());	
             $("#totalxacomodacion_nino").val(total_acomodacion_nino);
              /////////////////////////////
              var valores_infante = parseInt($("#valor_por_pasajero_infante").val())
      								+ parseInt($("#impuestos_infante").val())
      								+ parseInt($("#tours_adicionales_infante").val())
      								+ parseInt($("#noches_adicionales_infante").val());

      		 var valores_infante_sin_imp = parseInt($("#valor_por_pasajero_infante").val())
      								+ parseInt($("#tours_adicionales_infante").val())
      								+ parseInt($("#noches_adicionales_infante").val());


            $("#totalxpersona_infante").val(valores_infante);
            var total_acomodacion_infante =  parseInt(valores_infante)  *  
            						parseInt($("#cantidad_personas_infante").val());	
             $("#totalxacomodacion_infante").val(total_acomodacion_infante);
            
             ////////////////sumar totales y colocar el valor total del contrato 
             var sumas_totales = parseInt(total_acomodacion_sencilla)
             		+ parseInt(total_acomodacion_doble)
             		+ parseInt(total_acomodacion_triple)
             		+ parseInt(total_acomodacion_nino)
             		+ parseInt(total_acomodacion_infante)
             $("#total").val(sumas_totales);		

             ///falta colocar un campo donde esten los valores sin impuestos 
             

             var suma_sin_impuestos = 
                    (parseInt(valores_sencilla_sin_imp) * parseInt($("#cantidad_personas_sencilla").val()))
                    +(parseInt(valores_doble_sin_imp) * parseInt($("#cantidad_personas_doble").val()))
                    +(parseInt(valores_triple_sin_imp) * parseInt($("#cantidad_personas_triple").val()))
                    +(parseInt(valores_nino_sin_imp) * parseInt($("#cantidad_personas_nino").val()))
                    +(parseInt(valores_infante_sin_imp) * parseInt($("#cantidad_personas_infante").val()))
           
             $("#total_sin_impuestos").val(suma_sin_impuestos);			

             //calcular la inicial y las cuotas 
              var valor_contrato = $("#total").val();


              var cuota_inicial = (parseInt(valor_contrato) * 30)/100;
              var no_cuotas = $("#no_cuotas").val();
              var saldo_valor = parseInt(valor_contrato)-parseInt(cuota_inicial);
              var valor_cuota = parseInt(saldo_valor)/no_cuotas;
   			 //var inicial_format=	number_format(cuota_inicial, 0);
   			 //var valor_cuota_format =  number_format(valor_cuota, 0);
              
              $("#vr_inicial").val(cuota_inicial);
              $("#no_cuotas").val(no_cuotas);
              $("#vr_cuota_mensual").val(valor_cuota);

             ///calcular el valor de la comision 


  });//fin de btn_realizar_calculos 
*/
      ////////////////////////////////////
    function  iniciar_valores(){
    	/*
      	$("#valor_por_pasajero_sencilla").val(0);
      	$("#valor_por_pasajero_doble").val(0);
      	$("#valor_por_pasajero_triple").val(0);
      	$("#valor_por_pasajero_nino").val(0);
      	$("#valor_por_pasajero_infante").val(0);


      	$("#impuestos_sencilla").val(0);
      	$("#impuestos_doble").val(0);
      	$("#impuestos_triple").val(0);
      	$("#impuestos_nino").val(0);
      	$("#impuestos_infante").val(0);



      	$("#tours_adicionales_sencilla").val(0);
      	$("#tours_adicionales_doble").val(0);
      	$("#tours_adicionales_triple").val(0);
      	$("#tours_adicionales_nino").val(0);
      	$("#tours_adicionales_infante").val(0);


      	$("#noches_adicionales_sencilla").val(0);
      	$("#noches_adicionales_doble").val(0);
      	$("#noches_adicionales_triple").val(0);
      	$("#noches_adicionales_nino").val(0);
      	$("#noches_adicionales_infante").val(0);


    

		$("#cantidad_personas_sencilla").val(0);
		$("#cantidad_personas_doble").val(0);
		$("#cantidad_personas_triple").val(0);
		$("#cantidad_personas_nino").val(0);
		$("#cantidad_personas_infante").val(0);

	*/

		};//fin de funcion iniciar variables

});		////finde la funcion principal de script

</script>
<script>
	/*	
function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
    */
}
</script>