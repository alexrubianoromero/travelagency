<?php
session_start();
include('../valotablapc.php');
$ancho_tabla = "100%";
$tamano_letra= "15px";

$fecha_hora_actual = date('Y-m-d H:i:s'); 


$sql_traer_reserva = "select * from $reservas where id_reserva = '".$_REQUEST['id_reserva']."'  ";
$datos_reserva= consulta_assoc123($reservas,'id_reserva',$_REQUEST['id_reserva'],$conexion);
//echo '<br>'.$datos_reserva['no_reserva'];
function  consulta_assoc123($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }

$datos_vendedor= consulta_assoc123($tabla3,'idcliente',$datos_reserva['id_vendedor'],$conexion);
$datos_director= consulta_assoc123($tabla3,'idcliente',$datos_reserva['id_director_comercial'],$conexion);
$datos_cliente= consulta_assoc123($tabla3,'idcliente',$datos_reserva['id_cliente'],$conexion);
$datos_tipo_vuelo= consulta_assoc123($tipo_vuelo,'id_tipo_vuelo',$datos_reserva['id_tipo_vuelo'],$conexion);
$datos_tarifa= consulta_assoc123($productos,'id_producto',$datos_reserva['id_tarifa'],$conexion);
$datos_liq_reserva= consulta_assoc123($liquidacion_reserva,'id_reserva',$datos_reserva['id_reserva'],$conexion);



?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>

</head>
<style>
   .fila_verde
   {
   		background-color: green; 
   	 color:white;} 
   .fila_verde input{color : black;} 
.formato_tabla  td{
  padding: 10px;
}
.formato_tabla  ,th,td {
   border-collapse: collapse;
   border: 1px solid black;
}
.formato_tabla thead{
  background-color: orange;
  text-align: center;
}

</style>

<body>
  <?php
//echo 'FECHA:'.date('Y-m-d H:i:s');

?>

<input type="hidden"  id="id_reserva"  value= "<? echo $_REQUEST['id_reserva']  ?>" >
  <br>
<table class ="formato_tabla" border="1" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
<tr>

</td>NUMERO DE CONTRATO</td>
</td><input type="text" id="no_contrato" class ="fila_llenar" value = "<?php  echo $datos_reserva['no_contrato'] ?>"></td>
</td></td>
</td></td>
</tr>
<br><br>
</table>
</td>DESTINO NACIONAL/DESTINO INTERNACIONAL</td>
</td><select id="id_tipo_destino"  class="fila_llenar"  >
            

            <?php
                //colocar_select_general($tipo_destino,$conexion,'id_tipo_destino','nombre',$datos_reserva['no_contrato']);
                colocar_select_general_condicion_mejorada321($tipo_destino,$conexion,'id_tipo_destino','nombre',$datos_reserva['id_tipo_destino']);
            ?>
         
         </select></td>
</td></td>
</td></td>
</tr>
</table>

<br><br>
<table class ="formato_tabla" border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
<tr>

</td>BUSCAR NOMBRE ASESOR</td>
</td><input type="text" id="buscar_asesor" class ="fila_llenar"></td>
</td>&nbsp;&nbsp;<button id="btn_crear_asesor">CREAR ASESOR</button>  &nbsp;&nbsp;&nbsp;  <button id="btn_cerrar_crear_asesor">CERRAR CREAR ASESOR</button>    </td>
</td></td>
</tr>
</table>
<div  id="div_buscar_asesor">
</div>    
<div id="div_crear_asesor">
</div>
<table  class ="formato_tabla"  border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
    <tr>
    <td class="fila_verde" colspan = "4" align = "center">DATOS COMPLETOS DEL ASESOR</td>
</tr>
<tr>
    <td>Nombre Completo:</td>
    <td><input type="hidden"   id="id_asesor"  size= "90%">

        <input type="text"   id="nombre_asesor" onFocus="blur();" value = "<?php echo $datos_vendedor['nombre'];  ?>">
    </td>
    <td></td>
    <td></td>
</tr>    
<tr>
    <td>Identificacion:</td>
    <td><input type="text"   id="identi_asesor"  onfocus="blur();"  value = "<?php echo $datos_vendedor['identi'];  ?>" ></td>
    <td>Cel: <input type="text"   id="cel_asesor"value = "<?php echo $datos_vendedor['telefono_celular'];  ?>"></td>
    <td>Email:<input type="text"   id="email_asesor"  value = "<?php echo $datos_vendedor['email'];  ?>"></td>
</tr>  
</table>

