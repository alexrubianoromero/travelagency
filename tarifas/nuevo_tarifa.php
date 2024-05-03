<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');

$sql_productos = "select * from $tarifas  ";
$con_productos = mysql_query($sql_productos,$conexion);

////////////////////////////


function colocar_select_general_condicion123($tabla,$conexion,$campo1,$campo2){
  $sql_general = "select * from $tabla    ";
 
  echo '<br>'.$sql_personas;
  $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
    echo '<option value="'.$general[$campo2].'" >'.$general[$campo1].'</option>';
  }
}



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
   /* border: 1px solid black; */
    padding: 5px;
    text-align: center;
  }


</style>
</head>
<body>
<div id="div_nuevo_producto">

  <table border ="0">
    
    <tr>
      <td> VIGENCIA</td>
      <td><input type="text"  id="vigencia" class="fila_llenar"></td>
   
    <td>PLAN </td>
     <td><input type="text"  id="plan"  size="20px" class="fila_llenar"></td>
   </tr>
 </tr>
  
      <td>DESTINO</td>
      <td>
      <select id="id_destino">
        <?php
          colocar_select_general_condicion123($destinos,$conexion,'nombre','id_destino',$campo_comparacion);
        ?>
      </select>
      </td>
      <tr>

      </tr>

      <td>HOTEL</td>
      <td>
      <select id="id_hotel">
        <?php
          colocar_select_general_condicion123($hoteles,$conexion,'nombre','id_hotel',$campo_comparacion);
        ?>
      </select>
      </td>
    </tr>
</table>
<br>
  <table border ="0">
     <tr>
      
    <td>VALOR SENCILLA</td>
     <td>
   

      <input type="text"  id="sencilla"  size="20px" class="fila_llenar"> 

    </td>
     <td>IMPUESTOS SENCILLA</td>
    <td>
     <select id= "impuestos_sencilla">
      </select> 
      <!--<input type="text"  id="impuestos_sencilla"  size="20px" class="fila_llenar">-->

    </td>
     <td>VALOR NOCHE ADICIONAL</td>
     <td><input type="text"  id="cargos_sencilla"  size="20px" class="fila_llenar"></td>
     </tr>
     </table>
<br>
  <table border ="0">
      <tr>
    <td>VALOR DOBLE</td>
     <td><input type="text"  id="doble"  size="20px" class="fila_llenar"></td>
      <td>IMPUESTOS DOBLE</td>
     <td>
      <select id= "impuestos_doble">
      </select> 
      <!--<input type="text"  id="impuestos_doble"  size="20px" class="fila_llenar">--></td>
           <td>VALOR NOCHE ADICIONAL</td>
     <td><input type="text"  id="cargos_doble"  size="20px" class="fila_llenar"></td>
     </tr>

          </table>
<br>
  <table border ="0">
      <tr>
    <td>VALOR TRIPLE</td>
     <td><input type="text"  id="triple"  size="20px" class="fila_llenar"></td>
     <td>IMPUESTOS TRIPLE</td>
     <td>

      <select id= "impuestos_triple">
      </select> 
      <!--<input type="text"  id="impuestos_triple"  size="20px" class="fila_llenar">--></td>
          <td>VALOR NOCHE ADICIONAL</td>
     <td><input type="text"  id="cargos_triple"  size="20px" class="fila_llenar"></td>
     </tr>
      <tr>
             </table>
<br>
  <table border ="0">
    <td>VALOR NINO</td>
     <td><input type="text"  id="nino"  size="20px" class="fila_llenar"></td>
       <td>IMPUESTOS NINO</td>
     <td>
      <select id= "impuestos_nino">
      </select> 
      <!--<input type="text"  id="impuestos_nino"  size="20px" class="fila_llenar">--></td>
       <td>VALOR NOCHE ADICIONAL</td>
     <td><input type="text"  id="cargos_nino"  size="20px" class="fila_llenar"></td>
     </tr>
      <tr>
             </table>
<br>
  <table border ="0">
    <td>VALOR INFANTE</td>
     <td><input type="text"  id="infante"  size="20px" class="fila_llenar"></td>
      <td>IMPUESTOS INFANTE</td>
     <td>
        <select id= "impuestos_infante">
      </select> 
      <!--<input type="text"  id="impuestos_infante"  size="20px" class="fila_llenar">--></td>
           <td>VALOR NOCHE ADICIONAL</td>
     <td><input type="text"  id="cargos_infante"  size="20px" class="fila_llenar"></td>
     </tr>
    <tr>
      <td colspan="6" align="center"> <button type="submit"  id="btn_grabar_producto">GRABAR TARIFA</button></td>
    </tr>
   </table> 
</div>  
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
   /////////////////////////

    $("#id_destino").change(function(event){
            var id = $("#id_destino").find(':selected').val();
            $("#id_hotel").load('genera-select.php?id='+id);

            $("#impuestos_sencilla").load('genera-select1.php?id='+id);
            $("#impuestos_doble").load('genera-select2.php?id='+id);
             $("#impuestos_triple").load('genera-select3.php?id='+id);
              $("#impuestos_nino").load('genera-select_nino.php?id='+id);
               $("#impuestos_infante").load('genera-select_infante.php?id='+id);
            //$("#producto2").load('genera-select.php?id='+id);
            //$("#producto3").load('genera-select.php?id='+id);
        });

///////////////////////////////


           $("#btn_grabar_producto").click(function(){

          
            if($("#vigencia").val().length < 1)
            { alert('digite vigencia');
              $(vigencia).focus();
              return false;
             }



              var data =  'vigencia=' + $("#vigencia").val();
              data += '&plan=' + $("#plan").val();
              data += '&id_hotel=' + $("#id_hotel").val();
                data += '&id_destino=' + $("#id_destino").val();
                
                data += '&sencilla=' + $("#sencilla").val();
                data += '&impuestos_sencilla=' + $("#impuestos_sencilla").val();
                 data += '&cargos_sencilla=' + $("#cargos_sencilla").val();

                data += '&doble=' + $("#doble").val();
                data += '&impuestos_doble=' + $("#impuestos_doble").val();
                 data += '&cargos_doble=' + $("#cargos_doble").val();


                data += '&triple=' + $("#triple").val();
                 data += '&impuestos_triple=' + $("#impuestos_triple").val();
                 data += '&cargos_triple=' + $("#cargos_triple").val();



                data += '&nino=' + $("#nino").val();
                 data += '&impuestos_nino=' + $("#impuestos_nino").val();
                 data += '&cargos_nino=' + $("#cargos_nino").val();


                data += '&infante=' + $("#infante").val();
                       data += '&impuestos_infante=' + $("#impuestos_infante").val();
                 data += '&cargos_infante=' + $("#cargos_infante").val();

                





            
              $.post('grabar_tarifa.php',data,function(a){
              //$(window).attr('location', '../index.php);
              $("#div_muestre_productos").html(a);
                //alert(data);
              }); 
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>