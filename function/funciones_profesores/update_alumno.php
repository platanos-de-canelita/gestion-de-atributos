<?php
function actualizar_alumno(){

    require_once('bdconexion.php');
  
    $id = $_POST['nControl']; //numero de control del alumno
  
    $nuevoNombre = $_POST['Nombre'];
    $nuevoAp_P = $_POST['Apellido_p'];
    $nuevoAp_M = $_POST['Apellido_m'];
    $nuevaEspecialidad = $_POST['Especialidad']:

    if(empty($id)){
  
        $msg['msga'] = "Debes indicar un nombre";
  
        echo "Debes indicar un nombre";
  
    }else{
  
        $sql = "UPDATE alumno SET Nombre = '$nuevoNombre', Ap_P = '$nuevoAp_P', Ap_M = '$nuevoAp_M', especialidad_id = '$nuevaEspecialidad' WHERE Num_Control = $id";
  
          if($conn->query($sql)){
            $msg['msga'] = "Modificacion realizada. ";
  
            echo "Modificacion realizada. ";
          }
          else{
            echo "Error";
          }
    }
  
  } 


  switch ($_POST['func']) {
  
    case 'actualizar':
  
      actualizar_alumno();
  
      break;
  
  }

?>