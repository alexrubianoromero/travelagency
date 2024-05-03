<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/

if ($_REQUEST['enviar_excel']== 'undefined'){$_POST['enviar_excel'] = 0;}

if ($_REQUEST['enviar_excel']== '1')
{

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
}

$sql_reservas = "select * from $reservas 
where cast(fecha_creacion as date) between  '".$_REQUEST['fecha_in']."'   and '".$_REQUEST['fecha_fin']."'  ";

$consulta_reservas= mysql_query($sql_reservas,$conexion);
?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>

</style>
</head>
<body>

 <div id="div_mostrar_fechas_informe">
 
 <a href="mostrar_informe_resumido_fechas_excell.php?fecha_in=<?php echo $_REQUEST['fecha_in']; ?>&fecha_fin=<?php echo $_REQUEST['fecha_fin']; ?>"  > ENVIAR EXCEL</a>
<br><br>
    <table class="formato_tabla">
 <thead> 
<?php
	echo '<tr>';
  echo '<td>FECHA</td>';
  echo '<td>FECHA_VIAJE</td>';
     echo '<td>CONTRATO</td>';
      echo '<td>RESERVA</td>';
      
       echo '<td>IDEN CLIENTE</td>';
  		echo '<td>NOMBRE CLIENTE</td>';
      echo '<td>ESTADO</td>';
  		echo '<td>VALOR RESERVA</td>';
      echo '<td>ABONOS</td>';
      echo '<td>SALDO </td>';
    
  		echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      ////////////////////////
      
$suma_valor_total=0;
$suma_abonos_totales=0;
$suma_saldos_totales=0;
  while($reservas = mysql_fetch_assoc($consulta_reservas))
  {
          
          $datos_cliente =  consulta_assoc($tabla3,'idcliente',$reservas['id_cliente'],$conexion);
           $datos_estado =  consulta_assoc($estados_reserva,'id_estado',$reservas['id_estado'],$conexion);
          $sql_traer_suma_cxp  = "select sum(valor_total) as suma_valor_total ,sum(saldo) as saldo_total from $cxp_proveedores    
          	where id_reserva = '".$reservas['id_reserva']."'  ";
          $consulta_cxp = mysql_query($sql_traer_suma_cxp,$conexion);
          $arr_cxp = mysql_fetch_assoc($consulta_cxp);
          ///////////////////////////////calcular los abonos

          $sql_abonos_cliente = "select sum(valor) as suma_recibos from $recibos   where id_reserva = '".$reservas['id_reserva']."' ";
          $consulta_recibos = mysql_query($sql_abonos_cliente,$conexion);
          $arr_suma= mysql_fetch_assoc($consulta_recibos);


  		  echo '<tr>';
        echo '<td>'.substr($reservas['fecha_creacion'],0,10).'</td>';
        echo '<td>'.$reservas['fecha_salida'].'</td>';
        echo '<td>'.$reservas['no_contrato'].'</td>';
          echo '<td>'.$reservas['no_reserva'].'</td>';

          echo '<td>'.$datos_cliente['identi'].'</td>';
          
          echo '<td>'.$datos_cliente['nombre'].'</td>';
          echo '<td>'.$datos_estado['nombre'].'</td>';
          echo '<td align="right">'.number_format($reservas['total'], 0, ',', '.') .'</td>';
          echo '<td align="right">'.number_format($arr_suma['suma_recibos'], 0, ',', '.') .'</td>';
          echo '<td align="right">'.number_format($reservas['saldo_reserva'], 0, ',', '.') .'</td>';

        $suma_valor_total= $suma_valor_total + $reservas['total'] ;
        $suma_abonos_totales= $suma_abonos_totales + $arr_suma['suma_recibos'] ;
        $suma_saldos_totales= $suma_saldos_totales + $reservas['saldo_reserva'];
  }	

      //////////////////////////

      echo '<tr>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td></td>';
      echo '<td>TOTALES</td>';
      echo '<td  align="right" >'.number_format($suma_valor_total, 0, ',', '.').'</td>';
      echo '<td  align="right" >'.number_format($suma_abonos_totales, 0, ',', '.').'</td>';
      echo '<td  align="right" >'.number_format($suma_saldos_totales, 0, ',', '.').'</td>';
      echo '</tr>';
      echo '</tbody>';

      echo '</table>';

      ///////////////////////////

        function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
      
 ?>     
 </div>	



</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">      
$(document).ready(function(){
	 /////////////////////////
					 $("#btn_nueva_reserva").click(function(){

							var data =  'rol=' + '1';
							//data += '&placa=' + $("#placa").val();
							//$.post('nueva_reserva.php',data,function(a){
						    $.post('pregunte_cliente.php',data,function(a){		
							//$(window).attr('location', '../index.php);
							$("#div_muestre_reservas").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////
					  $("#btn_buscar_fechas").click(function(){

							var data =  'fecha_in=' + $("#fecha_in").val();
							data += '&fecha_fin=' + $("#fecha_fin").val();
							//$.post('nueva_reserva.php',data,function(a){
						    $.post('mostrar_informe_resumido_fechas.php',data,function(a){		
							//$(window).attr('location', '../index.php);
							$("#div_muestre_reservas").html(a);
								//alert(data);
							});	
						 });
					 ////////////////////////

});		////finde la funcion principal de script
		
</script>
