
<?php
  //reanuda la sesion
  /*session_start();
  //valida si la sesion esta activa
  if (session_status() === PHP_SESSION_ACTIVE && $_SESSION['usuario']!="") {

  }else{

  	header("Location: login.php");
  	exit();
  }*/
 ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="../css/bootstrap.min.css">
     <link rel="stylesheet" href="../css/main.css">

     <title>Profesor</title>

 </head>

 <body style="background: #f8f8f8">

     <!--Barra superior-->
     <div style="background: rgb(27, 57, 106); height: 4em; display: flex; justify-content: center; align-items: center;">
         <h1 style="color:#f8f8f8">Profesores</h1>
     </div>

     <!--Navegacion de secciones-->
     <ul class="nav nav-tabs sticky-top" id="myTab" role="tablist" style="background: #f0f0f0;">
         <li class="nav-item">
             <a class="nav-link active list-group-item-action" id="alumnos-tab" data-toggle="tab" href="#alumnos"
                 role="tab" aria-controls="home" aria-selected="false">Alumnos</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="grupos-tab" data-toggle="tab" href="#grupos"
                 role="tab" aria-controls="home" aria-selected="false">Grupos</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="materias-tab" data-toggle="tab" href="#materias"
                 role="tab" aria-controls="profile" aria-selected="false">Materias</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="evaluaciones-tab" data-toggle="tab" href="#evaluaciones"
                 role="tab" aria-controls="profile" aria-selected="false">Evaluaciones</a>
         </li>


         <li class="nav-item"><a class="nav-link list-group-item-action" href='../function/cerrar.php'>Salir</a></li>
     </ul>

     <!--seccion de gestion-->

     <div class="tab-content" id="myTabContent" style="margin-top:1em;">

     <div class="tab-content" id="myTabContent" style="margin-top:1em; margin-left: 2em; margin-right: 2em;">
         <!--Seccion de proyectos-->

         <div class="tab-pane fade show active" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab">
           <div class="container">
             <div id="row">
               <div class="row">
                 <div class="col-md-12 titulo">
                   <h2>Registrar alumno</h2>
                 </div>
               </div>

               <div class="row" style="padding-left: 20em; padding-right: 20em">
                 <br>
                 <form class="col-md-12" action="" method="post">
                   <br><br>
                   <input type="text" class="form-control" name="txtnombre" value=""
                     placeholder="Nombre"><br>
                   <input type="text" class="form-control" name="txtnc" value=""
                     placeholder="Número de control"><br>
                   <select class="form-control" name="carrera">
                     <option value="">Seleccionar carrera</option>
                     <option value="industrial">Industrial</option>
                   </select><br>
                   <select class="form-control" name="materia">
                     <option value="">Seleccione carrera</option>
                     <option value="m1">Materia 1</option>
                     <option value="m2">Materia 2</option>
                     <option value="m3">Materia 3</option>
                     <option value="m4">Materia 4</option>
                   </select><br>
                   <select class="form-control" name="profesor">
                     <option value="">Seleccione profesor</option>
                     <option value="p1">José Perez</option>
                     <option value="p2">Oscar Torres</option>
                     <option value="p3">Javier Calderon</option>
                   </select><br>
                   <select class="form-control" name="especialidad">
                     <option value="">Seleccione especialidad</option>
                     <option value="esp1">Especialidad 1</option>
                     <option value="esp2">Especialidad 2</option>
                     <option value="esp3">Especialidad 3</option>
                   </select><br>
                   <select class="form-control" name="semestre">
                     <option value="">Seleccione semestre</option>
                     <option value="s7">7° Semestre</option>
                     <option value="s8">8° Semestre</option>
                     <option value="s9">9° Semestre</option>
                     <option value="s10">10° Semestre</option>
                     <option value="s11">11° Semestre</option>
                   </select><br><br>
                   <button type="submit" class="btn" name="altaregistro">Registrar</button><br><br>
                   <div class="col-md-12 titulo">
                     <h2>Carga mediante Excel</h2>
                   </div><br><br>
                   <h3>Selecciona el documento de Excel que contiene los alumnos.</h3>
                   <br><br>
                   <input type="file" name="excel"><br><br>
                   <button type="submit" class="btn" name="alta">Cargar archivo</button>
                 </form>
               </div>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
             </div>
           </div>
         </div>

         <div class="tab-pane fade" id="grupos" role="tabpanel" aria-labelledby="grupos-tab">
           <div class="container">
             <div id="row">
               <div class="row">
                 <div class="col-md-12 titulo">
                   <h2>Crear grupo de estudio</h2>
                 </div>
               </div>

               <div class="row" style="padding-left: 20em; padding-right: 20em">
                 <br>
                 <form class="col-md-12" action="" method="post">
                   <br><br>
                   <input type="text" class="form-control" placeholder="Nombre del grupo"></input>
                   <br>
                   <select class="form-control" name="carrera">
                     <option value="">Seleccionar carrera</option>
                     <option value="industrial">Industrial</option>
                   </select><br>
                   <select class="form-control" name="materia">
                     <option value="">Seleccionar materia</option>
                     <option value="industrial">Ingenieria economica</option>
                   </select><br>
                   <select class="form-control" name="alumnos">
                     <option value="">Alberto Robles</option>
                     <option value="industrial">Alejandro Nuñez</option>
                   </select>
                   <br><br>
                   <button class="btn" onclick="">Agregar alumno</button>
                  <br><br>
                   <button type="submit" class="btn" name="altaregistro">Crear grupo</button><br><br>

                 </form>
               </div>
               <br>
               <br>
               <br>

             </div>
           </div>
           <form class="form-inline">
               <div class="form-group" style="margin:1%;">
                   <label for="in_palabra_proyecto">Filtros:</label>
                   <input id="in_palabra_proyecto" type="text" placeholder="buscar" class="form-control mx-sm-3">
                   <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3">Buscar</button>
               </div>
           </form>
           <br>
           <table class="table">
              <thead>
                <tr>

                  <th scope="col">Nombre</th>
                  <th scope="col">Carrera</th>
                  <th scope="col">Materia</th>
                  <th scope="col">Ver integrantes</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody id="filas">
                <tr>

                  <th scope="col">Platanitos</th>
                  <th scope="col">Industrial</th>
                  <th scope="col">Ingenieria economica</th>
                  <th scope="col">Detalles</th>
                  <th scope="col">Modificar|Eliminar</th>
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

         <!--Seccion de materias-->
         <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab">
           <div class="row">
               <div class="col-lg-3">
                 <form class="formulario" action="" method="post">
                   <p>Agregar materias: </p>
                   <br>
                   <p>Nombre de la materia:</p>
                   <input type="text" class="form-control"></input>
                   <br><br>
                  <p>Selecciona un carrera:</p>
                   <select class="form-control" name="tipo">
                    <option value="industrial">Industrial</option>
                     <option value="sistemas">Sistemas y computación</option>
                   </select>
                   <br><br>
                   <button type="submit" class="btn" name="login">Agregar</button>
                 </form>
               </div>
               <div class="col-lg-9">
                   <form class="form-inline">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <input id="in_palabra_proyecto" type="text" placeholder="buscar" class="form-control mx-sm-3">
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3">Buscar</button>
                       </div>
                   </form>
                   <br>
                   <table class="table">
                      <thead class="">
                        <tr>
                          <th scope="col">Materia</th>
                          <th scope="col">Carrera</th>
                          <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Procesos de manufactura</td>
                          <td>Ingenieria Industrial</td>
                          <td>Modificar | Eliminar</td>
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

         <div class="tab-pane fade" id="evaluaciones" role="tabpanel" aria-labelledby="evaluaciones-tab">
           <div class="row">

               <div class="col-lg-12">
                   <form class="form-inline">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <input id="in_palabra_proyecto" type="text" placeholder="buscar" class="form-control mx-sm-3">
                           <button id="tbn_refrescar_filtros_proyectos" type="button" class="form-control mx-sm-3">Buscar</button>
                       </div>
                       </form>
                </div>
            </div>
            <div class="row">
              <br>
              <br>
              <div class="col-lg-4">
                <select class="form-control" name="carrera">
                  <option value="">Tipo de evaluación</option>
                  <option value="industrial">Parcial</option>
                  <option value="industrial">Final</option>
                </select><br>
                <select class="form-control" name="carrera">
                  <option value="">Materia evaluada</option>
                  <option value="industrial">Parcial</option>
                  <option value="industrial">Final</option>
                </select><br>
                <select class="form-control" name="carrera">
                  <option value="">Año</option>
                  <option value="industrial">2018</option>
                  <option value="industrial">2019</option>
                </select><br>
                <select class="form-control" name="carrera">
                  <option value="">Semestre</option>
                  <option value="industrial">Ene-Jun</option>
                  <option value="industrial">Ago-Dic</option>
                </select><br>
                <select class="form-control" name="carrera">
                  <option value="">Equipo a evaluar</option>
                  <option value="industrial">Pollo choncho</option>
                  <option value="industrial">Abarrotera Enrique Silva</option>
                </select><br>
              </div><br>
              <div class="col-lg-8">
                <table class="table">
                   <thead class="">
                     <tr>
                       <th scope="col">Atributo</th>
                       <th scope="col">Ponderación</th>
                       <th scope="col">Calificación</th>

                     </tr>
                   </thead>
                   <tbody>
                     <tr>
                       <th scope="row">Trabajo en equipo</th>
                       <td>15%</td>
                       <td><input type="number" class="form-control"></input></td>

                     </tr>
                     <tr>
                       <th scope="row">Resultados obtenidos</th>
                       <td>55%</td>
                       <td><input type="number" class="form-control"></input></td>

                     </tr>
                     <tr>
                       <th scope="row">Calidad de analisis</th>
                       <td>30%</td>
                       <td><input type="number" class="form-control"></input></td>

                     </tr>
                   </tbody>
                 </table>
              </div>




              <div class="container" style="margin-top:1em;">
              <div id="contenedor_proyectos" class="row">

              </div>
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
                <input type="text" name="" value="">
                <input type="text" name="" value="">

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="confirmDelete()">Aceptar</button>
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


     <script src="../js/jquery-3.3.1.min.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <!--Importo la libreria sweetalert2 para generar mensajes y entradas procedurales-->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

     <script src="../js/admin/admin.js"></script>
     <script>
        //añado un click listener para el boton de agregar atributo.
        document.getElementById("btn_atrib").addEventListener("click", function(){
          //invoco al modal de sweet alert para mostrar el mensaje de exito
          Swal.fire(
            'Atributo agregado exitosamente!',
            '',
            'success'
          )
         });

     </script>
 </body>

 </html>
