<?php
session_start();
include('../valotablapc.php');

$datos_tarifa=consulta_assoc222($tarifas,'id_tarifa',$_REQUEST['id_tarifa'],$conexion);


echo '<input type="hidden" id="id_tarifa"  value ="'.$_REQUEST['id_tarifa'].'">';



?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<div id="div_total_actualizar_tarifa">	
	<br><br>
<table class="formato_tabla">
 <thead>
 	<tr>
 		<td>VIGENCIA</td>
 		<td>PLAN </td>
 		<td>DESTINO</td>
 		<td>HOTEL</td>
 		<td>SENCILLA</td>
 		<td>DOBLE</td>
 		<td>TRIPLE</td>
 		<td>NINO</td>
 		<td>INFANTE</td>
 		

 	<tr>	
 </thead>	
 <tbody>
 	<?php
 	$ancho_celda="5px";
 	//echo 'id_hotel ='.$datos_tarifa['id_hotel'];
 	//echo 'id_destino ='.$datos_tarifa['id_destino'];
 	echo '<tr>';
 	echo '<td><input type="text" id= "vigencia"  value = " '.trim($datos_tarifa['vigencia']).'" class="fila_llenar" 
 	size="'.$ancho_celda.'"></td>';
 	echo '<td><input type="text" id= "plan"  value = " '.trim($datos_tarifa['plan']).'" class="fila_llenar"
 	size="'.$ancho_celda.'"></td>';

 	echo '<td>';
 	echo '<select id="id_destino" size="'.$ancho_celda.'">';
 	colocar_select_general_condicion_mejorada123($destinos,$conexion,'id_destino','nombre',$datos_tarifa['id_destino']);
 	echo '</select>';
 	echo '</td>';

 	echo '<td>';
 	echo '<select id="id_hotel" size="'.$ancho_celda.'" >';
 	colocar_select_general_condicion_mejorada123($hoteles,$conexion,'id_hotel','nombre',$datos_tarifa['id_hotel']);
 	echo '</select>';
 	echo '</td>';
     
 	echo '<td><input type="text" id= "sencilla"  value = " '.trim($datos_tarifa['sencilla']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 	echo '<td><input type="text" id= "doble"  value = " '.trim($datos_tarifa['doble']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 		echo '<td><input type="text" id= "triple"  value = " '.trim($datos_tarifa['triple']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 			echo '<td><input type="text" id= "nino"  value = " '.trim($datos_tarifa['nino']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 				echo '<td><input type="text" id= "infante"  value = " '.trim($datos_tarifa['infante']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 	echo '</tr>'; 	

 	echo '<tr>';
 	echo '<td></td>';
 	echo '<td></td>';
 	echo '<td></td>';
 	echo '<td>IMPUESTOS</td>';
 	echo '<td><input type="text" id= "impuestos_sencilla"  value = " '.trim($datos_tarifa['impuestos_sencilla']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 	echo '<td><input type="text" id= "impuestos_doble"  value = " '.trim($datos_tarifa['impuestos_doble']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 	echo '<td><input type="text" id= "impuestos_triple"  value = " '.trim($datos_tarifa['impuestos_triple']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 		echo '<td><input type="text" id= "impuestos_nino"  value = " '.trim($datos_tarifa['impuestos_nino']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 		echo '<td><input type="text" id= "impuestos_infante"  value = " '.trim($datos_tarifa['impuestos_infante']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 	echo '</tr>'; 
 	echo '<tr>';
 	echo '<td></td>';
 	echo '<td></td>';
 	echo '<td></td>';
 	echo '<td>VALOR NOCHE ADICIONAL</td>';
 	echo '<td><input type="text" id= "cargos_sencilla"  value = " '.trim($datos_tarifa['cargos_sencilla']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 	echo '<td><input type="text" id= "cargos_doble"  value = " '.trim($datos_tarifa['cargos_doble']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 	echo '<td><input type="text" id= "cargos_triple"  value = " '.trim($datos_tarifa['cargos_triple']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 		echo '<td><input type="text" id= "cargos_nino"  value = " '.trim($datos_tarifa['cargos_nino']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 		echo '<td><input type="text" id= "cargos_infante"  value = " '.trim($datos_tarifa['cargos_infante']).'" class="fila_llenar" size="'.$ancho_celda.'"></td>';
 	echo '</tr>'; 	
 	?>
</tbody>
</table>
<br>	
<div id="div_actualizar_tarifa" align="center"> 
	<button id="btn_actualizar_tarifa">ACTUALIZAR TARIFA</button>
</div> 	

</div>
<?php



/////////////////////////////
  function  consulta_assoc222($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

////////////////////////////////
  function colocar_select_general_condicion_mejorada123($tabla,$conexion,$campo1,$campo2,$condicion){
  $sql_general = "select * from $tabla    ";
  
 $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
      if($general[$campo1] == $condicion){
           echo '<option value="'.$general[$campo1].'" selected >'.$general[$campo2].'</option>';
       }
      else 
      {
          echo '<option value="'.$general[$campo1].'" >'.$general[$campo2].'</option>';
      }
     }//fin del while
    } //fin ed la funcion   



////////////////////////////////////////////////
?>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
					 $("#btn_actualizar_tarifa").click(function(){
					 	//alert('digito actualizar');
							var data =  'vigencia=' + $("#vigencia").val();
							data += '&plan=' + $("#plan").val();
							data += '&id_destino=' + $("#id_destino").val();
							data += '&id_hotel=' + $("#id_hotel").val();
							data += '&sencilla=' + $("#sencilla").val();
							data += '&doble=' + $("#doble").val();
							data += '&triple=' + $("#triple").val();
							data += '&nino=' + $("#nino").val();
							data += '&infante=' + $("#infante").val();
							data += '&id_tarifa=' + $("#id_tarifa").val();

							data += '&impuestos_sencilla=' + $("#impuestos_sencilla").val();
							data += '&impuestos_doble=' + $("#impuestos_doble").val();
							data += '&impuestos_triple=' + $("#impuestos_triple").val();
							data += '&impuestos_nino=' + $("#impuestos_nino").val();
							data += '&impuestos_infante=' + $("#impuestos_infante").val();

							data += '&cargos_sencilla=' + $("#cargos_sencilla").val();
							data += '&cargos_doble=' + $("#cargos_doble").val();
							data += '&cargos_triple=' + $("#cargos_triple").val();
							data += '&cargos_nino=' + $("#cargos_nino").val();
							data += '&cargos_infante=' + $("#cargos_infante").val();





							$.post('actualizar_tarifa.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_total_actualizar_tarifa").html(a);
								//alert(data);
							});	

							$.post('consulta_general_tarifas.php',data,function(b){
							//$(window).attr('location', '../index.php);
							$("#div_total_actualizar_tarifa").html(b);
								//alert(data);
							});


						 });
					

});		////finde la funcion principal de script
		
</script>

</body>
</html>