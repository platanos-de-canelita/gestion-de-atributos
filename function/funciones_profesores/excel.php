<?php
extract($_POST);
if (isset($_POST['action'])) {
$action=$_POST['action'];
}

if (isset($action)== "upload"){
//cargamos el fichero
$archivo = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$destino = "cop_".$archivo;//Le agregamos un prefijo para identificarlo el archivo cargado
if (copy($_FILES['excel']['tmp_name'],$destino)) echo "Archivo Cargado Con Éxito";
else echo "Error Al Cargar el Archivo";

if (file_exists ("cop_".$archivo)){
/** Llamamos las clases necesarias PHPEcel */
require_once('../../Classes/PHPExcel.php');
require_once('../../Classes/PHPExcel/Reader/Excel2007.php');
// Cargando la hoja de excel
$objReader = new PHPExcel_Reader_Excel2007();
$objPHPExcel = $objReader->load("cop_".$archivo);
$objFecha = new PHPExcel_Shared_Date();
// Asignamon la hoja de excel activa
$objPHPExcel->setActiveSheetIndex(0);

// Importante - conexión con la base de datos
require_once "bdconexion.php";

// Rellenamos el arreglo con los datos  del archivo xlsx que ha sido subido

$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();

//Creamos un array con todos los datos del Excel importado
for ($i=2;$i<=$filas;$i++){
 $_DATOS_EXCEL[$i]['Num_Control'] = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
 $_DATOS_EXCEL[$i]['Nombre'] = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
 $_DATOS_EXCEL[$i]['Ap_P']= $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
 $_DATOS_EXCEL[$i]['Ap_M']= $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();
 $_DATOS_EXCEL[$i]['id_carrera'] = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();
 $_DATOS_EXCEL[$i]['especialidad_id'] = $objPHPExcel->getActiveSheet()->getCell('F'.$i)->getCalculatedValue();

 }
 $errores=0;
 echo $filas;

for ($i=2; $i <=$filas ; $i++) {
  $control=strval($_DATOS_EXCEL[$i]['Num_Control']);
  $nombre=strval($_DATOS_EXCEL[$i]['Nombre']);
  $app=strval($_DATOS_EXCEL[$i]['Ap_P']);
  $apm=strval($_DATOS_EXCEL[$i]['Ap_M']);
  $carrera=intval($_DATOS_EXCEL[$i]['id_carrera']);
  $espec=intval($_DATOS_EXCEL[$i]['especialidad_id']);
  $sql = "INSERT INTO alumno (`Num_Control`,`Nombre`,`Ap_P`,`Ap_M`,`id_carrera`,`especialidad_id`) VALUES ('$control','$nombre','$app','$apm',$carrera,$espec)";
  $result=$conn->query($sql);
  if(!$result) echo "error al insertar la linea $i";
}


echo "<hr> <div class='col-xs-12'>
    	<div class='form-group'>";
       echo "<strong><center>ARCHIVO IMPORTADO CON EXITO, EN TOTAL $filas REGISTROS Y $errores ERRORES</center></strong>";
echo "</div>
</div>  ";
 //Borramos el archivo que esta en el servidor con el prefijo cop_
 unlink($destino);

 }
 //si por algun motivo no cargo el archivo cop_
 else{
 echo "Primero debes cargar el archivo con extencion .xlsx";
 }
 }
 ?>
<?php
 if (isset($action)) {
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
 }
 if (isset($filas)) {
$columnas = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
 }
 if (isset($filas)) {
$filas = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
 }

//echo 'getHighestColumn() =  [' . $columnas . ']<br/>';
//echo 'getHighestRow() =  [' . $filas . ']<br/>';
if (isset($action)== "upload"){

 echo '<table border="1" class="table">';
 echo '<thead>';
 echo '<tr>';
 echo '<th>Nombres</th>';
 echo '<th>Apellidos</th>';
 echo '<th>Genero</th>';
 echo '<th>Edad</th>';
 echo '<th>Carrera</th>';
 echo '<th>E-Mail</th>';

 echo '</tr> ';
 echo '</thead> ';
 echo '<tbody> ';

$count=0;
foreach ($objPHPExcel->setActiveSheetIndex(0)->getRowIterator() as $row) {
    $count++;
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    echo '<tr>';
    foreach ($cellIterator as $cell) {
        if (!is_null($cell)) {
            $value = $cell->getCalculatedValue();
            echo '<td>';
            echo $value . ' ';
            echo '</td>';
        }
    }
    echo '</tr>';
}
  echo '</tbody>';
  echo '</table>';
}
 echo '</div>';
//include ("footer.php");
?>
