<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');
$sql_comen="select * from $historial_cambios   where id_reserva = '".$_REQUEST['id_reserva']."'  ";
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
<button id="btn_nuevo_historial_cambio">AGREGAR HISTORIAL </button>
<br><br>
<div id="div_nuevo_historial">

</div>

<?php
echo '<table border = "1">';
	 echo '<tr>';
   echo '<td>Fecha Hora</td>';
   echo '<td>Observaciones</td>';
   echo '<td>Usuario</td>';
   echo '<tr>';
while($comen = mysql_fetch_assoc($con_coment))
{
  $nombre_usuario = traer_nombre_usuario($tabla16,$comen['id_usuario'],$conexion);
   echo '<tr>';
   echo '<td>'.$comen['fechahora'].'</td>';
   echo '<td>'.$comen['observaciones'].'</td>';
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
					 $("#btn_nuevo_historial_cambio").click(function(){
							var data =  'id_reserva=' + $("#id_reserva").val()
							//data += '&placa=' + $("#placa").val();
							$.post('nuevo_historial_cambio.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_nuevo_historial").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					 



});		////finde la funcion principal de script
		
</script>