<?php
session_start();
include('../valotablapc.php');
$ancho_tabla = "100%";
$tamano_letra= "15px";

$fecha_hora_actual = date('Y-m-d H:i:s'); 
?>
<!doctype html>
<html>
<head>
	<title></title>

  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>

</head>
<style>
  
#div_buscar_asesor {

  position:absolute;
  width: 300px;
  height: 200px;

  color: white;
  border: 1px solid black;
}
</style>

<body>
<br>
<table class ="formato_tabla" border="1" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
<tr>
</td>NUMERO DE CONTRATO</td>
</td><input type="text" id="no_contrato" class ="fila_llenar"></td>
</tr>

<br><br>
</table>
</td>DESTINO NACIONAL/DESTINO INTERNACIONAL</td>
</td><select id="id_tipo_destino"  class="fila_llenar"  >
            <?php
                colocar_select_general($tipo_destino,$conexion,'id_tipo_destino','nombre');
            ?>
         
         </select></td>
</td></td>
</td></td>
</tr>
</table>
<br><br>
<table class ="formato_tabla" border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
<tr>

</td>ESCOGER ASESOR</td>
</td>
<select id="id_asesor"  class="fila_llenar"  >
            <?php
                colocar_select_general_roles($tabla3,$conexion,'idcliente','nombre','2');
            ?>
         
         </select>


</td>
</td>&nbsp;&nbsp;<button id="btn_crear_asesor">CREAR ASESOR</button>     </td>
</td></td>
</tr>
</table>
<div  id="div_buscar_asesor123">
</div>    
<BR>
<button id="btn_siguiente">SIGUIENTE</button>
</body>
</html>
<script src="../js/jquery-2.1.1.js"></script>   
<?php

function colocar_select_general($tabla,$conexion,$campo1,$campo2){
  $sql_general = "select * from $tabla   ";
  //echo '<br>'.$sql_personas;
  $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
    echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
  }
}

/////////////////////////////////////////
function colocar_select_general_roles($tabla,$conexion,$campo1,$campo2,$rol){
  $sql_general = "select * from $tabla  where rol = '".$rol."' order by '".$campo2."' ";
  //echo '<br>'.$sql_personas;
  $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
    echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
  }
}
?>

<script language="JavaScript" type="text/JavaScript">      
$(document).ready(function(){
//////////////////////////////////////////////////////////
  /////////////////////////////////////
$("#btn_crear_asesor").click(function(){
              $("#div_crear_asesor").css("display","block");
              var data =  'rol=' + '2';
              //data += '&placa=' + $("#placa").val();
              $.post('../clientes/captura_cliente.php',data,function(a){
              //$(window).attr('location', '../index.php);
              $("#div_buscar_asesor123").html(a);
                //alert(data);
              }); 

              ///////////////////////////
 });


///////////////////////////////////////
$("#btn_siguiente").click(function(){
        //alert('asdasdas');
              var data =  'no_contrato=' + $("#no_contrato").val();
              data += '&id_tipo_destino=' + $("#id_tipo_destino").val();
               data += '&id_asesor=' + $("#id_asesor").val();

              $.post('pregunte_director.php',data,function(b){
              //$(window).attr('location', '../index.php);
              $("#div_buscar_asesor123").html(b);
                //alert(data);
              }); 

 });


////////////////////////////////////


});   ////finde la funcion principal de script
    
</script>


