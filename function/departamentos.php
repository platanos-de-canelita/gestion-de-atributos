<?php


function eliminar_departamento(){
  require_once("bdconexion.php");

  $id = $_POST['id'];

  if($conn->query("CALL DEL_DEPARTAMENTO($id)")){
    $msg['msg'] = "Departamento eliminado.";
    echo json_encode($msg);
  }

}



switch ($_POST['func']) {

  case 'eliminarDto':
    eliminar_departamento();
  break;

  default:
    // code...
  break;

}

?>