<table class ="formato_tabla" border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
<tr>

</td>BUSCAR NOMBRE DIRECTOR</td>
</td><input type="text" id="buscar_director" class ="fila_llenar"></td>
</td> &nbsp;&nbsp;   <button id="btn_crear_director">CREAR DIRECTOR</button> &nbsp;&nbsp; <button id="btn_cerrar_crear_director">CERRAR CREAR DIRECTOR</button> </td>
</td></td>
</tr>
</table>

<div  id="div_buscar_director">
</div>    
<div id="div_crear_director">
</div>

<table  class ="formato_tabla"  border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
   <tr>
    <td class="fila_verde" colspan = "4" align = "center">DATOS COMPLETOS DEL DIRECTOR</td>
</tr>
<tr>
    <td>Director Comercial:</td>
    <td><input type="text"   id="nombre_director_comercial" onFocus="blur();"  value = "<?php echo $datos_director['nombre'];  ?>" ></td>
    <input type="hidden"   id="identificacion_director_comercial"  value = "<?php echo $datos_director['identi'];  ?>" >
    <td>Cel: <input type="text"   id="cel_director_comercial" onFocus="blur();"value = "<?php echo $datos_director['telefono_celular'];  ?>" ></td>
    <td>Email:<input type="text"   id="email_director_comercial" onFocus="blur();"  value = "<?php echo $datos_director['email'];  ?>" ></td>
</tr>  
<!--
<tr>
    <td>Director General:</td>
   <td><input type="text"   id="director_general" class ="fila_llenar" ></td>
    <td>Cel: <input type="text"   id="cel_director_general" class ="fila_llenar" ></td>
    <td>Email:<input type="text"   id="email_director_general"  class ="fila_llenar"></td>
</tr>  
-->
<tr>
    <td>Ciudad y Fecha</td>
    <td><input type="text" id = "fechita"        value = "<?php echo date('Y-m-d H:i:s');   ?>"> </td>
    <td>Oficina</td>
    <td><input type="text" id="oficina" class ="fila_llenar" value = "<?php echo $datos_reserva['oficina'];  ?>"></td>
</tr>  
</table>

<table  class ="formato_tabla"  border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">

<tr>
</td>BUSCAR NOMBRE CLIENTE</td>
</td><input type="text" id="buscar_cliente" class ="fila_llenar"></td>
</td><button id="btn_crear_cliente">CREAR CLIENTE</button>
&nbsp;&nbsp; <button id="btn_cerrar_crear_cliente">CERRAR CREAR CLIENTE</button>
</td>
</td></td>
</tr>
</table>
<div  id="div_buscar_cliente">
</div>    
<div id="div_crear_cliente">
</div>
<table class ="formato_tabla"  border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
<tr>
    <td class="fila_verde" colspan = "4" align = "center">DATOS COMPLETOS DEL CLIENTE</td>
</tr>  
<tr>
    <td>Nombres y Apellidos</td>
    <td colspan = "3"><input type="text"  id="nombre_cliente" size= "70%"   onfocus="blur();" value = "<?php echo $datos_cliente['nombre'];  ?>"></td>
 
</tr>  
<tr>
    <td>Identificacion</td>
    <td><input type="text"  id="identidad_cliente" onFocus="blur();" value = "<?php echo $datos_cliente['identi'];  ?>"></td>
    <td>Celular:<input type="text"  id="celular_cliente" onFocus="blur();" value = "<?php echo $datos_cliente['telefono_celular'];  ?>"></td>
    <td>Fijo:<input type="text"  id="fijo_cliente" onFocus="blur();" value = "<?php echo $datos_cliente['telefono'];  ?>"></td>
</tr>  
<tr>
    <td>Direccion</td>
    <td colspan="3"><input type="text"  id="direccion_cliente" onFocus="blur();" size= "70%" value = "<?php echo $datos_cliente['direccion'];  ?>" ></td>
  
</tr>  
<tr>
    <td>EMAIL DEL CLIENTE:</td>
  <td colspan="3"><input type="text"  id="email_cliente" onFocus="blur();" size= "70%" value = "<?php echo $datos_cliente['email'];  ?>"></td>
</tr>  
<tr>
    <td class="fila_verde" colspan = "4" align = "center">RESERVA AEREA</td>
</tr> 
<tr>
     <td>CIUDAD DE ORIGEN:</td>
     <td><input type="text"  id="ciudad_origen" class="fila_llenar" value = "<?php echo $datos_reserva['ciudad_origen'];  ?>"></td>
     <td>CIUDAD DE DESTINO:</td>
     <td><input type="text"  id="ciudad_destino" class="fila_llenar"  value = "<?php echo $datos_reserva['ciudad_destino'];  ?>"></td>
