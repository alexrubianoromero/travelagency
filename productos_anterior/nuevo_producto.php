<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');

$sql_productos = "select * from $productos  ";
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
      <td><label for = "codigo_producto">CODIGO PRODUCTO</label></td>
      <td><input type="text"  id="codigo_producto" class="fila_llenar" size="5px"></td>
    </tr> 
    <tr>
      <td><label for = "nombre_producto">NOMBRE PRODUCTO</label></td>
      <td><input type="text"  id="nombre_producto" class="fila_llenar"></td>
    </tr>  
    <tr>
      <td><label for = "tiquetes">TIQUETES</label></td>
      <td>
        <select id="tiquetes" class="fila_llenar">
          <option value="">...</option>
          <option value="SI">SI</option>
           <option value="NO">NO</option>
        </select>
      </td>
    </tr> 
    <tr>
      <td><label for = "alojamiento">ALOJAMIENTO</label>

      </td>
      <td> <select id="alojamiento" class="fila_llenar">
          <option value="">...</option>
          <option value="SI">SI</option>
           <option value="NO">NO</option>
        </select></td>
    </tr> 
     <tr>
      <td><label for = "id_tipo_habitacion"> TIPO HABITACION</label></td>
      <td><select id = "id_tipo_habitacion" class="fila_llenar" >
        <?php
        colocar_select_general($tipo_habitacion,$conexion,'id_tipo_habitacion','descripcion');
        ?>
      </select></td>
    </tr> 
    <tr>
      <td> <label for = "alimentacion">ALIMENTACION</label></td>
      <td><input type="text"  id="alimentacion" class="fila_llenar" size="5px"></td>
    </tr> 
      <tr>
      <td> <label for = "alimentacion">TIPO ALIMENTACION</label></td>
      <td><select id = "id_tipo_alimentacion" class="fila_llenar" >
        <?php
        colocar_select_general($tipo_alimentacion,$conexion,'id_tipo_alimentacion','codigo');
        ?>
      </select>
      </td>
    </tr> 
    <tr>
      <td><label for = "traslado">TRASLADO</label></td>
      <td>
        <select id="traslado" class="fila_llenar">
          <option value="">...</option>
          <option value="SI">SI</option>
           <option value="NO">NO</option>
        </select>
      </td>
    </tr> 
    <tr>
      <td><label for = "asistencia_medica">ASISTENCIA MEDICA</label></td>
      <td>
         <select id="asistencia_medica" class="fila_llenar">
          <option value="">...</option>
          <option value="SI">SI</option>
           <option value="NO">NO</option>
        </select>
      </td>
    </tr> 
    <tr>
      <td><label for = "impuestos">IMPUESTO</label></td>
      <td> <input type="text"  id="impuestos" class="fila_llenar" size="5px"></td>
    </tr> 
      <tr>
      <td><label for = "impuesto_adulto">IMPUESTO ADULTO</label></td>
      <td>
          <select id = "impuesto_adulto" class="fila_llenar" >
        <?php
        colocar_select_general_condicion($tarifas_impuestos,$conexion,'destino',$campo2,'adulto');
        ?>
      </select>
      </td>
    </tr> 
      <tr>
      <td><label for = "impuesto_nino">IMPUESTO INFANTE </label></td>
      <td>   <select id = "impuesto_nino" class="fila_llenar" >
        <?php
        colocar_select_general_condicion($tarifas_impuestos,$conexion,'destino',$campo2,'nino');
        ?>
      </select></td>
    </tr> 
    <tr>
      <td><label for = "valor">VALOR</label></td>
      <td><input type="text"  id="valor" class="fila_llenar"></td>
    </tr> 
      <tr>
      <td><label for = "observaciones">OBSERVACIONES</label></td>
      <td><textarea cols = "50" rows="3" id="observaciones" class="fila_llenar"></textarea></td>
    </tr> 

    <tr>
      <td colspan="2" align="center"> <button type="submit"  id="btn_grabar_producto">GRABAR PRODUCTO</button></td>
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
           $("#btn_grabar_producto").click(function(){

             if($("#codigo_producto").val().length < 1)
            { alert('digite codigo_producto ');
              $(codigo_producto).focus();
              return false;
             }
            if($("#nombre_producto").val().length < 1)
            { alert('digite nombre_producto ');
              $(nombre_producto).focus();
              return false;
             }

          if($("#tiquetes").val().length < 1)
            { alert('Digite tiquetes'); 
            $(tiquetes).focus();
              return false;}
          if($("#alojamiento").val().length < 1)
            { alert('Digite alojamiento'); 
            $(alojamiento).focus();
            return false;}


            if($("#id_tipo_habitacion").val().length < 1)
            { alert('Digite  tipo habitacion'); 
            $(id_tipo_habitacion).focus();
            return false;}


          if($("#alimentacion").val().length < 1)
            { alert('Digite alimentacion'); 
            $(alimentacion).focus();
            return false;}
             if($("#id_tipo_alimentacion").val().length < 1)
            { alert('Digite tipo_alimentacion'); 
            $(id_tipo_alimentacion).focus();
            return false;}

            id_tipo_alimentacion
          if($("#traslado").val().length < 1)
            { alert('Digite traslado'); 
            $(traslado).focus();
            return false; }
          if($("#asistencia_medica").val().length < 1)
            { alert('Digite  asistencia_medica'); 
            $(asistencia_medica).focus();
            return false;}
             if($("#impuestos").val().length < 1)
            { alert('Digite  impuestos'); 
            $(impuestos).focus();
            return false;}
              if($("#valor").val().length < 1)
            { alert('Digite valor'); 
            $(valor).focus();
            return false;}


              var data =  'nombre=' + $("#nombre_producto").val();
              data += '&tiquetes=' + $("#tiquetes").val();
              data += '&alojamiento=' + $("#alojamiento").val();
               data += '&id_tipo_habitacion=' + $("#id_tipo_habitacion").val();
              data += '&alimentacion=' + $("#alimentacion").val();
              data += '&id_tipo_alimentacion=' + $("#id_tipo_alimentacion").val();
              data += '&traslado=' + $("#traslado").val();
              data += '&asistencia_medica=' + $("#asistencia_medica").val();
              data += '&impuestos=' + $("#impuestos").val();
              data += '&valor=' + $("#valor").val();
              data += '&observaciones=' + $("#observaciones").val();
              data += '&codigo_producto=' + $("#codigo_producto").val();

              $.post('grabar_producto.php',data,function(a){
              //$(window).attr('location', '../index.php);
              $("#div_muestre_productos").html(a);
                //alert(data);
              }); 
             });
           ////////////////////////
         

});   ////finde la funcion principal de script
    
</script>