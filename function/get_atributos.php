<?php
 require_once("bdconexion.php");
 try{

     $query = "SELECT id_atributo_pk, nombre FROM atributo WHERE Estado=1";
     $sql_query = $conn->query($query);

     if($sql_query->num_rows == 0)
         echo "Sin Atributos";

     while($row = $sql_query->fetch_assoc()){
         echo "<option value='".$row["id_atributo_pk"]."'>" . utf8_encode($row["nombre"]) . "</option>";
     }
 }
 catch(PDOException $e){
     echo "Error: " . $e -> getMessage();
 }

 ?>
