<?php
function consultar_grupo(){
  require_once("bdconexion.php");
  try{
      if($_POST["filtro"]=='All'){
          $query = "SELECT Id_grupo, grupo_trabajo.Nombre AS gnombre, carrera.Nombre AS cnombre, materia.Nombre AS mnombre, profesores.nombre AS profesor FROM grupo_trabajo INNER JOIN carrera ON grupo_trabajo.Id_carrera = carrera.id_carrera INNER JOIN materia ON materia.id_materia = grupo_trabajo.Id_materia INNER JOIN profesores ON profesores.idprofesor=grupo_trabajo.Id_profesor WHERE carrera.Estado=1";
          $sql_query = $conn->query($query);
      }
      else{
          $query = "SELECT Id_grupo, Nombre, id_carrera FROM grupo_trabajo WHERE nombre LIKE '%" . $_POST['filtro'] . "%'";
          $sql_query = $conn->query($query);
      }
      if($sql_query->num_rows == 0)
          echo "Sin Grupos";
      while($row = $sql_query->fetch_assoc()){
          echo "<tr><td>" . $row["Id_grupo"] . "</td><td>" . utf8_encode($row["gnombre"]) . "</td><td>" . utf8_encode($row["cnombre"]) . "</td><td>".utf8_encode($row["mnombre"])."</td><td>".utf8_encode($row["profesor"]) . "</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarAtributo(".$row["Id_grupo"] . ")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='eliminarAtributo(".$row["Id_grupo"].")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
      }
  }
  catch(PDOException $e){
      echo "Error: " . $e -> getMessage();
  }
}
switch ($_POST['func']) {

  case 'consultar':
    consultar_grupo();
    break;
  default:
    // code...
    break;
}
 ?>
