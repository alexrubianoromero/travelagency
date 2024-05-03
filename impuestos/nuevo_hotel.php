<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');

$sql_productos = "select * from $hoteles  ";
$con_productos = mysql_query($sql_productos,$conexion);

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>

  #div_nuevo_producto{
    position:relative;
    width: 60%;
    border: 1px solid black;
    padding: 5px;
    text-align: center;
  }


</style>
</head>
<body>
<div id="div_nuevo_producto">

  <table border ="0">
    
    <tr>
      <td><label for = "nombre_producto">NOMBRE </label></td>
      <td><input type="text"  id="nombre_producto" class="fila_llenar"></td>
    </tr>  
      <tr>
      <td><label for = "id_destino">DESTINO </label></td>
      <td><select id="id_destino" class="fila_llenar">
        <?php
             colocar_select_general_dest($destinos,$conexion,'id_destino','nombre');
           ?>  
    <select>
      </td>
    </tr> 
      <tr>
      <td><label for = "sencilla">SENCILLA </label></td>
      <td><input type="text"  id="sencilla" class="fila_llenar"></td>
    </tr> 
      <tr>
      <td><label for = "doble">DOBLE </label></td>
      <td><input type="text"  id="doble" class="fila_llenar"></td>
    </tr> 
      <tr>
      <td><label for = "triple">TRIPLE </label></td>
      <td><input type="text"  id="triple" class="fila_llenar"></td>
    </tr> 
      <tr>
      <td><label for = "nino">NINO </label></td>
      <td><input type="text"  id="nino" class="fila_llenar"></td>
    </tr> 
      <tr>
      <td><label for = "infante">INFANTE </label></td>
      <td><input type="text"  id="infante" class="fila_llenar"></td>
    </tr> 
    

    <tr>
      <td colspan="2" align="center"> <button type="submit"  id="btn_grabar_producto">GRABAR </button></td>
    </tr>
   </table> 
</div>  
</body>
</html>
<?php
function colocar_select_general_dest($tabla,$conexion,$campo1,$campo2){
  $sql_general = "select * from $tabla   ";
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
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////
           $("#btn_grabar_producto").click(function(){

          
            if($("#nombre_producto").val().length < 1)
            { alert('digite nombre_producto ');
              $(nombre_producto).focus();
              return false;
             }



              var data =  'nombre=' + $("#nombre_producto").val();
              data += '&id_destino=' + $("#id_destino").val();
               data += '&sencilla=' + $("#sencilla").val();
                data += '&doble=' + $("#doble").val();
                 data += '&triple=' + $("#triple").val();
                  data += '&nino=' + $("#nino").val();
                   data += '&infante=' + $("#infante").val();

            
              $.post('grabar_hotel.php',data,function(a){
              //$(window).attr('location', '../index.php);
              $("#div_muestre_productos").html(a);
                //alert(data);
              }); 
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>