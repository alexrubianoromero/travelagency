<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_productos = "select rp.*  ";

if($_REQUEST['buscar_id_tipo']!='')
{  
    if( $_REQUEST['buscar_id_tipo'] == '2')
    {
     $sql_productos .= ",cxp.id_concepto,r.no_reserva "; 
     $sql_productos .= "from $recibos_proveedores rp  ";
     $sql_productos .= "inner join $cxp_proveedores cxp  on (cxp.id_cxp = rp.id_cxp) 
    inner join $reservas r on (r.id_reserva =  cxp.id_reserva)
    where 1=1"; 

     $sql_productos .= " and rp.id_tipo_egreso  = '".$_REQUEST['buscar_id_tipo']."'  ";
     if(isset($_REQUEST['buscar_id_concepto']) && $_REQUEST['buscar_id_concepto'] != '')
      {
      $sql_productos .= " and cxp.id_concepto  = '".$_REQUEST['buscar_id_concepto']."'  ";
      }
      if(isset($_REQUEST['buscar_no_radicado']) && $_REQUEST['buscar_no_radicado'] != '')
      {
       $sql_productos .= " and r.no_reserva  = '".$_REQUEST['buscar_no_radicado']."'  ";
      }
    if(isset($_REQUEST['buscar_fecha_in']) && $_REQUEST['buscar_fecha_in'] != '')
      {
      $sql_productos .= " and rp.fecha  >= '".$_REQUEST['buscar_fecha_in']."'  ";
      }

      if(isset($_REQUEST['buscar_fecha_fin']) && $_REQUEST['buscar_fecha_fin'] != '')
      {
      $sql_productos .= " and rp.fecha  < '".$_REQUEST['buscar_fecha_fin']."'  ";
      }
      if(isset($_REQUEST['buscar_id_concepto']) && $_REQUEST['buscar_id_concepto'] != '')
      {
      $sql_productos .= " and cxp.id_concepto  = '".$_REQUEST['buscar_id_concepto']."'  ";
      }

    }//////////////////////////////////fin de si es tipo2
    if( $_REQUEST['buscar_id_tipo'] == '1')
    {

    $sql_productos .= "from $recibos_proveedores rp  ";
    $sql_productos .= "inner join $reservas re on (re.id_reserva = rp.id_cxp)  ";
    $sql_productos .= " where 1=1  ";

    $sql_productos .= " and rp.id_tipo_egreso  = '".$_REQUEST['buscar_id_tipo']."'  ";




      if(isset($_REQUEST['buscar_no_radicado']) && $_REQUEST['buscar_no_radicado'] != '')
      {
       $sql_productos .= " and re.no_reserva = '".$_REQUEST['buscar_no_radicado']."'  ";
      }
        if(isset($_REQUEST['buscar_fecha_in']) && $_REQUEST['buscar_fecha_in'] != '')
      {
      $sql_productos .= " and rp.fecha  >= '".$_REQUEST['buscar_fecha_in']."'  ";
      }

      if(isset($_REQUEST['buscar_fecha_fin']) && $_REQUEST['buscar_fecha_fin'] != '')
      {
      $sql_productos .= " and rp.fecha  < '".$_REQUEST['buscar_fecha_fin']."'  ";
      }

    }//fin de si es tipo1
}//de si no esta en blanco 
else //esta opscion es si esta en blaco el tipo de recibo ose debe sacarlos todos
{
  $sql_productos .= "from $recibos_proveedores rp 
  where 1=1 ";

if(isset($_REQUEST['buscar_fecha_in']) && $_REQUEST['buscar_fecha_in'] != '')
{
$sql_productos .= " and rp.fecha  >= '".$_REQUEST['buscar_fecha_in']."'  ";
}
if(isset($_REQUEST['buscar_fecha_fin']) && $_REQUEST['buscar_fecha_fin'] != '')
{
$sql_productos .= " and rp.fecha  < '".$_REQUEST['buscar_fecha_fin']."'  ";
}

if(isset($_REQUEST['buscar_no_radicado']) && $_REQUEST['buscar_no_radicado'] != '')
{
 $sql_productos .= " and r.no_reserva  = '".$_REQUEST['buscar_no_radicado']."'  ";
}



}//fin de else de si pa opcin esta en blanco






//echo '<br>'.$sql_productos;
/*
echo '<br>'.$sql_productos;
if(isset($_REQUEST['buscar_id_tipo']) && $_REQUEST['buscar_id_tipo'] != '')
{
$sql_productos .= " and rp.id_tipo_egreso  = '".$_REQUEST['buscar_id_tipo']."'  ";
}

if(isset($_REQUEST['buscar_id_concepto']) && $_REQUEST['buscar_id_concepto'] != '')
{
$sql_productos .= " and cxp.id_concepto  = '".$_REQUEST['buscar_id_concepto']."'  ";
}

if(isset($_REQUEST['buscar_fecha_in']) && $_REQUEST['buscar_fecha_in'] != '')
{
$sql_productos .= " and rp.fecha  >= '".$_REQUEST['buscar_fecha_in']."'  ";
}


if(isset($_REQUEST['buscar_fecha_fin']) && $_REQUEST['buscar_fecha_fin'] != '')
{
$sql_productos .= " and rp.fecha  < '".$_REQUEST['buscar_fecha_fin']."'  ";
}

if(isset($_REQUEST['buscar_no_radicado']) && $_REQUEST['buscar_no_radicado'] != '')
{
 $sql_productos .= " and r.no_reserva  = '".$_REQUEST['buscar_no_radicado']."'  ";
}

*/


