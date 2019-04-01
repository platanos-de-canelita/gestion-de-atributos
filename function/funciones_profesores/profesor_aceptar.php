<?php
include_once 'bdconexion.php';
$id_p = $_GET['mi_id'];
$q='UPDATE profesor SET status = 1 WHERE idprofesor = '.$id_p;
if(bd_consulta($q)){
  echo'<script type="text/javascript">
    alert("Campo  modificado");
    window.location.href="index.php?op=90";
    </script>';
}else {
   echo'<script type="text/javascript">
      alert("Error al modificar");
      window.location.href="index.php?op=90";
      </script>';
}

// header('Location: index.php');
 ?>
