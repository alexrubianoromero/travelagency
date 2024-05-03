<?php
session_start();
include('../valotablapc.php');





 function  consulta_assoc($tabla,$campo,$parametro,$conexion)
  {
       $sql="select * from $tabla  where ".$campo." = '".$parametro."' ";
       //echo '<br>'.$sql;
       $con = mysql_query($sql,$conexion);
       $arr_con = mysql_fetch_assoc($con);
       return $arr_con;
  }
?>

<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
	
	 <meta name="viewport" content="width:device-width,user-scalable=no">
    <link rel='stylesheet' href='../css/bootstrap.min.css'>
     <script src='../js/bootstrap.min.js'></script>

</head>
<body>

<div class="container">




<?php
echo  '<H1>CONSULTA DE BOLETAS</H1><BR><BR>';


echo ' <a class="btn btn-info btn-lg" href="../clientes/consultacliente_general.php" role="button">Menu Consultas</a>';
echo ' <input type="text"   id="buscar_boleta" placeholder="No Boleta">';
echo '<button id="btn_buscar_boleta">BUSCAR</button>';
echo '<br><br>';

echo '<div id="div_muestre_boletas">';
include('muestre_boletas.php');
echo '</div>';
?>
</div>
</body>
</html>
<script src="../js/modernizr.js"></script>   
<script src="../js/prefixfree.min.js"></script>
<script src="../js/jquery-2.1.1.js"></script>   


<script language="JavaScript" type="text/JavaScript">            
  $(document).ready(function(){

    $("#btn_buscar_boleta").click(function(){
      //alert('asdasdasdas');
      var data =  'buscar_boleta=' + $("#buscar_boleta").val();
              //data += '&buscar_identificacion=' + $("#buscar_identificacion").val();
              
              $.post('../clientes/muestre_boletas.php',data,function(a){
              //$(window).attr('location', '../index.php);
              $("#div_muestre_boletas").html(a);
                //alert(data);
              }); 


    }); 
  });   ////finde la funcion principal de script    
</script>
