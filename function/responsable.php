<?php

    function insert_responsable(){
        require_once("bdconexion.php");

        $usuario = $_POST['usuario'];
        $pass = $_POST['contraseña'];
        $id_profesor = $_POST['profesor'];
        $id_depto = $_POST['depto'];

        if($usuario == ''){
            echo "Favor de enviar un usuario";
        }
        else{
            if($pass == ''){
                echo "Ingrese una contraseña valida";
            }
            else{
                $sql = "INSERT INTO responsable VALUES (null, $id_profesor, '$usuario', '$pass', $id_depto, true)";

                if($conn->query($sql)){
                    echo "Responsable registrado con éxito";
                }
                else{
                    echo "Error al registrar";
                }
            }
        }
    }

    function select_responsable(){
        require_once('bdconexion.php');

        if(isset($_POST['nombre'])){
            $sql = "SELECT r.id_responsable, r.usuario, r.pass, p.nombre FROM responsable r INNER JOIN profesores p ON r.id_profesor = p.idprofesor WHERE r.estado = true AND p.nombre LIKE '%". $_POST['nombre'] ."%' AND id_depto = ".$_POST['depto'];
        }
        else
        {
            $sql = "SELECT r.id_responsable, r.usuario, r.pass, p.nombre FROM responsable r INNER JOIN profesores p ON r.id_profesor = p.idprofesor WHERE r.estado = true AND r.id_depto = ".$_POST['depto'];
        }

        $sql_query = $conn->query($sql);

        if($sql_query->num_rows == 0){
            echo "Sin Resultados";
        }
        else{
            while($row = $sql_query->fetch_assoc()){
                echo "<tr><td>". $row['id_responsable'] ."</td><td>". $row['nombre'] ."</td><td>". $row['usuario'] ."</td><td>". $row['pass'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarResponsable(\"". $row['usuario'] ."\", \"". $row['pass'] ."\", \"". $row['nombre'] ."\", ". $row['id_responsable'] .")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='deleteResponsable(\"". $row['nombre'] ."\", ". $row['id_responsable'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
            }
        }
    }

    function delete_responsable(){
        require_once('bdconexion.php');
        $sql = "UPDATE responsable SET estado=false WHERE id_responsable=".$_POST['id_responsable'];

        if($conn->query($sql)){
            echo "Eliminado Exitosamente";
        }
        else{
            echo "Error al eliminar";
        }
    }

    function getProfesores(){
        require_once("bdconexion.php");

        $sql = "SELECT idprofesor, nombre FROM profesores WHERE status = true";

        $sql_query = $conn->query($sql);

        if($sql_query->num_rows == 0){
            echo "<option disabled>No hay Profesores registrados</option>";
        }
        else
        {    
            while($row = $sql_query->fetch_assoc()){
                echo "<option value='". $row['idprofesor'] ."'>". $row['nombre'] ."</option>";
            }
        }
    }

    function update_responsable(){
        require_once("bdconexion.php");

        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $id = $_POST['id_responsable'];

        if($usuario == ''){
            echo "Ingrese un usuario valido";
        }
        else
        {
            if($pass == ''){
                echo "Ingrese una contraseña valida";
            }
            else
            {
                $sql = "UPDATE responsable SET usuario = '$usuario', pass = '$pass' WHERE id_responsable=$id";

                if($conn->query($sql)){
                    echo "Actualizado con éxxito";
                }
                else
                {
                    echo "Error al actualizar";
                }
            }
        }
    }

    switch($_POST['funcion'])
    {
        case 'insert':
            insert_responsable();
            break;
        case 'delete':
            delete_responsable();
            break;
        case 'select':
            select_responsable();
            break;
        case 'profesores':
            getProfesores();
            break;
        case 'update':
            update_responsable();
            break;
    }
?>