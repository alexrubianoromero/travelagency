<?php
session_start();
include("../empresa.php");
include("../valotablapc.php");

/*
echo 'captura asesor<pre>';
print_r($_REQUEST);
echo '</pre>';

*/
$sql_roles = "select * from $roles ";
$con_roles = mysql_query($sql_roles,$conexion);

?>
<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../css/style.css">
    <style type="text/css">
<!--
.style1 {font-weight: bold}
-->
    </style>
</head>
<body>

<Div id="contenidos">
	
</Div>	

<div id = "datos">
  <?php
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
  echo '<input type="hidden" id="id_cliente" value ="'.$_REQUEST['id_cliente'].'" >';
  echo '<input type="hidden" id="dereserva" value ="'.$_REQUEST['dereserva'].'" >';
  ?>
<br>
<table width="50%" border="0">
    <tr>
    <td><strong>CEDULA</strong></td>
    <td><input type="text" name="cedula"  id = "cedula" class="fila_llenar"></td>
  </tr>
  <tr>
    <td><strong>NOMBRE</strong></td>
    <td><input type="text" name="nombre"  id = "nombre" class="fila_llenar"></td>
  </tr>

  <tr>
    <td><strong>TELEFONO FIJO</strong></td>
    <td><input type="text" name="telefono"  id = "telefono" class="fila_llenar"></td>
  </tr>
  <tr>
     <tr>
    <td><strong>TELEFONO CELULAR</strong></td>
    <td><input type="text" name="telefono_celular"  id = "telefono_celular" class="fila_llenar"></td>
  </tr>
  <tr>
    <td><strong>DIRECCION</strong></td>
    <td><input type="text" name="direccion"  id = "direccion" class="fila_llenar"></td>
  </tr>
  
  <tr>
    <td><strong>EMAIL</strong></td>
    <td><input type="text" name="email"  id = "email" class="fila_llenar"></td>
  </tr>
    <tr>
    <td><strong>ROL</strong></td>
    <td><select id="rol" class="fila_llenar"> 
      <option value="">...</option>
      <?php
        while ($roles = mysql_fetch_assoc($con_roles))
        {
         
         if(isset($_REQUEST['rol']) && $roles['id_rol'] == $_REQUEST['rol'] ){
            echo '<option value ="'.$roles['id_rol'].'" selected >'.$roles['nombre_rol'].'</option>';

         }
       else{
          echo '<option value ="'.$roles['id_rol'].'" >'.$roles['nombre_rol'].'</option>';
        }//fin de else
        }///fin de while
      ?>

    </select></td>
  </tr>
<tr>
    <td><strong>OBSERVACIONES</strong></td>
    <td><input type="text" name="observaciones"  id = "observaciones" class="fila_llenar"></td>
  </tr>
  <tr>
    <td><strong></strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><button type ="sumbit" class="style1"  id = "grabar_tecnico" >GRABAR</button></td>
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
				$("#grabar_tecnico").click(function(){

            ////////////////////////

      if($("#cedula").val().length < 1)
        { alert('digite cedula ');
      $(cedula).focus();
          return false;
         }

      if($("#nombre").val().length < 1)
        { alert('Digite nombre'); 
        $(nombre).focus();
          return false;}
          /*
      if($("#telefono").val().length < 1)
        { alert('Digite telefono'); 
        $(telefono).focus();
        return false;}
     */
         if($("#telefono_celular").val().length < 1)
        { alert('Digite telefono_celular'); 
        $(telefono_celular).focus();
        return false;}
        /*
      if($("#direccion").val().length < 1)
        { alert('Digite direccion'); 
        $(direccion).focus();
        return false;}
  */
      if($("#email").val().length < 1)
        { alert('Digite email'); 
        $(email).focus();
        return false; }

           if($("#rol").val().length < 1)
        { alert('Digite rol'); 
        $(rol).focus();
        return false; }
            //////////////////////
             var  rol = $("#rol").val();
              var  nombresito = $("#nombre").val();
              var  identidadsita  = $("#cedula").val(); 
              var  telefono_fijo = $("#telefono").val(); 
              var  celular = $("#telefono_celular").val(); 
              var  direccion = $("#direccion").val(); 
              var  email = $("#email").val(); 

              if(rol==1)
              {
                  $("#nombre_cliente").val(nombresito);
                 $("#identidad_cliente").val(identidadsita);
                 $("#celular_cliente").val(celular);
                // $("#fijo_cliente").val(telefono_fijo);
                 $("#email_cliente").val(email);
                 $("#direccion_cliente").val(direccion);

              }
               if(rol==2)
              {
                  $("#nombre_asesor").val(nombresito);
                 $("#identi_asesor").val(identidadsita);
                 $("#cel_asesor").val(celular);
                 $("#email_asesor").val(email);
               

              }
                if(rol==4)
              {
                   $("#nombre_director_comercial").val(nombresito);
                 $("#identificacion_director_comercial").val(identidadsita);
                 $("#cel_director_comercial").val(celular);
                 $("#email_director_comercial").val(email);
      

              }

							var data =  'nombre=' + $("#nombre").val();
							data += '&cedula=' + $("#cedula").val();
							data += '&telefono=' + $("#telefono").val();
              data += '&telefono_celular=' + $("#telefono_celular").val();
							data += '&direccion=' + $("#direccion").val();
							data += '&entidad=' + $("#entidad").val();
							data += '&email=' + $("#email").val();
              data += '&rol=' + $("#rol").val();
							data += '&observaciones=' + $("#observaciones").val();
              data += '&dereserva=' + $("#dereserva").val();
              /////////////este idcliente es el que envia captura cliente
              data += '&id_cliente=' + $("#id_cliente").val();




							$.post('grabar_persona.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#datos").html(a);
								//alert(data);
							});	

              
              
              $.post('pregunte_director.php',data,function(c){
              //$(window).attr('location', '../index.php);
              $("#datos").html(c);
                //alert(data);
              }); 



              ////////////////aqui deberia ir lo de colocar el id 
              ///para la parte separada de pedir la informacion en reserva
              //solo de asesor 


						 });
					////////////////////////
			       
			
			});		////finde la funcion principal de script
			
			
			
			
			
</script>

  
