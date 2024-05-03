<?php
session_start();
include('../valotablapc.php');
include('../funciones_summers.php');
include('../herramientas/verificar_saldos.php');

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=nombre_del_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");

$ancho_tabla= "100%";

$sql_reservas = "select * from $reservas 
where cast(fecha_creacion as date) between  '".$_REQUEST['fecha_in']."'   and '".$_REQUEST['fecha_fin']."'  ";
$consulta_reservas= mysql_query($sql_reservas,$conexion);

?>
<html>
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>



<?php

 echo '<table class="formato_tabla">';
 echo '<thead>'; 
	echo '<tr>';
    echo '<td>FECHA<br>RESERVA</td>';
    echo '<td>FECHA<br>VIAJE</td>';
    echo '<td>CIUDAD<br>DESTINO</td>';
    echo '<td>No_RESERVA</td>';
     echo '<td>IDEN_CLIENTE</td>';
     echo '<td>NOMBRE_CLIENTE</td>';
      echo '<td>ESTADO</td>';
  
  	echo '<td>VALOR RESERVA</td>';
      echo '<td>R.CAJA</td>';
      echo '<td>SALDO <BR>CARTERA </td>';
      echo '<td> TOTAL<BR>PROVEEDORES </td>';
      echo '<td> RECIBOS<BR>PROVEEDORES </td>';
      echo '<td> SALDO<BR>PROVEEDORES.. </td>';
  	echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      ////////////////////////

$suma_valor_reserva = 0;
$suma_recibos_reserva = 0;
$suma_saldo_reserva = 0;
$suma_proveedores = 0;
$suma_recibos_proveedores = 0;
$suma_saldo_proveedores = 0;

 while($reservas = mysql_fetch_assoc($consulta_reservas))
  {
  		
        $datos_cliente =  consulta_assoc($tabla3,'idcliente',$reservas['id_cliente'],$conexion);
         $datos_estado =  consulta_assoc($estados_reserva,'id_estado',$reservas['id_estado'],$conexion);
        $sql_abonos_cliente = "select sum(valor) as suma_recibos from $recibos   where id_reserva = '".$reservas['id_reserva']."' ";
		$consulta_recibos = mysql_query($sql_abonos_cliente,$conexion);
		$arr_suma= mysql_fetch_assoc($consulta_recibos);


		$sql_buscar_cxp_proveedores = "select sum(valor_total) as valor_total from $cxp_proveedores   where id_reserva = '".$reservas['id_reserva']."'  ";
        $consulta_cxp_proveedores = mysql_query($sql_buscar_cxp_proveedores,$conexion);
        $arr_calor_cxp = mysql_fetch_assoc($consulta_cxp_proveedores);


        $sql_pagos_proveedores = "select  sum(rp.valor) as suma_recibos from $recibos_proveedores rp
		inner join $cxp_proveedores  cxp  on (cxp.id_cxp  = rp.id_cxp)
		where cxp.id_reserva = '".$reservas['id_reserva']."'
		   ";

		$consulta_pagos_proveedores =  mysql_query($sql_pagos_proveedores,$conexion);

		$arr_recibos_proveedores = mysql_fetch_assoc($consulta_pagos_proveedores);


        $saldo_proveedores = $arr_calor_cxp['valor_total'] -  $arr_recibos_proveedores['suma_recibos'];

//////////////////////////destinos
        $datos_destino = consulta_assoc($destinos,'id_destino',$reservas['ciudad_destino'],$conexion);

  		echo '<tr>';
        echo '<td>'.substr($reservas['fecha_creacion'],0,10).'</td>';
        echo '<td>'.$reservas['fecha_salida'].'</td>';
         echo '<td>'.$datos_destino['nombre'].'</td>';
         echo '<td>'.$reservas['no_reserva'].'</td>';

         
         echo '<td>'.$datos_cliente['identi'].'</td>';
         echo '<td>'.$datos_cliente['nombre'].'</td>';
         echo '<td>'.$datos_estado['nombre'].'</td>';
         echo '<td align="right">'.$reservas['total'] .'</td>';
         echo '<td align="right">'.$arr_suma['suma_recibos'].'</td>';
         echo '<td align="right">'.$reservas['saldo_reserva'] .'</td>';
        echo '<td align="right">'.$arr_calor_cxp['valor_total'].'</td>';
        echo '<td align="right">'.$arr_recibos_proveedores['suma_recibos'].'</td>';
          echo '<td align="right">'.$saldo_proveedores .'</td>';
        echo '</tr>';
        $suma_valor_reserva = $suma_valor_reserva+ $reservas['total'] ;
		$suma_recibos_reserva = $suma_recibos_reserva + $arr_suma['suma_recibos'];
		$suma_saldo_reserva = $suma_saldo_reserva + $reservas['saldo_reserva'] ;
		$suma_proveedores = $suma_proveedores + $arr_calor_cxp['valor_total'];
		$suma_recibos_proveedores = $suma_recibos_proveedores + $arr_recibos_proveedores['suma_recibos'] ;
		$suma_saldo_proveedores = $suma_saldo_proveedores + $saldo_proveedores ;

  } //fin de while	
  echo '<tr>';
  echo '<td></td>';
   echo '<td></td>';
    echo '<td></td>';
     echo '<td></td>';
     echo '<td></td>';
     echo '<td></td>';
      echo '<td>TOTALES</td>';
       echo '<td align="right">'.$suma_valor_reserva .'</td>';
       echo '<td align="right">'.$suma_recibos_reserva .'</td>';
       echo '<td align="right">'.$suma_saldo_reserva .'</td>';
       echo '<td align="right">'.$suma_proveedores .'</td>';
       echo '<td align="right">'.$suma_recibos_proveedores .'</td>';
       echo '<td align="right">'.$suma_saldo_proveedores.'</td>';
  echo '<tr>';
  echo '</tbody>';
  echo '</table>';


?>
</body>
</html>