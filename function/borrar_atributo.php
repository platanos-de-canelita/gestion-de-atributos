<?php
  require_once("bdconexion.php");

  $nombre = $_GET['nombre'];
  if(empty($nombre)){
    echo "No existe el atributo";
  }
  else{
    //var $idAd, $idCar;
    $sql = "CALL DEL_ATRIBUTO ($id,$nombre);"
    $result = $conn->query($sql);
    $info = $result->fetch_row();

    $sql="CALL DeleteAtribute ($nombre, @idd_admin_pk, @idd_carrera);";
    $conn->query($sql);
  }



 ?>
