<?php
  require_once("bdconexion.php");
  $admin = $_SESSION['usuario'];

  $nombre = $_GET['nombreA'];
  if(empty($nombre)){
    echo "No existe el atributo";
  }
  else{
    var $idAd, $idCar;
    $sql = "CALL Info_admin ($admin,$pass, @idd_admin_pk,@idd_carrera);"
    +
    "CALL DeleteAtribute ($nombre, @idd_admin_pk, @idd_carrera);";
    $conn->query($sql);
  }
  
  

 ?>
