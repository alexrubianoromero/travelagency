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
    	<td>Fecha de Creacion </td>
    	<td><input type="text"  id="fecha_creacion"  value= <? echo date ( "Y/m/j" , $fechapan );?> > </td>
    </tr>
    <tr>	
    	<td>Pasajero Responsable</td>
    	<td><input type="text"    id="pasajero_responsable" sise="10px" class="fila_llenar">
    </tr> 	
    <tr>    
        <td>Moneda</td>
        <td><input type="text"    id="moneda" sise="10px" class="fila_llenar">
    </tr>   
      <tr>    
        <td>Ciudad Venta</td>
        <td><input type="text"    id="ciudad_venta" sise="10px" class="fila_llenar">
    </tr>   
       <tr>
    	<td>Forma de Pago </td>
    	<td><input type="text"  id="forma_pago"  class="fila_llenar"></td>
    </tr>
         <tr>
    	<td>Titular </td>
    	<td><input type="text"  id="titular"  class="fila_llenar"></td>
    </tr>
         
</table>	
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   
