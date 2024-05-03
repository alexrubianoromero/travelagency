<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/
////////////////////
  function  consulta_asso_varios($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
////////////////////
$sql_recibos = "select * from $recibos_proveedores "; 

if(isset($_REQUEST['id_cxp']) && $_REQUEST['id_cxp'] != '')
{
$sql_recibos .= " where id_cxp  = '".$_REQUEST['id_cxp']."'  ";
}


$consulta_reciboscxp = mysql_query($sql_recibos,$conexion);

?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
table { 
    /*border-spacing: 10px;*/
    border-collapse: collapse;
  }
td { 
    padding: 10px;
}
</style>
</head>
<body>
	<BR>
<div id="div_reci_proveedores">	
RECIBOS PROVEEDORES
<input type="hidden"   id="id_cxp"  value = "<?php echo $_REQUEST['id_cxp']  ?>" >
<button id="btn_crear_recibo_proveedor">CREAR NUEVO RECIBO</button>	
<BR><br>
<div id="div_mostrar_reci_proveedores">	
<table class="formato_tabla">
  <thead>
<?php
	echo '<tr>';
      echo '<td align= "center">No_Egreso</td>';
      echo '<td>Fecha</td>';
      echo '<td>Proveedor</td>';
      echo '<td>Valor</td>';
      echo '<td>Forma_Pago</td>';
      echo '<td>Observaciones</td>';
      if($_SESSION['nivel_perfil']>2)
       { 
       echo '<td>Eliminar</td>';
     }
      echo '<td>Imprimir</td>';
  		echo '</tr>';
      echo '</thead>';
       echo '<tbody>';
  $suma_recibos = 0;
  while($cxp_recibos = mysql_fetch_assoc($consulta_reciboscxp))
  {
  	
      //$no_radicado = traer_algo_reserva3211($reservas,'id_reserva',$cxp['id_reserva'],'no_reserva',$conexion);
      //buscar el proveedor 
      $datos_cxp = consulta_asso_varios($cxp_proveedores,'id_cxp',$cxp_recibos['id_cxp'],$conexion);
      $datos_proveedor = consulta_asso_varios($tabla3,'idcliente',$datos_cxp['id_proveedor'],$conexion);
      $datos_forma_pago = consulta_asso_varios($formas_pago_egresos,'id_forma_pago_egreso',$cxp_recibos['id_forma_pago'],$conexion);

      echo '<tr>';
       echo '<td align="center">'.$cxp_recibos['no_egreso'].'</td>';
      echo '<td>'.$cxp_recibos['fecha'].'</td>';
      echo '<td>'.$datos_proveedor['nombre'].'</td>';
      echo '<td align="right">'.$cxp_recibos['valor'].'</td>';
      echo '<td>'.$datos_forma_pago['descripcion'].'</td>';
       echo '<td>'.$cxp_recibos['observaciones'].'</td>';
        if($_SESSION['nivel_perfil']>2)
       { 
       //echo '<td><a href="../recibos_proveedores/eliminar_recibo_proveedor.php?id_recibo_proveedor='.$cxp_recibos['id_recibo_proveedor'].'">ELIMINAR</a></td>';
  	    echo '<td>';
        echo '<button id="btn_eliminar_recibo" class="btn_eliminar_recibo"  value = "'.$cxp_recibos['id_recibo_proveedor'].'" >Eliminar</button>';
        echo '</td>';
        echo '<td>';
        echo '<a href="../recibos_proveedores/imprimir_egreso.php?id_recibo_proveedor='.$cxp_recibos['id_recibo_proveedor'].'" target="_blank">Imprimir Egreso</a>';
        echo '</td>';
      }
      echo '</tr>';
      $suma_recibos  = $suma_recibos + $cxp_recibos['valor'];
  }//fin de while 
  echo '<tr>';
  echo '<td></td>'; 
  echo '<td>Total</td>'; 
  echo '<td></td>'; 
  echo '<td>'.$suma_recibos.'</td>';
  echo '<td></td>'; 
  echo '<td></td>'; 
  echo '<td></td>'; 
  echo '<td></td>'; 
  echo '</tr>';
  /////////////////////


?>
</tbody>
</table>	
</div>
</div>
</body>
</html>

<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
<script  type="text/JavaScript">
$(document).ready(function(){

	/////////////////////////////////
	 $("#btn_crear_recibo_proveedor").click(function(){

							var data =  'id_cxp=' + $("#id_cxp").val();
							$.post('../recibos_proveedores/preguntar_datos_recibo_proveedor.php',data,function(a){
							$("#div_mostrar_reci_proveedores").html(a);
								//alert(data);
							});	

						 });
      ////////////////
    
    ///////////////////////////////
    $(".pagos").click(function(){
              //alert('dasdasdasdas');
              var data =  'id_cxp=' + $(this).attr('value');
              //data += '&id_reserva=' + $("#id_reserva").val();
              $.post('../recibos_proveedores/mostrar_recibos_proveedores.php',data,function(a){
                $("#div_pagos").html(a);
                //alert(data);
              }); 
    });
    ///////////////////////////////  
      $(".btn_eliminar_recibo").click(function(){
                    //alert('dasdasdasdas');
                    var data =  'id_recibo_cxp=' + $(this).attr('value');
                    //data += '&id_reserva=' + $("#id_reserva").val();
                    $.post('../recibos_proveedores/eliminar_recibo_proveedor.php',data,function(a){
                      $("#div_mostrar_reci_proveedores").html(a);
                      //alert(data);
                    }); 
          });
    ///////////////////////////////  




 });
</script>