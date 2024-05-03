<?php
session_start();
include('../valotablapc.php');
include('../num2letras.php'); 
$ancho_tabla = "90%";
$tamano_letra = "12px";
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
$datos_egreso = consulta_assoc($recibos_proveedores,'id_recibo_proveedor',$_REQUEST['id_recibo_proveedor'],$conexion);

?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
<style>


</style>
</head>
<body>	
<div id="div_egresos"  >
 <?php 
if($datos_egreso['id_tipo_egreso'] ==1)
{
  $datos_reserva = consulta_assoc($reservas,'id_reserva',$datos_egreso['id_cxp'],$conexion);
  $datos_forma_pago=consulta_assoc($formas_pago_egresos,'id_forma_pago_egreso',$datos_egreso['id_forma_pago'],$conexion);
  $datos_asesor = consulta_assoc($tabla3,'idcliente',$datos_reserva['id_vendedor'],$conexion);



$sql_empresa = "select * from empresa ";
$con_empresa = mysql_query($sql_empresa,$conexion);
$arr_empresa = mysql_fetch_assoc($con_empresa);

$letras = num2letras($datos_egreso['valor']);

?>
<!--si el recibo es de comision-->
  <table border="1" width="<?php echo $ancho_tabla;  ?>"   style="font-size:<?php echo $tamano_letra;?>" >
      <tr>
        <td align="center">
          <img src = "../logos/summers2.png" width="170px" height="100px"><br>
          <?php  echo  $arr_empresa['identi'] ?>
          <br>
          <?php  echo  $arr_empresa['razon_social'] ?> - REGIMEN COMUN


        </td> 
        <td>
          <table border = "1">
              <tr>
                     <td COLSPAN = "2">COMPROBANTE DE EGRESO
                     </td>
                    
               </tr>

               <tr>
                     <td>Num
                     </td>
                     <td><?php  echo $datos_egreso['no_egreso'] ?>
                     </td>    
               </tr>
               <tr>

                <td>No CONTRATO</td>  
                <td><?php  echo  $datos_reserva['no_contrato']  ?></td> 
               </tr>
               <tr>

                <td>No RSV</td> 
                <td><?php  echo  $datos_reserva['no_reserva']  ?></td>  
               </tr>


          </table>  
        </td> 
      </tr>
    
  </table>  


  <table id = "1"    width="<?php echo $ancho_tabla;?>" style="font-size:<?php echo $tamano_letra;?>" >
    <tr>
           <td>FECHA:</td>
           <td><?php echo $datos_egreso['fecha']; ?> </td>
           <td> </td>
           <td> </td>
    </tr> 
    <tr>
           <td>NIT: </td>
           <td> <?php echo $datos_asesor['identi']; ?></td>
           <td>Valor </td>
           <td><?php echo $datos_egreso['valor']; ?> </td>
    </tr>
    <tr>
           <td>DIRECCION: </td>
           <td><?php echo $datos_asesor['direccion']; ?> </td>
           <td> TELEFONO:</td>
           <td> <?php echo $datos_asesor['telefono']; ?></td>
    </tr>
    <tr>
           <td>PAGUESE A: </td>
           <td><?php echo $datos_asesor['nombre']; ?> </td>
           <td> </td>
           <td> </td>
    </tr>
    <tr>
           <td align= "center" colspan = "4"> <?php  echo  $letras; ?> </td>
          
    </tr>
    <tr>
           <td> </td>
           <td> </td>
           <td> </td>
           <td> </td>
    </tr>

  </table> 

 <br>
<table id = "1"    width="<?php echo $ancho_tabla;?>"  style="font-size:<?php echo $tamano_letra;?>">
    <tr>
           <td>FORMA DE PAGO:</td>
           <td><?php echo $datos_forma_pago['descripcion']; ?> </td>
           <td>CHEQUE:</td>
           <td> </td>
    </tr> 
</table>    

<br>
<table id = "1"    width="<?php echo $ancho_tabla;?>"  style="font-size:<?php echo $tamano_letra;?>">
    <tr>
      <td>NO</td>
      <td>DESTINO</td>
      <td>CONCEPTO</td>
      <td>DEBITO</td>
      <td>CREDITO</td>
      <td>SALDO</td>
    </tr> 
    <tr>
      <td>1</td>
      <td><?php echo $datos_cxp['destino'] ?></td>
      <td>GASTOS DE TRANSPORTE</td>
      <td align="right"><?php echo  number_format($datos_egreso['valor'], 0, ',', '.') ?></td>
      <td align="right" ></td>
      <td align="right"><?php echo number_format($datos_cxp['saldo'], 0, ',', '.') ?></td>
    </tr>
</table>
<br>
<table id = "1"    width="<?php echo $ancho_tabla;?>" style="font-size:<?php echo $tamano_letra;?>" >
    <tr>
           <td>OBSERVACIONES:<?php echo $datos_egreso['observaciones']; ?></td>
        
    </tr> 
</table>    

<br>
<table id = "1"    width="<?php echo $ancho_tabla;?>"  style="font-size:<?php echo $tamano_letra;?>">
    <tr>
            <td>____________<br>Elaboro<br><?php echo  $datos_usuario['nombre'];  ?></td>
            <td>____________<br>Contabilizo<br></td>
            <td>____________<br>Aprobo<br></td>
            <td>____________<br>Recibio<br></td>
        
    </tr> 
</table>
<?php
} // fin de si es recibo tipo 1 de comision

?>


