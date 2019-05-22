<?php

function getCarreras(){//Obtiene las carreras del departamento del administrador
    require_once("bdconexion.php");
    $query = "SELECT id_carrera, nombre FROM carrera WHERE id_depto = " . $_POST['departamento']. " AND Estado = true";
    
    $sql_query = $conn->query($query);
    if($sql_query->num_rows > 0){
        while($item = $sql_query->fetch_assoc()){
            echo '<option value="'. $item['id_carrera'] .'">' . $item['nombre'] . '</option>';
        }
    }
}

function getAtributos(){//obtiene los atributos pertenecientes a la carrera seleccionada
    require_once("bdconexion.php");
    $query = "SELECT id_atributo_pk, nombre FROM atributo WHERE id_carrera = " . $_POST['carrera']. " AND Estado = true";

    $sql_query = $conn->query($query);
    if($sql_query)
    while ($item = $sql_query->fetch_assoc()){
        echo '<option value="' . $item['id_atributo_pk'] .'">' . $item['nombre'] . '</option>';
    }
}

function getMaterias(){//obtiene los atributos pertenecientes a la carrera seleccionada
    require_once("bdconexion.php");
    $query = "SELECT id_materia, Nombre FROM materia WHERE id_carrera = " . $_POST['carre']. " AND estado = true";

    $sql_query = $conn->query($query);
    if($sql_query)
    while ($item = $sql_query->fetch_assoc()){
        echo '<option value="' . $item['id_materia'] .'">' . $item['Nombre'] . '</option>';
    }
}


//-_-_-_-_-_-_--_-_-_-_-_-_--_-_-_-_-_-_--_-_-_-_-_-_--_-_-_-_-_-_-

function getProfesor(){ //Obtiene las materias de la carrera seleccionada
    require_once("bdconexion.php");
    $query = "SELECT idprofesor, nombre FROM profesores WHERE status = true";

    $sql_query = $conn->query($query);

    while ($item = $sql_query->fetch_assoc()){
        echo '<option value ="'. $item['idprofesor'] . '">' . $item['nombre'] . '</option>';
    }

}

//-_-_-_-_-_-_--_-_-_-_-_-_--_-_-_-_-_-_--_-_-_-_-_-_--_-_-_-_-_-_-

function filtroCriterios(){
    if(isset($_POST['carreraFiltro']) && $_POST['carreraFiltro']!=null ){
       getCarreraFiltro();
    }
    else{
        if(isset($_POST['nombre']) && $_POST['nombre']!="")
        {
            getNameFiltro();
        }
        else{
            if(isset($_POST['semestre']) && $_POST['semestre']!=""){
                getSemestreFiltro();
            }
            else{
                getAllAtribMat();
                
            }
        }
    }
}



function getAllAtribMat(){ //Selecciona los atrib de las mate de las carreras que pertenecen al departamento del administador
    require_once("bdconexion.php");
    $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = " . $_POST['Allatr_mat'] . ") AND matatr.Estado = true" ;
    
    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["NombreCarr"] . "</td><td>" . $row["NombreMat"] .
         "</td><td>" . $row["NombreAtr"] . "</td><td>" .
          "<button class='btn btn-default' onclick='eliminarAtribMat(". $row['Id_materia'] .",".
           $row['id_atributo_pk'] .",". $row['id_carrera'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}



function getCarreraFiltro(){//Obtiene los criterios de las carreras asociadas
    require_once("bdconexion.php");
    if(isset($_POST['nombre']) && $_POST['nombre']!="")
        {
            
            if(isset($_POST['semestre']) && $_POST['semestre']!=""){
                $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera = " . $_POST['carreraFiltro'] . " AND (a.Nombre like '%" . $_POST['nombre'] . "%' OR mat.nombre like '%" . $_POST['nombre'] . "%') AND mat.semestre  = " . $_POST['semestre']." AND matatr.Estado = true" ;
               
            }
            else{
                $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera = " . $_POST['carreraFiltro'] . " AND (a.Nombre like '%" . $_POST['nombre'] . "%' OR mat.nombre like '%" . $_POST['nombre'] . "%') AND matatr.Estado = true" ;
               }   
        }
    else{
        if(isset($_POST['semestre']) && $_POST['semestre']!=""){
            $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera  = " . $_POST['carreraFiltro'] ." AND mat.semestre  = " . $_POST['semestre'].  " AND matatr.Estado = true " ;  
            
        }
        else{
            $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera  = " . $_POST['carreraFiltro'] . " AND matatr.Estado = true" ;
    
        }
    }
    
   
    $sql_query = $conn->query($query);
    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["NombreCarr"] . "</td><td>" . $row["NombreMat"] .
         "</td><td>" . $row["NombreAtr"] . "</td><td>
          <button class='btn btn-default' onclick='eliminarAtribMat(". $row['Id_materia'] .",".
           $row['id_atributo_pk'] .",". $row['id_carrera'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

function getNameFiltro(){//Filtra los atributos por nombre o descripcion
    require_once("bdconexion.php");
    if(isset($_POST['carrera']) && $_POST['carrera']!=null)
    {
        
        if(isset($_POST['semestre']) && $_POST['semestre']!=""){
            $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera = " . $_POST['carreraFiltro'] . " AND (a.Nombre like '%" . $_POST['nombre'] . "%' OR mat.nombre like '%" . $_POST['nombre'] . "%') AND mat.semestre  = " . $_POST['semestre']." AND matatr.Estado = true" ;
           
        }
        else{
            $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera = " . $_POST['carreraFiltro'] . " AND (a.Nombre like '%" . $_POST['nombre'] . "%' OR mat.nombre like '%" . $_POST['nombre'] . "%') AND matatr.Estado = true" ;
        }   
    }
else{
    if(isset($_POST['semestre']) && $_POST['semestre']!=""){
        $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera  = (a.Nombre like '%" . $_POST['nombre'] . "%' OR mat.nombre like '%" . $_POST['nombre'] . "%') AND mat.semestre  = " . $_POST['semestre'].  " AND matatr.Estado = true " ;  
        
    }
    else{
        $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera  = (a.Nombre like '%" . $_POST['nombre'] . "%' OR mat.nombre like '%" . $_POST['nombre'] . "%') AND matatr.Estado = true" ;

    }
}
   
    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["NombreCarr"] . "</td><td>" . $row["NombreMat"] .
         "</td><td>" . $row["NombreAtr"] . "</td><td>
          <button class='btn btn-default' onclick='eliminarAtribMat(". $row['Id_materia'] .",".
           $row['id_atributo_pk'] .",". $row['id_carrera'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

function getSemestreFiltro(){
    require_once("bdconexion.php");
    
        $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE mat.semestre  = " . $_POST['semestre'].  " AND matatr.Estado = true " ;  
        
    

    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["NombreCarr"] . "</td><td>" . $row["NombreMat"] .
         "</td><td>" . $row["NombreAtr"] . "</td><td>
          <button class='btn btn-default' onclick='eliminarAtribMat(". $row['Id_materia'] .",".
           $row['id_atributo_pk'] .",". $row['id_carrera'] .")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

if(isset($_POST['departamento'])){
    getCarreras();
}
else
{
    if(isset($_POST['carrera'])){
        getAtributos();
    }
    else{
        if(isset($_POST['carre'])){
            getMaterias();
        }
        else{
            if(isset($_POST['profe'])){
                getProfesor();
            }
            else{
                filtroCriterios();
            }
        }
    }
}

?>