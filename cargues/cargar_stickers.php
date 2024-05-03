<?php
session_start();
include('../valotablapc.php');
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<?php 
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/
?>

<h3>Seleccionar archivo Excel que contiene los tikets<br />
<br />
 </h3>
    <form name="frmload" method="post" action="cargar_stickers.php" enctype="multipart/form-data">
        <input type="file" name="file" />       <input type="submit" value="----- IMPORTAR -----" />
    </form>
<div id="show_excel">

        <?php
 
        if($_FILES['file']['name'] != '')
        {
 
           // require_once 'reader/Classes/PHPExcel/IOFactory.php';
		   require_once '../../Classes/PHPExcel/IOFactory.php';
 
            //Funciones extras
 
            function get_cell($cell, $objPHPExcel){
                //select one cell
                $objCell = ($objPHPExcel->getActiveSheet()->getCell($cell));
                //get cell value
                return $objCell->getvalue();
            }
 
            function pp(&$var){
                $var = chr(ord($var)+1);
                return true;
            }
 
            $name     = $_FILES['file']['name'];
            $tname    = $_FILES['file']['tmp_name'];
            $type     = $_FILES['file']['type'];
 
            if($type == 'application/vnd.ms-excel')
            {
                // Extension excel 97
                $ext = 'xls';
            }
            else if($type == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            {
                // Extension excel 2007 y 2010
                $ext = 'xlsx';
            }else{
                // Extension no valida
                echo -1;
                exit();
            }
 
            $xlsx = 'Excel2007';
            $xls  = 'Excel5';
 
            //creando el lector
            $objReader = PHPExcel_IOFactory::createReader($$ext);
 
            //cargamos el archivo
            $objPHPExcel = $objReader->load($tname);
 
            $dim = $objPHPExcel->getActiveSheet()->calculateWorksheetDimension();
 
            // list coloca en array $start y $end
            list($start, $end) = explode(':', $dim);
 
            if(!preg_match('#([A-Z]+)([0-9]+)#', $start, $rslt)){
                return false;
            }
            list($start, $start_h, $start_v) = $rslt;
            if(!preg_match('#([A-Z]+)([0-9]+)#', $end, $rslt)){
                return false;
            }
            list($end, $end_h, $end_v) = $rslt;

            $fechapan =  time();
            $fechapan= date ( "Y/m/j" , $fechapan );
            $fecha_hora_actual = date('Y-m-d H:i:s'); 

            $nombre_archivo = $_FILES['file']['name'].'-'.$fecha_hora_actual;

            //echo '<br>nombrearchivo<b>'.$_FILES['file']['name'].'-'.$fechapan;
            $sql_grabar_nombre_archivo = "insert into $tabla54  (nombre_archivo,id_empresa) values('".$nombre_archivo."','".$_SESSION['id_empresa']."')";
           // echo '<br>consulta_grabar_nombre<br>'.$sql_grabar_nombre_archivo.'<br>';
            $consulta_grabar_nombre = mysql_query($sql_grabar_nombre_archivo,$conexion);

            $sql_maximo_id_nombre = "select max(id_archivo) as maximo   from $tabla54  ";
            $consulta_maximo_id = mysql_query($sql_maximo_id_nombre,$conexion);
            $arreglo_maximo_id = mysql_fetch_assoc($consulta_maximo_id);
            $maximo_id = $arreglo_maximo_id['maximo'];
            //echo '<br>maximo_id<br>'.$maximo_id;
            //empieza  lectura vertical
            
            
            $table = "<table  border='1'>";

            for($v=$start_v+1; $v<=$end_v; $v++){
                //empieza lectura horizontal
                $table .= "<tr>";
                for($h=$start_h; ord($h)<=ord($end_h); pp($h)){
                    $cellValue = get_cell($h.$v, $objPHPExcel);
					//$arreglo_mostrar[$h][$v] = $cellValue; 
                    $table .= "<td><input type ='text' name = 'loco_".$v."_".$h."' value ='".$cellValue."'";
					if($h == 'A'){$arreglo_mostrar[$v]['A'] = $cellValue; }
					if($h == 'B'){$arreglo_mostrar[$v]['B'] = $cellValue; }
					if($h == 'C'){$arreglo_mostrar[$v]['C'] = $cellValue; }
                    if($h == 'D'){$arreglo_mostrar[$v]['D'] = $cellValue; }
					if($h == 'E'){$arreglo_mostrar[$v]['E'] = $cellValue; }
                    if($h == 'F'){$arreglo_mostrar[$v]['F'] = $cellValue; }
                    if($h == 'G'){$arreglo_mostrar[$v]['G'] = $cellValue; }
                    if($h == 'H'){$arreglo_mostrar[$v]['H'] = $cellValue; }
                    
                   
					//$arreglo_mostrar[$v][$h] = $cellValue; 
                    if($cellValue !== null){
                        $table .= $cellValue;
                    }
                    
					$table .= "></td>";
					
                }
                $table .= "</tr>";
            }
            $table .= "</table>";
            
            ////////////////////////////////
           // echo 'resultado'.$table;

        }
		/*
		echo '<pre>';
		print_r($arreglo_mostrar);
		echo '</pre>';
		*/

        //////////////////////////////////////////////

		echo '<form name = "hoja1" method = "post" action = "mostrar_arreglo.php">';
		echo '<table border = "1">';
		
		$i = 1;
		if (sizeof($arreglo_mostrar)> 0);
					{
						foreach ($arreglo_mostrar as $am)
								{
									
                                    //$timestamp = PHPExcel_Shared_Date::ExcelToPHP($fecha);    
                                    //echo 'la fecha '.$am['F'].'<br>';
                                    $timestamp123 = PHPExcel_Shared_Date::ExcelToPHP($am['F']);
                                    //echo 'nueva_fecha'.$timestamp.'<br>';
                                    $fecha_php = date("Y-m-d",$timestamp123);
                                    //echo 'ultima forma'.$fecha_php.'<br>';
                                	
									$sql_grabar_filas = "insert into $tabla3 (identi,nombre,telefono,telefono_celular
                                        ,direccion,email,rol,observaci,id_empresa,id_cargue_nombre)
                                    values (
                                        '".trim($am['A'])."'
                                        , '".trim($am['B'])."'
                                        , '".trim($am['C'])."'
                                        , '".trim($am['D'])."'
                                        , '".trim($am['E'])."'
                                        , '".trim($am['F'])."'
                                        , '".trim($am['G'])."'
                                        , '".trim($am['H'])."'
                                        ,'300'
                                        ,'".$maximo_id."'
                                        )";
                                    //echo '<br>consulta<br>'.$sql_grabar_filas;
                                    $consulta_grabar_detalle = mysql_query($sql_grabar_filas,$conexion);
                                       //echo '<br>'.$sql_grabar_filas; 
                                       //exit();  
									$i++;
								}
					 } // parece fin de sizeof
							
		//echo '<tr><td><input type ="submit" value ="enviar" ></td></tr>';		
		echo '<table>';
		echo '</form>';		
         
        echo '<BR>IMPORTACION REALIZADA REGISTRADA BAJO EL NOMBRE DE ARCHIVO '.$nombre_archivo;
        //////////////aqui se van a mostrar los cargues existentes en el sistema 
        
        /*
        echo '<br><br>CARGUES EXISTENTES EN EL SISTEMA<br>';
        $sql_archivos_cargados = "select * from $tabla54  where id_empresa = '".$_SESSION['id_empresa']."' and activo = 1 order by id_archivo desc";
        $consulta_archivos_cargados = mysql_query($sql_archivos_cargados,$conexion);
       echo '<table border = "1">';
       while ($cargados = mysql_fetch_assoc($consulta_archivos_cargados))
                {
                    echo '<tr>';
                    echo '<td>'.$cargados['nombre_archivo'].'</td>';
                    echo '<td><a href ="../cargues/ver_registros_cargue.php?id_archivo='.$cargados['id_archivo'].'">Ver Contenido</a></td>';
                    echo '<tr>';
                }
         echo '</table>';   
        */ 
		?>
		
</div>

</body>
</html>
