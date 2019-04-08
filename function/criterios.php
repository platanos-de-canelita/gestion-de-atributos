<?php

/* EMPIEZA FUNCION PARA ACTUALIZAR CRITERIO */
function actualizar_criterio(){

  require_once('bdconexion.php');

  $id = $_POST['Criterio'];
  $nuevoNombre = $_POST['Nombre'];
  $descripcion = $_POST['Descripcion'];
  $ponderacion = $_POST['Ponderacion'];

  if(empty($id)){
      $msg['msga'] = "Debes indicar un nombre";
      echo json_encode($msg);
  }else{
      $sql = "UPDATE criterio_ev SET Nombre = '$nuevoNombre', Descripcion = '$descripcion', ponderacion = '$ponderacion' WHERE id_criterio = '$id'";
      if($con->query($sql)){
          $msg['msga'] = "Modificacion realizada. ";
          echo json_encode($msg);
      }else{
          $msg['msga'] = "Error.";
          echo json_encode($msg);
      }
  }
} /* TERMINA FUNCION PARA ACTUALIZAR CRITERIO */

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
  $id = $_POST['id'];
  if($conn->query("CALL DEL_ATRIBUTO($id)")){
    $msg['msg'] = "Atributo eliminado.";
    echo json_encode($msg);
  }
}

function insertar_atributo(){
  require_once("bdconexion.php");


   /*$sql = "SELECT id_admin_pk FROM administador WHERE usuario = '" . $_POST['usuario'] . "'";
   $result = $conn->query($sql);
   $data = $result->fetch_row();*/

    $nombre = $_POST['nombre'];
    $desc = $_POST['descripcion'];
    $ponde = $_POST['ponderacion'];
    if(empty($nombre) || empty($desc) || empty($ponde) ){
        echo "no se puede dar de alta atributo ";
    }else{
        //var $idAdmin, $idCarrera
        $sql = "INSERT INTO atributo (id_atributo_pk, Nombre, Descripcion, Estado, Ponderacion, Admin_id, id_carrera) VALUES (NULL, '$nombre', '$desc', '1', $ponde, 1, 1)";
        $result = $conn->query($sql);
        //$info = $result->fetch_row();
        echo "Registrado correctamente";
      }
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
    actualizar_criterio();
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
