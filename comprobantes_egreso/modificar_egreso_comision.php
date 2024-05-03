<?php
session_start();
include('../valotablapc.php');

//////////////para traer un select y dejar una opcion seleccionada de cuerdo a la condicion
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



////////////////////////////////////////////////

function  consulta_assoc_hot($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$recibo_proveedor = consulta_assoc_hot($recibos_proveedores,'id_recibo_proveedor',$_REQUEST['id_hotel'],$conexion);
$datos_reserva = consulta_assoc_hot($reservas,'id_reserva',$recibo_proveedor['id_cxp'],$conexion);
$datos_proveedor = consulta_assoc_hot($tabla3,'idcliente',$datos_reserva['id_vendedor'],$conexion);
     // $datos_forma_pago = consulta_assoc_hot($formas_pago_egresos,'id_forma_pago_egreso',$productos['id_forma_pago'],$conexion);

?>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<?php

echo '<div id="div_123_modificar" align="center">';
echo '<input type="hidden" id="id_cxp"  value = "'.$datos_cxp['id_cxp'].'">';
echo '<BR><BR>';
echo '<h3>MODIFICACION RECIBOS EGRESO COMISIONES</h3>';
echo '<br><br>';
echo '<table border = "1" >';
echo '<tr>';
echo '<td> <input type="hidden" id="id_hotel" value="'.$_REQUEST['id_hotel'].'" ></td><td></td>';
echo '</tr>';

echo '<tr>';
echo '<td>FECHA</td><td><input type="text" id="fecha" value="'.$recibo_proveedor['fecha'].'" class="fila_llenar" ></td>';
echo '<tr>';

echo '</tr>';
echo '<td>ASESOR</td><td>'.$datos_proveedor['nombre'].'<input type="hidden" id="id_proveedor" value = "'.$datos_cxp['id_proveedor'].'"></td>';
echo '</tr>';
echo '</tr>';
echo '<td>VALOR</td><td><input type="text" id="valor" value="'.$recibo_proveedor['valor'].'" class="fila_llenar" ></td>';
echo '</tr>';

echo '<input type="hidden"  id="valor_anterior" value ="'.$recibo_proveedor['valor'].'">';
echo '</tr>';
echo '<td>FORMA DE PAGO  </td><td><select id="id_forma_pago" class="fila_llenar" >';
 colocar_select_general_condicion_mejorada($formas_pago_egresos,$conexion,'id_forma_pago_egreso','descripcion',$recibo_proveedor['id_forma_pago']);   
echo '</select</td>';
echo '</tr>';
echo '</tr>';
echo '<td>OBSERVACIONES</td><td><input type="text" id="observaciones" value="'.$recibo_proveedor['observaciones'].'" class="fila_llenar" ></td>';
echo '</tr>';





echo '<tr>';
echo '<td colspan = "2" align="center"><button id="btn_grabar_modificar" >MODIFICAR</button></td>';

echo '<tr>';
echo '</table>';


/*
$sql_modificar = "update $destinos 
set nombre = '".$_REQUEST['nombre']."' 
 where id_destino = '".$_REQUEST['id_destino']."'  ";

$consulta_modif = mysql_query($sql_modificar,$conexion); 
*/

function colocar_select_general_condicion_mejorada_dest($tabla,$conexion,$campo1,$campo2,$condicion){
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

?>
</div>	
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////
           $("#btn_grabar_modificar").click(function(){
           	//alert('modificar destino');
           			
		              var data =  'id_hotel=' + $("#id_hotel").val();
		              data += '&fecha=' + $("#fecha").val();
		              data += '&valor=' + $("#valor").val();
                   data += '&valor_anterior=' + $("#valor_anterior").val();
                  data += '&id_forma_pago=' + $("#id_forma_pago").val();
		              data += '&observaciones=' + $("#observaciones").val();
                  //data += '&id_cxp=' + $("#id_cxp").val();
		              $.post('grabar_modificar_egreso_comision.php',data,function(a){
		              //$(window).attr('location', '../index.php);
		              $("#div_123_modificar").html(a);
		                //alert(data);
		              }); 
					
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>