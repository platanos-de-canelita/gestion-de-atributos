<?php
require_once("bdconexion.php");
  /* Getting file name */
$filename = $_FILES['file']['name'];
$tamanio = $_FILES['file']['size'];
$nombre=$_POST['nombre'];
$contador=0;
if($tamanio==0){
  echo "Selecciona una imagen";
  $contador++;
}
if(empty($nombre)){
  echo "Ingresa un nombre";
  $contador++;
}
/* Location */
if($contador==0){
  $location = "..\\image\\departamentos\\".$filename;
  $uploadOk = 1;
  $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

  /* Valid Extensions */
  $valid_extensions = array("jpg","jpeg","png");
  /* Check file extension */
  if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
     $uploadOk = 0;
  }
  if($uploadOk == 0){
     echo "Error al registrar";
  }else{
     /* Upload file */
     if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
       $sql = "INSERT INTO departamento (`Nombre`,`Logo`) values ('$nombre','$filename')";
       if($conn->query($sql)){
         echo $location;
       }
     }else{
        echo "Error al registrar";
     }
  }
}
 ?>
