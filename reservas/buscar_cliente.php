<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

$sql_traer_codigos = "select * from $tabla3 where nombre like '%".$_REQUEST['buscar_cliente']."%'  and rol = '1' ";
//echo '<br>'.$sql_traer_codigos;
$consulta_codigos = mysql_query($sql_traer_codigos,$conexion);

echo "<select name='codigo_a_escoger_cliente' id='codigo_a_escoger_cliente' class='fila_llenar' multiple= 'multiple' size='10'>";
  echo "<option value='' selected>...</option>";     
  while($codigos123 = mysql_fetch_assoc($consulta_codigos))
      {
             echo '<h2><option value= '.$codigos123['idcliente'].'>'.$codigos123['identi'].'-'.$codigos123['nombre'].'</h2></option>';
        }
   echo "</select>";
?>


<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
    $(document).ready(function(){
               /////////////////////////
          $("#codigo_a_escoger_cliente").change(function(){
            var codigo = $("#codigo_a_escoger_cliente").val();  
              var data1 ='idcliente123=' + codigo;
                $.post('traer_datos_cliente_por_idcliente2.php',data1,function(b){
                    //$("#id_cliente123").val(b[0].id_cliente);
                    $("#nombre_cliente").val(b[0].nombre);
                    $("#identidad_cliente").val(b[0].identi);
                    $("#direccion_cliente").val(b[0].direccion);
                    $("#email_cliente").val(b[0].email);
                     $("#celular_cliente").val(b[0].telefono_celular);
                     $("#fijo_cliente").val(b[0].telefono);
                    celular_cliente
                    //$("#cantipan").focus();
                 
                 //(data1);
                },
                'json');
              $("#div_buscar_cliente").css("display","none");  
          });
        ///////////////////////
      });   ////finde la funcion principal de script  
</script>