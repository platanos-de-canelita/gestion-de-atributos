<?php

function getAllDeptos(){
    require_once('bdconexion.php');

    $sql = "SELECT id_depto, nombre, logo FROM departamento WHERE Estado = true";

    $sql_query = $conn->query($sql);

    if($sql_query->num_rows == 0)
    {
        echo "Sin Resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row['nombre'] . "</td><td><img src='../image/departamentos/" . $row['logo'] . "'></td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='updateDepartamento(" . $row['id_depto'] . ", \"" . $row['nombre'] . "\", \"" . $row['logo'] . "\")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick = 'eliminarDto(". $row['id_depto'] .", \"". $row['nombre'] ."\")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

function getFiltroDepartamento(){
    require_once('bdconexion.php');

    $sql = "SELECT id_depto, nombre, logo FROM departamento WHERE nombre LIKE '%" . $_POST['deptoName'] . "%' AND Estado = true";

    $sql_query = $conn->query($sql);

    if($sql_query->num_rows == 0){
        echo "Sin Resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row['nombre'] . "</td><td><img src='../image/departamentos/" . $row['logo'] . "'></td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='updateDepartamento(" . $row['id_depto'] . ", \"" . $row['nombre'] . "\", \"" . $row['logo'] . "\")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick = 'eliminarDto(". $row['id_depto'] .", \"". $row['nombre'] ."\")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

function updateDepartamento(){
    require_once('bdconexion.php');
    $nombre = $_POST['nombre'];
    $logo = $_POST['logo'];
    $id = $_POST['id_depto'];
    $sql = "UPDATE departamento SET Nombre = '$nombre', Logo = '$logo' WHERE id_depto = ".$id.";";
    $sql_query = $conn->query($sql);
    if($sql_query){
        echo "Actualización éxitosa";
    }
    else{
        echo "Error al actualizar";
    }

}

function save_file(){
    require_once('bdconexion.php');

    //$sql = "SELECT logo FROM departamento WHERE id_depto = " . $_FILES['id_depto'];
    $file_upload = '..\\image\\departamentos\\';

    $file_name = $_FILES['archivo']['name'];

    $file_type = $_FILES['archivo']['type'];

    if($file_type != 'image/png' && $file_type != 'image/jpg'){
        echo "Archivo invalido";
    }
    else
    {
        $tmp_file = $_FILES['archivo']['tmp_name'];

        $guardado = $file_upload . $file_name;

        if(!move_uploaded_file($tmp_file, $guardado)){
            echo "Error al almacenar el logo";
        }
        else
        {
            echo "Logo almacenado con éxito";
        }
    }
}
if(!isset($_POST['accion'])){
    $_POST['accion'] = '1';
}
switch($_POST['accion']){
    case 'all':
        getAllDeptos();
        break;
    case 'filtro':
        getFiltroDepartamento();
        break;
    case 'update':
        updateDepartamento();
        break;
    default:
        save_file();
        break;
}

?>