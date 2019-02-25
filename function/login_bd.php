<?php
  require_once('bdconexion.php');
  if(isset($_POST['login'])) {
    $usuario = $_POST['txtusuario'];
    $pass = $_POST['txtpass'];
    if(empty($usuario) | empty($pass)){
      header("Location: ../admin/login.php");
      exit();
    }
    $sql = mysqli_query($conn,"SELECT * FROM administrador WHERE user = '$usuario' and pass ='$pass'");
    if($row = mysqli_fetch_array($sql)){
      session_start();
      $_SESSION['usuario'] = $usuario;
      //indica aqui la ruta a donde te redireccionara en caso que el login sea correcto
      header("Location: ../admin/index.php");
    }else{
      header("Location: ../admin/login.php");
    }
  }
 ?>
