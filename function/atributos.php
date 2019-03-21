<?php

function actualizar_atributo(){
  require_once("bdconexion.php");
  $nombre = $_POST['nombre'];
  $id = $_POST['id'];
  if($conn->query("UPDATE atributo SET nombre=$nombre WHERE idmateria=$id")){
    $msg['msg'] = "Atributo insertado correctamente.";
    echo json_encode($msg);
  }
}

function buscar_atributo(){
  require_once("bdconexion.php");
  $nombre = $_POST['nombre'];
  $sql = "SELECT * FROM atributo WHERE nombre LIKE '%$nombre%'";
  if ($datos = $conn->query($sql)) {
      while ($dato=$datos->fetch_assoc()) {
          $informacion=array(
            'id'=>utf8_encode($dato['id_atributo_pk']),
            'nombre'=>utf8_encode($dato['Nombre']),
            'desc'=>utf8_encode($dato['Descripcion'])
          );
          $info[]=$informacion;
      }
      echo json_encode($info);
  }
}

function eliminar_atributo(){
  require_once("bdconexion.php");
  $id=$_POST['id'];
  if($conn->query("CALL DEL_ATRIBUTO($id)")){
    $msg['msg'] = "Atributo eliminado correctamente.";
    echo json_encode($msg);
  }
}

function insertar_atributo(){
  require_once("bdconexion.php");

}

function consultar_atributo(){
  require_once("bdconexion.php");
  $info=[];
  $sql_registe=$conn->query("SELECT COUNT(*) AS total_registro FROM atributo");
  $result_register = $sql_registe->fetch_assoc();
  $total_registro = $result_register['total_registro'];

  $por_pagina = 10;
  //si no se envia una pagina en la url configuramos la busqueda en la primera pagina de resultados
  if(empty($_POST['pagina'])){
    $pagina = 1;
  }else{
    $pagina = $_POST['pagina'];
  }

  $desde = ($pagina-1) * $por_pagina;
  $total_paginas = ceil($total_registro / $por_pagina);

  $sql = "SELECT * FROM atributo WHERE Estado=1";
  if ($datos = $conn->query($sql)) {
      while ($dato=$datos->fetch_assoc()) {
          $informacion=array(
            'id'=>utf8_encode($dato['id_atributo_pk']),
            'nombre'=>utf8_encode($dato['Nombre']),
            'desc'=>utf8_encode($dato['Descripcion']),
            'estado'=>utf8_encode($dato['Estado'])
          );
          $info[]=$informacion;
      }
      echo json_encode($info);
  }
}

switch ($_POST['func']) {
  case 'buscar':
    buscar_atributo($nombre);
    break;
  case 'actualizar':
    actualizar_atributo($nombre);
    break;
  case 'eliminar':
    eliminar_atributo();
    break;
  case 'consultar':
    consultar_atributo();
    break;
  case 'insertar':
    insertar_atributo();
    break;
  default:
    // code...
    break;
}


 ?>
