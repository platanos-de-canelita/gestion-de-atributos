<?php

function getCarreras(){//Obtiene las carreras del departamento del administrador
    require_once("bdconexion.php");
    $query = "SELECT id_carrera, nombre FROM carrera WHERE id_depto = " . $_POST['departamento']. " AND Estado = true";
    
    $sql_query = $conn->query($query);

    while($item = $sql_query->fetch_assoc()){
        echo '<option value="'. $item['id_carrera'] .'">' . $item['nombre'] . '</option>';
    }
}

function getAtributos(){//obtiene los atributos pertenecientes a la carrera seleccionada
    require_once("bdconexion.php");
    $query = "SELECT id_atributo_pk, nombre FROM atributo WHERE id_carrera = " . $_POST['carrera']. " AND Estado = true";

    $sql_query = $conn->query($query);

    while ($item = $sql_query->fetch_assoc()){
        echo '<option value="' . $item['id_atributo_pk'] .'">' . $item['nombre'] . '</option>';
    }
}

function filtroCriterios(){
    if(isset($_POST['atributoFiltro'])){
        getAtributoFiltro();
    }
    else{
        if(isset($_POST['carreraFiltro']))
        {
            getCarreraFiltro();
        }
        else{
            if(isset($_POST['Alldepto'])){
                getAllCriterios();
            }
            else{
                getNameFiltro();
                
            }
        }
    }
}

function getAllCriterios(){ //Selecciona los criterios de las carreras que pertenecen al departamento del administador
    require_once("bdconexion.php");
    $query="SELECT c.id_criterio, c.nombre, c.descripcion, a.nombre as Nombre, ig.tipo, ig.P_Ind, ig.P_Gpal FROM ind_gpal ig INNER JOIN Criterio_ev c ON ig.id_criterio = c.id_criterio INNER JOIN atributo a ON c.id_atributo = a.id_atributo_pk WHERE a.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = " . $_POST['Alldepto'] . ") AND c.Estado = true" ;
    
    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["P_Ind"] . "</td><td>" . $row["P_Gpal"] . "</td><td>". $row["Nombre"] ."</td><td>". $row['tipo'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\", \"". $row['descripcion'] ."\", \"". $row['tipo'] ."\", ". $row['P_Ind'] .", ". $row['P_Gpal'] .")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='eliminarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

function getAllCritMat(){ //Selecciona los atrib de las mate de las carreras que pertenecen al departamento del administador
    require_once("bdconexion.php");
    $query="SELECT c.id_criterio, c.nombre, c.descripcion, a.nombre as Nombre, ig.tipo, ig.P_Ind, ig.P_Gpal FROM ind_gpal ig INNER JOIN Criterio_ev c ON ig.id_criterio = c.id_criterio INNER JOIN atributo a ON c.id_atributo = a.id_atributo_pk WHERE a.id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = " . $_POST['Alldepto'] . ") AND c.Estado = true" ;
    
    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["P_Ind"] . "</td><td>" . $row["P_Gpal"] . "</td><td>". $row["Nombre"] ."</td><td>". $row['tipo'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\", \"". $row['descripcion'] ."\", \"". $row['tipo'] ."\", ". $row['P_Ind'] .", ". $row['P_Gpal'] .")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='eliminarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

function getAtributoFiltro(){
    require_once("bdconexion.php");
    $query = "SELECT c.id_criterio, c.nombre, c.descripcion, a.nombre as Nombre, ig.tipo, ig.P_Ind, ig.P_Gpal FROM ind_gpal ig INNER JOIN Criterio_ev c ON ig.id_criterio = c.id_criterio INNER JOIN atributo a ON c.id_atributo = a.id_atributo_pk WHERE a.id_carrera = ". $_POST['carreraFiltro'] ." AND c.id_atributo = ". $_POST['atributoFiltro'] ." AND ( c.nombre like '%". $_POST['nombre'] . "%' OR c.descripcion like '%". $_POST['nombre'] . "%') AND c.Estado = true";

    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["P_Ind"] . "</td><td>" . $row["P_Gpal"] . "</td><td>". $row['Nombre'] ."</td><td>". $row['tipo'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\", \"". $row['descripcion'] ."\", \"". $row['tipo'] ."\", ". $row['P_Ind'] .", ". $row['P_Gpal'] .")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='eliminarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

function getCarreraFiltro(){//Obtiene los criterios de las carreras asociadas
    require_once("bdconexion.php");
    $query="SELECT c.id_criterio, c.nombre, c.descripcion, a.nombre as Nombre, ig.tipo, ig.P_Ind, ig.P_Gpal FROM ind_gpal ig INNER JOIN Criterio_ev c ON ig.id_criterio = c.id_criterio INNER JOIN atributo a ON c.id_atributo = a.id_atributo_pk WHERE a.id_carrera = " . $_POST['carreraFiltro'] . " AND (c.nombre like '%" . $_POST['nombre'] . "%' OR c.descripcion like '%" . $_POST['nombre'] . "%') AND c.Estado = true";

    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["P_Ind"] . "</td><td>" . $row["P_Gpal"] . "</td><td>". $row['Nombre'] ."</td><td>". $row['tipo'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\", \"". $row['descripcion'] ."\", \"". $row['tipo'] ."\", ". $row['P_Ind'] .", ". $row['P_Gpal'] .")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='eliminarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
    }
}

function getNameFiltro(){//Filtra los atributos por nombre o descripcion
    require_once("bdconexion.php");
    $query = "SELECT c.id_criterio, c.nombre, c.descripcion, a.nombre as Nombre, ig.tipo, ig.P_Ind, ig.P_Gpal FROM ind_gpal ig INNER JOIN Criterio_ev c ON ig.id_criterio = c.id_criterio INNER JOIN atributo a ON c.id_atributo = a.id_atributo_pk WHERE c.nombre like '%" . $_POST['nombre'] . "%' OR c.descripcion like '%" . $_POST['nombre'] . "%' AND id_carrera IN (SELECT id_carrera FROM carrera WHERE id_depto = " . $_POST['depto'] . ") AND c.Estado = true";
    $sql_query = $conn->query($query);

    if($sql_query->num_rows == 0){
        echo "Sin resultados";
    }

    while($row = $sql_query->fetch_assoc()){
        echo "<tr><td>" . $row["nombre"] . "</td><td>" . $row["descripcion"] . "</td><td>" . $row["P_Ind"] . "</td><td>" . $row["P_Gpal"] . "</td><td>". $row['Nombre'] ."</td><td>". $row['tipo'] ."</td><td><button style='margin-right: 15px;' class='btn btn-default' onclick='modificarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\", \"". $row['descripcion'] ."\", \"". $row['tipo'] ."\", ". $row['P_Ind'] .", ". $row['P_Gpal'] .")'><span style='color: rgb(27, 57, 106);'><i class='fas fa-pencil-alt'></i></span></button><button class='btn btn-default' onclick='eliminarCriterio(". $row['id_criterio'] .", \"". $row['nombre'] ."\")'><span style='color:red;'><i class='fas fa-trash-alt'></i></span></button></td></tr>";
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
        filtroCriterios();
    }
}

?>