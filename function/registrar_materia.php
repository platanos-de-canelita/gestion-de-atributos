<?php
  require_once("bdconexion.php");
  $materia = $_POST['materia'];
  $sql = "INSERT INTO materia (nombre) VALUES ('$materia')";
  $conn->query($sql);


 ?>
