<?php
session_start();
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
include('../valotablapc.php');
include('../funciones_summers.php');

$traer_datos_reserva = "select * from $reservas where id_reserva =  '".$_REQUEST['id_reserva']."'  ";
$consulta_reserva = mysql_query($traer_datos_reserva,$conexion);
$arr_reserva = mysql_fetch_assoc($consulta_reserva);


$nombre_cliente =traer_nombre($tabla3,$arr_reserva['id_cliente'],$conexion);
$identidad_cliente = traer_identi($tabla3,$arr_reserva['id_cliente'],$conexion);
$nombre_vendedor =traer_nombre($tabla3,$arr_reserva['id_vendedor'],$conexion);
$nombre_estado =   traer_estado($estados_reserva,$arr_reserva['id_estado'],$conexion);
$nombre_tarifa = nombre_tarifa($productos,$arr_reserva['id_tarifa'],$conexion);
$nombre_titular =traer_nombre($tabla3,$arr_reserva['id_titular'],$conexion);
?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>
	<br>
<table border="1">
    <tr>
    	<td>Numero de Reserva</td>
    	<td><input type="text" id = "no_reserva" value = "<?php echo $arr_reserva['no_reserva'];  ?>"  onfocus="blur();" size="5px"></td>
    	<td>&nbsp;</td>
    	<td>Fecha de Creacion </td>
    	<td><input type="text"  id="fecha_creacion"  value= "<? echo  $arr_reserva['fecha_creacion'];?>" >
        </td>
    </tr>
    <tr>	
    	<td>Cedula Cliente</td>
    	<td><input type="text"  
             id="identidad" name="identidad" sise="10px" class="fila_llenar"  
             value = "<?php echo $identidad_cliente; ?>">
            
            <input type="hidden" id="id_cliente">        </td>
    	<td>&nbsp;</td>
    	<td>Pasajero Responsable</td>
    	<td><input type="text"    id="pasajero_responsable" sise="10px" class="fila_llenar"
         value= "<? echo  $arr_reserva['pasajero_responsable'];?>"
            >
        </tr> 	
   <tr>
    	<td>Nombre Cliente</td>
    	<td><input type="text"  id="nombre_cliente"   value ="<?php echo $nombre_cliente; ?>" onfocus="blur();"></td>
    	<td>&nbsp;</td>
    	<td>Moneda</td>
    	<td><input type="text"    id="moneda" sise="10px" class="fila_llenar" 
             value= "<? echo  $arr_reserva['moneda'];?>"
            >
        </tr>
     <tr>
    	<td>Vendedor</td>
    	<td><?php echo $nombre_vendedor;  ?>     </td>
    	<td>&nbsp;</td>
    	<td>Ciudad Venta</td>
    	<td><input type="text"    id="ciudad_venta" sise="10px" class="fila_llenar" 
             value= "<? echo  $arr_reserva['ciudad_venta'];?>"
            >
        </tr>
     <tr>
    	<td>Ciudad Asesor</td>
    	<td><input type="text"  id="ciudad_asesor" class="fila_llenar"   value ="<?php echo  $arr_reserva['ciudad_asesor'];  ?>"></td>
    	<td>&nbsp;</td>
    	<td>Forma de Pago </td>
    	<td><input type="text"  id="forma_pago"  class="fila_llenar"
             value= "<? echo  $arr_reserva['forma_pago'];?>"
            ></td>
    </tr>
     <tr>
    	<td>Total</td>
    	<td><input type="text"  id="total" class="fila_llenar"  value ="<?php echo  $arr_reserva['total'];  ?>"></td>
    	<td>&nbsp;</td>
    	<td>Titular </td>
    	<td><input type="text"  id="titular"  class="fila_llenar"  
            value ="<?php echo  $arr_reserva['id_titular'];  ?>"></td>
    </tr>
     <tr>
    	<td>Tipo de Venta</td>
    	<td><input type="text"  id="tipo_venta" class="fila_llenar" value ="<?php echo  $arr_reserva['tipo_venta'];  ?>"></td>
    	<td>&nbsp;</td>
    	<td>Fecha Salida </td>
    	<td><input  type="date"  class="fila_llenar"  id="fecha_salida"  
                 value ="<?php echo  $arr_reserva['fecha_salida'];  ?>"
            ></td>
   	</tr>
     <tr>
    	<td>Estado</td>
    	<td><?php echo  $nombre_estado; ?></td>
    	<td>&nbsp;</td>
    	<td>Fecha Regreso </td>
    	<td><input   type="date"  class="fila_llenar"  id="fecha_regreso"
             value ="<?php echo  $arr_reserva['fecha_regreso'];  ?>"
            ></td>
   	</tr>
      <tr>
    	<td>Sucursal</td>
    	<td><input type="text"  id="Sucursal" class="fila_llenar"  
        value ="<?php echo  $arr_reserva['sucursal'];  ?>" ></td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
   	</tr>
    <tr>
    	<td>Tarifa</td>
    	<td> <?php  echo $nombre_tarifa;  ?>  </td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
   	</tr>
     <tr>
    	<td>Usuario Registro</td>
    	<td><input type="text"  
            id = "id_usuario_registro"  
          
            value= "<?php echo $_SESSION['nombre_usuario'];   ?> " 
            onfocus="blur();"   >        </td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
   	</tr>
</table>	
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

