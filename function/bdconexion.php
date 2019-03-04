<?php
    //Ingresar Servidor, usuario, contraseña, nombre de la bd
    $conn = new mysqli('localhost','root','','');
    if($conn->connect_error) {
        echo $error->$conn->connect_error;
    }
?>
