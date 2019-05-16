<?php
    require_once('bdconexion.php');
    //$admin = $_SESSION['usuario'];

    $nombre = $_POST['Atributo'];
    $nombreNuevo = $_POST['Nombre'];
    $descripcion = $_POST['Descripcion'];
    if(empty($nombre)){
        echo "No existe el atributo";
    }else{
      $sql ="UPDATE atributo SET Nombre ='$nombreNuevo', Descripcion='$descripcion' WHERE id_atributo_pk='$nombre'";
      if($conn->query($sql)){
        echo "Modificacion realizada.";
      }else{
        echo "Error al modificar datos.";
      }
    }
    //var $idAdmin, $idCarrera
    /*$sql = "CALL Info_admin ($admin,$pass, @idd_admin_pk,@idd_carrera);"
    $result = $conn->query($sql);
    $info = $result->fetch_row();

    $sql="CALL updateAtributo ($nombre, $nombreNuevo, $descripcion, @idd_admin_pk, @idd_carrera);"
    $conn->query($sql);*/
?>
