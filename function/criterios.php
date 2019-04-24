<?php

function eliminar_criterio(){

  require_once("bdconexion.php");

  $id = $_POST['id'];

  if($conn->query("CALL DEL_CRITERIO($id)")){

    $msg['msg'] = "Criterio eliminado.";

    echo json_encode($msg);

  }

}

/* EMPIEZA FUNCION PARA ACTUALIZAR CRITERIO */

function actualizar_criterio(){



  require_once('bdconexion.php');



  $id = $_POST['Criterio'];

  $nuevoNombre = $_POST['Nombre'];

  $descripcion = $_POST['Descripcion'];




  if(empty($id)){

      $msg['msga'] = "Debes indicar un nombre";

      echo "Debes indicar un nombre";

  }else{

      $sql = "UPDATE criterio_ev SET Nombre = '$nuevoNombre', Descripcion = '$descripcion' WHERE id_criterio = $id";

      if($conn->query($sql)){

        $sql = "UPDATE ind_gpal SET P_Ind = ". $_POST['PonderacionI'] .", P_Gpal = " . $_POST['PonderacionG'] .", tipo = '". $_POST['tipo'] ."' WHERE id_criterio = $id";

        if($conn->query($sql)){
          $msg['msga'] = "Modificacion realizada. ";

          echo "Modificacion realizada. ";
        }
        else{
          echo "Error";
        }

      }else{

          $msg['msga'] = "Error.";

          echo "Error.";

      }

  }

} /* TERMINA FUNCION PARA ACTUALIZAR CRITERIO */

switch ($_POST['func']) {

  case 'actualizar':

  actualizar_criterio();

    break;

  case 'eliminarC':

    eliminar_criterio();

    break;

  default:

    // code...

    break;

}

?>
