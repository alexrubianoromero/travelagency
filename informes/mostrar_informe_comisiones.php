<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_cxp_proveedores = "select * from $reservas  where 1=1   ";  


if($_REQUEST['id_proveedor'] && $_REQUEST['id_proveedor'] !='')
{
	$sql_cxp_proveedores .=  " and id_vendedor = '".$_REQUEST['id_proveedor']."'   ";
}



if($_REQUEST['no_radicado'] && $_REQUEST['no_radicado'] !='')
{
	$sql_cxp_proveedores .=  " and no_reserva = '".$_REQUEST['no_radicado']."'   ";
}


if($_REQUEST['fecha_in'] && $_REQUEST['fecha_in'] !='')
{
	$sql_cxp_proveedores .=  " and fecha_creacion >= '".$_REQUEST['fecha_in']."'   ";
}

if($_REQUEST['fecha_fin'] && $_REQUEST['fecha_fin'] !='')
{
	$sql_cxp_proveedores .=  " and fecha_creacion <= '".$_REQUEST['fecha_fin']."'   ";
}



$sql_cxp_proveedores .= "  order by fecha_creacion desc ";

//echo '<br>'.$sql_cxp_proveedores.'<br>';

$con_cxp_proveedores = mysql_query($sql_cxp_proveedores,$conexion);
?>

<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>

<div id="div_mostrar_informe_comsiones">  
  <input type="hidden"   id="id_proveedor"    value="<?php  echo $_REQUEST['id_proveedor'] ?>">
  <input type="hidden"   id="no_radicado"    value="<?php  echo $_REQUEST['no_radicado'] ?>">
   <input type="hidden"   id="fecha_in"    value="<?php  echo $_REQUEST['fecha_in'] ?>">
   <input type="hidden"   id="fecha_fin"    value="<?php  echo $_REQUEST['fecha_fin'] ?>">
  
 <a href="mostrar_informe_comisiones_excell.php?id_proveedor=<?php echo $_REQUEST['id_proveedor'] ?>&fecha_in=<?php echo $_REQUEST['fecha_in']; ?>&fecha_fin=<?php echo $_REQUEST['fecha_fin']; ?>&no_radicado=<?php echo $_REQUEST['no_radicado']; ?>"  > ENVIAR EXCEL</a>

<br><br>
<?php



  echo '<table class="formato_tabla">';
 echo  '<thead>'; 
	 echo '<tr>';
      echo '<td>FECHA</td>';
      echo '<td>ASESOR</td>';
      echo '<td>RESERVA</td>';
      echo '<td>% COMISION</td>';
      echo '<td>VALOR_COMISION</td>';
      echo '<td>IMPRIMIR_EGRESO</td>';     
  		echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      ////////////////////////
      

  while($reservas = mysql_fetch_assoc($con_cxp_proveedores))
  {
          
         
           $datos_asesor =  consulta_assoc($tabla3,'idcliente',$reservas['id_vendedor'],$conexion);
           $datos_recibo_egreso = consulta_assoc_comision($recibos_proveedores,'id_cxp',$reservas['id_reserva'],$conexion,'1');
           $sql_saber_si_tiene_egreso = "select * from $recibos_proveedores  where  id_cxp = '".$reservas['id_reserva']."'   and  id_tipo_egreso = '1'    ";
           $con_saber_si_hay_egreso = mysql_query($sql_saber_si_tiene_egreso,$conexion);
           $filas_egreso = mysql_num_rows($con_saber_si_hay_egreso);

          //$datos_recibo_egreso = consulta_assoc($recibos_proveedores,'id_cxp',$reservas['id_reserva'],$conexion);


  		  echo '<tr>';
        echo '<td>'.$reservas['fecha_creacion'].'</td>';
        echo '<td>'.$datos_asesor['nombre'].'</td>';
        echo '<td>'.$reservas['no_reserva'].'</td>';
        echo '<td>'.$reservas['porcen_comision'].'</td>';
        echo '<td align="right">'.number_format($reservas['vr_comision'], 0, ',', '.') .'</td>';
        echo '<td>';
        if($filas_egreso>0)
         { 
         echo '<a href="../recibos_proveedores/imprimir_egreso.php?id_recibo_proveedor='.$datos_recibo_egreso['id_recibo_proveedor'].'" target="_blank">IMPRIMIR</a>';
          }
          else
           {
             echo '<button id="btn_generar_egreso" class="btn_generar_egreso" value = "'.$reservas['id_reserva'].'">GENERAR_EGRESO</button>';
           } 
       echo '</td>';
         
  }	
echo '</tbody>';


////////////////////////////////

   function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
  /////////////////////////////
    function  consulta_assoc_comision($tabla,$campo,$parametro,$conexion,$tipo_recibo)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."'
       and id_tipo_egreso = '".$tipo_recibo."'
        ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>
</div>   <!-- fin de mostrar comisiones -->
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
  ///////////////////////////////////para eliminar items
  
          $(".btn_generar_egreso").click(function(){
              //alert('asdasdasdasdasdasd');
               
              var data =  'id_reserva=' + $(this).attr('value');
              //data += '&factupan=' + $("#orden_numero").val();
              $.post('../informes/generar_egreso.php',data,function(a){
                $("#div_mostrar_informe_comsiones").html(a);
                //alert(data);
              }); 
              /*
              var data2 =  'id_proveedor=' + $("#id_proveedor").val();
              data2 += '&no_radicado=' + $("#no_radicado").val();
              data2 += '&fecha_in=' + $("#fecha_in").val();
              data2 += '&fecha_fin=' + $("#fecha_fin").val();
              $.post('../informes/mostrar_informe_comisiones.php',data2,function(a){
              $("#div_mostrar_informe_comsiones").html(a);
                //alert(data);
              }); 
              */
             });
          

          //////////////////////////////////

 });//fin funcion principal
</script>  