</tr>    
<tr>
     <td>FECHA IDA</td>
     <td><input  type="date"  class="fila_llenar"  id="fecha_salida" value = "<?php echo $datos_reserva['fecha_salida'];  ?>"></td>
     <td>FECHA REGRESO</td>
     <td><input   type="date"  class="fila_llenar"  id="fecha_regreso" value = "<?php echo $datos_reserva['fecha_regreso'];  ?>"></td>
</tr>

<tr>
     <td>CANT ADULTOS <input type="text"  id="cant_adultos" size="2px" class="fila_llenar" value = "<?php echo $datos_reserva['cant_adultos'];  ?>"></td>
      <td>CANT NINOS<input type="text"  id="cant_ninos" size="2px" class="fila_llenar" value = "<?php echo $datos_reserva['cant_ninos'];  ?>"></td>
     <td>INFANTES<input type="text"  id="cant_infantes" size="2px" class="fila_llenar" value = "<?php echo $datos_reserva['cant_infantes'];  ?>"></td>
     <td></td>

</tr>  
</table>

<table class ="formato_tabla"  border="1" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">

<tr>
    <td class="fila_verde" colspan = "3" align = "center">RESERVA HOTELERA</td>
     <td class="fila_verde" colspan = "3" align = "center">TOTAL PASAJEROS</td>
</tr> 
<tr>
     <td >HOTEL SELECCIONADO </td>
      <td colspan = "5"><input type="text"  id="hotel_seleccionado" size="65%" class="fila_llenar" value = "<?php echo $datos_reserva['hotel_seleccionado'];  ?>"></td>

</tr> 

<tr>
     <td>TOTAL NOCHES Y DIAS</td>
     <td>NOCHES<input type="text"  id="noches" size="3px" class="fila_llenar" value = "<?php echo $datos_reserva['noches'];  ?>"></td>
     <td>DIAS<input type="text"  id="dias" size="3px" class="fila_llenar" value = "<?php echo $datos_reserva['dias'];  ?>" ></td>

     <td>TIPO DE VUELO</td>
     <td colspan="2"><select id = "id_tipo_vuelo" class="fila_llenar" >
        <?php
         //colocar_select_general($tipo_vuelo,$conexion,'id_tipo_vuelo','descripcion');
         colocar_select_general_condicion_mejorada321($tipo_vuelo,$conexion,'id_tipo_vuelo','descripcion',$datos_reserva['id_tipo_vuelo']);
          

        ?>

     </select></td>

    
     
</tr>
<tr>
    <td>ACOMODACION:</td>
    <td>SENCILLA</td>
     <td>DOBLE</td>
      <td>TRIPLE</td>
       <td>NINO</td>
         <td>INFANTE</td>

</tr>
<tr>  <td>CANTIDAD HABITACIONES</td>
    <td><input size="2px" id="no_hab_sencillas" class="fila_llenar" sise="5px" value = "<?php echo $datos_reserva['no_hab_sencillas'];  ?>" ></td>
   <td><input size="2px" id="no_hab_dobles" class="fila_llenar" sise="5px" value = "<?php echo $datos_reserva['no_hab_dobles'];  ?>" ></td>
   <td><input size="2px" id="no_hab_triples" class="fila_llenar" sise="5px" value = "<?php echo $datos_reserva['no_hab_triples'];  ?>" ></td>
  <td><input size="2px" id="no_hab_ninos" class="fila_llenar" sise="5px" value = "<?php echo $datos_reserva['no_hab_ninos'];  ?>" ></td>
   <td><input size="2px" id="no_hab_infantes" class="fila_llenar" sise="5px" value = "<?php echo $datos_reserva['no_hab_infantes'];  ?>" ></td>

  </tr>
  </table>
  
  <table class ="formato_tabla"  border="0" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">

    <tr>
     <td class="fila_verde" colspan = "4" align = "center">SERVICIOS INCLUIDOS SEGUN LA TARIFA</td>
    </tr>
    <tr>
        <td>TARIFA DE VENTA </td>
         <td colspan= "4"><select id="id_tarifa" name="id_tarifa" class="fila_llenar">
            <?php 
            //colocar_select_general($productos,$conexion,'id_producto','nombre'); 
             colocar_select_general_condicion_mejorada321($productos,$conexion,'id_producto','nombre',$datos_reserva['id_tarifa']);
        

            ?>
            </select></td>

    </tr>  
     <tr>
        <td>TOURS INCLUIDOS </td>
         <td colspan= "4"><input size="100%" id="tours_incluidos" class="fila_llenar" value = "<?php echo $datos_reserva['tours_incluidos'];  ?>"></td>

    </tr>   
      <tr>
        <td>CONTACTO ASISTENCIA MEDICA </td>
         <td colspan= "4"><input size="100%" id="contacto_asistencia" class="fila_llenar" value = "<?php echo $datos_reserva['contacto_asistencia'];  ?>"></td>

    </tr>   
     <tr>
        <td>EMAIL CONTACTO </td>
         <td ><input size="50%" id="email_contacto_asistencia" class="fila_llenar" value = "<?php echo $datos_reserva['email_contacto_asistencia'];  ?>"></td>
         <td>CELULAR</td>
          <td><input size="10px" id="celular_contacto_asistencia" class="fila_llenar" value = "<?php echo $datos_reserva['celular_contacto_asistencia'];  ?>"></td>

    </tr>
