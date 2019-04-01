<?php
  $user = $_POST['txtusuario'];
  $pass = $_POST['txtpass'];
  $cpass = $_POST['txtcpass'];
  $nombre = $_POST['txtnombre'];
  $email = $_POST['txtcorreo'];
  require_once("bdconexion.php");
  $contador=0;
  if(!empty($user)) $contador++;
  if(!empty($pass)) $contador++;
  if(!empty($cpass)) $contador++;
  if(!empty($nombre)) $contador++;
  if(!empty($email)) $contador++;

  if($contador==5){
    if($pass==$cpass){
      echo "entra";
      if($conn->query("INSERT INTO profesor (`user`,`pass`,`nombre`,`e_mail`) VALUES ('$user','$pass','$nombre','$email')")){
        header("Location: ../../profesor/login.php");
      }
    }
  }


 ?>
