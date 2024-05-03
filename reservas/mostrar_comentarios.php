<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');
$sql_comen="select * from $comentarios_reserva   where id_reserva = '".$_REQUEST['id_reserva']."'  ";
$con_coment =mysql_query($sql_comen,$conexion);
//echo '<br>'.$sql_comen;
?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<br>
<button id="btn_nuevo_comentario">AGREGAR COMENTARIO </button>
<br><br>
<div id="div_nuevo_comentario">

</div>

<?php
echo '<table border = "1">';
	 echo '<tr>';
   echo '<td>Fecha</td>';
   echo '<td>Comentario</td>';
   echo '<td>Usuario</td>';
   echo '<tr>';
while($comen = mysql_fetch_assoc($con_coment))
{
  $nombre_usuario = traer_nombre_usuario($tabla16,$comen['id_usuario'],$conexion);
   echo '<tr>';
   echo '<td>'.$comen['fecha'].'</td>';
   echo '<td>'.$comen['comentario'].'</td>';
    echo '<td>'.$nombre_usuario.'</td>';
   echo '<tr>';
 }
 echo '</table>';
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
					 $("#btn_nuevo_comentario").click(function(){
							var data =  'id_reserva=' + $("#id_reserva").val()
							//data += '&placa=' + $("#placa").val();
							$.post('nuevo_comentario.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_nuevo_comentario").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#btn_grabar_comentario").click(function(){

							var data =  'id_reserva=' + $("#id_reserva").val()
							data += '&comentario=' + $("#comentario").val();
							$.post('grabar_comentario.php',data,function(a){
							//$(window).attr('location', '../index.php);
							//$("#div_nuevo_comentario").html(a);
								//alert(data);
							});	

							var data1 =  'id_reserva=' + $("#id_reserva").val()
							data1 += '&comentario=' + $("#comentario").val();
							$.post('mostrar_comentarios.php',data1,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_central").html(a);
								//alert(data);
							});	


						 });



});		////finde la funcion principal de script
		
</script>