<?php

function update_carrera(){
    require_once('bdconexion.php');
    
    $id = $_POST['id_grupo'];
    $carrera = $_POST['modifCarrera'];
    $nombre = $_POST['txnombreGrupo'];
    $materia = $_POST['modifMateria'];

    $idC = "";
    $idM = "";

    // Obtengo id de la carrera
    $query = "SELECT id_carrera WHERE Nombre = '$carrera'";
    $sql_query = $conn->query($query);
    while($row = $sql_query->fetch_assoc()){
        $idC = $row['id_carrera'];
    }
    
    // Obtengo el id de la materia
    $query2 = "SELECT id_materia WHERE Nombre = '$materia'";
    $sql_query = $conn->query($query2);
    while($row = $sql_query->fetch_assoc()){
        $idM = $row['id_materia'];
    }


    // Consulta donde se actualizan los datos
    $sql = "UPDATE grupo_trabajo SET Nombre = '$nombre', Id_carrera = $idC, Id_materia = $idM WHERE id_grupo = $id";
    if($conn->query($sql)){
        echo "Modificación Exitosa";
    }
    else
    {
        echo "Error al modificar";
    }
}

switch($_POST['accion']){
    case 'update':
        update_carrera();
        break;
    case 'delete':
        break;
}
?>