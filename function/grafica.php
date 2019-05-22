<?php

require_once('bdconexion.php');

$Generacion = $_POST['generacion'];
$id = $_POST['depto'];

$sql = "SELECT a.nombre, AVG(c.calificacion) as promedio, mat.semestre FROM carrera cr INNER JOIN atributo a ON cr.id_carrera = a.id_carrera INNER JOIN criterio_ev cv ON cv.id_atributo = a.id_atributo_pk INNER JOIN Calificaciones c ON cv.id_criterio = c.id_criterio INNER JOIN materia mat ON c.id_materia = mat.id_materia WHERE c.numControl like '$Generacion%' AND cr.id_depto = $id GROUP BY a.nombre, mat.semestre";

$sql_query = $conn->query($sql);

if($sql_query->num_rows == 0){
    echo '';
}
else{
    $response = array();
    while($row = $sql_query->fetch_assoc()){
        $response['atributos'][] = $row;
    }
    echo json_encode($response);
}
?>

