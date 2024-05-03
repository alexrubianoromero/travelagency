<?php
session_start();
include('../valotablapc.php');
$fechapan =  time();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
//////////////////////////////
function colocar_select_general_formas_pago($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla   ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}

//////////////////////////////
$sql_recibos = "select * from $recibos_proveedores  where id_cxp  = '".$_REQUEST['id_cxp']."'  ";
$consulta_reciboscxp = mysql_query($sql_recibos,$conexion);

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
<input type="hidden"   id="id_cxp" value = "<?php  echo $_REQUEST['id_cxp'] ?>">
<table border = "1">
<tr>
	<td>FECHA</td>
	<td><input type="text" id="fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?> class ="fila_llenar" ></td>
</tr>	
<tr>
	<td>VALOR </td>
	<td><input type="text" id="valor" class ="fila_llenar" ></td>
</tr>
<tr>
	<td>FORMA DE PAGO EGRESO </td>
	<td>
		<select id="id_forma_pago" class ="fila_llenar" >
			<?php
					colocar_select_general_formas_pago($formas_pago_egresos,$conexion,'id_forma_pago_egreso','descripcion');
			?>
		</select>	
	</td>
</tr>	
<tr>

   <td>OBSERVACIONES</td>
   <td><input type="text" id="observaciones" class ="fila_llenar" ></td>
</tr>

</table>	
<br>
<button type="submit"  id="btn_grabar_recibo"  >GRABAR RECIBO PROVEEDOR</button>
</body>
</html>

<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
<script  type="text/JavaScript">
$(document).ready(function(){

	/////////////////////////////////
	
       $("#btn_grabar_recibo").click(function(){



							var data =  'id_cxp=' + $("#id_cxp").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&valor=' + $("#valor").val();
							data += '&observaciones=' + $("#observaciones").val();
							data += '&id_forma_pago=' + $("#id_forma_pago").val();

							
							//alert(data);
							$.post('../recibos_proveedores/grabar_recibos_proveedores.php',data,function(a){
							    //$("#div_reci_proveedores").html(a);
								//alert(data);
							});	

				/////////////////////////////
				
				 var data1 =  'id_cxp=' + $("#id_cxp").val();
              	$.post('../recibos_proveedores/mostrar_recibos_proveedores.php',data1,function(b){
                $("#div_reci_proveedores").html(b);
                //alert(data);
             	 }); 
             	 		


	  });

    ///////////////////////////////
      
 });
</script>