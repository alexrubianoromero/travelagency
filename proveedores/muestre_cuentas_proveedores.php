<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '<pre>';
*/
$sql_reservas = "select * from $cxp_proveedores where 1=1 ";

//echo '<br>'.$sql_reservas;
//exit();

if(isset($_REQUEST['buscar_radicado']) && $_REQUEST['buscar_radicado'] != '')
{
   $id_reserva = traer_algo_reserva3211($reservas,'no_reserva',$_REQUEST['buscar_radicado'],'id_reserva',$conexion);
                 //traer_algo_reserva3211($tabla,$campo,$parametro,$devolver,$conexion)

   $sql_reservas .=  "  and id_reserva =  '".$id_reserva."'  ";

}

$sql_reservas .= " order  by id_cxp desc ";

$con_reservas = mysql_query($sql_reservas,$conexion);
?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>
table { 
    /*border-spacing: 10px;*/
    border-collapse: collapse;
  }
td { 
    padding: 10px;
}
</style>
</head>
<body>  

  <div id="div_cuentas_proveedores123">
CUENTAS PROVEEDORES
<table class="formato_tabla" width="80%">
  <thead>
<?php
	echo '<tr>';
  //echo '<td>id_cxp</td>';
      echo '<td>FECHA</td>';
      echo '<td>RADICADO</td>';
       echo '<td>PROVEEDOR</td>';
      echo '<td>NUEVO_CONCEPTO</td>';
       echo '<td>CONCEPTO</td>';
  		echo '<td>DOCUMENTO </td>';
  		echo '<td>VALOR</td>';
      echo '<td>ABONOS</td>';
      echo '<td>SALDO</td>';
      //echo '<td>FORMA PAGO</td>';
      echo '<td>DESTINOS</td>';
      if($_SESSION['nivel_perfil']>2)
       {
          echo '<td>MODIFICAR</td>';
          echo '<td>ELIMINAR</td>';
       }
      echo '<td>PREFORMA</td>'; 
      echo '<td>PAGOS</td>';
  		echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
  while($cxp = mysql_fetch_assoc($con_reservas))
  {
  	
      $no_radicado = traer_algo_reserva3211($reservas,'id_reserva',$cxp['id_reserva'],'no_reserva',$conexion);
      
      $suma= sumar_valores1($recibos_proveedores,'valor','id_cxp',$cxp["id_cxp"],$conexion);

      $datos_concepto = consulta_assoc_concepto($cxp_conceptos,'id_concepto',$cxp["id_concepto"],$conexion);

      $datos_proveedor = consulta_assoc_concepto($tabla3,'idcliente',$cxp["id_proveedor"],$conexion);

      echo '<tr>';
      //echo '<td>'.$cxp['id_cxp'].'</td>';
      echo '<td>'.$cxp['fecha'].'</td>';
       echo '<td align="center">'.$no_radicado.'</td>';
       echo '<td>'.$datos_proveedor['nombre'].'</td>';
       echo '<td>'.$datos_concepto['nombre_concepto'].'</td>';
      echo '<td>'.$cxp['concepto'].'</td>';
      echo '<td>'.$cxp['documento'].'</td>';
      echo '<td align="right">'.$cxp['valor_total'].'</td>';
      echo '<td align="right">'.$suma.'</td>';
       echo '<td align="right">'.$cxp['saldo'].'</td>';
       //echo '<td>'.$cxp['forma_pago'].'</td>';
        echo '<td>'.$cxp['destino'].'</td>';
         if($_SESSION['nivel_perfil']>2)
       {
           echo '<td><a href="modificar_cxp_proveedor.php?id_cxp='.$cxp['id_cxp'].'" >Modificar</a></td>';
          echo '<td><a href="eliminar_cxp_proveedor.php?id_cxp='.$cxp['id_cxp'].'" >Eliminar</a></td>';
       }
          if($cxp['id_factura_proforma']==0)
          { 
          echo '<td><button id="btn_preforma"  class="btn_preforma" value = "'.$cxp['id_cxp'].'" >PREFORMA</button></td>';
          }
          else
          {
            echo '<td><a href ="../facturas_proforma/imprimir_proforma.php?id_proforma='.$cxp['id_factura_proforma'].'" target="_blank">VER_PROFORMA</a></td>';
          }
        echo '<td><button id="pagos"  class="pagos" value = "'.$cxp['id_cxp'].'" >PAGOS</button></td>';
  	  echo '</tr>';
  }//fin de while 
  /////////////////////
    function traer_algo_reserva3211($tabla,$campo,$parametro,$devolver,$conexion){
      $sql_reserva= "select * from $tabla where $campo = '".$parametro."'  ";
      //echo '<br>'.$sql_reserva;
      $con_reserva = mysql_query($sql_reserva,$conexion);
      $arr_reserva = mysql_fetch_assoc($con_reserva);
      $resultado = $arr_reserva[$devolver];
      return  $resultado;
  }
//////////////////////////////////////////////////
  function sumar_valores1($tabla,$campo,$campo2,$condicional,$conexion)
  {
        $sql = "select sum($campo) as suma from $tabla where $campo2  = ".$condicional." ";
        //echo '<br>'.$sql;
        $con = mysql_query($sql,$conexion);
        $arreglo_suma = mysql_fetch_assoc($con);
        $suma = $arreglo_suma['suma'];
        return  $suma;
  }

  function  consulta_assoc_concepto($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
?>
</tbody>
</table>	
</div> <!-- fin de div_cuentas_proveedores123-->
</body>
</html>

<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script> 
<script  type="text/JavaScript">
$(document).ready(function(){
                      

    ///////////////////////////////
    $(".pagos").click(function(){
              //alert('dasdasdasdas');
              var data =  'id_cxp=' + $(this).attr('value');
              //data += '&id_reserva=' + $("#id_reserva").val();
              $.post('../recibos_proveedores/mostrar_recibos_proveedores.php',data,function(a){
                $("#div_pagos").html(a);
                //alert(data);
              }); 

    });
   
    ///////////////////////////////    
     $(".btn_preforma").click(function(){
              //alert('dasdasdasdas');
              var data =  'id_cxp=' + $(this).attr('value');
              //data += '&id_reserva=' + $("#id_reserva").val();
              $.post('../facturas_proforma/captura_factura_proforma.php',data,function(a){
                $("#div_cuentas_proveedores123").html(a);
                //alert(data);
              }); 

    });  



    /////////////////////////////////////////
 });//fini principal
</script>