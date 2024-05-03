<?php
include('../valotablapc.php');
 function  consulta_assoc_cxp($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
////////////////////////
function colocar_select_general_condicion_mejorada($tabla,$conexion,$campo1,$campo2,$condicion){
  $sql_general = "select * from $tabla    ";
  
 $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
      if($general[$campo1] == $condicion){
           echo '<option value="'.$general[$campo1].'" selected >'.$general [$campo2].'</option>';
      }
      else 
      {
          echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
      }
     }//fin del while
    } //fin ed la funcion   

  ///////////////////////////////
$datos_cxp = consulta_assoc_cxp($cxp_proveedores,'id_cxp',$_REQUEST['id_cxp'],$conexion);
$datos_reserva = consulta_assoc_cxp($reservas,'id_reserva',$datos_cxp['id_reserva'],$conexion);
$datos_cliente= consulta_assoc_cxp($tabla3,'idcliente',$datos_reserva['id_cliente'],$conexion);
$datos_proveedor= consulta_assoc_cxp($tabla3,'idcliente',$datos_cxp['id_proveedor'],$conexion);
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
          <td>No RADICADO </td> <td>
          <input type="hidden" id="id_cxp"  value = "<?php  echo $_REQUEST['id_cxp'];  ?>">
          <?php echo $datos_reserva['no_reserva']; ?>
      </td>
		</tr>	
		<tr>
			<td>nombre</td>
			<td><?php echo $datos_cliente['nombre'];  ?></td>
		</tr>
		<tr>
			<td>Proveedor</td><td><?php  echo $datos_proveedor['nombre'] ?></td>
		</tr>
		<tr><td>FECHA</td><td><?php  echo $datos_cxp['fecha'];   ?></td>
		</tr>
		<tr><td>CONCEPTO</td><td>
			<select id= "id_concepto" >
			<!--<input type="text"  id="concepto"  > -->
			<?php
				//colocar_select_general_conceptos($cxp_conceptos,$conexion,'id_concepto','nombre_concepto');
			colocar_select_general_condicion_mejorada($cxp_conceptos,$conexion,'id_concepto','nombre_concepto',$datos_cxp['id_concepto']);
			?>
			</select>
		</td>
		</tr>
		<tr><td>CONCEPTO ANTERIOR</td><td><?php echo $datos_cxp['concepto']  ?></td></tr>
		<tr><td>DOCUMENTO</td><td><input type="text"  id="documento" value = "<?php  echo $datos_cxp['documento'] ; ?>"  ></td>
		</tr>
		<tr><td>VALOR</td><td><?php echo $datos_cxp['valor_total']  ?></td></tr>
		
		<tr><td>DESTINO</td><td><input type="text"  id="destino"  value = "<?php  echo $datos_cxp['destino'] ;  ?>" ></td></tr>
	</table>	
	<br><br>
	<button  type="submit" id="btn_modificar_cuenta" >MODIFICAR </button>
</div>	
</div>	
<div id="prueba">
</div>	
</body>
</html>


<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
	 
					 $("#btn_modificar_cuenta").click(function(){

					 		
					 	   if($("#id_concepto").val().length < 1)
					        { alert('Digite Concepto'); 
					        $(id_concepto).focus();
					        return false;}
					        


							var data =  'id_cxp=' + $("#id_cxp").val();
							data += '&id_concepto=' + $("#id_concepto").val();
							data += '&documento=' + $("#documento").val();
							data += '&destino=' + $("#destino").val();
							
						

							$.post('modificar_cuenta.php',data,function(a){
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