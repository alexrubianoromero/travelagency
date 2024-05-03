<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$sql_clientes = "select nombre,telefono,email,direccion,observaci,idcliente,identi,rol,telefono_celular 
from $tabla3 as cli  where  1=1

  ";
if(isset($_REQUEST['rol']))
{
     $sql_clientes  .= " and rol = '".$_REQUEST['rol']."'";
}//fin de if


if(isset($_REQUEST['anulado']) && $_REQUEST['anulado']==1)
{
$sql_clientes  .= " and anulado = '1' ";
}
else
{
	$sql_clientes  .= " and anulado = '0' ";
}



$sql_clientes  .= " order by nombre  ";

//echo '<br>'.$sql_clientes;
?>
<html>
<head>
	<title></title>
	    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>

</head>
</head>
<body>
<?php
echo '<table class="formato_tabla" width = "90%" >';
echo '<thead>';
echo '<tr><td>NOMBRE</td><td>IDENTIFICACION</td><td>TEL FIJO </td><td>CELULAR</td>
<td>EMAIL</td><td>DIRECCION</td>';
echo '<td>MODIFICAR</td>';
echo '<td>ACCION</td>';
echo '</thead>';
echo '<tbody>';
//echo '<td>PLACA</td><td>MARCA</td><td>MODELO</td><td>HISTORIAL</td></tr>';
$consulta_clientes = mysql_query($sql_clientes,$conexion);
while($clientes = mysql_fetch_assoc($consulta_clientes))
	{
			echo '<tr>';	
			//echo '<td>'.$clientes[0].'</td>';
			echo '<td>'.$clientes['nombre'].'</td>';
			//echo '<a href="orden_detallado.php?idorden='.$ordenes['0'].'">Ver Detalle</a>';
			echo '<td>'.$clientes['identi'].'</td>';
			echo '<td>'.$clientes['telefono'].'</td>';
			echo '<td>'.$clientes['telefono_celular'].'</td>';
			echo '<td>'.$clientes['email'].'</td>';
			echo '<td>'.$clientes['direccion'].'</td>';

			echo '<td>
			<a href ="muestre_datos_cliente.php?idcliente='.$clientes['idcliente'].'" >MODIFICAR</a>
			</td>';
            if(isset($_REQUEST['anulado']) && $_REQUEST['anulado']==1){
            echo '<td><a href ="habilitar_datos_cliente.php?idcliente='.$clientes['idcliente'].'" >HABILITAR</a></td>';
            } 
            else{
			echo '<td><a href ="esta_seguro_anular_datos_cliente.php?idcliente='.$clientes['idcliente'].'" >ANULAR</a></td>';
		    }
			//echo '<td>'..'</td>';
	
			
			echo '</tr>';
	}
echo '</tbody>';
echo '</table>';

echo '</div>';
echo '<div id = "muestre">';
echo '</div>';

?>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   