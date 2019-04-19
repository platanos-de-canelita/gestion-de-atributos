<?php
    function get_carreras(){
        require_once('bdconexion.php');

        if(isset($_POST['carrera'])){
            $sql = "SELECT c.id_carrera, c.nombre, d.nombre AS departamento FROM carrera c INNER JOIN departamento d ON c.id_depto = d.id_depto WHERE d.id_depto = " . $_POST['id_depto'] ." AND c.nombre LIKE '%".$_POST["carrera"]."%' AND c.Estado = true";
        }
        else
        { 
            $sql = "SELECT c.id_carrera, c.nombre, d.nombre AS departamento FROM carrera c INNER JOIN departamento d ON c.id_depto = d.id_depto WHERE d.id_depto = " . $_POST['id_depto'] . " AND c.Estado = true";
        }

        $sql_query = $conn->query($sql);

        if($sql_query->num_rows == 0){
            echo "Sin Resultados";
        }

        while($row = $sql_query->fetch_assoc()){
            echo "<tr><td>". $row['nombre'] ."</td><td>". $row['departamento'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='updateCarrera(" . $row['id_carrera'] . ", \"" . $row['nombre'] . "\")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button></td></tr>";
        }
    }

    function insert_carrera(){
        require_once('bdconexion.php');
        $carrera = $_POST['carrera_insert'];
        $id = $_POST['id_depto'];
        $sql = "INSERT INTO carrera VALUES (null, '$carrera', $id, true)";

        $sql_query = $conn->query($sql);

        if($sql_query){
            echo "Carrera registrada correctamente";
        }
        else
        {
            echo "Error al registrar";
        }
    }

    function update_carrera(){
        require_once('bdconexion.php');
        $carrera = $_POST['txnombreCarrera'];
        $id = $_POST['id_carrera'];

        $sql = "UPDATE carrera SET nombre = '$carrera' WHERE id_carrera = $id";

        if($conn->query($sql)){
            echo "Modificación Exitosa";
        }
        else
        {
            echo "Error al modificar";
        }
    }

    switch($_POST['accion']){
        case 'select':
            get_carreras();
            break;
        case 'insert':
            insert_carrera();
            break;
        case 'update':
            update_carrera();
            break;
        case 'delete':
            break;
    }
?>