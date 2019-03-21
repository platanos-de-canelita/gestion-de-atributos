<?php
    require_once('bdconexion.php');
    $admin = $_SESSION['usuario'];

    $nombre = $_GET['del'];
    $nombreNuevo = $_GET['txnombre'];
    $descripcion = $_GET['txdesc'];
    if(empty($nombre)){
        echo "No existe el atributo";
    }else{
        //var $idAdmin, $idCarrera
        $sql = "CALL Info_admin ($admin,$pass, @idd_admin_pk,@idd_carrera);"
        $result = $conn->query($sql);
        $info = $result->fetch_row();
        
        $sql="CALL updateAtributo ($nombre, $nombreNuevo, $descripcion, @idd_admin_pk, @idd_carrera);"
        $conn->query($sql);
    }
?>