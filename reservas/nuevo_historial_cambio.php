<html>
<head>
	<title></title>
</head>
<body>
comentario <textarea  id="comentario" cols ="50" rows ="3" placeholder= "INGRESE NUEVO  CAMBIO"></textarea>
<button type="submit" id="btn_grabar_historial">Grabar Cambio</button>
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 //////////////
					 ////////////////////////
					 $("#btn_grabar_historial").click(function(){

							var data =  'id_reserva=' + $("#id_reserva").val()
							data += '&comentario=' + $("#comentario").val();
							$.post('grabar_historial_cambio.php',data,function(a){
							//$(window).attr('location', '../index.php);
							//$("#div_nuevo_comentario").html(a);
								//alert(data);
							});	

							var data1 =  'id_reserva=' + $("#id_reserva").val()
							data1 += '&comentario=' + $("#comentario").val();
							$.post('mostrar_historial_cambios.php',data1,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_central").html(a);
								//alert(data);
							});	


						 });


});		////finde la funcion principal de script
		
</script>