</table>

<table class ="formato_tabla"  border="1" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
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
            <td><input type = "text"  id="valor_por_pasajero_sencilla"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['valor_por_pasajero_sencilla'];  ?>" ></td>
             <td><input type = "text"  id="valor_por_pasajero_doble"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['valor_por_pasajero_doble'];  ?>"></td>
             <td><input type = "text"  id="valor_por_pasajero_triple"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['valor_por_pasajero_triple'];  ?>"></td>
             <td><input type = "text"  id="valor_por_pasajero_nino"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['valor_por_pasajero_nino'];  ?>"></td>
             <td><input type = "text"  id="valor_por_pasajero_infante"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['valor_por_pasajero_infante'];  ?>"></td>
        </tr> 

          <tr>
            <td>CARGOS E IMPUESTOS</td>
            <td><input type = "text"  id="impuestos_sencilla"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['impuestos_sencilla'];  ?>"></td>
             <td><input type = "text"  id="impuestos_doble"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['impuestos_doble'];  ?>"></td>
             <td><input type = "text"  id="impuestos_triple"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['impuestos_triple'];  ?>"></td>
             <td><input type = "text"  id="impuestos_nino"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['impuestos_nino'];  ?>"></td>
             <td><input type = "text"  id="impuestos_infante"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['impuestos_infante'];  ?>"></td>
        </tr>  
         <tr>
            <td>TOURS ADICIONALES</td>
             <td><input type = "text"  id="tours_adicionales_sencilla"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['tours_adicionales_sencilla'];  ?>" ></td>
             <td><input type = "text"  id="tours_adicionales_doble"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['tours_adicionales_doble'];  ?>"></td>
             <td><input type = "text"  id="tours_adicionales_triple"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['tours_adicionales_triple'];  ?>"></td>
             <td><input type = "text"  id="tours_adicionales_nino"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['tours_adicionales_nino'];  ?>"></td>
             <td><input type = "text"  id="tours_adicionales_infante"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['tours_adicionales_infante'];  ?>"></td>
        </tr>  
       
         <tr>
            <td>NOCHES ADICIONALES</td>
         <td><input type = "text"  id="noches_adicionales_sencilla"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['noches_adicionales_sencilla'];  ?>"></td>
             <td><input type = "text"  id="noches_adicionales_doble"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['noches_adicionales_doble'];  ?>"></td>
             <td><input type = "text"  id="noches_adicionales_triple"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['noches_adicionales_triple'];  ?>"></td>
             <td><input type = "text"  id="noches_adicionales_nino"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['noches_adicionales_nino'];  ?>"></td>
             <td><input type = "text"  id="noches_adicionales_infante"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['noches_adicionales_infante'];  ?>"></td>
        </tr>  
         
         <tr class="fila_verde" colspan = "6" >
            <td>TOTAL POR PERSONA</td>
              <td><input type = "text"  id="totalxpersona_sencilla"   size = "10px" onfocus="blur();"  value = "<?php echo $datos_liq_reserva['totalxpersona_sencilla'];  ?>"></td>
             <td><input type = "text"  id="totalxpersona_doble"   size = "10px" onfocus="blur();"  value = "<?php echo $datos_liq_reserva['totalxpersona_doble'];  ?>"></td>
             <td><input type = "text"  id="totalxpersona_triple"   size = "10px" onfocus="blur();"  value = "<?php echo $datos_liq_reserva['totalxpersona_triple'];  ?>"></td>
             <td><input type = "text"  id="totalxpersona_nino"   size = "10px" onfocus="blur();"  value = "<?php echo $datos_liq_reserva['totalxpersona_nino'];  ?>" ></td>
             <td><input type = "text"  id="totalxpersona_infante"   size = "10px" onfocus="blur();"  value = "<?php echo $datos_liq_reserva['totalxpersona_infante'];  ?>"></td>
        </tr> 
         <tr>
            <td>TOTAL DE PERSONAS</td>
             <td><input type = "text"  id="cantidad_personas_sencilla"  class="fila_llenar" size = "10px"  value = "<?php echo $datos_liq_reserva['cantidad_personas_sencilla'];  ?>"></td>
             <td><input type = "text"  id="cantidad_personas_doble"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['cantidad_personas_doble'];  ?>"></td>
             <td><input type = "text"  id="cantidad_personas_triple"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['cantidad_personas_triple'];  ?>"></td>
             <td><input type = "text"  id="cantidad_personas_nino"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['cantidad_personas_nino'];  ?>"></td>
             <td><input type = "text"  id="cantidad_personas_infante"  class="fila_llenar" size = "10px" value = "<?php echo $datos_liq_reserva['cantidad_personas_infante'];  ?>"></td>
        </tr>  
         <tr>
            <td>TOTAL POR ACOMODACION</td>
            <td><input type = "text"  id="totalxacomodacion_sencilla"   size = "10px" onfocus="blur();" value = "<?php echo $datos_liq_reserva['totalxacomodacion_sencilla'];  ?>"></td>
             <td><input type = "text"  id="totalxacomodacion_doble"   size = "10px" onfocus="blur();" value = "<?php echo $datos_liq_reserva['totalxacomodacion_doble'];  ?>"></td>
             <td><input type = "text"  id="totalxacomodacion_triple"   size = "10px" onfocus="blur();" value = "<?php echo $datos_liq_reserva['totalxacomodacion_triple'];  ?>"></td>
             <td><input type = "text"  id="totalxacomodacion_nino"   size = "10px" onfocus="blur();" value = "<?php echo $datos_liq_reserva['totalxacomodacion_nino'];  ?>"></td>
             <td><input type = "text"  id="totalxacomodacion_infante"   size = "10px" onfocus="blur();" value = "<?php echo $datos_liq_reserva['totalxacomodacion_infante'];  ?>"></td>
        </tr> 
