<?php

function getAlumnos(){//obtiene los atributos pertenecientes a la carrera seleccionada
    require_once("bdconexion.php");
    $query="SELECT m.Num_Control as NumC, a.Nombre as NombreA FROM materias_cursando m INNER JOIN alumno a ON m.Num_Control = c.id_carrera  WHERE m.id_materia = " . $_POST['materia'] . " AND a.Estado = true" ;
    $sql_query = $conn->query($query);
    if($sql_query)
    while ($item = $sql_query->fetch_assoc()){
        echo '<option value="' . $item['NumC'] .'">' . $item['NombreA'] . '</option>';
    }
}

function getGrupos(){//obtiene los atributos pertenecientes a la carrera seleccionada
    require_once("bdconexion.php");
    $query = "SELECT Id_grupo, Nombre FROM grupo_trabajo WHERE Id_materia = " . $_POST['materiag']. " AND Estado = true";

    $sql_query = $conn->query($query);
    if($sql_query)
    while ($item = $sql_query->fetch_assoc()){
        echo '<option value="' . $item['Id_grupo'] .'">' . $item['Nombre'] . '</option>';
    }
}

function insertaGrupo(){//obtiene los atributos pertenecientes a la carrera seleccionada
    require_once("bdconexion.php");
    //$sql = "INSERT INTO grupo_trabajo VALUES (null, '$_POST['grupo']', $_POST['carrera'], $_POST['materia'], $_POST['profesor'], true)";
    $grupo=$_POST['grupo'];
    $carr=$_POST['carrera'];
    $mat=$_POST['materia'];
    $prof=$_POST['profesor'];
    $sql = "INSERT INTO grupo_trabajo VALUES (null, '$grupo', $carr, $mat, $prof, true)";
    $sql_query = $conn->query($sql);
    if($sql_query){
        echo "Grupo de trabajo registrado correctamente";
    }
    else
    {
        echo "Error al registrar";
    }
}
function insertaAlu(){//obtiene los atributos pertenecientes a la carrera seleccionada
    require_once("bdconexion.php");
        //$sql = "INSERT INTO grupo_alumno VALUES ($_POST['grupo'], $_POST['alumno'])";
        $grup=$_POST['grupo'];
        $alu=$_POST['alumno'];
        $sql = "INSERT INTO grupo_alumno VALUES ($grup, $alu)";
        $sql_query = $conn->query($sql);

        if($sql_query){
            echo "Alumno registrado correctamente";
        }
        else
        {
            echo "Error al registrar";
        }
}

function accion(){
    if($_POST['func']=="insertarGrupo" ){
       insertaGrupo();
    }
    else{
        if($_POST['func']=="insertarAlu" ){
            insertaAlu();
        }
    }
}


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
    $query="SELECT matatr.Id_materia, mat.Nombre as NombreMat, c.id_carrera,c.Nombre as NombreCarr, a.id_atributo_pk, a.Nombre as NombreAtr FROM materia_atributos matatr INNER JOIN carrera c ON matatr.Id_carrera = c.id_carrera INNER JOIN atributo a ON matatr.Id_atributo = a.id_atributo_pk INNER JOIN materia mat ON matatr.Id_materia = mat.id_materia WHERE c.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_materia = " . $_POST['materia'] . ") AND matatr.Estado = true" ;
    
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


if(isset($_POST['func'])){
    accion();
}
else{
        if(isset($_POST['materia'])){
            getAlumnos();
        }
        else{
            if(isset($_POST['materiag'])){
                getGrupos();
            }
            else{
               // filtroCriterios();
            }
        }
   
}
?>