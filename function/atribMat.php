<?php
function verifE(){
  require_once("bdconexion.php");

    $materia = $_POST['materia'];
    $atributo = $_POST['atributo'];
    $carrera = $_POST['carrera'];

    $query = "SELECT Id_atributo, Id_materia, Id_carrera FROM materia_atributos WHERE Id_atributo = " . $atributo . " AND Id_materia = ".$materia. " AND Id_carrera = ".$carrera. " AND Estado = false";
    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }
    else{
      $sql = "UPDATE materia_atributos SET Estado = true WHERE Id_materia = ". $materia." AND Id_carrera = ".$carrera." AND Id_atributo = ".$atributo;
      $sql_query = $conn->query($sql);
  
      if($sql_query){
        echo "Se dio de alta un atributo existente";
      }
      else{
        echo "Error";
      }
    }
    
}

function eliminar_criterio(){

  require_once("bdconexion.php");

  $idM = $_POST['idM'];
  $idA = $_POST['idA'];
  $idC = $_POST['idC'];

  if($conn->query("CALL DEL_ATRIMAT($idM,$idA,$idC)")){

    $msg['msg'] = "Atributo eliminado.";

    echo json_encode($msg);

  }

}

/* EMPIEZA FUNCION PARA ACTUALIZAR CRITERIO */


switch ($_POST['func']) {

  case 'eliminarC':

    eliminar_criterio();

    break;
  case 'verifE':

    verifE();

  break;

  default:

    // code...

    break;

}

?>
