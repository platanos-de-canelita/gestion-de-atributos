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
     <script src="../js/admin/responsable.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

      <!-- Latest compiled JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


     <title>Responsable</title>

 </head>

 <body style="background: #f8f8f8">

     <!--Barra superior-->
     <div style="background: rgb(27, 57, 106); height: 4em; display: flex; justify-content: center; align-items: center;">
         <h1 style="color:#f8f8f8">Responsable</h1>
     </div>

     <!--Navegacion de secciones-->
     <ul class="nav nav-tabs sticky-top" id="myTab" role="tablist" style="background: #f0f0f0;">
         <li class="nav-item">
             <a class="nav-link active list-group-item-action" id="atributos-tab" data-toggle="tab" href="#atributos"
                 role="tab" aria-controls="home" aria-selected="false">Atributos</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="atrib_mate-tab" data-toggle="tab" href="#atrib_mate"
                 role="tab" aria-controls="profile" aria-selected="false">Atributos de Materias</a>
         </li>
         <li class="nav-item">
             <a class="nav-link list-group-item-action" id="prof-tab" data-toggle="tab" href="#profes"
                 role="tab" aria-controls="profile" aria-selected="false">Profesores de Materias</a>
         </li>
         <li class="nav-item"><a class="nav-link list-group-item-action" href='../function/cerrar.php'>Salir</a></li>
     </ul>

   

     <div class="tab-content" id="myTabContent" style="margin-top:1em;">

     <div class="tab-content" id="myTabContent" style="margin-top:1em; margin-left: 2em; margin-right: 2em;">
    

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

                         
                        </ul>
                      </div>
                 </div>
             </div>
             <div class="container" style="margin-top:1em;">
                 <div id="contenedor_proyectos" class="row">

                 </div>
             </div>
         </div>

        
         <div class="tab-pane fade" id="atrib_mate" role="tabpanel" aria-labelledby="atrib_mate-tab">
           <div class="row">
               <div class="col-lg-3">
                 <form class="formulario" id="formcrit">
                  <p>Agregar atributos: </p>
                    <!--input type="text" min="0" max="100" class="form-control" name="Nombre" placeholder="Nombre"-->
                    <select id="carreras_criterio" name="carreraFiltro" class="form-control ">
                        <option disabled selected>Selecciona una carrera</option>
                    </select>
                    
                    <br><br>

                    <select id="materias_criterio" name="materiaFiltro" class="form-control">
                        <option disabled selected>Selecciona una materia</option>
                    </select>

                    <br><br>
                    <select id="atributos_criterio" name="atributoFiltro" class="form-control">
                        <option disabled selected>Selecciona un atributo</option>
                    </select>

                    <br><br>
                 </form>
                 <button class="btn" name="login" onclick="revisaAsigmat()">Agregar</button>
               </div> 
               <div class="col-lg-9">
                   <form id="atrib_mate_form" class="form-inline">
                       <div class="form-group" style="margin:1%;">
                           <label for="in_palabra_proyecto">Filtros:</label>
                           <select id="carreras_atributoo" name="carreraFiltro" class="form-control mx-sm-3">
                            <option disabled selected>Selecciona una carrera</option>
                           </select>                                               <!--name=filtro el de atributos-->
                           <input id="in_palabra_proyecto" type="text" placeholder="buscar" name="nombre" class="form-control mx-sm-3">
                           <input id="in_palabra_proyecto" type="text" placeholder="semestre" name="semestre" class="form-control mx-sm-3">
                          
                           <button id="tbn_refrescar_filtros_proyectos" onclick="getatrib_mate()" type="button" class="form-control mx-sm-3">Buscar</button>
                           <button id="btn_ver_todos" type="button" class="form-control mx-sm-3" onclick="getAllatrib_mate()">Ver todos</button>
                       </div>
                   </form>
                   <br>
                   <table class="table" id="table_atrib_mate">
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
                          <td><button id="btn_eliCrit" type="button" class="form-control mx-sm-3">Eliminar</button></td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="paginador">
                        <ul id="paginas" style="list-style: none; ">

                         
                        </ul>
                    </div>
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

      Está seguro que desea quitar el atributo?

    </div>

    <div class="modal-footer">

      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

      <button type="button" class="btn btn-primary" onclick="confirmDeleteC()">Aceptar</button>

    </div>

  </div>

</div>

</div>



      <!-- Modal -->

     <script>

        var myvar='<?php echo $_SESSION["usuario"];?>';
        myvar='<?php echo $_SESSION["usuario"];?>';

        //llamamos al metodo get_datos para obtener todos los datos del administrador

        get_datos_sesion();

        

        var select = document.getElementById('carreras_criterio');
        select.addEventListener('change',
        function(){
          var selectedOption = this.options[select.selectedIndex];
          getAtributo(selectedOption.value);
          getMateria(selectedOption.value);
        });



        
        
        getAllatrib_mate();
        getAllAtributos();
        
        //añado un click listener para el boton de agregar atributo.
        document.getElementById("btn_atrib").addEventListener("click", function(){
          //invoco al modal de sweet alert para mostrar el mensaje de exito

         });

     </script>
 </body>

 </html>
