<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

$sql_traer_codigos = "select * from $tabla3 where nombre like '%".$_REQUEST['buscar_asesor']."%'  and rol = '4' ";
//echo '<br>'.$sql_traer_codigos;
$consulta_codigos = mysql_query($sql_traer_codigos,$conexion);

echo "<select name='codigo_a_escoger123' id='codigo_a_escoger123' class='fila_llenar' multiple= 'multiple' size='10'>";
  echo "<option value='' selected>...</option>";     
  while($codigos = mysql_fetch_assoc($consulta_codigos))
      {
             echo '<h2><option value= '.$codigos['idcliente'].'>'.$codigos['identi'].'-'.$codigos['nombre'].'</h2></option>';
        }
   echo "</select>";
?>


<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
    $(document).ready(function(){
               /////////////////////////
          $("#codigo_a_escoger123").change(function(){
            var codigo = $("#codigo_a_escoger123").val();  
              var data1 ='idcliente=' + codigo;
                $.post('traer_datos_cliente_por_idcliente.php',data1,function(b){
                  
                    $("#identificacion_director_comercial").val(b[0].identidad);
                    $("#nombre_director_comercial").val(b[0].nombre);
                    $("#cel_director_comercial").val(b[0].celular);
                     $("#email_director_comercial").val(b[0].email);
                  
                    //$("#cantipan").focus();
                 
                 //(data1);
                },
                'json');
              $("#div_buscar_director").css("display","none");  
          });
        ///////////////////////
      });   ////finde la funcion principal de script  
</script>