$sql_productos .=  "order by rp.id_recibo_proveedor desc ";


//echo '<br>'.$sql_productos;

$con_productos = mysql_query($sql_productos,$conexion);



  function  consulta_asso_varios($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
  
<table class="formato_tabla">
  <thead>
<?php
	echo '<tr>';
        echo '<td>NO_EGRESO</td>';
        echo '<td>TIPO_EGRESO</td>';
  		  echo '<td>FECHA_RECI</td>';
        echo '<td>RESERVA</td>';
        echo '<td>PROVEEDOR/ASESOR</td>';
        echo '<td>VALOR</td>';
        echo '<td>FORMA_PAGO</td>';
        echo '<td>OBSERVACIONES</td>';
        echo '<td> MODIFICAR</td>';
        echo '<td> ELIMINAR</td>';
        echo '<td> IMPRIMIR</td>';
  		echo '</tr>';
   echo '</head>'; 

    echo ' <tbody>';   
  while($productos = mysql_fetch_assoc($con_productos))
  {
  		
     
     if($productos['id_tipo_egreso']==1)
     {
      //el numero de reserva es el numero del campo cxp
      $datos_reserva = $datos_reserva = consulta_asso_varios($reservas,'id_reserva',$productos['id_cxp'],$conexion);
       $no_reserva = $datos_reserva['no_reserva'];
      $datos_asesor = consulta_asso_varios($tabla3,'idcliente',$datos_reserva['id_vendedor'],$conexion); 
       $proveedor_asesor = $datos_asesor['nombre'];

     }  
     else{
      $datos_cxp = consulta_asso_varios($cxp_proveedores,'id_cxp',$productos['id_cxp'],$conexion);
      $datos_proveedor = consulta_asso_varios($tabla3,'idcliente',$datos_cxp['id_proveedor'],$conexion);
      $datos_reserva = consulta_asso_varios($reservas,'id_reserva',$datos_cxp['id_reserva'],$conexion);
      $no_reserva  = $datos_reserva['no_reserva'];
      $proveedor_asesor = $datos_proveedor['nombre'];
     } 



      $datos_forma_pago = consulta_asso_varios($formas_pago_egresos,'id_forma_pago_egreso',$productos['id_forma_pago'],$conexion);
      $tipo_recibo = consulta_asso_varios($tipos_recibos_proveedores,'id_tipo_recibo',$productos['id_tipo_egreso'],$conexion);
      
      //radicado igual numero de reserva
      //////////////aqui comienza la impresion de la fila 
      

      echo '<tr>';
      echo '<td>'.$productos['no_egreso'].'</td>';
      echo '<td>'.$tipo_recibo['descripcion'].'</td>';
  		echo '<td>'.$productos['fecha'].'</td>';
      echo '<td>'.$no_reserva.'</td>';
       echo '<td>'.$proveedor_asesor.'</td>'; 
      echo '<td align="right">'.$productos['valor'].'</td>';
        echo '<td align="right">'.$datos_forma_pago['descripcion'].'</td>';
        echo '<td>'.$productos['observaciones'].'</td>';
      echo '<td>';
      ///esto es de acuerdo a nivel osea seria solo para nivel 3
        if($productos['id_tipo_egreso']==1) 
        {
             echo '<a  href="modificar_egreso_comision.php?id_hotel='.$productos['id_recibo_proveedor'].' ">Modificar</a>';
        }
        else //osea si es tipo 2
        {
             echo '<a  href="modificar.php?id_hotel='.$productos['id_recibo_proveedor'].' ">Modificar</a>';
        }
   ///   fin de si fuera para nivel 3
      echo '</td>';
      
       echo '<td>';
       ///esto es de acuerdo a nivel osea seria solo para nivel 3
       echo '<a  href="eliminar.php?id_hotel='.$productos['id_recibo_proveedor'].' ">Eliminar</a>';

       //fin de nivel 3
      echo '</td>';
       echo '<td>';
       echo '<a href="../recibos_proveedores/imprimir_egreso.php?id_recibo_proveedor='.$productos['id_recibo_proveedor'].'" target="_blank">Imprimir</a>';
       echo '</td>';
  		echo '</tr>';

      //fin de la impresion de la fila 
  }//fin de while 
?>
</tbody>
</table>	

</body>
</html>