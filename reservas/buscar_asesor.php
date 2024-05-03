<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

$sql_traer_codigos = "select * from $tabla3 where nombre like '%".$_REQUEST['buscar_asesor']."%'  and rol = '2' ";
//echo '<br>'.$sql_traer_codigos;
$consulta_codigos = mysql_query($sql_traer_codigos,$conexion);

echo "<select name='codigo_a_escoger' id='codigo_a_escoger' class='fila_llenar' multiple= 'multiple' size='10'>";
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
          $("#codigo_a_escoger").change(function(){
            var codigo = $("#codigo_a_escoger").val();  
              var data1 ='idcliente=' + codigo;
                $.post('traer_datos_cliente_por_idcliente.php',data1,function(b){
                    $("#id_asesor").val(b[0].id_cliente);
                    $("#nombre_asesor").val(b[0].nombre);
                    $("#identi_asesor").val(b[0].identidad);
                    $("#cel_asesor").val(b[0].celular);
                     $("#email_asesor").val(b[0].email);
                    //$("#cantipan").focus();
                 //(data1);
                },
                'json');
              $("#div_buscar_asesor").css("display","none");  
          });
        ///////////////////////
});   ////finde la funcion principal de script  
</script>