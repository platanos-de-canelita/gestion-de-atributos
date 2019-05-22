<?php

function getCarreras(){
    require_once('../bdconexion.php');
    $id = $_POST['depto'];
    
    $sql = "SELECT id_carrera, nombre FROM carrera WHERE id_depto = $id AND Estado = 1";

    $sql_query = $conn->query($sql);

    if($sql_query->num_rows == 0){
        echo "<option disabled>No hay carreras registradas</option>";
    }else{
        while($row = $sql_query->fetch_assoc()){
            $id_carrera = $row['id_carrera'];
            $nombre = $row['nombre'];
            echo "<option value='$id_carrera'>$nombre</option>";
        }
    }
}

function getMaterias(){
    require_once('../bdconexion.php');
    $id = $_POST['depto'];
    $id_carrera = $_POST['id_carrera'];

    $sql = "SELECT id_materia, nombre FROM materia WHERE id_carrera = $id_carrera";

    $sql_query = $conn->query($sql);

    if($sql_query->num_rows == 0){
        echo "<option disabled>No hay Materias registradas</option>";
    }
    else{
        while($row = $sql_query->fetch_assoc()){
            $id_carrer = $row['id_materia'];
            $nombre = $row['nombre'];
            echo "<option value='$id_carrer'>$nombre</option>"; 
        }
    }
}

function getProfesores(){
    require_once('../bdconexion.php');
    $id_carrera = $_POST['id_carrera'];
    $id = $_POST['depto'];
    $materia = $_POST['id_materia'];

    $sql = "SELECT mp.idprofesor, p.nombre FROM materias_profesor mp INNER JOIN profesores p ON mp.idprofesor = p.idprofesor WHERE mp.id_carrera = $id_carrera AND mp.id_materia = $materia";

    $sql_query = $conn->query($sql);

    if($sql_query->num_rows == 0){
        echo "<option disabled>No hay Profesores Registrados</option>";
    }
    else{
        while($row = $sql_query->fetch_assoc()){
            $idp = $row['idprofesor'];
            $nombre = $row['nombre'];
            echo "<option value='$idp'>$nombre</option>";
        }
    }
}

function insertEval()
{
    require_once('../bdconexion.php');
    $id_carrera = $_POST['carrera'];
    $id_materia = $_POST['materia'];
    $tipo = $_POST['tipo'];

    if(isset($_POST['profesor'])){
        $id_profesor = $_POST['profesor'];
    }
    else
    {
        $id_profesor = -1;
    }

    if(($tipo == "Individual" && $id_profesor > 0) || ($tipo == "Grupal" && $id_profesor < 0))
    {    
        $sql = "INSERT INTO asig_evaluacion VALUES (null, '$tipo', $id_carrera, $id_profesor, $id_materia)";

        if($conn->query($sql)){
            echo "Evaluación registrada con éxito";
        }
        else{
            echo "Error al registrar la evaluación";
        }
    }
    else{
        echo "Error al registrar la evaluación";
    }
}

function getEvaluaciones(){
    require_once('../bdconexion.php');
    $id = $_POST['depto'];
    if(isset($_POST['carrera'])){
        $carrera = $_POST['carrera'];
        if(isset($_POST['materia'])){
            $materia = $_POST['materia'];
            $sql = "SELECT ae.id_evaluacion, c.nombre as carrera, m.nombre as materia, p.nombre as profesor, ae.tipo FROM asig_evaluacion ae left JOIN carrera c on ae.id_carrera = c.id_carrera left join profesores p on p.idprofesor = ae.id_profesor left join materia m on m.id_materia = ae.id_materia WHERE c.id_depto = $id AND c.id_carrera = $carrera AND m.id_materia = $materia";
        }
        else{
            $sql = "SELECT ae.id_evaluacion, c.nombre as carrera, m.nombre as materia, p.nombre as profesor, ae.tipo FROM asig_evaluacion ae left JOIN carrera c on ae.id_carrera = c.id_carrera left join profesores p on p.idprofesor = ae.id_profesor left join materia m on m.id_materia = ae.id_materia WHERE c.id_depto = $id AND c.id_carrera = $carrera";
        }
    }
    else{
        $sql = "SELECT ae.id_evaluacion, c.nombre as carrera, m.nombre as materia, p.nombre as profesor, ae.tipo FROM asig_evaluacion ae left JOIN carrera c on ae.id_carrera = c.id_carrera left join profesores p on p.idprofesor = ae.id_profesor left join materia m on m.id_materia = ae.id_materia WHERE c.id_depto = $id";
    }

    $sql_query = $conn->query($sql);

    if($sql_query->num_rows == 0){
        echo "Sin Resultados";
    }
    else{
        while($row = $sql_query->fetch_assoc()){
            echo "<tr><td>". $row['id_evaluacion'] ."</td><td>". $row['carrera'] ."</td><td>". $row['materia'] ."</td><td>". $row['profesor'] ."</td><td>". $row['tipo'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='deleteEval(". $row['id_evaluacion'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
        }
    }
}

function deleteEval(){
    require_once('../bdconexion.php');
    $id = $_POST['id'];

    $sql = "DELETE FROM asig_evaluacion WHERE id_evaluacion = $id";

    if($conn->query($sql)){
        echo "Eliminación Exitosa";
    }
    else{
        echo "Error al eliminar";
    }
}

switch($_POST['accion']){
    case 'Ccarrera':
        getCarreras();
        break;
    case 'Cmateria':
        getMaterias();
        break;
    case 'Cprofesor':
        getProfesores();
        break;
    case 'insert':
        insertEval();
        break;
    case 'select':
        getEvaluaciones();
        break;
    case 'delete':
        deleteEval();
        break;
}

?>