</table>	
<button id="btn_realizar_calculos" >CALCULAR VALORES</button>

<table class ="formato_tabla"  border="1" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
           <tr>
            <td>VALOR TOTAL DEL CONTRATO SIN  IMPUESTOS EN $ </td>
            <td colspan = "5"><input type="text"  id="total_sin_impuestos"  name = "total_sin_impuestos"
              size = "10px" onfocus="blur();"
                value = "<?php echo $datos_reserva['total_sin_impuestos'];  ?>"
               >
               </td>
        </tr> 
          <tr>
            <td>VALOR TOTAL DEL CONTRATO CON IMPUESTOS EN $ </td>
            <td colspan = "5"><input type="number"  id="total" 
              size = "10px" onfocus="blur();"
              value = "<?php echo $datos_reserva['total'];  ?>"
               >
             </td>
        </tr>   
           <tr>
            <td>VALOR TOTAL DEL CONTRATO EN LETRAS:</td>
            <td colspan = "5"></td>
        </tr>   

      <tr>
        <td>VALOR CUOTA INICIAL $</td>
        <td><input type="text"  id="vr_inicial" class="fila_llenar" size = "10px"  onfocus="blur();"   value = "<?php echo $datos_reserva['vr_inicial'];  ?>"></td>
        <td>NoDE CUOTAS $</td>
         <td><input type="text"  id="no_cuotas" class="fila_llenar" size = "10px"   value = "<?php echo $datos_reserva['no_cuotas'];  ?>" ></td>
         <td>VALOR CUOTA  $</td>
          <td><input type="text"  id="vr_cuota_mensual" class="fila_llenar" size = "10px" onfocus="blur();"   value = "<?php echo $datos_reserva['vr_cuota_mensual'];  ?>"></td>
  </tr>
        <tr>
        <td>FORMA DE PAGO:</td> 
        <td>EFECTIVO:</td> 
        <td><input type="text"  id="vr_efectivo" class="fila_llenar" size = "10px"></td>
        <td>CONSIG/TRANS:</td> 
        <td><input type="text"  id="vr_cons_trans" class="fila_llenar" size = "10px"></td>
         <td>TC/TD:<input type="text"  id="vr_tarjeta" class="fila_llenar" size = "10px"></td> 
    </tr>
