<?php
session_start();
include('../valotablapc.php');
$fechapan =  time();
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

</head>
<body>	
<div id="div_proveedores_nueva_cuenta" align="center">
	CUENTA NUEVA PROVEEDORES
<div id="datos_cuenta"	>
	<table border = "1">
		<tr>
          <td>No RADICADO </td> <td><input type="text" id="radicado" name= "radicado" class= "fila_llenar"
          placeholder="Digite Radicado y enter" >
          <input type="hidden"  id="id_reserva">
      </td>
		</tr>	
		<tr>
			<td>nombre</td>
			<td><input type="text" id="nombre_cliente" name = "nombre_cliente" onfocus="blur();"></td>
		</tr>
		<tr>
			<td>Proveedor</td><td><select id= "id_proveedor" >
			<?php
				colocar_select_general($tabla3,$conexion,'idcliente','nombre')
			?>
		</select></td>
		</tr>
		<tr><td>FECHA</td><td><input type="text"  id="fecha"  value= <? echo date ( "Y/m/j" , $fechapan );?> ></td>
		</tr>
		<tr><td>CONCEPTO</td><td>
			<select id= "id_concepto" >
			<!--<input type="text"  id="concepto"  > -->
			<?php
				colocar_select_general_conceptos($cxp_conceptos,$conexion,'id_concepto','nombre_concepto')
			?>
			</select>
		</td>
		</tr>
		<tr><td>DOCUMENTO</td><td><input type="text"  id="documento"  ></td>
		</tr>
		<tr><td>VALOR</td><td><input type="text"  id="valor"  ></td></tr>
		<tr><td>FORMA PAGO</td><td><input type="text"  id="forma_pago"  ></td></tr>
		<tr><td>DESTINO</td><td><input type="text"  id="destino"  ></td></tr>
	</table>	
	<button  type="submit" id="btn_grabar_cuenta" >GRABAR CUENTA</button>
</div>	
</div>	
<div id="prueba">
</div>	
</body>
</html>
<?php
function colocar_select_general($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla  where rol=3 ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}
function colocar_select_general_conceptos($tabla,$conexion,$campo1,$campo2){
	$sql_general = "select * from $tabla  ";
	//echo '<br>'.$sql_personas;
	$con_general = mysql_query($sql_general,$conexion);
	echo '<option value="" >...</option>';
	while($general  = mysql_fetch_assoc($con_general))
	{
		echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
	}
}
?>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
	 
					 $("#btn_grabar_cuenta").click(function(){

					 	 if($("#radicado").val().length < 1)
					        { alert('Digite radicado'); 
					        $(radicado).focus();
					        return false;}


							var data =  'id_reserva=' + $("#id_reserva").val();
							data += '&id_proveedor=' + $("#id_proveedor").val();
							data += '&fecha=' + $("#fecha").val();
							data += '&concepto=' + $("#concepto").val();
							data += '&documento=' + $("#documento").val();
							data += '&valor=' + $("#valor").val();
							data += '&forma_pago=' + $("#forma_pago").val();
							data += '&destino=' + $("#destino").val();
							data += '&id_concepto=' + $("#id_concepto").val();
						

							$.post('grabar_nueva_cuenta.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_proveedores_nueva_cuenta").html(a);
								//alert(data);
							});	
						 });

	////////////////////////
	   $("#radicado").keyup(function(e){
          //$("#cosito").html( $("#nombrepan").val() );
          if (e.which == 13)
          {
              
          	//alert('digito enter');	
          		/*
          		 var data1 ='radicado=' + $("#radicado").val();
              $.post('traer_datos_reserva.php',data1,function(b){
              		$("#prueba").html(b);
              });
				*/
              
              var data1 ='radicado=' + $("#radicado").val();
              $.post('traer_datos_reserva.php',data1,function(b){
                      
                  
                 
                  $("#nombre_cliente").val(b[0].nombre);
                  $("#id_reserva").val(b[0].id_reserva);
                 
               //(data1);
              },
              'json');
               
              /////////////////////////
          }// fin del if    
         });//finde funcion 
	     
	////////////////////////



});		////finde la funcion principal de script
		
</script>