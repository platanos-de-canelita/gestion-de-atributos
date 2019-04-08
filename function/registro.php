<?php
require_once("bdconexion.php");

  $usuario = $_POST['txtusuario'];
  $password = $_POST['txtpass'];
  $cpassword = $_POST['txtcpass'];
  if(empty($usuario)){
    header("Location: ../admin/registro.php");
    echo "Debes ingresar un usuario.";
    exit();
  }
  if(empty($password) || empty($cpassword) ){
    header("Location: ../admin/registro.php");
    echo "Debes llenar los campos de contraseña.";
    exit();
  }
  if($password==$cpassword){
    $pass_cifrado =password_hash($password, PASSWORD_DEFAULT);
    if($conn->query("INSERT INTO administrador (`usuario`,`pass`) VALUES ('$usuario','$pass_cifrado')")){
        header("Location: ../admin/login.php");
        exit();
    }
  }

?>
