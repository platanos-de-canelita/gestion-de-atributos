<?php

function getCarreras(){
    require_once("bdconexion.php");
    $query = "SELECT id_carrera, nombre FROM carrera WHERE id_depto = " . $_POST['departamento']. " AND Estado = true";
    
    $sql_query = $conn->query($query);

    while($item = $sql_query->fetch_assoc()){
        echo '<option value="'. $item['id_carrera'] .'">' . $item['nombre'] . '</option>';
    }
}

function getMaterias(){
    require_once("bdconexion.php");
    $query = "SELECT id_materia, Nombre FROM materia WHERE id_carrera = " . $_POST['carre']. " AND estado = true";

    $sql_query = $conn->query($query);

    while ($item = $sql_query->fetch_assoc()){
        echo '<option value="' . $item['id_materia'] .'">' . $item['Nombre'] . '</option>';
    }
}

function getProfesor(){ //Obtiene las materias de la carrera seleccionada
    require_once("bdconexion.php");
    $query = "SELECT idprofesor, nombre FROM profesores WHERE status = true";

    $sql_query = $conn->query($query);

    while ($item = $sql_query->fetch_assoc()){
        echo '<option value ="'. $item['idprofesor'] . '">' . $item['nombre'] . '</option>';
    }

}


function insertar_profMate(){
    require_once("bdconexion.php");
  
      $materia = $_POST['materia'];
      $carrera = $_POST['carrera'];
      $profesor = $_POST['profesor'];
  
  
      $sql ="INSERT INTO profesor_materia (Id_carrera, Id_materia, Id_profesor, Estado) VALUES ($carrera, '$materia',  '$profesor','1')"; 
      $result = $conn->query($sql);
      if($result){
          echo "Registrado correctamente";
      }
      else{
          echo "Error al registrar";
      }
  }


  function filtroprofe_materia(){
    if(isset($_POST['carreraFiltroProf']) && $_POST['carreraFiltroProf']!=null ){
        getCarreraFiltro();
    }else{
        if(isset($_POST['nombreMat']) && $_POST['nombreMat'] != null){
            getMateriaFiltro();
        }else{
            getAllProfeMat();
        }
    }
  }


  function getCarreraFiltro(){
    require_once("bdconexion.php");
    if(isset($_POST['nombreMat']) && $_POST['nombreMat']!="")
        {

            $query = "SELECT profmat.Id_materia, mat.Nombre as NombreMat, c.id_carrera, c.Nombre as NombreCarr, p.idprofesor, p.nombre as Nombreprof FROM profesor_materia profmat INNER JOIN carrera c ON profmat.Id_carrera = c.id_carrera INNER JOIN profesores p ON profmat.Id_profesor = p.idprofesor INNER JOIN materia mat ON profmat.Id_materia = mat.id_materia WHERE c.id_carrera = " . $_POST['carreraFiltroProf'] . " AND (mat.Nombre like '%" . $_POST['nombreMat'] . "%' OR p.nombre like '%" . $_POST['nombreMat'] . "%') AND profmat.Estado = true" ;


        }
    else{

            $query = "SELECT profmat.Id_materia, mat.Nombre as NombreMat, c.id_carrera, c.Nombre as NombreCarr, p.idprofesor, p.nombre as Nombreprof FROM profesor_materia profmat INNER JOIN carrera c ON profmat.Id_carrera = c.id_carrera INNER JOIN profesores p ON profmat.Id_profesor = p.idprofesor INNER JOIN materia mat ON profmat.Id_materia = mat.id_materia WHERE c.id_carrera = " . $_POST['carreraFiltroProf'] . " AND profmat.Estado = true" ;
    }

    $sql_query = $conn->query($query);
    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["NombreCarr"] . "</td><td>" . $row["Nombreprof"] .
         "</td><td>" . $row["NombreMat"] . "</td><td>
          <button class='btn btn-default' onclick='eliminarProfMat(". $row['Id_materia'] .",".
           $row['idprofesor'] .",". $row['id_carrera'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }

  }
  
  function getMateriaFiltro(){//Filtra las materias
    require_once("bdconexion.php");
    if(isset($_POST['carrera']) && $_POST['carrera']!=null)
    {

        $query="SELECT profmat.Id_materia, mat.Nombre as NombreMat, c.id_carrera, c.Nombre as NombreCarr, p.idprofesor, p.nombre as NombreProfe FROM profesor_materia profmat INNER JOIN carrera c ON profmat.Id_carrera = c.id_carrera INNER JOIN profesores p ON profmat.Id_profesor = p.idprofesor INNER JOIN materia mat ON profmat.Id_materia = mat.id_materia WHERE c.id_carrera = " . $_POST['carreraFiltroProf'] . " AND (p.nombre like '%" . $_POST['nombreMat'] . "%' OR mat.Nombre like '%" . $_POST[nombreMat] . "%') AND profmat.Estado = true" ;
    }
else{

        $query="SELECT profmat.Id_materia, mat.Nombre as NombreMat, c.id_carrera, c.Nombre as NombreCarr, p.idprofesor, p.nombre as NombreProfe FROM profesor_materia profmat INNER JOIN carrera c ON profmat.Id_carrera = c.id_carrera INNER JOIN profesores p ON profmat.Id_profesor = p.idprofesor INNER JOIN materia mat ON profmat.Id_materia = mat.id_materia WHERE c.id_carrera = (p.nombre like '%" . $_POST['nombreMat'] . "%' OR mat.Nombre like '%" . $_POST['nombreMat'] . "%') AND profmat.Estado = true" ;
       
    }
   
    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["NombreCarr"] . "</td><td>" . $row["NombreProfe"] .
         "</td><td>" . $row["NombreMat"] . "</td><td>
          <button class='btn btn-default' onclick='eliminarProfbMat(". $row['id_materia'] .",".
           $row['idprofesor'] .",". $row['id_carrera'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}


function getAllProfeMat(){ 
    require_once("bdconexion.php");

    $query = "SELECT profmat.Id_materia, mat.Nombre as NombreMat, c.id_carrera, c.Nombre as NombreCarr, p.idprofesor, p.nombre as NombreProfe FROM profesor_materia profmat INNER JOIN carrera c ON profmat.Id_carrera = c.id_carrera INNER JOIN profesor p ON profmat.Id_profesor = p.idprofesor INNER JOIN materia mat ON profmat.Id_materia = mat.id_materia WHERE c.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = " . $_POST['Allprof_mat'] . ") AND profmat.Estado = true" ;
    
    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["NombreCarr"] . "</td><td>" . $row["NombreProfe"] .
         "</td><td>" . $row["NombreMat"] . "</td><td>
          <button class='btn btn-default' onclick='eliminarProfMat(". $row['Id_materia'] .",".
           $row['idprofesor'] .",". $row['id_carrera'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}



  function eliminar_profMate(){

    require_once("bdconexion.php");
  
    $idC = $_POST['idC'];
    $idM = $_POST['idM'];
    $idP = $_POST['idP'];


  
    if($conn->query("CALL DEL_PROFMAT($idC,$idM,$idP)")){
  
      $msg['msg'] = "Atributo eliminado.";
  
      echo json_encode($msg);
  
    }
  
  }



  if(isset($_POST['departamento'])){
    getCarreras();
}else{
    if(isset($_POST['Allprof_mat'])){
        filtroprofe_materia();
    }else{
        if(isset($_POST['carre'])){
            getMaterias();
        }else{
            if(isset($_POST['profe'])){
                getProfesor();
            }else{
                filtroprofe_materia();
            }
        }
    }
}
  
  ?>