<?php
session_start();
include('../valotablapc.php');
include('../num2letras.php'); 
//include_once('../funciones_summers.php');
$ancho_tabla = "95%";
$tamano_letra  = "10px";
$tamano_letra_recuadro = "8px";

$sql_traer_reserva = "select * from $reservas where id_reserva = '".$_REQUEST['id_reserva']."'  ";
$datos_reserva= consulta_assoc123($reservas,'id_reserva',$_REQUEST['id_reserva'],$conexion);

//echo '<br>'.$datos_reserva['id_quien_recibe'];


function  consulta_assoc123($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$datos_vendedor= consulta_assoc123($tabla3,'idcliente',$datos_reserva['id_vendedor'],$conexion);
$datos_cliente= consulta_assoc123($tabla3,'idcliente',$datos_reserva['id_cliente'],$conexion);
$datos_tipo_vuelo= consulta_assoc123($tipo_vuelo,'id_tipo_vuelo',$datos_reserva['id_tipo_vuelo'],$conexion);
$datos_tarifa= consulta_assoc123($productos,'id_producto',$datos_reserva['id_tarifa'],$conexion);
$datos_liq_reserva= consulta_assoc123($liquidacion_reserva,'id_reserva',$datos_reserva['id_reserva'],$conexion);
$datos_quien_recibe = consulta_assoc123($tabla16,'id_usuario',$datos_reserva['id_quien_recibe'],$conexion);
$datos_quien_confirma = consulta_assoc123($tabla16,'id_usuario',$datos_reserva['id_quien_confirma'],$conexion);
$datos_liqu_reserva = consulta_assoc123($liquidacion_reserva,'id_reserva',$datos_reserva['id_reserva'],$conexion);
$datos_director= consulta_assoc123($tabla3,'idcliente',$datos_reserva['id_director_comercial'],$conexion);
$datos_ciudad_destino= consulta_assoc123($destinos,'id_destino',$datos_reserva['ciudad_destino'],$conexion);

//$datos_quien_elabora = consulta_assoc123($tabla16,'id_usuario',$datos_reserva['id_usuario_registro'],$conexion);
//echo 'rrrrrrrrrrrr<br>'.$datos_liq_reserva['valor_por_pasajero_sencilla'];
?>

<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
  <style>

    .unificacion{
      text-align: right;
    }

 
  </style>
</head>
<body >
<div class="sin_fondo">
<table   width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td><div align="center"><img src="../logos/summers.png" width="100px" height="70px"></div></td>
    <td><table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>NUMERO DE CONTRATO </td>
    <td><?php  echo $datos_reserva['no_contrato'] ?></td>
  </tr>
  <tr>
    <td>NUMERO DE RECIBIDO </td>
    <td><?php  echo $datos_reserva['no_reserva'] ?></td>
  </tr>
</table>
</td>
    <td><table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra_recuadro; ?>">
  <tr>
    <td><div align="center">ANEXAR</div></td>
  </tr>
  <tr>
    <td><div align="center">CONTRATO CON HUELLA </div></td>
  </tr>
  <tr>
    <td><div align="center">COMPROBANTE DE PAGO </div></td>
  </tr>
  <tr>
    <td><div align="center">COPIAS CC PAX </div></td>
  </tr>
</table>
</td>
  </tr>
</table>
<br>
<table  width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td align="center">LIQUIDACION DE RESERVAS AR TRAVEL </td>
  </tr>
  <tr>
    <td class="fila_verde" align="center">DATOS COMPLETOS DEL ASESOR </td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>NOMBRE COMPLETO : </td>
    <td colspan="3"><?php  echo $datos_vendedor['nombre'] ?></td>
  </tr>
  <tr>
    <td># IDENTIFICACION : </td>
    <td><?php  echo $datos_vendedor['identi'] ?></td>
    <td>CEL:<?php  echo $datos_vendedor['telefono_celular'] ?></td>
    <td>EMAIL:<?php  echo $datos_vendedor['email'] ?></td>
  </tr>
  <tr>
    <td>DIRECTOR COMERCIAL: </td>
    <td><?php  echo  $datos_director['nombre']; ?></td>
    <td>CEL:<?php  echo   $datos_director['telefono_celular']; ?></td>
    <td>EMAIL:<?php  echo   $datos_director['email']; ?></td>
  </tr>
  <!--
  <tr>
    <td>DIRECTOR GENERAL:</td>
    <td><?php  echo  $datos_reserva['director_general']; ?></td>
       <td>CEL:<?php  echo  $datos_reserva['cel_director_general']; ?></td>
     <td>EMAIL:<?php  echo  $datos_reserva['email_director_general']; ?></td>
  </tr>
 --> 
  <tr>
    <td>CIUDAD Y FECHA: </td>
    <td><?php  echo  $datos_reserva['fecha_creacion']; ?></td>
    <td>OFICINA:</td>
    <td><?php  echo  $datos_reserva['oficina']; ?></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td class="fila_verde" align="center">DATOS COMPLETOS DEL CLIENTE </td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>NOMBRES Y APELLIDOS: </td>
    <td colspan="3"><?php  echo  $datos_cliente['nombre']; ?></td>
  </tr>
  <tr>
    <td>#IDENTIFICACION:</td>
    <td><?php  echo  $datos_cliente['identi']; ?></td>
    <td>CELULAR:<?php  echo  $datos_cliente['telefono_celular']; ?></td>
    <td>FIJO:<?php  echo  $datos_cliente['telefono']; ?></td>
  </tr>
  <tr>
    <td>DIRECCION:</td>
    <td colspan="3"><?php  echo  $datos_cliente['direccion']; ?></td>
  </tr>
  <tr>
    <td>EMAIL DEL CLIENTE: </td>
    <td colspan="3"><?php  echo  $datos_cliente['email']; ?></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td class="fila_verde" align="center">RESERVA AEREA </td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>CIUDAD DE ORIGEN: </td>
    <td colspan="2"><?php  echo  $datos_reserva['ciudad_origen']; ?></td>
    <td>CIUDAD DESTINO: </td>
    <td colspan="2"><?php  echo  $datos_ciudad_destino['nombre']; ?></td>
  </tr>
  <tr>
    <td>FECHA IDA: </td>
    <td colspan="2"><?php  echo  $datos_reserva['fecha_salida']; ?></td>
    <td>FECHA REGRESO: </td>
    <td colspan="2"><?php  echo  $datos_reserva['fecha_regreso']; ?></td>
  </tr>

<?php
$cantidad_adultos = $datos_liqu_reserva['cantidad_personas_sencilla'] +
$datos_liqu_reserva['cantidad_personas_doble'] +
$datos_liqu_reserva['cantidad_personas_triple'];

?>

  <tr>
    <td>CANTIDAD ADULTOS: </td>
    <td><?php  echo  $cantidad_adultos; ?></td>
    <td>CANTIDAD NINOS: </td>
    <td><?php  echo  $datos_liqu_reserva['cantidad_personas_nino']; ?></td>
    <td>INFANTES:</td>
    <td><?php  echo  $datos_liqu_reserva['cantidad_personas_infante']; ?></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td align="center">RESERVA HOTELERA </td>
	<td align="center">TOTAL PASAJEROS </td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>HOTEL SELECCIONADO: </td>
    <td colspan="5"><?php  echo  $datos_reserva['hotel_seleccionado']; ?></td>
  </tr>
  <tr>
    <td>TOTAL NOCHES Y DIAS: </td>
    <td>NOCHES:</td>
    <td><?php  echo  $datos_reserva['noches']; ?></td>
    <td colspan="2">TIPO DE VUELO </td>
    <td><?php echo $datos_tipo_vuelo['descripcion']; ?></td>
  </tr>
  <tr>
    <td>ACOMODACION:</td>
    <td>SENCILLA</td>
    <td>DOBLE</td>
    <td>TRIPLE</td>
    <td> NINO</td>
    <td>INFANTE</td>
  </tr>
  <tr>
    <td>CANTIDAD HABITACIONES: </td>
    <td align= "center"><?php  echo  $datos_liqu_reserva['cantidad_personas_sencilla']; ?></td>
      <td align= "center" ><?php  echo  $datos_liqu_reserva['cantidad_personas_doble']; ?></td>
       <td align= "center" ><?php  echo  $datos_liqu_reserva['cantidad_personas_triple']; ?></td>
       <td align= "center" ><?php  echo $datos_liqu_reserva['cantidad_personas_nino']; ?></td>
      <td align= "center" ><?php  echo $datos_liqu_reserva['cantidad_personas_infante']; ?></td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td  class="fila_verde" align="center">SERVICIOS INCLUIDOS SEGUN LA TARIFA </td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>TARIFA DE VENTA (NOMBRE): </td>
    <td colspan="3"><?php  echo  $datos_tarifa['nombre']; ?></td>
  </tr>
  <tr>
    <td>TOURS INCLUIDOS: </td>
    <td colspan="3"><?php  echo  $datos_reserva['tours_incluidos']; ?></td>
  </tr>
  <tr>
    <td>CONTACTO ASISTENCIA MEDICA: </td>
    <td colspan="3"><?php  echo  $datos_reserva['contacto_asistencia']; ?></td>
  </tr>
  <tr>
    <td>EMAIL CONTACTO: </td>
    <td><?php  echo  $datos_reserva['email_contacto_asistencia']; ?></td>
    <td>CELULAR:</td>
    <td><?php  echo  $datos_reserva['celular_contacto_asistencia']; ?></td>
  </tr>
</table>
<!-- liquidacion de reserva  -->
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
    <tr>
        <td class="fila_verde" colspan = "6" align = "center">LIQUIDACION DE RESERVA</td>
    </tr>
        <tr>
            <td>VALORES</td>
            <td>SENCILLA</td>
            <td>DOBLE</td>
            <td>TRIPLE</td>
            <td>NINO</td>
            <td>INFANTE</td>
        </tr>
        <tr>
            <td>VALOR POR PASAJERO:</td>
            <td class="unificacion"><?php echo $datos_liq_reserva['valor_por_pasajero_sencilla'];  ?></td>
             <td class="unificacion"><?php echo $datos_liq_reserva['valor_por_pasajero_doble'];  ?></td>
             <td class="unificacion"><?php echo $datos_liq_reserva['valor_por_pasajero_triple'];  ?></td>
             <td class="unificacion"><?php echo $datos_liq_reserva['valor_por_pasajero_nino'];  ?></td>
            <td class="unificacion"><?php echo $datos_liq_reserva['valor_por_pasajero_infante'];  ?></td>
        </tr> 

          <tr>
            <td>CARGOS E IMPUESTOS</td>
            <td class="unificacion"><?php echo $datos_liq_reserva['impuestos_sencilla'];  ?></td>
              <td class="unificacion"><?php echo $datos_liq_reserva['impuestos_doble'];  ?></td>
              <td class="unificacion"><?php echo $datos_liq_reserva['impuestos_triple'];  ?></td>
           <td class="unificacion"><?php echo $datos_liq_reserva['impuestos_nino'];  ?></td>        
           <td class="unificacion"><?php echo $datos_liq_reserva['impuestos_infante'];  ?></td>     

        </tr>  
         <tr>
            <td>TOURS ADICIONALES</td>
             <td class="unificacion"><?php echo $datos_liq_reserva['tours_adicionales_sencilla'];  ?></td>   
              <td class="unificacion"><?php echo $datos_liq_reserva['tours_adicionales_doble'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['tours_adicionales_triple'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['tours_adicionales_nino'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['tours_adicionales_infante'];  ?></td> 
        </tr>  
       
         <tr>
            <td>NOCHES ADICIONALES</td>
           <td class="unificacion"><?php echo $datos_liq_reserva['noches_adicionales_sencilla'];  ?></td>   
              <td class="unificacion"><?php echo $datos_liq_reserva['noches_adicionales_doble'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['noches_adicionales_triple'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['noches_adicionales_nino'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['noches_adicionales_infante'];  ?></td> 
        </tr>  
         
         <tr class="fila_verde" colspan = "6" >
            <td>TOTAL POR PERSONA</td>
            <td class="unificacion"><?php echo $datos_liq_reserva['totalxpersona_sencilla'];  ?></td>   
              <td class="unificacion"><?php echo $datos_liq_reserva['totalxpersona_doble'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['totalxpersona_triple'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['totalxpersona_nino'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['totalxpersona_infante'];  ?></td>
        </tr> 
         <tr>
            <td>CANTIDAD DE PERSONAS</td>
          
            <td class="unificacion"><?php echo $datos_liq_reserva['cantidad_personas_sencilla'];  ?></td>   
              <td class="unificacion"><?php echo $datos_liq_reserva['cantidad_personas_doble'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['cantidad_personas_triple'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['cantidad_personas_nino'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['cantidad_personas_infante'];  ?></td>

            
        </tr>  
         <tr>
            <td>TOTAL POR ACOMODACION</td>
               <td class="unificacion"><?php echo $datos_liq_reserva['totalxacomodacion_sencilla'];  ?></td>   
              <td class="unificacion"><?php echo $datos_liq_reserva['totalxacomodacion_doble'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['totalxacomodacion_triple'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['totalxacomodacion_nino'];  ?></td> 
                <td class="unificacion"><?php echo $datos_liq_reserva['totalxacomodacion_infante'];  ?></td>
        </tr> 
</table>  
<?php  
 $letras = num2letras($datos_reserva['total']);
?>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <tr>
     <td colspan = "5" align="left">VALOR EN LETRAS  <?php  echo $letras;  ?> </td>

  </tr>
     <td align="left">DETALLES PAGO:  </td>
    <td align="left">Total: <?php   echo $datos_reserva['total']; ?>  </td>
   <td align="left">Incial:  <?php   echo $datos_reserva['vr_inicial']; ?>  </td>
    <td align="left">No Cuotoas <?php   echo $datos_reserva['no_cuotas']; ?> </td>
    <td align="left">Valor Cuota <?php   echo $datos_reserva['vr_cuota_mensual']; ?> </td>
  </tr>
   </tr>
     <td align="left">EFECTIVO  <?php   echo $datos_reserva['vr_efectivo']; ?> </td>
    <td align="left">CONSIGNACION <?php   echo $datos_reserva['vr_cons_trans']; ?>  </td>
   <td align="left">TARJETA <?php   echo $datos_reserva['vr_tarjeta']; ?>  </td>
    <td align="left"> </td>
    <td align="left"> </td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td align="center">DATOS DE LOS PASAJEROS </td>
  </tr>
</table>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td># PAX </td>
    <td>APELLIDOS</td>
    <td>NOMBRES</td>
    <td># IDENTIFICACION </td>
    <td>FECHA NACIMIENTO </td>
  </tr>
<?php   
include('mostrar_pasajeros_impresion.php');
mostrar_pasajeros_impresion($datos_reserva['id_reserva']);
completar_espacios($item_pasajeros_reserva,$datos_reserva['id_reserva'],$conexion);
?>
</table>
<br>
<table width="<?php echo $ancho_tabla;  ?>" border="1" style="font-size:<?php echo $tamano_letra; ?>">
  <tr>
    <td>OBSERVACIONES<br><br></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td>QUIEN RECIBE:<br><br><?php  echo $datos_quien_recibe['nombre'] ?> </td>
    <td>QUIEN CONFIRMA DISPONIBILIDAD <br><br><?php  echo $datos_quien_confirma['nombre'] ?> </td>
    <td>ELABORADO POR: <br><br><?php  echo $datos_reserva['id_usuario_registro'] ?></td>
    <td></td>
  </tr>
</table>
</div>
</body>
</html>
<?php
function completar_espacios($tabla,$id_reserva,$conexion){
$sql_pasajeros = "select * from $tabla   where   id_reserva =  '".$id_reserva."'   ";
$con_pasajeros = mysql_query($sql_pasajeros,$conexion);
$no_pasajeros = mysql_num_rows($con_pasajeros);
$filas_completar = 10 - $no_pasajeros;
$i=1;
for($i=1;$i<= $filas_completar;$i++ ){
echo '<tr>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '<td></td>';
echo '</tr>';
}//

}//fin funcion completar espacios

?>
