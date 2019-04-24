<?php
    function loginAdmin(){
        require_once("bdconexion.php");
        $usuario = $_POST['txtusuario'];
        $password = $_POST['txtpass'];
        $pass_cifrado =password_hash($password, PASSWORD_DEFAULT);
        if(empty($usuario) | empty($password)){
            echo "0";
            //header("Location: ../admin/login.php");
            exit();
        }
        $stm = $conn->query("CALL LOGIN('$usuario')");
        $pas = $stm->fetch_row();
        if($password == $pas[0]){
            session_start();
            $_SESSION['usuario'] = $usuario;
            //echo "1";
            echo '../admin/index.php';
            
            //indica aqui la ruta a donde te redireccionara en caso que el login sea correcto
        }else{
            echo "0";
            //header("Location: ../admin/login.php");
        }
    }

    function loginEncar(){
        require_once("bdconexion.php");
        $usuario = $_POST['txtusuario'];
        $password = $_POST['txtpass'];

        if(empty($usuario) | empty($password)){
            echo "0";
            exit();
        }
        
        $stm = $conn->query("CALL LOGINE('$usuario')");
        $pass = $stm->fetch_row();
        if($password == $pass[0]){
            session_start();
            $_SESSION['usuario'] = $usuario;
            echo '../admin/index.php';
        }else{
            echo "0";
        }
    }

    function loginProf(){
        require_once("bdconexion.php");
        $usuario = $_POST['txtusuario'];
        $password = $_POST['txtpass'];

        if(empty($usuario) | empty($password)){
            echo "0";
            exit();
        }
        
        $stm = $conn->query("CALL LOGINP('$usuario')");
        $pass = $stm->fetch_row();
        if($password == $pass[0]){
            session_start();
            $_SESSION['usuario'] = $usuario;
            echo '../admin/index.php';
        }else{
            echo "0";
        }
    }

    switch($_POST['tipoU']){
        case 'Administrador':
            loginAdmin();
            break;
        case 'Encargado':
            loginEncar();
            break;
        case 'Profesor':
            loginProf();
            break;   
    }
 ?>
