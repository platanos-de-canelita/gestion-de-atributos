
<?php
  include_once 'bdconexion.php';
  $sql_registe=$conn->query("SELECT COUNT(*) AS total_registro FROM materia");
  $result_register = $sql_registe->fetch_assoc();
  $total_registro = $result_register['total_registro'];
  echo $total_registro;
 ?>
