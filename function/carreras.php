<?php





function eliminar_carrera(){

  require_once("bdconexion.php");

  $id = $_POST['id'];

  if($conn->query("CALL DEL_CARRERA($id)")){

    $msg['msg'] = "Carrera eliminada.";

    echo json_encode($msg);

  }

}



switch ($_POST['func']) {

  

  case 'eliminarCarrera':

  eliminar_carrera();

    break;

  default:

    // code...

    break;

}

?>
