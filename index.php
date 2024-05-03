<!DOCTYPE html>
<html lang="es"  class"no-js">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
<style>

.formato_tabla123  td{
  padding: 10px;
}
.formato_tabla123  ,th,td {
   border-collapse: collapse;
   border: 1px solid #E6E6E6;
}
.formato_tabla123 thead{
  background-color: orange;
  text-align: center;
}
</style>
</head>
<body>
<br />
<br />

<br />
<br />
<Div id="contenidos">
<form action="verificar_usuario.php" method="post">
  <div align="center">
    <table width="797" border="0" class="formato_tabla123">
      <tr>
        <td colspan="2" align= "center" ><img src = "logos/summers.png" width="250" style="border-radius:50%;" ></td>
      </tr>
      <tr>
        <td colspan="2" align= "center" ><H2>AR AGENCIA DE VIAJES</H2>  </td>
      </tr>
      
      <tr>
        <td width="208" align="right"><img src="imagenes/usuario.png" width="60" height="72"></td>
        <td width="573"><label><h2>
          <input type="text" name="usuario" /></h2>
        </label></td>
      </tr>
      <tr>
        <td align="right"><img src="imagenes/clave.png" width="60" height="30"></td>
        <td><h2><input type="password" name="clave" /></h2></td>
      </tr>
      <tr>
        <td colspan="2"><h2><label>
          <div align="center">
            <input type="image" name="Submit" value="Enviar" src="imagenes/boton_enviar.png" width ="200" heigh = "20" />
            </div>
        </label></h2></td>
        </tr>
      
      <tr>
        <td colspan="2">
        </td>
       </tr>
    </table>
  </div>
</form>
</Div>
</body>
</html>

<script src="js/modernizr.js"></script>   
<script src="js/prefixfree.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>   