<?php
/////////////////////////////////////////////////////////////////////////////////////////////////
if($datos_egreso['id_tipo_egreso'] ==2)
{
$datos_cxp = consulta_assoc($cxp_proveedores,'id_cxp',$datos_egreso['id_cxp'],$conexion);
$datos_proveedor = consulta_assoc($tabla3,'idcliente',$datos_cxp['id_proveedor'],$conexion);
$datos_reserva = consulta_assoc($reservas,'id_reserva',$datos_cxp['id_reserva'],$conexion);
$datos_forma_pago=consulta_assoc($formas_pago_egresos,'id_forma_pago_egreso',$datos_egreso['id_forma_pago'],$conexion);
$datos_usuario = consulta_assoc($tabla16,'id_usuario',$datos_egreso['id_usuario_creacion'],$conexion);
$datos_concepto = consulta_assoc($cxp_conceptos,'id_concepto',$datos_cxp['id_concepto'],$conexion);

$sql_empresa = "select * from empresa ";
$con_empresa = mysql_query($sql_empresa,$conexion);
$arr_empresa = mysql_fetch_assoc($con_empresa);

$letras = num2letras($datos_egreso['valor']);


?>

<!--si el recibo es de proveedor-->
  <table border="1" width="<?php echo $ancho_tabla;  ?>"   style="font-size:<?php echo $tamano_letra;?>" >
      <tr>
      	<td align="center">
      		<img src = "../logos/summers2.png" width="170px" height="100px"><br>
      		<?php  echo  $arr_empresa['identi'] ?>
      		<br>
      		<?php  echo  $arr_empresa['razon_social'] ?> - REGIMEN COMUN


      	</td>	
      	<td>
      		<table border = "1">
      			 	<tr>
      	             <td COLSPAN = "2">COMPROBANTE DE EGRESO
      	             </td>
      	           	
      				 </tr>

      				 <tr>
      	             <td>Num
      	             </td>
      	             <td><?php  echo $datos_egreso['no_egreso'] ?>
      	             </td>		
      				 </tr>
      				 <tr>

      				 	<td>No CONTRATO</td>	
      				 	<td><?php  echo  $datos_reserva['no_contrato']  ?></td>	
      				 </tr>
      				 <tr>

      				 	<td>No RSV</td>	
      				 	<td><?php  echo  $datos_reserva['no_reserva']  ?></td>	
      				 </tr>


      		</table>	
      	</td>	
      </tr>
    
  </table>	


	<table id = "1"    width="<?php echo $ancho_tabla;?>" style="font-size:<?php echo $tamano_letra;?>" >
		<tr>
           <td>FECHA:</td>
           <td><?php echo $datos_egreso['fecha']; ?> </td>
           <td> </td>
           <td> </td>
		</tr>	
		<tr>
           <td>NIT: </td>
           <td> <?php echo $datos_proveedor['identi']; ?></td>
           <td>Valor </td>
           <td><?php echo $datos_egreso['valor']; ?> </td>
		</tr>
		<tr>
           <td>DIRECCION: </td>
           <td><?php echo $datos_proveedor['direccion']; ?> </td>
           <td> TELEFONO:</td>
           <td> <?php echo $datos_proveedor['telefono']; ?></td>
		</tr>
		<tr>
           <td>PAGUESE A: </td>
           <td><?php echo $datos_proveedor['nombre']; ?> </td>
           <td> </td>
           <td> </td>
		</tr>
		<tr>
           <td align= "center" colspan = "4"> <?php  echo  $letras; ?> </td>
          
		</tr>
		<tr>
           <td> </td>
           <td> </td>
           <td> </td>
           <td> </td>
		</tr>

	</table> 

 <br>
<table id = "1"    width="<?php echo $ancho_tabla;?>"  style="font-size:<?php echo $tamano_letra;?>">
		<tr>
           <td>FORMA DE PAGO:</td>
           <td><?php echo $datos_forma_pago['descripcion']; ?> </td>
           <td>CHEQUE:</td>
           <td> </td>
		</tr>	
</table>		

<br>
<table id = "1"    width="<?php echo $ancho_tabla;?>"  style="font-size:<?php echo $tamano_letra;?>">
		<tr>
			<td>NO</td>
			<td>DESTINO</td>
			<td>CONCEPTO</td>
			<td>DEBITO</td>
			<td>CREDITO</td>
			<td>SALDO</td>
		</tr>	
		<tr>
			<td>1</td>
			<td><?php echo $datos_cxp['destino'] ?></td>
			<td><?php echo $datos_concepto['nombre_concepto'] ?></td>
			<td align="right"><?php echo  number_format($datos_egreso['valor'], 0, ',', '.') ?></td>
			<td align="right" ></td>
			<td align="right"><?php echo number_format($datos_cxp['saldo'], 0, ',', '.') ?></td>
		</tr>
</table>
<br>
<table id = "1"    width="<?php echo $ancho_tabla;?>" style="font-size:<?php echo $tamano_letra;?>" >
		<tr>
           <td>OBSERVACIONES:<?php echo $datos_egreso['observaciones']; ?></td>
        
		</tr>	
</table>		

<br>
<table id = "1"    width="<?php echo $ancho_tabla;?>"  style="font-size:<?php echo $tamano_letra;?>">
		<tr>
            <td>____________<br>Elaboro<br><?php echo  $datos_usuario['nombre'];  ?></td>
            <td>____________<br>Contabilizo<br></td>
            <td>____________<br>Aprobo<br></td>
            <td>____________<br>Recibio<br></td>
        
		</tr>	
</table>
<?php
} //fin de si es egreso tipo 2 de proveedor 
?>
</div>
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   


<?php

  function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }


?>