</table>
<br>
<table class ="formato_tabla"  border="1" width="<?php echo $ancho_tabla;  ?>"  style="font-size:<?php echo $tamano_letra; ?>">
<tr>
<td colspan = "4">OBSERVACIONES:<BR></td>
</tr>
<tr>
    <td>QUIEN RECIBE</td>
     <td>

      <select id="id_quien_recibe" class="fila_llenar">
        <?php
          //colocar_select_general_321($tabla16,$conexion,'id_usuario','nombre');
           colocar_select_general_condicion_mejorada321($tabla16,$conexion,'id_usuario','nombre',$datos_reserva['id_quien_recibe']);
        
        ?>

      </select>

     </td>
      <td>QUIEN CONFIRMA DISPONIBILIDAD</td>
       <td> <select id="id_quien_confirma" class="fila_llenar">
        <?php
           colocar_select_general_condicion_mejorada321($tabla16,$conexion,'id_usuario','nombre',$datos_reserva['id_quien_confirma']);
        ?>

      </select></td>
</tr>
</table>
	<br>
<hr></hr>    

<table border="0" width="<?php echo $ancho_tabla;  ?>">
  <tr>
    <td>Tipo de Venta</td>
    <td><select id="id_tipo_venta"  class="fila_llenar"  >
            <?php
                //colocar_select_general($tipo_venta,$conexion,'id_tipo_venta','descripcion');
                 colocar_select_general_condicion_mejorada321($tipo_venta,$conexion,'id_tipo_venta','descripcion',$datos_reserva['id_tipo_venta']);
       
            ?>
         
         </select></td>
    <td colspan="2"><input type = "text"  id="crucero"  class="fila_llenar"  placeholder = "CRUCERO" size = "40px" value = "<?php echo $datos_reserva['crucero'];  ?>" ></td>
   
   </tr> 
  <tr>
    <td></td>
    <td></td>
    <td>Sucursal</td>
    <td><input type="text"  id="sucursal" class="fila_llenar" value = "Bogota"></td>
  </tr>
  <tr>
    <td>Forma de Pago </td>
    <td><select id="id_forma_pago"  class="fila_llenar"  >
            <?php
                //colocar_select_general($forma_pago,$conexion,'id_forma_pago','descripcion');
                  colocar_select_general_condicion_mejorada321($forma_pago,$conexion,'id_forma_pago','descripcion',$datos_reserva['id_forma_pago']);
       
            ?>
         
         </select></td>
    <td>Usuario Registro</td>
    <td><input type="text"  
            id = "id_usuario_registro"  
          
            value= "<?php echo $_SESSION['nombre_usuario'];   ?> " 
            onfocus="blur();"   ></td>
  </tr>
  <tr>
    <td>Estado</td>
    <td>
        <select id="id_estado" class="fila_llenar">
            <?php colocar_select_general_condicion_1($estados_reserva,$conexion,'id_estado','nombre','2'); ?>
        </select>

      </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

	<br>
  <br>
  <br>
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   


<?
function colocar_select_general_321($tabla,$conexion,$campo1,$campo2){
  $sql_general = "select * from $tabla  where id_perfil = '13'  ";
  //echo '<br>'.$sql_personas;
  $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
    echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
  }
}

function colocar_select_general_condicion_1($tabla,$conexion,$campo1,$campo2,$condicion){
  $sql_general = "select * from $tabla    ";
  
 $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {

      if($general[$campo1] == $condicion){
           echo '<option value="'.$general[$campo1].'" selected >'.$general [$campo2].'</option>';
      }
      else 
      {
          echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
      }

     }//fin del while
    } //fin ed la funcion   

    //////////////////////////////////


function colocar_select_general_condicion_mejorada321($tabla,$conexion,$campo1,$campo2,$condicion){
  $sql_general = "select * from $tabla    ";
  
 $con_general = mysql_query($sql_general,$conexion);
  echo '<option value="" >...</option>';
  while($general  = mysql_fetch_assoc($con_general))
  {
      if($general[$campo1] == $condicion){
           echo '<option value="'.$general[$campo1].'" selected >'.$general [$campo2].'</option>';
      }
      else 
      {
          echo '<option value="'.$general[$campo1].'" >'.$general [$campo2].'</option>';
      }
     }//fin del while
    } //fin ed la funcion   



?>

