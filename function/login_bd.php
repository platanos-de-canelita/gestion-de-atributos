<?php
require_once("bdconexion.php");
if(isset($_POST['login'])){
    $usuario = $_POST['txtusuario'];
    $password = $_POST['txtpass'];
    $pass_cifrado =password_hash($password, PASSWORD_DEFAULT);
    if(empty($usuario) | empty($password)){
        header("Location: ../admin/login.php");
        exit();
    }
    $stm = $conn->query("CALL LOGIN('$usuario')");
    $pas = $stm->fetch_row();
    if($password == $pas[0]){
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: ../admin/index.php");
        //indica aqui la ruta a donde te redireccionara en caso que el login sea correcto
    }else{
        header("Location: ../admin/login.php");
    }
}else{

}
 ?>
