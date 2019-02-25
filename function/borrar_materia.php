<?php
  require_once("bdconexion.php");
  $id = $_GET['materia'];
  $sql = "DELETE FROM materia WHERE idmateria=$id";

  $conn->query($sql);

 ?>
