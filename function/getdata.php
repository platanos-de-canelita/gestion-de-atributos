<?php 
    include_once "bdconexion.php";
    $atributos = [];
    try{
        if($_POST["filtro"]=='All'){
            $query = "SELECT id_atributo_pk, nombre, descripcion, ponderacion FROM atributo";
            $sql_query = $conn->query($query);
        }   
        else{
            $query = "SELECT id_atributo_pk, nombre, descripcion, ponderacion FROM atributo WHERE nombre LIKE '%" . $_POST['filtro'] . "%' OR descripcion LIKE '%" . $_POST['filtro'] ."%'";
            $sql_query = $conn->query($query);
        }
        
        if($sql_query->num_rows == 0)
            echo "Sin Atributos";

        while($row = $sql_query->fetch_assoc()){
            echo "<tr><td>" . $row["id_atributo_pk"] . "</td><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["ponderacion"] . "</td><td><button style='margin-right: 15px;' class='btn btn-default'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
        }
    }
    catch(PDOException $e){
        echo "Error: " . $e -> getMessage();
    }
 //$conn->close();
?>