<?php
session_start();
include('../valotablapc.php');


  function  consulta_assoc_imp1($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }


  $arr_impuesto =  consulta_assoc_imp1($impuestos,'id_impuesto',$_REQUEST['id_impuesto'],$conexion);
?>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
<?php

echo '<div id="div_123_modificar"';
echo '<br><br>';
echo '<table border = "1" >';
echo '<tr>';
echo '<td> <input type="hidden" id="id_impuesto" value="'.$_REQUEST['id_impuesto'].'" ></td> <td></td>';

echo '<tr>';

echo '<tr>';
echo '<td>NOMBRE </td><td><input type="text" id="nombre" value="'.$_REQUEST['nombre'].'" class="fila_llenar" ></td>';
echo '<tr>';

echo '<tr>';
echo '<td>DESTINO</td>';
echo '<td><select id="id_destino">';
colocar_select_general_condicion_mejorada_imp($destinos,$conexion,'id_destino','nombre',$_REQUEST['id_destino']);

echo '</select></td>';
echo '<tr>';

echo'
 <tr>
      <td><label for = "sencilla">SENCILLA </label></td>
      <td><input type="text"  id="sencilla" class="fila_llenar" value="'.  $arr_impuesto['sencilla'].'"></td>
    </tr> 
      <tr>
      <td><label for = "doble">DOBLE </label></td>
      <td><input type="text"  id="doble" class="fila_llenar" value="'.  $arr_impuesto['doble'].'"></td>
    </tr> 
      <tr>
      <td><label for = "triple">TRIPLE </label></td>
      <td><input type="text"  id="triple" class="fila_llenar" value="'.  $arr_impuesto['triple'].'"></td>
    </tr> 
      <tr>
      <td><label for = "nino">NINO </label></td>
      <td><input type="text"  id="nino" class="fila_llenar" value="'.  $arr_impuesto['nino'].'"></td>
    </tr> 
      <tr>
      <td><label for = "infante">INFANTE </label></td>
      <td><input type="text"  id="infante" class="fila_llenar" value="'.  $arr_impuesto['infante'].'"></td>
    </tr> 
';   

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
function colocar_select_general_condicion_mejorada_imp($tabla,$conexion,$campo1,$campo2,$condicion){
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
           			
		              var data =  'nombre=' + $("#nombre").val();
		              data += '&id_impuesto=' + $("#id_impuesto").val();
		               data += '&id_destino=' + $("#id_destino").val();
		                data += '&sencilla=' + $("#sencilla").val();
		                 data += '&doble=' + $("#doble").val();
		                  data += '&triple=' + $("#triple").val();
		                   data += '&nino=' + $("#nino").val();
		                    data += '&infante=' + $("#infante").val();

		            
		              $.post('grabar_modificar_destino.php',data,function(a){
		              //$(window).attr('location', '../index.php);
		              $("#div_123_modificar").html(a);
		                //alert(data);
		              }); 
					
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>