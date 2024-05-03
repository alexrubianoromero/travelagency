<?php
session_start();
include('../valotablapc.php');

function  consulta_assoc_cliente($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }


/*
echo '<pre>';
print_r($datos_cliente);
echo '</pre>';
*/


  if(isset($_REQUEST['id_cliente']))  //osea si se escogio el cliente 
        {
            $datos_cliente = consulta_assoc_cliente($tabla3,'idcliente',$_REQUEST['id_cliente'],$conexion);
         }  
  /////////////////////////asesor
  if(isset($_REQUEST['id_asesor']))  //osea si se escogio el cliente 
        {
            $datos_asesor = consulta_assoc_cliente($tabla3,'idcliente',$_REQUEST['id_asesor'],$conexion);
         }  

  else { //osea si se creo el cliente 

          $datos_asesor = consulta_assoc_cliente($tabla3,'nombre',$_REQUEST['nombre'],$conexion);  
  }   




$ancho_tabla = "100%";
$tamano_letra= "15px";
$tamano_letra_cliente = $tamano_letra= "20px";

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
  <?php
   echo '<input type="hidden"   id="id_cliente"   value = "'.$datos_cliente['idcliente'].'"   >';
   echo '<input type="hidden"   id="id_asesor"   value = "'.$datos_asesor['idcliente'].'"   >';
  ?>
<div id="div_pregunte_cliente">

<br>

<table class ="formato_tabla" border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra_cliente; ?>">
<tr>
</td>CLIENTE:</td>
</td><h3><?php  echo $datos_cliente['nombre'];  ?></h3></td>
</tr>
</table>
<table class ="formato_tabla" border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra_cliente; ?>">
<tr>
</td>ASESOR:</td>
</td><h3><?php  echo $datos_asesor['nombre'];  ?></h3></td>
</tr>
</table>



<table class ="formato_tabla" border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
<tr>

</td>ESCOGER DIRECTOR </td>
</td>
<select id="id_director"  class="id_director"  >
            <?php
                colocar_select_general_roles($tabla3,$conexion,'idcliente','nombre','4','0');
            ?>
         
         </select>


</td>
</td>&nbsp;&nbsp;<button id="btn_crear_cliente">CREAR NUEVO DIRECTOR </button>     </td>
</td></td>
</tr>
</table>
<div  id="div_buscar_asesor123">
</div>    
<BR>
<button id="btn_siguiente" type ="submit" >CONTINUAR CON LA CREACION DE LA RESERVA</button>
</div>
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
function colocar_select_general_roles($tabla,$conexion,$campo1,$campo2,$rol,$anulado){
  $sql_general = "select * from $tabla  where rol =  '".$rol."'
  and anulado = '".$anulado."' order by ".$campo2." ";
  echo '<br>'.$sql_personas;
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
$("#btn_crear_cliente").click(function(){
              $("#div_crear_asesor").css("display","block");
              var data =  'rol=' + '4';
              data += '&id_cliente='  + $("#id_cliente").val();
              data += '&id_asesor='  + $("#id_asesor").val();
              $.post('captura_director.php',data,function(a){
              //$(window).attr('location', '../index.php);
              $("#div_pregunte_cliente").html(a);
                //alert(data);
              }); 

              ///////////////////////////
 });


///////////////////////////////////////
$("#btn_siguiente").click(function(){
        //alert('asdasdas');


                if($("#id_director").val().length < 1)
                  { alert('Escoja un Director por favor '); 
                  $(id_director).focus();
                  return false; }


              var data =  'id_director=' + $("#id_director").val();
              data += '&id_cliente=' + $("#id_cliente").val();
              data += '&id_asesor=' + $("#id_asesor").val();
              // data += '&id_asesor=' + $("#id_asesor").val();

              $.post('nueva_reserva.php',data,function(b){
              //$(window).attr('location', '../index.php);
              $("#div_pregunte_cliente").html(b);
                //alert(data);
              }); 

 });


////////////////////////////////////


});   ////finde la funcion principal de script
    
</script>


