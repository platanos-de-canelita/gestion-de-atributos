<?php
function actualizar_criterio(){

 
}

function eliminar_criterio(){
  require_once("bdconexion.php");
  $id = $_POST['id'];
  if($conn->query("CALL DEL_CRITERIO($id)")){
    $msg['msg'] = "Criterio eliminado.";
    echo json_encode($msg);
  }
}

switch ($_POST['func']) {
  case 'actualizar':
    actualizar_atributo();
    break;
  case 'eliminarC':
    eliminar_criterio();
    break;
  default:
    // code...
    break;
}
?>
