
<?php
function administrador(){
    require_once("bdconexion.php");

    $usuario = $_POST['usuario'];

    //obtengo el departamento del administrador

    $res = $conn->query("SELECT id_depto_fk FROM administrador WHERE usuario='$usuario'");
    $response = $res->fetch_row();
    echo $response[0];
}

function responsable(){
    require_once("bdconexion.php");

    $usuario = $_POST['usuario'];

    //obtengo el departamento del administrador

    $res = $conn->query("SELECT id_depto FROM responsable WHERE usuario='$usuario'");
    $response = $res->fetch_row();
    echo $response[0];
}

function profesor(){
    require_once("bdconexion.php");

    $usuario = $_POST['usuario'];

    //obtengo el departamento del administrador

    $res = $conn->query("SELECT idprofesor FROM profesores WHERE user='$usuario'");
    $response = $res->fetch_row();
    echo $response[0];
}

switch($_POST['tipo']){
    case 'Administrador':
        administrador();
        break;
    case 'Encargado':
        responsable();
        break;
    case 'Profesor':
        profesor();
        break;
}

?>
