<?php
session_start();
include('../valotablapc.php');

$sql_clientes = "select nombre,telefono,email,direccion,observaci,idcliente,identi,rol,telefono_celular 
from $tabla3 as cli  where  1=1
and anulado = '0'
  ";
if(isset($_REQUEST['cedula1']) && $_REQUEST['cedula1'] != '')
{
     $sql_clientes  .= " and identi like '%".$_REQUEST['cedula1']."%'   ";
}//fin de if
if(isset($_REQUEST['nombre1']) && $_REQUEST['nombre1'] != '')
{
     $sql_clientes  .= " and nombre like '%".$_REQUEST['nombre1']."%'   ";
}//fin de if




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
echo '<tr><td>ROL</td><td>NOMBRE</td><td>IDENTIFICACION</td><td>TEL FIJO </td><td>CELULAR</td>
<td>EMAIL</td><td>DIRECCION</td>';
echo '<td>MODIFICAR</td>';
echo '<td>ANULAR</td>';
echo '</thead>';
echo '<tbody>';
//echo '<td>PLACA</td><td>MARCA</td><td>MODELO</td><td>HISTORIAL</td></tr>';
$consulta_clientes = mysql_query($sql_clientes,$conexion);
while($clientes = mysql_fetch_assoc($consulta_clientes))
	{
			echo '<tr>';	
			//echo '<td>'.$clientes[0].'</td>';
			$nombre_rol = consulta_assoc_rol($roles,'id_rol',$clientes['rol'],$conexion);
			echo '<td>'.$nombre_rol['nombre_rol'].'</td>';

			echo '<td>'.$clientes['nombre'].'</td>';
			//echo '<a href="orden_detallado.php?idorden='.$ordenes['0'].'">Ver Detalle</a>';
			echo '<td>'.$clientes['identi'].'</td>';
			echo '<td>'.$clientes['telefono'].'</td>';
			echo '<td>'.$clientes['telefono_celular'].'</td>';
			echo '<td>'.$clientes['email'].'</td>';
			echo '<td>'.$clientes['direccion'].'</td>';
			echo '<td>
			<a href ="../clientes/muestre_datos_cliente.php?idcliente='.$clientes['idcliente'].'" >MODIFICAR</a>
			</td>';
			echo '<td><a href ="../clientes/anular_datos_cliente.php?idcliente='.$clientes['idcliente'].'" >ANULAR</a></td>';
			//echo '<td>'..'</td>';
			echo '</tr>';
	}
echo '</tbody>';
echo '</table>';

echo '</div>';
echo '<div id = "muestre">';
echo '</div>';


  function  consulta_assoc_rol($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

?>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   