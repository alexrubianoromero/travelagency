<?php
	/*
	echo '<pre>';
	print_r($_GET);
	echo '</pre>';
	*/
	include('../valotablapc.php');
	$consulta = "select  * from $tarifas where id_destino = ".$_REQUEST['id']." ";
			/*
			if($_REQUEST['id']==2)
			{
				$consulta = "select * from $tabla12 where id_concepto = ".$_REQUEST['id']." or full_aceite = '1' ";
			}
			*/
	//echo '<br>'.$consulta;
	$query = mysql_query($consulta);
	echo '<option value="0">Selecciona</option>';
	while ($fila = mysql_fetch_array($query)) {
		echo '<option value="'.$fila['id_tarifa'].'">'.$fila['vigencia'].'</option>';
	};
 
?>
