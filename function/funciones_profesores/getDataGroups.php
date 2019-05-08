<?php
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

function accion(){
    if($_POST['func']=="insertarGrupo" ){
       insertaGrupo();
    }
    else{
        if($_POST['func']=="insertarAlu" ){
            insertaAlu();
        }
        else{
            if($_POST['func']=="revisaGrupo" ){
                existeG();
            } 
            else{
                if($_POST['func']=="revisaAlu" ){
                    existeA();
                } 
            }
        }
    }
}

function getAlumnos(){//obtiene los atributos pertenecientes a la carrera seleccionada
    require_once("bdconexion.php");
    $query="SELECT m.Num_Control as NumC, a.Nombre as NombreA FROM materias_cursando m INNER JOIN alumno a ON m.Num_Control = a.Num_Control  WHERE m.id_materia = " . $_POST['materia'] . " AND a.Estado = true" ;
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
        $sql = "INSERT INTO grupo_alumno VALUES ($grup, $alu, true)";
        $sql_query = $conn->query($sql);

        if($sql_query){
            echo "Alumno registrado correctamente";
        }
        else
        {
            echo "Error al registrar";
        }
}





function existeG(){ //Selecciona los atrib de las mate de las carreras que pertenecen al departamento del administador
    require_once("bdconexion.php");
    $grupo=$_POST['grupo'];
    $carr=$_POST['carrera'];
    $mat=$_POST['materia'];
    $prof=$_POST['profesor'];
    
    $query="SELECT Id_grupo as id, Nombre FROM grupo_trabajo WHERE Nombre = '".$grupo."' AND Id_carrera = ".$carr." AND Id_materia = ".$mat." AND Id_profesor = ".$prof.";";
    /*
    $sql_query = $conn->query($query);
    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }
    else{
        while ($item = $sql_query->fetch_assoc()){
            $query2="UPDATE grupo_trabajo SET Estado = true WHERE Id_grupo = ".$item['id']." AND Estado = false;";
            if($conn->query($query2)){
                echo "Hecho";
            }
            else{
                echo "No dado de alta de nuevo";
            }
        }
    }
    */
    $sql_query = $conn->query($query);
    $msg=" ";
        while ($item = $sql_query->fetch_assoc()){
            $query2="UPDATE grupo_trabajo SET Estado = true WHERE Id_grupo = ".$item['id']." AND Estado = 0;";
            $sql_query2 = $conn->query($query2);
            if($sql_query2->affected_rows > 0){
                $msg= "Hecho";
            }
            else{
                $msg= "No dado de alta de nuevo";
            }
        }
        if($msg == " ")
            $msg= "Sin resultados";
        echo $msg;
}

function existeA(){ //Selecciona los atrib de las mate de las carreras que pertenecen al departamento del administador
    require_once("bdconexion.php");
    $carr=$_POST['carrera'];
    $mat=$_POST['materia'];
    $prof=$_POST['profesor'];
    $alu=$_POST['alumno'];
    $query="SELECT ga.Id_alumno FROM grupo_trabajo gt INNER JOIN grupo_alumno ga ON gt.Id_grupo = ga.Id_grupo WHERE  gt.Id_carrera = ".$carr." AND gt.Id_materia = ".$mat." AND gt.Id_profesor = ".$prof." AND ga.Id_alumno = ".$alu.";";
    $sql_query = $conn->query($query);
    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }
    else{
        echo "Ya se ha registrado este alumno a otro equipo";
    }
    
}



?>