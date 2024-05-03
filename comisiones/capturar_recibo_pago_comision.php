<?php
session_start();
include('../valotablapc.php');
 function  consulta_assoc98($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$datos_reserva = consulta_assoc98($reservas,'id_reserva',$_REQUEST['id_reserva'],$conexion);
$datos_tarifa = consulta_assoc98($tarifas,'id_tarifa',$datos_reserva['id_tarifa'],$conexion);
$datos_destino = consulta_assoc98($destinos,'id_destino',$datos_tarifa['id_destino'],$conexion);
$datos_asesor = consulta_assoc98($tabla3,'idcliente',$datos_reserva['id_vendedor'],$conexion);
/*
echo '<pre>';
print_r($datos_tarifa);
echo '</pre>';
*/

?>

<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>

<?php
echo '<div id="div_recibo_comision">';
echo '<input type="text" id="id_reserva" value="'.$_REQUEST['id_reserva'].'">';
echo '<h2>EGRESO GASTOS DE TRANSPORTE</h2>';
echo '<table border = "1">';

echo '<tr>';
echo '<td>NOMBRE</td>';
echo '<td>'.$datos_asesor['nombre'].'</td>';
echo '</tr>';


echo '<tr>';
echo '<td>DESTINO</td>';
echo '<td>'.$datos_destino['nombre'].'</td>';
echo '</tr>';

echo '<tr>';
echo '<td>RESERVA</td>';
echo '<td>'.$datos_reserva['no_reserva'].'</td>';
echo '</tr>';



echo '<tr>';
echo '<td>CONTRATO</td>';
echo '<td>'.$datos_reserva['no_contrato'].'</td>';
echo '</tr>';

echo '</table>';

echo '<br><br>';
echo '<button id="btn_crear_recibo">Crear Recibo </button>';


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
					 $("#btn_crear_recibo").click(function(){

							var data =  'id_reserva='  + $("#id_reserva").val();
							//data += '&placa=' + $("#placa").val();
							$.post('marcar_comision_pagada.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_recibo_comision").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////

});		////finde la funcion principal de script
		
</script>