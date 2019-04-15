<?php 

    /*function getAllCriterios(){ //Selecciona los criterios de las carreras que pertenecen al departamento del administador
        $query="SELECT c.id_criterio, c.nombre, c.descripcion, c.ponderacion FROM Criterios_ev c INNER JOIN atributos a ON c.id_atributo = a.id_atributo_pk WHERE a.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = " . $_POST['depto'] . ")" ;
        
        $sql_query = $conn->query($query);

        if($sql_query->num_rows == 0){
            echo "Sin resultados";
        }

        while($row = $sql_query->fetch_assoc()){
            echo "<tr><td>" . $row["id_criterio"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["ponderacion"] . "</td><td><button style='margin-right: 15px;' class='btn btn-default'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
        }
    }

    function getCarreraFiltro(){//Obtiene los criterios de las carreras asociadas
        $query="SELECT c.id_criterio, c.nombre, c.descripcion, c.ponderacion FROM Criterios_ev c INNER JOIN atributos a ON c.id_atributo = a.id_atributo_pk WHERE a.id_carrera = " . $_POST['carrera'];

        $sql_query = $conn->query($query);

        if($sql_query->num_rows == 0){
            echo "Sin resultados";
        }

        while($row = $sql_query->fetch_assoc()){
            echo "<tr><td>" . $row["id_criterio"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["ponderacion"] . "</td><td><button style='margin-right: 15px;' class='btn btn-default'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
        }
    }

    function getCarreras(){//Obtiene las carreras del departamento del administrador
        $query = "SELECT id_carrera, nombre FROM carrera WHERE id_depto = " . $_POST['depto'];

        $sql_query = $conn->query($query);

        while($item = $sql_query->fetch_assoc()){
            echo $item;
        }
    }

    function getAtributos(){//obtiene los atributos pertenecientes a la carrera seleccionada
        $query = "SELECT id_atributo_pk, nombre FROM atributos WHERE id_carrera = " . $_POST['carrera'];

        $sql_query = $conn->query($query);

        while ($item = $sql_query->fetch_assoc()){
            echo $item;
        }
    }

    function getNameFiltro(){//Filtra los atributos por nombre o descripcion
        $query = "SELECT * FROM Criterios WHERE nombre like '%" . $_POST['nombre'] . "%' OR descripcion like '%" . $_POST['descripcion'] . "%'";
        $sql_query = $conn->query($query);

        if($sql_query->num_rows == 0){
            echo "Sin resultados";
        }

        while($row = $sql_query->fetch_assoc()){
            echo "<tr><td>" . $row["id_criterio"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["ponderacion"] . "</td><td><button style='margin-right: 15px;' class='btn btn-default'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
        }
    }
*/
    include_once "bdconexion.php";
    $atributos = [];
    try{
        if($_POST["filtro"]=='All'){
            $query = "SELECT a.id_atributo_pk, a.nombre, a.descripcion, c.Nombre FROM atributo a INNER JOIN carrera c ON a.id_carrera = c.id_carrera WHERE a.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = " . $_POST['depto'] . ") AND a.Estado = true";
            $sql_query = $conn->query($query);
        }   
        else{
            $query = "SELECT a.id_atributo_pk, a.nombre, a.descripcion, c.Nombre FROM atributo a INNER JOIN carrera c ON a.id_carrera = c.id_carrera WHERE a.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = " . $_POST['depto'] . ") AND (a.nombre LIKE '%" . $_POST['filtro'] . "%' OR a.descripcion LIKE '%" . $_POST['filtro'] ."%') AND a.Estado = true";
            $sql_query = $conn->query($query);
        }
        
        if($sql_query->num_rows == 0)
            echo "Sin Atributos";

        while($row = $sql_query->fetch_assoc()){
            echo "<tr><td>" . $row["id_atributo_pk"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["Nombre"] . "</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarAtributo(\"". $row['nombre'] ."\",\"". $row['descripcion'] ."\",". $row['id_atributo_pk'] .")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='eliminarAtributo(". $row["id_atributo_pk"] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
        }
    }
    catch(PDOException $e){
        echo "Error: " . $e -> getMessage();
    }
 //$conn->close();
?>