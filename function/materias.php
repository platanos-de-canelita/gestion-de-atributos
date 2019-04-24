<?php

    function insert_materia(){
        require_once("bdconexion.php");
    
        $nombre = $_POST['nombreM'];
        $carrera = $_POST['carrera'];
        
        $sql = "INSERT INTO materia VALUES (null, '$nombre', $carrera, true)";

        if($conn->query($sql)){
            echo "Materia Registrada con éxito";
        }
        else{
            echo "Error al registrar";
        }
    }

    function delete_materia(){
        require_once("bdconexion.php");
        $sql = "UPDATE materia SET estado = false WHERE id_materia = " . $_POST['id_materia'];

        if($conn->query($sql)){
            echo "Eliminación exitosa";
        }
        else{
            echo "Error al eliminar";
        }
    }

    function select_materia(){
        require_once("bdconexion.php");
        if(isset($_POST['nombre'])){
            if(isset($_POST['carrera'])){
                $sql = "SELECT m.id_materia, m.nombre, c.nombre as carrera FROM materia m INNER JOIN carrera c ON m.id_carrera = c.id_carrera WHERE m.nombre LIKE '%". $_POST['nombre'] ."%' AND m.id_carrera = ". $_POST['carrera'] ." AND c.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = ".$_POST['depto'].") AND m.estado = true";
            }
            else{
                $sql = "SELECT m.id_materia, m.nombre, c.nombre as carrera FROM materia m INNER JOIN carrera c ON m.id_carrera = c.id_carrera WHERE m.nombre LIKE '%". $_POST['nombre'] ."%' AND c.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = ".$_POST['depto'].") AND m.estado = true";
            }
        }
        else{
            $sql = "SELECT m.id_materia, m.nombre, c.nombre as carrera FROM materia m INNER JOIN carrera c ON m.id_carrera = c.id_carrera WHERE c.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = ".$_POST['depto'].") AND m.estado = true";
        }

        $sql_query = $conn->query($sql);

        if($sql_query->num_rows == 0){
            echo "Sin Resultados";
        }
        
        while($row = $sql_query->fetch_assoc()){
            echo "<tr><td>". $row['id_materia'] ."</td><td>". $row['nombre'] ."</td><td>". $row['carrera'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarMateria(". $row['id_materia'] .", \"". $row['nombre'] ."\")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='eliminarMateria(". $row['id_materia'] .", \"". $row['nombre'] ."\")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
        }

    }
    

    function update_materia(){
        require_once("bdconexion.php");
        $sql = "UPDATE materia SET nombre = \"" . $_POST['nombre'] . "\" WHERE id_materia = " . $_POST['id_materia'];

        if($conn->query($sql)){
            echo "Actualización exitosa";
        } 
        else{
            echo "Error al actualizar";
        }
    }

    switch($_POST['funcion']){
        case 'insert':
            insert_materia();
            break;
        case 'select':
            select_materia();
            break;
        case 'delete':
            delete_materia();
            break;
        case 'update':
            update_materia();
            break;
    }
?>