<?php
session_start();
include('../valotablapc.php');
$fechapan =  time();
$fechapan = date ( "Y/m/j" , $fechapan );
/*
echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
*/
/////////////////////
  function  consulta_assoc_proforma($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
////////////////////////////

$datos_cxp = consulta_assoc_proforma($cxp_proveedores,'id_cxp',$_REQUEST['id_cxp'],$conexion);
$datos_proveedor = consulta_assoc_proforma($tabla3,'idcliente',$datos_cxp['id_proveedor'],$conexion);
?>
<!doctype html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery.js" type="text/javascript"></script>
</head>
<body>	
<div id="div_preguntar_datos_proforma">
	<h2>FACTURA PROFORMA</h2>
	<input type="hidden" id = "id_cxp" value = "<?php   echo $_REQUEST['id_cxp'];  ?>">
	Fecha: <input type="text" id = "fecha" value = "<?php   echo $fechapan;  ?>">

	  <div id="div_datos_proveedor">

	  	Proveedor: <?php echo $datos_proveedor['nombre']; ?> <br>
	  	c.c: 		<?php echo $datos_proveedor['identi']; ?> <br>
	  	Direccion: <?php echo $datos_proveedor['direccion']; ?> <br>
	  	Telefonos: <?php echo $datos_proveedor['telefono']; ?> <br>

	  </div>	

	   <div id="div_concepto">
	   	<textarea id="concepto_factura" cols="60" rows="6" placeholder="concepto"></textarea>
	   </div>	
	   <div id="div_importe">
	   	Total Cuenta : <?php echo $datos_cxp['valor_total']; ?> <br>
	    Valor Factura Proforma : <input type="text" id="valor_proforma">	
	   </div>
	   <BR><BR>
     <button id="btn_grabar_proforma">GRABAR PROFORMA</button>
</div>
</body>
</html>

<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   

<script language="JavaScript" type="text/JavaScript">
            
$(document).ready(function(){
	 /////////////////////////
	 	$("#btn_grabar_proforma").click(function(){

            ////////////////////////
       if($("#valor_proforma").val().length < 1)
        { alert('digite valor_proforma ');
      $(valor_proforma).focus();
          return false;
         }

      if($("#concepto_factura").val().length < 1)
        { alert('digite concepto_factura ');
      $(concepto_factura).focus();
          return false;
         }


         			
              var data =  'valor_proforma=' + $("#valor_proforma").val();
              data += '&valor_proforma=' + $("#valor_proforma").val();
              data += '&id_cxp=' + $("#id_cxp").val();
              data += '&fecha=' + $("#fecha").val();


							$.post('../facturas_proforma/grabar_proforma.php',data,function(a){
							//$(window).attr('location', '../index.php);
							$("#div_preguntar_datos_proforma").html(a);
								//alert(data);
							});	




      });//fin de btn_grabar_proforma
					 
});		////finde la funcion principal de script
		
</script>