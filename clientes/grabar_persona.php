<?php
session_start();
include('../valotablapc.php');
/*
echo '<pre>';
print_r($_REQUEST);
echo '<pre>';
*/
// validar que la cedula no quede grabada dos veces
$sql_buscar_cedula = "select * from $tabla3    where identi = '".$_REQUEST['cedula']."'  ";
$con_cedula =     mysql_query($sql_buscar_cedula,$conexion);
$filas_cedula = mysql_num_rows($con_cedula);
if($filas_cedula < 1)
{	
$sql_grabar_persona  = "insert into $tabla3 (identi,nombre,telefono,direccion,id_empresa,email,
	observaci,rol,telefono_celular,anulado)  
 values(
 	'".$_POST['cedula']."'
 	,'".$_POST['nombre']."'
 	,'".$_POST['telefono']."'
 	,'".$_POST['direccion']."'

 	,'".$_SESSION['id_empresa']."'
 	,'".$_POST['email']."'
 	,'".$_POST['observaciones']."',
 	'".$_REQUEST['rol']."',
 	'".$_REQUEST['telefono_celular']."',
 	'0'
 	)"; 
$consulta_grabar= mysql_query($sql_grabar_persona,$conexion);
} //fin de si no existe la cedula
//echo '<br>'.$sql_grabar_persona.'<br>';

//echo '<H3>GRABACION EXITOSA</H3>';

//include('../colocar_links2.php');



?>