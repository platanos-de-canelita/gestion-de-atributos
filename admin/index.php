<?php

  //reanuda la sesion
  session_start();
  //valida si la sesion esta activa
  if (session_status() === PHP_SESSION_ACTIVE && $_SESSION['usuario']!="") {
    $session_value=$_SESSION['usuario'];
  }else{
  	header("Location: login.php");
  	exit();
  }



 ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

     <link rel="stylesheet" href="../css/main.css">
     <script src="../js/admin/admin.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

     <title>Administración</title>

 </head>

 <body style="background: #f8f8f8">

     <!--Barra superior-->
     <div style="background: rgb(27, 57, 106); height: 4em; display: flex; justify-content: center; align-items: center;">
         <h1 style="color:#f8f8f8">Administración</h1>
     </div>

     <!--Navegacion de secciones-->
     <ul class="nav nav-tabs sticky-top" id="myTab" role="tablist" style="background: #f0f0f0;">
         <li class="nav-item">
             <a class="nav-link active list-group-item-action" id="atributos-tab" data-toggle="tab" href="#atributos"
                 role="tab" aria-controls="home" aria-selected="false">Atributos</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="criterios-tab" data-toggle="tab" href="#criterios"
                 role="tab" aria-controls="profile" aria-selected="false">Criterios</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="profesores-tab" data-toggle="tab" href="#profesores"
                 role="tab" aria-controls="profile" aria-selected="false">Profesores</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="departamentos-tab" data-toggle="tab" href="#departamentos"
                 role="tab" aria-controls="profile" aria-selected="false">Departamentos</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="carreras-tab" data-toggle="tab" href="#carreras"
                 role="tab" aria-controls="profile" aria-selected="false">Carreras</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="informes-tab" data-toggle="tab" href="#informes"
                 role="tab" aria-controls="profile" aria-selected="false">Estadísticas</a>
         </li>
         <li class="nav-item"><a class="nav-link list-group-item-action" href='../function/cerrar.php'>Salir</a></li>
     </ul>

     <!--seccion de gestion-->

     <div class="tab-content" id="myTabContent" style="margin-top:1em;">

     <div class="tab-content" id="myTabContent" style="margin-top:1em; margin-left: 2em; margin-right: 2em;">
         <!--Seccion de proyectos-->

         <div class="tab-pane fade show active" id="atributos" role="tabpanel" aria-labelledby="atributos-tab">
             <div class="row">
                 <div class="col-lg-3">
                   <form class="formulario" id="form" >
                    <p>Agregar atributo: </p>
                    <input type="text" class="form-control" name="nombre" value="" placeholder="Nombre"><br><br>
                    <input type="text" class="form-control" name="descripcion" value="" placeholder="Descripción"><br><br>
                    <select id="carreras_atributo" style="margin-left: 0px !important" name="carreraFiltro" class="form-control mx-sm-3">
                      <option disabled selected>Selecciona una carrera</option>
                    </select>
                    <br>
                    <button id="btn_atrib" class="btn" onclick="insertarAtributo()">Agregar</button>
                   </form>
                   
                 </div>
                 <div class="col-lg-9">
                     <form class="form-inline" id="Atributos">
                         <div class="form-group" style="margin:1%;">
                             <label for="in_palabra_proyecto">Filtros:</label>
                             <input id="in_palabra_proyecto" name="filtro" type="text" placeholder="buscar" class="form-control mx-sm-3">
                             <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3" onclick="getAtributos(/*departamento*/);">Buscar</button>
                             <button id="btn_ver_todos" type="button" class="form-control mx-sm-3" onclick="getAllAtributos(/*departamento*/);">Ver todos</button>
                         </div>
                     </form>
                     <br>
                     <table class="table" id="tabla_atributos">
                        <thead>
                          <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                          </tr>
                        </thead>
                        <tbody >
                          
                        </tbody>
                      </table>
                      <div class="paginador">
                        <ul id="paginas" style="list-style: none; ">

                          <!--<li><a href="#">|<<</a></li>
                          <li><a href="#"><<</a></li>
                          <li class="pageSelected">1</li>

                          <li><a href="#">>></a></li>
                          <li><a href="#">>>|</a></li>-->
                        </ul>
                      </div>
                 </div>
             </div>
             <div class="container" style="margin-top:1em;">
                 <div id="contenedor_proyectos" class="row">

                 </div>
             </div>
         </div>

         <!--Seccion de investigadores-->
         <div class="tab-pane fade" id="criterios" role="tabpanel" aria-labelledby="criterios-tab">
           <div class="row">
               <div class="col-lg-3">
                 <form class="formulario" id="formcrit">
                 <p>Agregar criterios: </p>
                   <input type="text" min="0" max="100" class="form-control" name="Nombre" placeholder="Nombre">
                   <br><br>
                   <select id="atrib" class="form-control" name="atributo">
                     <option value="">Atributo</option>

                   </select>
                   <br><br>

                   <select class="form-control" name="tipo" id="opc">
                     <option value="individual/grupal">Individual/Grupal</option>
                     <option value="Individual">Individual</option>
                     <option value="Grupal">Grupal</option>
                    
                   </select>
                   <br><br>
                   <input type="number" min="0" max="100" class="form-control" id="PonderaciónIndividual" name="ponderacionI" placeholder="Ponderación Individual " >
                   <br><br>
                   <input type="number" min="0" max="100" class="form-control" id="PonderaciónGrupal" name="ponderacionG" placeholder="Ponderación Grupal" >
                   <br><br>
                   <input type="text" min="0" max="100" class="form-control" name="Descripción" placeholder="Descripción">
                   <br><br>
                 </form>
                 <button class="btn" name="login" onclick="revisacrit()">Agregar</button>
               </div>
               <div class="col-lg-9">
                   <form id="criterios_form" class="form-inline">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <input id="in_palabra_proyecto" type="text" placeholder="buscar" name="nombre" class="form-control mx-sm-3">
                           <select id="carreras_criterio" name="carreraFiltro" class="form-control mx-sm-3">
                            <option disabled selected>Selecciona una carrera</option>
                           </select>
                           <select id="atributos_criterio" name="atributoFiltro" class="form-control mx-sm-3">
                            <option disabled selected>Selecciona un atributo</option>
                           </select>
                           <button id="tbn_refrescar_filtros_proyectos" onclick="getCriterios()" type="button" class="form-control mx-sm-3">Buscar</button>
                           <button id="btn_ver_todos" type="button" class="form-control mx-sm-3" onclick="getAllCriterios()">Ver todos</button>
                       </div>
                   </form>
                   <br>
                   <table class="table" id="table_criterios">
                      <thead class="">
                        <tr>
                          <th scope="col">Nombre</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Ponderación</th>
                          <th scope="col">Atributo</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">Trabajo en equipo</th>
                          <td>Nos ayuda a evaluar el desempeño de un estudiante al trabajar con sus compañeros de equipo</td>
                          <td>50%</td>
                          <td>Individual</td>
                          <td><button id="btn_eliCrit" type="button" class="form-control mx-sm-3" onclick="eliminarCriterio(3,'Trabaja en equipo')">Eliminar</button></td>
                        </tr>
                      </tbody>
                    </table>
               </div>
           </div>
           <div class="container" style="margin-top:1em;">
               <div id="contenedor_proyectos" class="row">

               </div>
           </div>
         </div>

         <div class="tab-pane fade" id="profesores" role="tabpanel" aria-labelledby="profesores-tab">
             <div class="row">

               <div class="col-lg-12">
                   <form class="form-inline">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <input id="buscarPC" type="text" placeholder="Buscar candidatos" class="form-control mx-sm-3">
                           </div>
                       <div class="form-group" style="margin-right:1%;position: absolute;right: 0px;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <input id="buscarPA" type="text" placeholder="Buscar aceptados" class="form-control mx-sm-3">
                        </div>
                   </form>
                   <br>
                   <div class="container">
                    <div class="row">
                      <div class="col-sm">
                        <div id="rbusqueda"></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm">
                          Profesores candidatos
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Acciones</th>
                              </tr>
                            </thead>
                            <tbody id="filas1">
                            </tbody>
                          </table>
                      </div>
                      <div class="col-sm">
                        Profesores autorizados
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Acciones</th>
                              </tr>
                            </thead>
                            <tbody id="filas2">
                            </tbody>
                          </table>
                      </div>
                    </div>
                  </div>
               </div>
           </div>
           <div class="container" style="margin-top:1em;">
               <div id="contenedor_proyectos" class="row">

                                          <div class="container">
                                            <div class="row">
                                              <div class="col-sm">
                                                <div id="rbusqueda"></div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-sm">
                                                 Profesores candidatos
                                                <table class="table">
                                                   <thead>
                                                     <tr>
                                                       <th scope="col">id</th>
                                                       <th scope="col">Nombre</th>
                                                       <th scope="col">Correo</th>
                                                       <th scope="col">Acciones</th>
                                                     </tr>
                                                   </thead>


                                                   <tbody id="filas1">

                                                   </tbody>
                                                 </table>
                                              </div>

                                              <div class="col-sm">
                                                Profesores autorizados
                                                <table class="table">
                                                   <thead>
                                                     <tr>
                                                       <th scope="col">id</th>
                                                       <th scope="col">Nombre</th>
                                                       <th scope="col">Correo</th>
                                                       <th scope="col">Acciones</th>
                                                     </tr>
                                                   </thead>
                                                   <tbody id="filas2">

                                                   </tbody>
                                                 </table>
                                              </div>
                                            </div>
                                          </div>






                      <div class="paginador">
                        <ul id="paginas" style="list-style: none; ">

                          <!--<li><a href="#">|<<</a></li>
                          <li><a href="#"><<</a></li>
                          <li class="pageSelected">1</li>

                          <li><a href="#">>></a></li>
                          <li><a href="#">>>|</a></li>-->
                        </ul>
                      </div>
                 </div>
             </div>
             <div class="container" style="margin-top:1em;">
                 <div id="contenedor_proyectos" class="row">

                 </div>
             </div>
         </div>

         <div class="tab-pane fade" id="carreras" role="tabpanel" aria-labelledby="carreras-tab">
           <div class="row">
               <div class="col-lg-3">
                 <form class="formulario" id="formCarreraI">
                   <p>Agregar carreras: </p>
                   <br>
                   <p>Nombre de la carrera:</p>
                   <input id="nameCarrI" type="text" name="carrera_insert" class="form-control">
                   <br>
                 </form>
                 <button class="btn" onclick="insert_carrera()">Agregar</button>
               </div>
               <div class="col-lg-9">
                   <form class="form-inline" id="formCarrera">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <input id="in_palabra_proyecto" type="text" name="carrera" placeholder="buscar" class="form-control mx-sm-3">
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3" onclick="getCarrerasFiltro('filtro')">Buscar</button>
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3" onclick="getCarrerasFiltro('All')">Ver todo</button>
                       </div>
                   </form>
                   <br>
                   <table class="table" id="tableCarrera">
                      <thead class="">
                        <tr>
                          <th scope="col">Carrera</th>
                          <th scope="col">departamento</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
               </div>
           </div>
           <div class="container" style="margin-top:1em;">
               <div id="contenedor_proyectos" class="row">

               </div>
           </div>
         </div>

         <div class="tab-pane fade" id="departamentos" role="tabpanel" aria-labelledby="departamentos-tab">
           <div class="row">
               <div class="col-lg-3">
                 <form class="formulario" id="formDeptoInsert" >
                   <p>Nombre del departamento: </p>
                   <input type="text" id="nombre_depto" class="form-control" name="nombre" value="" placeholder="Nombre"><br><br>
                   <input type="file" class="form-control" name="logo" id="insertFileDepto">
                   <br><br>

                 </form>
                 <button id="btn_atrib" class="btn" onclick="insertar_departamento()">Agregar</button>
               </div>
               <div class="col-lg-9">
                   <form class="form-inline" id="formDeptos">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <input id="in_palabra_proyecto" type="text" name="deptoName" placeholder="buscar" class="form-control mx-sm-3">
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3" onclick="getDeptoFiltro()">Buscar</button>
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3" onclick="getAlldeptos()">Ver todos</button>
                       </div>
                   </form>
                   <br>
                   <table class="table" id="departamentos">
                      <thead>
                        <tr>

                          <th scope="col">Nombre</th>
                          <th scope="col">Logo</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="filas">
                        <tr>

                          <th scope="col">Sistemas y computación</th>
                          <th scope="col">logo7.png</th>
                          <th scope="col"><button id="btn_eliCrit" type="button" class="form-control mx-sm-3" onclick="eliminarDto(1,'Sistemas')">Eliminar</button></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
               </div>
           </div>
           <div class="container" style="margin-top:1em;">
               <div id="contenedor_proyectos" class="row">

               </div>
           </div>
         </div>

         <div class="tab-pane fade" id="departamentos" role="tabpanel" aria-labelledby="departamentos-tab">
           <div class="row">
               <div class="col-lg-3">
                 <form class="formulario" id="formDeptoInsert" >
                   <p>Nombre del departamento: </p>
                   <input type="text" id="nombre_depto" class="form-control" name="nombre" value="" placeholder="Nombre"><br><br>
                   <input type="file" class="form-control" name="logo" id="insertFileDepto">
                   <br><br>

                 </form>
                 <button id="btn_atrib" class="btn" onclick="insertar_departamento()">Agregar</button>
               </div>
               <div class="col-lg-9">
                   <form class="form-inline" id="formDeptos">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <input id="in_palabra_proyecto" type="text" name="deptoName" placeholder="buscar" class="form-control mx-sm-3">
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3" onclick="getDeptoFiltro()">Buscar</button>
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3" onclick="getAlldeptos()">Ver todos</button>
                       </div>
                   </form>
                   <br>
                   <table class="table" id="departamentos">
                      <thead>
                        <tr>

                          <th scope="col">Nombre</th>
                          <th scope="col">Logo</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="filas">
                        <tr>

                          <th scope="col">Industrial</th>
                          <th scope="col">logo6.png</th>
                          <th scope="col"><button id="btn_eliCrit" type="button" class="form-control mx-sm-3" onclick="eliminarDto(2,'Industrial')">Eliminar</button></th>
                        </tr>
                      </tbody>
                    </table>
                    <div class="paginador">
                      <ul id="paginas" style="list-style: none; ">

                        <!--<li><a href="#">|<<</a></li>
                        <li><a href="#"><<</a></li>
                        <li class="pageSelected">1</li>

                        <li><a href="#">>></a></li>
                        <li><a href="#">>>|</a></li>-->
                      </ul>
                    </div>
               </div>
           </div>
           <div class="container" style="margin-top:1em;">
               <div id="contenedor_proyectos" class="row">

               </div>
           </div>
         </div>

         <div class="tab-pane fade" id="informes" role="tabpanel" aria-labelledby="informes-tab">
           <div class="row">

               <div class="col-lg-12">
                   <!--<form class="form-inline">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtrar por alumno:</label>
                           <input id="in_palabra_proyecto" type="text" placeholder="buscar" class="form-control mx-sm-3">
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3">Buscar</button>
                       </div>
                       <div class="form-group" style="margin:1%;">
                          <label for="in_palabra_proyecto">Por generacion</label>
                          <select class="form-control mx-sm-3">
                            <option value="">Periodo Ene-Jun 2018</option>
                            <option value="">Periodo Ago-Dic 2018</option>
                          </select>
                       </div>
                   </form>-->
                   <br>
                   <img src="../image/GRAFICA 7.png"/>
               </div>
           </div>
           <div class="container" style="margin-top:1em;">
               <div id="contenedor_proyectos" class="row">

               </div>
           </div>
         </div>
     </div>



      <!-- Modal -->
      <div class="modal fade" id="eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Está seguro que desea borrar: <span id="dato"></span>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="confirmDelete()">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" action="index.html" method="post">
                <h3 align="center">Nuevos Datos </h3>
                <input type="text" class="form-control" id="txnombre" name="txnombre" value="" placeholder="Nombre"><br>
                <input type="text" class="form-control" id="txdesc" name="txdesc" value="" placeholder="Descripción">
                <br>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="confirmMod()">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
     <!--Moda de confirmacion-->
     <div class="modal fade" id="confirmacion">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h3 id="text_titulo_confirmacion" class="modal-title">Confirmacion</h3>
                     <button id="btn_cerrar" tyle="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 </div>
                 <div class="modal-body">
                     <h4 id="text_confirmacion"> ¿Seguro que desea continuar? </h4>
                 </div>
                 <div class="modal-footer">
                     <button id="btn_si" class="btn btn-lg btn-outline-danger">Si</button>
                 </div>
             </div>
         </div>
     </div>
     <!--/Moda de confirmacion-->

     <!--Modal de nuevo proyecto-->
     <div class="modal fade" id="registrar_proyecto">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <!--Cabecera del modal-->
                 <div class="modal-header">
                     <h3 id="titulo_modal_proyecto" class="modal-title">Titulo P</h3>
                     <button id="btn_cerrar_registrar_proyectos" tyle="button" class="close" data-dismiss="modal"
                         aria-hidden="true">&times;</button>
                 </div>
                 <!--Cuerpo del modal-->
                 <div class="modal-body">
                     <div class="row">
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="in_titulo_proyecto" class="font-weight-bold">Titulo</label>
                             <input type="text" id="in_titulo_proyecto" class="form-control">
                         </div>
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="in_titulo_proyecto" class="font-weight-bold">Lider de proyecto</label>
                             <select id="select_lider_proyecto_registro" class="custom-select">
                                 <option value="" selected>Linea</option>
                                 <option value="1">One</option>
                             </select>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-lg-6 col-md-12">
                             <label class="font-weight-bold">Imagen</label>
                             <div class="input-group">
                                 <label class="input-group-btn">
                                     <span class="btn btn-outline-info">
                                         Buscar&hellip; <input id="img_proyecto_ref" name="img_proyecto_ref" type="file" style="display: none;" accept="image/png, image/jpeg">
                                     </span>
                                 </label>
                                 <input id="in_img_proyecto" type="text" class="form-control" readonly>
                             </div>
                         </div>
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="select_linea_proyecto_registro" class="font-weight-bold">Linea de investigación</label>
                             <select id="select_linea_proyecto_registro" class="custom-select">
                                 <option value="" selected>Linea</option>
                                 <option value="1">One</option>
                             </select>
                         </div>
                     </div>
                     <div class="row">
                         <div class='col-md-6'>
                             <div class="form-group">
                                 <label for="fecha_inicio" class="font-weight-bold">Fecha inicio</label>
                                 <div class='input-group date' id='fecha_inicio'>
                                     <input id="in_fecha_inicio" type='text' class="form-control">
                                     <span class="input-group-addon">
                                         <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                     </span>
                                 </div>
                             </div>
                         </div>
                         <div class='col-md-6'>
                             <div class="form-group">
                                 <label for="fecha_fin" class="font-weight-bold">Fecha inicio</label>
                                 <div class='input-group date' id='fecha_fin'>
                                     <input id="in_fecha_fin" type='text' class="form-control">
                                     <span class="input-group-addon">
                                         <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                                     </span>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="row" style="margin:1em;">
                         <div class="container col-sm-12">
                             <div class="form-check">
                                 <input id="check_financiado" class="form-check-input" type="checkbox" value="0">
                                 <label class="form-check-label font-weight-bold mx-sm-3" for="check_financiado">Proyecto
                                     financiado</label>
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="form-group col-sm-12">
                             <label for="txt_resumen_proyecto" class="font-weight-bold">Resumen</label>
                             <textarea class="form-control" id="txt_resumen_proyecto" rows="3"></textarea>
                         </div>
                     </div>
                     <div class="row">
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="select_colaboradores" class="font-weight-bold">Colaboradores</label>
                             <select id="select_colaboradores" class="custom-select">
                                 <option value="" selected>Linea</option>
                                 <option value="1">One</option>
                             </select>
                         </div>
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="lista_colaboradores" class="font-weight-bold">Colaboradores agregados</label>
                             <ul id="lista_colaboradores" class="list-group">
                                 <li class="list-group-item item list-group-item-success">Dapibus ac facilisis in<button id="" tyle="
                                     button" class="close" aria-hidden="true">&times;</button></li>
                             </ul>
                         </div>
                     </div>
                     <!---
                     <div class="row">
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="select_publicaciones" class="font-weight-bold">Publicaciones</label>
                             <select id="select_publicaciones" class="custom-select">
                                 <option value="" selected>Linea</option>
                                 <option value="1">One</option>
                             </select>
                         </div>
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="lista_publicaciones" class="font-weight-bold">Publicaciones relacionadas</label>
                             <ul id="lista_publicaciones" class="list-group">
                                 <li class="list-group-item item list-group-item-success"">Dapibus ac facilisis in<button id="" tyle="
                                     button" class="close" aria-hidden="true">&times;</button></li>
                             </ul>
                         </div>
                     </div>
                     <div class="row">
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="select_congresos" class="font-weight-bold">Congresos</label>
                             <select id="select_congresos" class="custom-select">
                                 <option value="" selected>Linea</option>
                                 <option value="1">One</option>
                             </select>
                         </div>
                         <div class="form-group col-lg-6 col-md-12">
                             <label for="lista_congresos" class="font-weight-bold">congresos relacionados</label>
                             <ul id="lista_congresos" class="list-group">
                                 <li class="list-group-item item list-group-item-success"">Dapibus ac facilisis in<button id="" tyle="
                                     button" class="close" aria-hidden="true">&times;</button></li>
                             </ul>
                         </div>
                     </div>
                     -->
                 </div>
                 <!--Pie del modal-->
                 <div class="modal-footer">
                     <button id="btn_guardar_proyecto" class="btn btn-md btn-outline-success">Guardar</button>
                 </div>
             </div>
         </div>
     </div>
     <!--/Modal de nuevo proyecto-->

     <!-- Modal actualización de departamento -->                            
     <div class="modal fade" id="actualizarDepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form id="modifDepto">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualización de departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <label for="id_depto">ID departamento</label>
                <br>
                <p id="id_depto"></p>
                <br>
                <label for="updateNameDep">Departamento</label>
                <br>
                <input id="updateNameDep" type="text" name="nombre" style="width: 376px;" placeholder="Nombre de departamento" class="form-control mx-sm-3">
                <br>
                <label for="fileDepto">Logo</label>
                <br>
                <img id="image_logo" src="" alt="">
                <br>
                <br>
                <input id="fileDepto" type="file" name="file">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="confirmActualización()">Aceptar</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Modal eliminar Criterio -->

    <div class="modal fade" id="eliminarc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">

  <div class="modal-content">

    <div class="modal-header">

      <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

      </button>

    </div>

    <div class="modal-body">

      Está seguro que desea borrar: <span id="datoc"></span>

    </div>

    <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

      <button type="button" class="btn btn-primary" onclick="confirmDeleteC()">Aceptar</button>

    </div>

  </div>

