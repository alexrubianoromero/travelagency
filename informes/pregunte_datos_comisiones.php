<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/


function colocar_select_general_proveedores($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla  where rol in ('2','4')  order by nombre asc ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}
function colocar_select_general_conceptos($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla    ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}
?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
</body>
<div id="div_informe_proveedores" align= "center">
<div id="div_superior_proveedores">
	<h3>INFORME COMISIONES</h3>
	<BR>Asesor
	<select id="id_proveedor">
       <?php
       		colocar_select_general_proveedores($tabla3,$conexion,'idcliente','nombre');
       ?>

	</select>	
    Radicado
    <input type="texto"  id="no_radicado">
	<input type="date"  id="fecha_in">
	<input type="date"  id="fecha_fin">

	<button id="btn_generar_informe">GENERAR INFORME</button>

</div>
<br><br>
<div id="resultados_proveedores" align= "center">
</div>	

</div>
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">      
$(document).ready(function(){
	 /////////////////////////
					 $("#btn_generar_informe").click(function(){
					 	//alert('asdsdfsdfssd');
						
							var data =  'id_proveedor=' + $("#id_proveedor").val();
							data += '&fecha_in=' + $("#fecha_in").val();
							data += '&fecha_fin=' + $("#fecha_fin").val();
							data += '&no_radicado=' + $("#no_radicado").val();
						    $.post('../informes/mostrar_informe_comisiones.php',data,function(a){		
							//$(window).attr('location', '../index.php);
							$("#resultados_proveedores").html(a);
								//alert(data);
							});	
						 });
					
});		////finde la funcion principal de script
		
</script>

