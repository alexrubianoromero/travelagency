<?php
session_start();
include('../valotablapc.php');

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
    	<td><input type="text" id = "no_reserva" value = "<?php echo $siguiente_reserva;  ?>"  onfocus="blur();" size="5px"></td>
    </tr>
    <tr>	
    	<td>Cedula Cliente</td>
    	<td>
            <input type="text"  placeholder = "Digite Identidad Y enter" 
             id="identidad" name="identidad" sise="10px" class="fila_llenar" >
             <a id="crear_cliente" href="">Nuevo_cliente</a>
            <input type="hidden" id="id_cliente">
        </td>
   </tr> 	
   <tr>
    	<td>Nombre Cliente</td>
    	<td><input type="text"  id="nombre_cliente"  onfocus="blur();"></td>
    </tr>
     <tr>
    	<td>Vendedor</td>
    	<td>
    		 <select id="id_vendedor" class="fila_llenar">
    		 	<?php select_listar_personas(2,$tabla3,$conexion); ?> 
    		 </select>
    	</td>
    </tr>
     <tr>
    	<td>Ciudad Asesor</td>
    	<td><input type="text"  id="ciudad_asesor" class="fila_llenar"></td>
    </tr>
     <tr>
    	<td>Total</td>
    	<td><input type="text"  id="total" class="fila_llenar"></td>
    </tr>
     <tr>
    	<td>Tipo de Venta</td>
    	<td><input type="text"  id="tipo_venta" class="fila_llenar"></td>
    </tr>
     <tr>
    	<td>Estado</td>
    	<td><select id="id_estado" class="fila_llenar">
    		 	<?php select_listar_estados_reserva($estados_reserva,$conexion); ?> 
    		 </select></td>
    </tr>
      <tr>
    	<td>Sucursal</td>
    	<td><input type="text"  id="Sucursal" class="fila_llenar"></td>
    </tr>
    <tr>
    	<td>Tarifa</td>
    	<td><select id="id_tarifa" class="id_tarifa" class="fila_llenar">
    		 	<?php colocar_select_general($productos,$conexion,'id_producto','nombre'); ?> 
    		 </select></td>
    </tr>
     <tr>
    	<td>Usuario Registro</td>
    	<td>
            <input type="text"  
            id = "id_usuario_registro"  
          
            value= "<?php echo $_SESSION['nombre_usuario'];   ?> " 
            onfocus="blur();"   >
        </td>
    </tr>
</table>	
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

