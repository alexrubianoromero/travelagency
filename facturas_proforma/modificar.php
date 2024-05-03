<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '<pre>';
*/
function  consulta_assoc_hot($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$datos_factura = consulta_assoc_hot($facturas_proforma,'id_factura',$_REQUEST['id_factura'],$conexion);
$datos_cxp = consulta_assoc_hot($cxp_proveedores,'id_cxp',$datos_factura['id_cxp'],$conexion);
$datos_proveedor = consulta_assoc_hot($tabla3,'idcliente',$datos_cxp['id_proveedor'],$conexion);
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<div id="div_123_modificar">


    <div id="div_datos_proveedor">
      <input type="hidden"  id="id_factura" value ="<?php   echo $_REQUEST['id_factura'] ?>">
      Proveedor: <?php echo $datos_proveedor['nombre']; ?> <br>
      c.c:    <?php echo $datos_proveedor['identi']; ?> <br>
      Direccion: <?php echo $datos_proveedor['direccion']; ?> <br>
      Telefonos: <?php echo $datos_proveedor['telefono']; ?> <br>

    </div>  

     <div id="div_concepto">
      <textarea id="concepto_factura" cols="60" rows="6" placeholder="concepto"></textarea>
     </div> 

     <div id="div_importe">
      Total Cuenta : <?php echo $datos_cxp['valor_total']; ?> <br>
      Valor Factura Proforma : <input class="fila_llenar"type="text" id="valor_proforma"  value="<?php   echo  $datos_factura['valor_proforma']; ?>">  
     </div>

     <BR><BR>
 

<?php
echo '<button id="btn_grabar_modificar" >MODIFICAR</button>';

echo '</div>';

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
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////
           $("#btn_grabar_modificar").click(function(){
           	//alert('modificar destino');
           			
		              var data =  'id_factura=' + $("#id_factura").val();
		              data += '&valor_proforma=' + $("#valor_proforma").val();
		             // data += '&id_destino=' + $("#id_destino").val();
		            
		              $.post('../facturas_proforma/grabar_modificar_destino.php',data,function(a){
		              //$(window).attr('location', '../index.php);
		              $("#div_123_modificar").html(a);
		                //alert(data);
		              }); 
					
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>