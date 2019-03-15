<?php


$nombre = $_POST['nombre'];

function actualizar_atributo($nombre){
  require_once("bdconexion.php");
  $id = $_POST['id'];
  if($conn->query("UPDATE atributo SET nombre=$nombre WHERE idmateria=$id")){
    $msg['msg'] = "Atributo insertado correctamente.";
    echo json_encode($msg);
  }
}

function buscar_atributo($nombre){
  require_once("bdconexion.php");
  $sql = "SELECT * FROM atributo WHERE nombre LIKE '%$nombre%'";
  if ($datos = $conn->query($sql)) {
      while ($dato=$datos->fetch_assoc()) {
          $informacion=array(
            'sub_id'=>utf8_encode($dato['idmateria']),
            'sub_name'=>utf8_encode($dato['nombre'])
          );
          $info[]=$informacion;
      }
      echo json_encode($info);
  }
}

function eliminar_atributo(){

}

function insertar_atributo(){
  require_once("bdconexion.php");
}
function consultar_atributo(){

}

switch ($_POST['func']) {
  case 'buscar':
    buscar_atributo($nombre);
    break;
  case 'actualizar':
    actualizar_atributo($nombre);
    break;
  case 'eliminar':
    eliminar_atributo($nombre);
    break;
  case 'consultar':
    actualizar_atributo($nombre);
    break;
  case 'insertar':
    insertar_atributo($nombre);
    break;
  default:
    // code...
    break;
}


 ?>