</div>

</div>



<!-- Modal eliminar Departamento-->

<div class="modal fade" id="eliminarDto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">

  <div class="modal-content">

    <div class="modal-header">

      <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

      </button>

    </div>

    <div class="modal-body">

      Está seguro que desea borrar: <span id="datodto"></span>

    </div>

    <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

      <button type="button" class="btn btn-primary" onclick="confirmDeleteDto()">Aceptar</button>

    </div>

  </div>

</div>

</div>

<!-- Modal eliminar Departamento-->

<div class="modal fade" id="eliminarCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

<div class="modal-dialog" role="document">

  <div class="modal-content">

    <div class="modal-header">

      <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

      </button>

    </div>

    <div class="modal-body">

      Está seguro que desea borrar: <span id="datocarrera"></span>

    </div>

    <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

      <button type="button" class="btn btn-primary" onclick="confirmDeleteCarrera()">Aceptar</button>

    </div>

  </div>

</div>

</div>

<!-- Modal ModificarCriterio-->
<div class="modal fade" id="modificarCrit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="" action="index.html" method="post">
                <h3 align="center">Nuevos Datos </h3>
                <input type="text" class="form-control" id="txnombreCrit" name="txnombreCrit" value=""
                  placeholder="Nombre"><br>
                <input type="text" class="form-control" id="txdesCrit" name="txdesCrit" value="" placeholder="Descripción">
                <br>
                <select class="form-control" name="tipo" id="modifTipoCriterio">
                  <option value="Individual">Individual</option>
                  <option value="grupal">Grupal</option>
                  <option value="individual/grupal">Individual/Grupal</option>
                </select>
                <br>
                <input type="number" class="form-control" min="0" max="100" id="txpondCrit" name="txpondCritI" value="" placeholder="Ponderación Individual">
                <input type="number" class="form-control" min="0" max="100" id="txpondCritG" name="txpondCritG" value="" placeholder="Ponderación Grupal">
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="confirmModCriterio()">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
<!-- Modal Modificar Carrera-->
<div class="modal fade" id="modificarCarrera" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmacion</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="formModCarrera">
                <br>
                <h3 align="center">Nuevos Datos </h3>
                <br>
                <label for="id_carrera">ID carrera</label>
                <br>
                <p id="id_carrera"></p>
                <input type="text" class="form-control" id="txnombreCarrera" name="txnombreCarrera" placeholder="Nombre"><br>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="confirmUpdateCarrera()">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
      <!--Fin modal Update Carrera-->

     <script>

        var myvar='<?php echo $_SESSION["usuario"];?>';
        myvar='<?php echo $_SESSION["usuario"];?>';

        //llamamos al metodo get_datos para obtener todos los datos del administrador

        get_datos_sesion();

        $( document ).ready(function() {
  //getAllAtributos();
    //get_atributos_criterio();
   var opc = document.getElementById('opc');
    opc.addEventListener( 'change', function(){
    var tipo = this.options[opc.selectedIndex];
        console.log(tipo.value);
        if(tipo.value == 'individual/grupal'){
          $("#PonderaciónGrupal").show();
          $("#PonderaciónIndividual").show();
          
        }
        else
        {
            $("#PonderaciónGrupal").hide();
          $("#PonderaciónIndividual").hide();
          
        }
      });
    });

        var select = document.getElementById('carreras_criterio');
        select.addEventListener('change',
        function(){
          var selectedOption = this.options[select.selectedIndex];
          getAtributo(selectedOption.value);
        });

        var selectTipoM = document.getElementById('modifTipoCriterio');
        selectTipoM.addEventListener('change', function(){
          var tipo = this.options[selectTipoM.selectedIndex];
          console.log(tipo.value);
          if(tipo.value == 'individual/grupal'){
            $("#txpondCrit").show();
            $("#txpondCritG").show();
          }
          else
          {
            $("#txpondCrit").hide();
            $("#txpondCritG").hide();
          }
        });
        getAlldeptos();
        getAllCriterios();
        getAllAtributos();
        getCarreras();
        get_atributos_criterio();
        getCarrerasFiltro('All');
        //añado un click listener para el boton de agregar atributo.
        document.getElementById("btn_atrib").addEventListener("click", function(){
          //invoco al modal de sweet alert para mostrar el mensaje de exito
         });

     </script>
 </body>

 </html>
