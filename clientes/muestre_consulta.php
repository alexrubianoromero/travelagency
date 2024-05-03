<?php

include('../valotablapc.php');
$sql_clientes = "select *
from $tabla3 where 1=1 ";

if($_REQUEST['buscar_nombre'] != '' )
{
	$sql_clientes .= " and  nombre like '%".$_REQUEST['buscar_nombre']."%'   ";
}
if($_REQUEST['buscar_identificacion'] != '' )
{
	$sql_clientes .= " and  identi  = '".$_REQUEST['buscar_identificacion']."'   ";
}
if($_REQUEST['buscar_telefono'] != '' )
{
	$sql_clientes .= " and  telefono like '%".$_REQUEST['buscar_telefono']."%'   ";
}





$sql_clientes .= " order by idcliente desc  ";

//echo '<br>'.$sql_clientes;

echo '<table border = "1" width = "95%" class="table table-striped">';
echo '<tr><td>NOMBRE</td><td>IDENTIFICACION</td><td>TELEFONO</td><td>EMAIL</td><td> INVERSION</td>';
echo  '<td> BOLETAS Nos</td>';
echo '<td> OBSERVACIONES</td>';
echo '<td> MODIFICAR</td></tr>';
$consulta_clientes = mysql_query($sql_clientes,$conexion);

while($clientes = mysql_fetch_assoc($consulta_clientes))
	{
			$boletas_asignadas = '';
			$sql_buscar_boletas = "select * from $boletas  where id_cliente = '".$clientes['idcliente']."'  "; 
			$consulta_boletas = mysql_query($sql_buscar_boletas,$conexion);
			$filas_boletas =mysql_num_rows($consulta_boletas);
			if($filas_boletas == 0){
				$boletas_asignadas = '0';

			}
			else 
			{
				$ciclo='0';
				while($resultado = mysql_fetch_assoc($consulta_boletas))
				//while($clientes = mysql_fetch_assoc($consulta_clientes))
				{
                  if($ciclo==0){
                  	$boletas_asignadas .= $resultado['no_boleta'];
                  }
                  else
                  {	
                  $boletas_asignadas .= '/'.$resultado['no_boleta'];
                  }
                  

                  //echo '----'.$boletas_asignadas;
                  $ciclo++;
				}//fin de while 

			}//fin de else 


			echo '<tr>';	
			//echo '<td>'.$clientes[0].'</td>';
			echo '<td>'.$clientes['nombre'].'</td>';
			//echo '<a href="orden_detallado.php?idorden='.$ordenes['0'].'">Ver Detalle</a>';
			echo '<td>'.$clientes['identi'].'</td>';
			echo '<td>'.$clientes['telefono'].'</td>';
			echo '<td>'.$clientes['email'].'</td>';
			echo '<td>'.$clientes['direccion'].'</td>';
			echo '<td>'.$boletas_asignadas.'</td>';
			echo '<td>'.$clientes['observaci'].'</td>';
			echo '<td><a  role="button"    class="btn btn-success btn-lg"  href ="muestre_datos_cliente.php?idcliente='.$clientes['idcliente'].'" >Modificar</a></td>';
			//echo '<td>'.$clientes[4].'</td>';
		
			echo '</tr>';
	}
echo '</table>';


?>