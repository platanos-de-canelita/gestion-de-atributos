
var a=0;
var del;
var mod;
var name;
var datos_sesion;

/*$( document ).ready(function() {
  //getAllAtributos();
    //get_atributos_criterio();
   var opc = document.getElementById('opc');
    opc.addEventListener( 'change', function(){
    var tipo = this.options[opc.selectedIndex];
        console.log(tipo.value);
        if(tipo.value == 'Individual/Grupal'){
          $("#PonderaciónGrupal").show();
          $("#PonderaciónIndividual").show();
          
        }
        else
        {
            $("#PonderaciónGrupal").hide();
          $("#PonderaciónIndividual").hide();
          
        }
      });
    });*/

    function ResponsablesFiltro(type){
      var datos;
      if(type == 'All'){
        datos = 'funcion=select&depto='+localStorage.getItem('depto');
        $("#formResponsable").trigger("reset");
      }
      else{
        datos = $("#formResponsable").serialize()+'&funcion=select&depto='+localStorage.getItem('depto');
      }
      console.log(datos);
      $("#responsables tbody").html("");
      $.ajax({
        type : 'POST',
        async : true,
        timeout : 12000,
        url : '../function/responsable.php',
        data : datos,
        success : function(response){
          if(response == "Sin Resultados"){
            $("#responsables > thead").html("<tr><th class='center'>No se encontrarón materias con los parametros de busqueda</th></tr>");
            $("#responsables tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
          }
          else
          {
            $("#responsables > thead").html("");
            $("#responsables thead").append(
              "<tr>"+
              "<th>ID</th>"+
              "<th>Nombre</th>"+
              "<th>Usuario</th>"+
              "<th>Contraseña</th>"+
              "<th>Acciones</th>"+
              "</tr>"
            );

            $("#responsables tbody").append(response);
          }
        },
        error : function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    function modificarResponsable(usuario, pass, nombre, id){
      $("#modificarResponsable").modal("show");
      localStorage.setItem('responsable', id);
      console.log(usuario);
      console.log(pass);
      console.log(nombre);
      $("id_responsable").text(nombre);
      $("#nombre_usuario_r").val(usuario);
      $("#pass_r").val(pass);
    }

    function confirmarModifResponsable(){
      let datos = 'usuario='+$("#nombre_usuario_r").val()+'&pass='+$("#pass_r").val()+'&funcion=update&id_responsable='+localStorage.getItem('responsable');
      $.ajax({
        type : 'POST',
        async : true,
        timeout : 12000,
        url : '../function/responsable.php',
        data : datos,
        success : function(response){
          alert(response);
          ResponsablesFiltro('All');
          $("#modificarResponsable").modal("hide");
        },
        error : function(jqXHR, textStatus, errorThrown) {
          
        }
      });
    }

    function deleteResponsable(nombre, id){
      $("#eliminarResp").modal("show");
      localStorage.setItem('responsable', id);
      $("#datodtoR").append(nombre);
    }

    function confirmDelResponsable(){
      let datos = 'funcion=delete&id_responsable='+localStorage.getItem('responsable');

      $.ajax({
        type: 'POST',
        async : true,
        timeout : 12000,
        url : '../function/responsable.php',
        data : datos,
        success : function(response){
          alert(response);
          $("#eliminarResp").modal("hide");
          ResponsablesFiltro('All');
        },
        error : function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    function insertar_responsable(){
      $.ajax({
        type : 'POST',
        async : true,
        timeout : 12000,
        url : '../function/responsable.php',
        data : $('#formResponsableInsert').serialize()+'&funcion=insert&depto='+localStorage.getItem('depto'),
        success : function(response){
          alert(response);
          if(response == 'Responsable registrado con éxito'){
            $('#formResponsableInsert').trigger("reset");
            ResponsablesFiltro('All');
          }
        },
        error : function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    function getProfesoresR(){
      $.ajax({
        type : 'POST',
        async : true,
        timeout : 12000,
        url : '../function/responsable.php',
        data : 'funcion=profesores',
        success : function(response){
          $("#profesores_select").append(response);
        },
        error : function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    function modificarMateria(id, nombre){
      $("#modificarMateria").modal("show");
      localStorage.setItem('id_materia', id);
      $("#nombre_carrera").val(nombre);
    }

    function confirmarModMateria(){
      var datos = "funcion=update&id_materia="+localStorage.getItem('id_materia')+"&nombre="+$("#nombre_carrera").val();
      console.log(datos);
      $.ajax({
        type : 'POST',
        async : true,
        timeout : 12000,
        url : '../function/materias.php',
        data : datos,
        success : function(response){
          alert(response);
          $("#modificarMateria").modal("hide");
          getMaterias('All');

        },
        error : function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    function eliminarMateria(id, nombre){
      $("#eliminarMateria").modal("show");
      localStorage.setItem('id_materia', id);
      $("#id_materia").text(nombre);
      
    }

    function confirmarEliminarMateria(){
      var datos = "funcion=delete&id_materia="+localStorage.getItem('id_materia');
      $.ajax({
        type : 'POST',
        async : true,
        timeout : 12000,
        url : '../function/materias.php',
        data : datos,
        success : function(response){
          alert(response);
          $("#eliminarMateria").modal("hide");
          getMaterias('All');
        },
        error : function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    function getMaterias(type){
      let depto = localStorage.getItem('depto');
      var datos;
      if(type == "All"){
        datos = "funcion=select&depto="+depto;
        $("#formMaterias").trigger("reset");
      }
      else{
        datos = $("#formMaterias").serialize()+'&funcion=select&depto='+depto;
      }

      $("#materias tbody").html("");

      $.ajax({
        type : 'POST',
        async : true,
        timeout : 12000,
        url : '../function/materias.php',
        data : datos,
        success : function(response){
          if(response == "Sin Resultados"){
            $("#materias > thead").html("<tr><th class='center'>No se encontrarón materias con los parametros de busqueda</th></tr>");
            $("#materias tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
          }
          else
          {
            $("#materias > thead").html("");
            $("#materias thead").append(
              "<tr>"+
              "<th>ID carrera</th>"+
              "<th>Nombre materia</th>"+
              "<th>Carrera</th>"+
              "<th>Acciones</th>"+
              "</tr>"
            );

            $("#materias tbody").append(response);
          }
        },
        error : function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    function insertar_materia(){
      $.ajax({
        type: 'POST',
        async : true,
        timeout : 12000,
        url : '../function/materias.php',
        data : $("#formMateriaInsert").serialize()+'&funcion=insert',
        success : function(response){
          alert(response);
          if(response == "Materia Registrada con éxito"){
            $("#formMateriaInsert").trigger("reset");
            getMaterias('All');
          }
        },
        error : function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    function insert_carrera(){
      var datos = $("#formCarreraI").serialize()+'&id_depto='+localStorage.getItem('depto')+'&accion=insert';

      if($("#nameCarrI").val() == ""){
        alert('Favor de introducir un nombre de carrera');
      }
      else
      {
        $.ajax({
          type: 'POST',
          async: true,
          url: '../function/get_carreras.php',
          timeout: 12000,
          data: datos,
          success: function(response){
            alert(response);
            getCarrerasFiltro('All');
            $("#formCarreraI").reset();
          },
          error: function(jqXHR, textStatus, errorThrown){

          }
        });
      }
    }

    function updateCarrera(id, nombre){
      $("#modificarCarrera").modal('show');
      $("#id_carrera").text(id);
      $("#txnombreCarrera").val(nombre);
    }

    function confirmUpdateCarrera(){
      var datos = $("#formModCarrera").serialize()+'&id_carrera='+$("#id_carrera").text()+'&accion=update';
      console.log(datos);
      $.ajax({
        url: '../function/get_carreras.php',
        type: 'POST',
        async: true,
        timeout: 12000,
        data: datos,
        success: function(response){
          alert(response);
          getCarrerasFiltro('All');
          $("#modificarCarrera").modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown){

        }
      });
    }

    //Recargar consulta de profesores en index
  setInterval(cons1,2000);
  function cons1 (){
    $.ajax({
        url:"../function/funciones_profesores/consulta_na.php",
        method: "POST",
        dataType:"text",
        data: {"nombre":$("#buscarPC").val()},
        success: function (data) {
          const contenido=document.getElementById('filas1');
          contenido.innerHTML=data;
        }
    });
  }
  setInterval(cons2,2000);
  function cons2 (){
    $.ajax({
        url:"../function/funciones_profesores/consulta_sa.php",
        method: "POST",
        dataType:"text",
        data: {"nombre": $("#buscarPA").val()},
        success: function (data) {
         const contenido=document.getElementById('filas2');
         contenido.innerHTML=data;
        }
    });
  }

function acepar_profe(ide){
   $.ajax({
       url:"../function/funciones_profesores/profesor_aceptar.php?mi_id="+ide,
       method: "GET",
       dataType:"text",
       success: function (data) {
        const contenido=document.getElementById('filas2');
        contenido.innerHTML=data;
       }
   });
     $("#rbusqueda").html("");
  }

function rechazar_profe(ide){
  $.ajax({
    url:"../function/funciones_profesores/profesor_rechazar.php?mi_id="+ide,
    method: "GET",
    dataType:"text",
    success: function (data) {
      const contenido=document.getElementById('filas2');
      contenido.innerHTML=data;
    }
  });
  $("#rbusqueda").html("");
}

function updateAllPlatform(){
  getAlldeptos();
  getAllCriterios();
  getAllAtributos();
  getCarreras();
  get_atributos_criterio();
  getCarrerasFiltro('All');
  getProfesoresR();
  ResponsablesFiltro('All');
}

    function getCarrerasFiltro(tipo){
      var data_filtro;
      $("#tableCarrera tbody").html("");
      if(tipo == 'All'){
        data_filtro = 'id_depto='+localStorage.getItem('depto')+'&accion=select';
      }
      else
      {
        data_filtro = $("#formCarrera").serialize()+'&id_depto='+localStorage.getItem('depto')+'&accion=select';
      }
      $.ajax({
        type: 'POST',
        async: true,
        url: '../function/get_carreras.php',
        timeout: 12000,
        data: data_filtro,
        success: function(data){
          if(data == "Sin Resultados"){
            $("#tableCarrera > thead").html("<tr><th class='center'>No se encontrarón carreras con los parametros de busqueda</th></tr>");
            $("#tableCarrera tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
          }
          else
          {
            $("#tableCarrera > thead").html("");
            $("#tableCarrera thead").append(
              "<tr>"+
              "<th>Carrera</th>"+
              "<th>Departamento</th>"+
              "<th>Acción</th>"+
              "</tr>"
            );

            $("#tableCarrera tbody").append(data);
          }
        },
        error: function(jqXHR, textStatus, errorThrown){

        }
      });
    }

   function revisacrit(){
 
    var podindiv=$('#PonderaciónIndividual').val();
    var pongrup=$('#PonderaciónGrupal').val();
    var tipo = $("#opc").val();
    console.log(parseInt(pongrup, 10)+parseInt(podindiv,10));
    if ((parseInt(pongrup, 10)+parseInt(podindiv,10))==100 && tipo == "individual/grupal") {
       insertarCricterio(podindiv, pongrup);

    }else
    {
      if(tipo == 'Individual'){
         podindiv=100; 
         pongrup=0;
         insertarCricterio(podindiv, pongrup);

      }else
      {
        if(tipo == 'Grupal'){
          podindiv=0
          pongrup=100;   
          insertarCricterio(podindiv, pongrup);
        }
        else{
          alert("no se puede insertar debido a que no acumulan el 100% ambos atributos")
        }
      }
    }
  }

function insertarCricterio(podindiv, pongrup){
  
  var data = $('#formcrit').serialize();
  data = data + '&func=insertardef';
  var id = $("#atrib").val();
  data =data + '&atributo='+id +'&pondI='+podindiv +'&pondG='+pongrup;
  console.log(data);
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/atributos.php",
    timeout: 12000,
    data: data,
    success: function(response)
    {
      console.log(response);
      alert("Criterio Registrado.");
      getAllCriterios();
    },
    error: function(jqXHR, textStatus, errorThrown){
   //   console.log(errorThrown);
    }
  });
}

function get_atributos_criterio(){
  $.ajax({
      url:"../function/get_atributos.php",
      method: "POST",
      dataType:"text",
      success: function (data) {
       const contenido=document.getElementById('atrib');
       contenido.innerHTML=data;
      }
  });
}

function getAlldeptos(){
  $("#departamentos > tbody").html(
    ""
  );
  $.ajax({
    type: 'POST',
    url: '../function/function_deptos.php',
    timeout: 12000,
    async: true,
    data: {"accion": 'all'},
    success: function(data){
      if(data == "Sin Resultados"){
        $("#departamentos > thead").html("<tr><th class='center'>No se encontrarón departamentos</th></tr>");
        $("#departamentos tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
      }
      else{
        $("#departamentos > thead").html("");
        $("#departamentos thead").append(
          "<tr>"+
          "<th>Nombre</th>"+
          "<th>Logo</th>"+
          "<th>Acción</th>"+
          "</tr>"
        );

        $("#departamentos tbody").append(
          data
        );

      }
    },
    error: function(jqXHR, textStatus, errorThrown){

    }
  });
}

function getDeptoFiltro(){
  $("#departamentos > tbody").html(
    ""
  );
  $.ajax({
    type: 'POST',
    url: '../function/function_deptos.php',
    timeout: 12000,
    async: true,
    data: $("#formDeptos").serialize() + "&accion=filtro",
    success: function(data){
      if(data == "Sin Resultados"){
        $("#departamentos > thead").html("<tr><th class='center'>No se encontrarón departamentos relacionados con la busqueda</th></tr>");
        $("#departamentos tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
      }
      else{
        $("#departamentos > thead").html("");
        $("#departamentos thead").append(
          "<tr>"+
          "<th>Nombre</th>"+
          "<th>Logo</th>"+
          "<th>Acción</th>"+
          "</tr>"
        );

        $("#departamentos tbody").append(
          data
        );

      }
    },
    error: function(jqXHR, textStatus, errorThrown){

    }
  });
}

function updateDepartamento(id, nombre, logo){
  $("#actualizarDepto").modal('show');
  $("#id_depto").text(id);
  $("#updateNameDep").val(nombre);
  $("#image_logo").attr("src",'../image/departamentos/'+logo);
}

function confirmActualización(){
  var inputFileImage = document.getElementById("fileDepto");
  var file = inputFileImage.files[0];
  console.log(file);
  var data1 = new FormData();
  data1.append('archivo',file);
  data1.append('id_depto', $("#id_depto").text());
  console.log($("#modifDepto").serialize()+'&accion=update&id_depto='+$("#id_depto").text()+'&logo='+file.name);
  if(file != null)
  {
    $.ajax({
      type: 'POST',
      async: true,
      timeout: 12000,
      url: '../function/function_deptos.php',
      data: $("#modifDepto").serialize()+'&accion=update&id_depto='+$("#id_depto").text()+'&logo='+file.name,
      success: function(data){
        console.log(data);
        if(file != null){
          $.ajax({
            type: 'POST',
            async: true,
            timeout: 12000,
            data: data1,
            contentType: false,
            processData:false,
            cache:false,
            url: '../function/function_deptos.php',
            success: function(response){
              alert(data);
              $("#actualizarDepto").modal('hide');
              getAlldeptos();
            },
            error: function(jqXHR, textStatus, errorThrown){}
          });
        }
        else
        {
          alert("Departamento Actualizado");
        }
      },
      error: function(jqXHR, textStatus, errorThrown){}
    });
  }
}

function updateDepto(){
  var inputFileImage = document.getElementById("archivoImage");
  var file = inputFileImage.files[0];
  var data = new FormData();
  data.append('archivo',file);
  var url = "upload.php";
  $.ajax({
    url:url,
    type:"POST",
    contentType:false,
    data:data,
    processData:false,
    cache:false
  });
}
function getCarreras(){
  datos_sesion = localStorage.getItem('depto');
  $.ajax({
    type: 'POST',
    url: '../function/getDataCriterio.php',
    timeout: 12000,
    async: true,
    data : {departamento: datos_sesion},
    success: function(data){
      $("#carreras_criterio").append(data);
      $("#carreras_atributo").append(data);
      $("#materais_carrera").append(data);
      $("#materias_carrera").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}

function getAtributo(carrera){
  $("#atributos_criterio").html("");
  $("#atributos_criterio").append("<option disabled selected>Selecciona un atributo</option>");
  console.log(carrera);
  $.ajax({
    type: 'POST',
    url: '../function/getDataCriterio.php',
    timeout: 12000,
    async: true,
    data : {carrera: carrera},
    success: function(data){
      $("#atributos_criterio").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}

function getCriterios(){
  datos_sesion = localStorage.getItem('depto');
  $("#table_criterios > tbody").html("");
  var datos = $("#criterios_form").serialize();
  var datos = datos + '&depto='+ datos_sesion;
  $.ajax({
    type: 'POST',
    url: '../function/getDataCriterio.php',
    timeout: 12000,
    async: true,
    data: datos,
    success: function(data){
      if(data == "Sin resultados"){
        $("#table_criterios > thead").html("<tr><th class='center'>No se encontrarón criterios relacionados con la busqueda</th></tr>");
        $("#table_criterios tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
      }
      else
      {
        $("#table_criterios > thead").html("");
        $("#table_criterios thead").append('<tr><th scope="col">Nombre</th>'+
        '<th scope="col">Descripción</th>'+
        '<th scope="col">Ponderación Individual</th>'+
        '<th scope="col">Ponderación Grupal</th>'+
        '<th scope="col">Atributo</th>'+
        '<th scope="col">Tipo</th>'+
        '<th scope="col">Acciones</th></tr>');
        $("#table_criterios tbody").append(data);
      }
    },
    error : function(jqXHR, textStatus, errorThrown){

    }
  });
  
}


function getAllCriterios(){
  datos_sesion = localStorage.getItem('depto');
  $("#criterios_form")[0].reset();
  $("#atributos_criterio").html("");
  $("#atributos_criterio").append("<option disabled selected>Selecciona un atributo</option>");
  $("#table_criterios > tbody").html("");
  $.ajax({
    type: 'POST',
    url: '../function/getDataCriterio.php',
    timeout: 12000,
    async: true,
    data: {"Alldepto": datos_sesion},
    success: function(data){
      if(data == "Sin Atributos"){
        $("#table_criterios > thead").html("<tr><th class='center'>No se encontrarón criterios relacionados con la busqueda</th></tr>");
        $("#table_criterios tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
      }
      else
      {
        $("#table_criterios > thead").html("");
        $("#table_criterios thead").append('<tr><th scope="col">Nombre</th>'+
        '<th scope="col">Descripción</th>'+
        '<th scope="col">Ponderación Individual</th>'+
        '<th scope="col">Ponderación Grupal</th>'+
        '<th scope="col">Atributo</th>'+
        '<th scope="col">Tipo</th>'+
        '<th scope="col">Acciones</th></tr>');
        $("#table_criterios tbody").append(data);
      }
    },
    error : function(jqXHR, textStatus, errorThrown){

    }
  });
}

function getAtributos(){
  datos_sesion = localStorage.getItem('depto');
  $("#tabla_atributos > tbody").html("");
  $.ajax({
    type: 'POST',
    url: '../function/getdata.php',
    timeout: 12000,
    async: true,
    data: $("#Atributos").serialize() + "&depto="+datos_sesion,
    success:function(data){
      console.log(data);
      if(data != ''){
        if(data == "Sin Atributos"){
          $("#tabla_atributos > thead").html("<tr><th class='center'>No se encontrarón atributos relacionados con la busqueda</th></tr>");
          $("#tabla_atributos tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
        }
        else{
          $("#tabla_atributos > thead").html("");
          $("#tabla_atributos thead").append("<tr>"+
          "<th scope='col'>id</th>"+
          "<th scope='col'>Nombre</th>"+
          "<th scope='col'>Descripción</th>"+
          '<th scope="col">Carrera</th>'+
          "<th scope='col'>Acciones</th>"
        +"</tr>");
          $("#tabla_atributos tbody").append(data);
        }
      }
      else
      {
        console.log(data);
      }
    },
    error:function(jqXHR, textStatus, errorThrown){
      console.log(textStatus);
      alert(jqXHR);
    }
  });
}

function getAllAtributos(){
  datos_sesion = localStorage.getItem('depto');
  $("#tabla_atributos > tbody").html("");
  $.ajax({
    type: 'POST',
    url: '../function/getdata.php',
    timeout: 12000,
    async: true,
    data: {'filtro':"All", "depto" : datos_sesion},
    success:function(data){
      if(data != ''){
        if(data == "Sin Atributos"){
          $("#tabla_atributos > thead").html("<tr><th class='center'>No hay atributos registrados</th></tr>");
          $("#tabla_atributos tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.jpg"+"'>"+"</td></tr>");
        }
        else{      
          $("#tabla_atributos > thead").html("");
          $("#tabla_atributos thead").append("<tr>"+
          "<th scope='col'>id</th>"+
          "<th scope='col'>Nombre</th>"+
          "<th scope='col'>Descripción</th>"+
          '<th scope="col">Carrera</th>'+
          "<th scope='col'>Acciones</th>"
        +"</tr>");
          $("#tabla_atributos tbody").append(data);
        }
      }
    },
    error:function(jqXHR, textStatus, errorThrown){
      console.log(textStatus);
      alert(jqXHR);
    }
  });
}
function insertarAtributo(){

  let data = $('#form').serialize();
  data = data + '&func=insertar';
  console.log(data);
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/atributos.php",
    timeout: 12000,
    data: data,
    success: function(response)
    {
      console.log(response);
      alert("Atributo cargada.");
      getAllAtributos();
    },
    error: function(jqXHR, textStatus, errorThrown){
   //   console.log(errorThrown);
    }
  });
}


function verAtributos(p){
  $("#tabla_atributos").empty();
  $("#paginas").empty();
  if(p==null)p=1;
  a=p;
  var fun = "consultar";
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/atributos.php",
    timeout: 12000,
    data:{pagina:p,func:fun,nombre:"x"},
    dataType: "json",
    success: function(response)
    {
      var i=0;
      $.each(response, function(key, value) {
          $("#tabla_atributos").append(
            "<tr>"+
              "<th scope='row'>"+ value.nombre +"</th>"+
              "<td>"+value.desc+"</td>"+
              "<td>"+value.estado+"</td>"+
              "<td>"+
              "<a href='#' onclick='modificarAtributo("+value.id+")'>Modificar</a>"+
              "|<a href='#' id='href"+value.id+"' onclick='eliminarAtributo("+value.id+")'>Eliminar</a>"+
              "</td>"+
            "</tr>"
          );
          i++;
      });
      getPaginas();

    },
    error: function(jqXHR, textStatus, errorThrown){
     // console.log(errorThrown);
    }
  });
}
function getPaginas(){
  $("#paginas").empty();
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/get_paginas.php",
    timeout: 12000,
    dataType: "json",
    success: function(response)
    {
      var pag=0;
      if(response%5==0){
        pag = response / 5;

      }else{
        pag = response / 5;
        pag = parseInt(pag);
        pag++;
      }

      for (var i = 0; i <= pag+1; i++) {
        if(i==0)$("#paginas").append("<li onclick='verAtributos(1)'><a>|<<</a></li><li><a><<</a></li>");
        else if(i==pag+1) $("#paginas").append("<li><a>>></a></li><li onclick='verAtributos("+pag+")'><a>>>|</a></li>");
        else{
          if(i==a) $("#paginas").append("<li class='pageSelected'>"+i+"</li>");
          else $("#paginas").append("<li onclick='verAtributos("+i+")'><a>"+i+"</a></li>");
        }

      }

    },
    error: function(jqXHR, textStatus, errorThrown){
      //console.log(errorThrown);
    }
  });
}

function modificarAtributo(value, descr, id){
  $('#modificar').modal('show');
  $("#txdesc").val(descr);
  $("#txnombre").val(value);
  mod = id;
}

function confirmMod(){
  var name = $("#txnombre").val();

  var desc = $("#txdesc").val();
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/atributos.php",
    timeout: 12000,
    data: {func:"actualizar",Atributo:mod,Nombre:name, Descripcion:desc},
    dataType:"json",
    success: function(response)
    {
      //var obje = JSON.parse(response);
      JSON.stringify(response);
      alert(response.msga);
      $('#modificar').modal('hide');
      getAllAtributos();
    },
    error: function(jqXHR, textStatus, errorThrown){
      console.log(errorThrown);
      //console.log(errorThrown);
    }
  });
}


function modificarAtributo(value){
  $('#modificar').modal('show');
  mod = value;

}
function confirmDelete(){
  var fun = "eliminar";

  $.ajax({
    type: "POST",
    async: true,
    url: "../function/atributos.php",
    timeout: 12000,
    data:{func:fun,id:del},
    success: function(response)
    {
      var obj = JSON.parse(response);
      alert(obj.msg);
      getAllAtributos();
      $('#eliminar').modal('hide');
      updateAllPlatform();
    },
    error: function(jqXHR, textStatus, errorThrown){
      //console.log(errorThrown);
    }
  });
}

function setdata_sesion(data){
  localStorage.setItem('depto', data.split('\n')[1]);
  getAlldeptos();
  getAllCriterios();
  getAllAtributos();
  getCarreras();
  get_atributos_criterio();
  getCarrerasFiltro('All');
  getMaterias('All');
  getProfesoresR();
  ResponsablesFiltro('All');
}
function get_datos_sesion(){

  $.ajax({

      url:"../function/get_datos_sesion.php",

      method: "POST",

      data:{usuario:myvar},

      success: function (data) {
        setdata_sesion(data);
      }

  });

}

//Necesita id_criterio,nombre_criterio

function eliminarCriterio(idC,nomC){

  $('#eliminarc').modal('show');

  $("#datoc").html(nomC);

  del = idC;

}

function confirmDeleteC(){

  var fun = "eliminarC";
  console.log(del);
  $.ajax({

    type: "POST",

    async: true,

    url: "../function/criterios.php",

    timeout: 12000,

    data:{func:fun,id:del},

    success: function(response)

    {

      var obj = JSON.parse(response);
      console.log(response);
      alert(obj.msg);

      getAllCriterios();
      updateAllPlatform();
      $('#eliminarc').modal('hide');

    },

    error: function(jqXHR, textStatus, errorThrown){

      //console.log(errorThrown);

    }

  });

}

function insertar_departamento(){
  var fun = "insertar";
  var fd = new FormData();
  var inputFileImage = document.getElementById("insertFileDepto");
  var files = inputFileImage.files[0];
  fd.append('file',files);
  var nombre=$("#nombre_depto").val();
  console.log(nombre);
  fd.append('nombre',nombre);
  //fd.append('func',fun);
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/departamento.php",
    contentType: false,
    processData: false,
    timeout: 12000,
    data: fd,
    success: function(response)
    {
      console.log(response);
      $("#formDeptoInsert")[0].reset();
      getAlldeptos();
    },
    error: function(jqXHR, textStatus, errorThrown){
      //console.log(errorThrown);
    }
  });
}



//Necesita id_departamento,nombre_departamento

function eliminarDto(id,nomC){

  $('#eliminarDto').modal('show');

  $("#datodto").html(nomC);

  del = id;

}

function confirmDeleteDto(){

  var fun = "eliminarDto";

  $.ajax({

    type: "POST",

    async: true,

    url: "../function/departamentos.php",

    timeout: 12000,

    data:{func:fun,id:del},

    success: function(response)

    {

      var obj = JSON.parse(response);

      alert(obj.msg);

      getAlldeptos();
      updateAllPlatform();

      $('#eliminarDto').modal('hide');

    },

    error: function(jqXHR, textStatus, errorThrown){

      //console.log(errorThrown);

    }

  });

}



//Necesita id_ carrera,nombre_carrera

function eliminarCarrera(id,nomC){

  $('#eliminarCarrera').modal('show');

  $("#datocarrera").html(nomC);

  del = id;

}

function confirmDeleteCarrera(){

  var fun = "eliminarCarrera";

  $.ajax({

    type: "POST",

    async: true,

    url: "../function/carreras.php",

    timeout: 12000,

    data:{func:fun,id:del},

    success: function(response)

    {

      var obj = JSON.parse(response);

      alert(obj.msg);

      //getAllCriterios();
      updateAllPlatform()

      $('#eliminarCarrera').modal('hide');

    },

    error: function(jqXHR, textStatus, errorThrown){

      //console.log(errorThrown);

    }

  });

}

/* FUNCIONES PARA MODIFICAR CRITERIOS */

function modificarCriterio(value, nombre, descripcion, tipo, pondI, pondG){

  $('#modificarCrit').modal('show');

  $("#txnombreCrit").val(nombre);

  $("#txdesCrit").val(descripcion);

  $("#modifTipoCriterio").val(tipo);

  $("#txpondCrit").val(pondI);
  
  $("#txpondCritG").val(pondG);

  mod = value;

}



function confirmModCriterio(){
  var name = $("#txnombreCrit").val();

  var desc = $("#txdesCrit").val();

  var tipo = $("#modifTipoCriterio").val();
  var pondI = 0;
  var pondG = 0;
  if(tipo == "individual/grupal"){
    pondI = $("#txpondCrit").val();
    pondG = $("#txpondCritG").val();
  }
  else{
    if(tipo == "Individual"){
      pondI = 100;
    }
    else{
      pondG = 100;
    }
  }
  
  if((parseInt(pondI, 10) + parseInt(pondG, 10)) == 100){
    $.ajax({
        type: "POST",
        async: true,
        url: "../function/criterios.php",
        timeout: 12000,
        data: {
            "func": "actualizar",
            "Criterio": mod,
            "Nombre": name,
            "Descripcion": desc,
            "PonderacionI": pondI,
            "PonderacionG": pondG,
            "tipo" : tipo
        },
        success: function(response)
        {
          alert(response);
          $('#modificarCrit').modal('hide');
          getAllCriterios();
        },
        error: function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown);
        }
    });
  }
  else{
    alert("Ponderaciones invalidas");
  }
}