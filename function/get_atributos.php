<?php
    require_once('bdconexion.php');

    $sql = "SELECT id_atributo_pk, Nombre FROM atributo WHERE Estado = true";

    $sql_query = $conn->query($sql);

    while($row = $sql_query->fetch_assoc()){
        echo "<option value='".$row["id_atributo_pk"]."'>".$row["Nombre"]."</option>";
    }
?>