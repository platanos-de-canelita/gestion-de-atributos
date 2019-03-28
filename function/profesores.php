<?php
function autorizar(){
  include_once 'bdconexion.php';
  $id_p = $_POST['mi_id'];
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
}

function rechazar(){
  include_once 'bdconexion.php';
  $id_p = $_POST['mi_id'];
  $q='UPDATE profesor SET status = 0 WHERE idprofesor = '.$id_p;
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
}

function listar(){

}
// header('Location: index.php');
switch ($_POST['func']) {
  case 'autorizar':
    autorizar();
    break;
  case 'rechazar':
    rechazar();
    break;
  case 'listar':
    listar();
    break;
  default:
    // code...
    break;
}
 ?>
