<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
  function  consulta_assoc22($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
$sql_comisiones = "select * from $reservas where 1=1";


if($_REQUEST['pagadas']==0)
{
	$sql_comisiones .= " and  comision_pagada = 0";
	$letrero = "PENDIENTE DE PAGO ";
}
else
{
	$sql_comisiones .= " and  comision_pagada= 1";	
	$letrero = "PAGADAS";
}


//echo '<br>'.$sql_comisiones;
$con_comision = mysql_query($sql_comisiones,$conexion);
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
COMISIONES 
<?php  echo $letrero  ?>
<br><br>
<table border="1"  class="formato_tabla">
<thead>
	<tr>
		<td>NO_RESERVA</td>;
		<td>FECHA</td>
		<td>DESTINO</td>
		<td>VR CONTRATO</td>
		<td>VENDEDOR</td>
		<td>DIRECTOR</td>
		<td>CONTRATO</td>
		<td>COMISION</td>

		<?php
          if ($_REQUEST['pagadas']==0)
          {
          	echo '<td>CREAR_RECIBO</td>';
          }	
           if ($_REQUEST['pagadas']==1)
          {
          	echo '<td>IMPRIMIR_RECIBO</td>';
          }	
		?>

	</tr>
</thead>	
<?php

$suma_comisiones = 0;
while($pendientes = mysql_fetch_assoc($con_comision))
{
	
   $nombre_destino =  consulta_assoc22($tipo_destino,'id_tipo_destino',$pendientes['id_tipo_destino'],$conexion);
   $nombre_vendedor =  consulta_assoc22($tabla3,'idcliente',$pendientes['id_vendedor'],$conexion);
   $nombre_director =  consulta_assoc22($tabla3,'idcliente',$pendientes['id_vendedor'],$conexion);
	echo '<tbody>';
	echo '<tr>';
	echo '<td>'.$pendientes['no_reserva'].'</td>';
	echo '<td>'.$pendientes['fecha_creacion'].'</td>';
	echo '<td>'.$nombre_destino['nombre'].'</td>';
	echo '<td align= "right">'.$pendientes['total'].'</td>';
	echo '<td>'.$nombre_vendedor['nombre'].'</td>';
	echo '<td>'.$nombre_director['nombre'].'</td>';
	echo '<td>'.$pendientes['no_contrato'].'</td>';
	echo '<td align= "right">'.'$'.number_format($pendientes['vr_comision'], 0, ',', '.').'</td>';
	  if ($_REQUEST['pagadas']==0)
          {
          	echo '<td><a href="capturar_recibo_pago_comision.php?id_reserva='.$pendientes['id_reserva'].'">CREAR_RECIBO</a></td>';
          }	

          if ($_REQUEST['pagadas']==1)
          {
          	echo '<td><a href="imprimir_recibo.php?id_reserva='.$pendientes['id_reserva'].'" target = "_blank">IMPRIMIR_RECIBO</a></td>';
          }	
	echo '</tr>';
	$suma_comisiones += $pendientes['vr_comision'];
}

	echo '<tr>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td></td>';
	echo '<td>TOTAL</td>';
	echo '<td></td>';
	echo '<td align= "right" >'.'$'.number_format($suma_comisiones, 0, ',', '.').'</td>';
	echo '</tr>';
?>
</tbody>
</table>

</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
					 $("#btn_nuevo_recibo").click(function(){

							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							$.post('nuevo_recibo.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_muestre_recibos").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////

});		////finde la funcion principal de script
		
</script>