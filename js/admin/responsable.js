var a=0;
var del;
var mod;
var name;
var datos_sesion;



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

 

function updateAllPlatform(){
  getAlldeptos();
  getAllatrib_mate();
  getAllAtributos();
  getCarreras();

  getCarrerasFiltro('All');
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
      getAllatrib_mate();
    },
    error: function(jqXHR, textStatus, errorThrown){
   //   console.log(errorThrown);
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
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}

function getAtributo(carrera){//---------GET MATERIA(Carrera) otro método
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

function getatrib_mate(){
  datos_sesion = localStorage.getItem('depto');
  $("#table_atrib_mate > tbody").html("");
  var datos = $("#atrib_mate_form").serialize();
  var datos = datos + '&depto='+ datos_sesion;
  $.ajax({
    type: 'POST',
    url: '../function/getDataCriterio.php',
    timeout: 12000,
    async: true,
    data: datos,
    success: function(data){
      if(data == "Sin resultados"){
        $("#table_atrib_mate > thead").html("<tr><th class='center'>No se encontrarón criterios relacionados con la busqueda</th></tr>");
        $("#table_atrib_mate tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
      }
      else
      {
        $("#table_atrib_mate > thead").html("");
        $("#table_atrib_mate thead").append('<tr><th scope="col">Nombre</th>'+
        '<th scope="col">Descripción</th>'+
        '<th scope="col">Ponderación Individual</th>'+
        '<th scope="col">Ponderación Grupal</th>'+
        '<th scope="col">Atributo</th>'+
        '<th scope="col">Tipo</th>'+
        '<th scope="col">Acciones</th></tr>');
        $("#table_atrib_mate tbody").append(data);
      }
    },
    error : function(jqXHR, textStatus, errorThrown){

    }
  });
  
}


function getAllatrib_mate(){
  datos_sesion = localStorage.getItem('depto');
  $("#atrib_mate_form")[0].reset();
  $("#atributos_criterio").html("");
  $("#atributos_criterio").append("<option disabled selected>Selecciona un atributo</option>");
  $("#table_atrib_mate > tbody").html("");
  $.ajax({
    type: 'POST',
    url: '../function/getDataCriterio.php',
    timeout: 12000,
    async: true,
    data: {"Alldepto": datos_sesion},
    success: function(data){
      if(data == "Sin Atributos"){
        $("#table_atrib_mate > thead").html("<tr><th class='center'>No se encontrarón criterios relacionados con la busqueda</th></tr>");
        $("#table_atrib_mate tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
      }
      else
      {
        $("#table_atrib_mate > thead").html("");
        $("#table_atrib_mate thead").append('<tr><th scope="col">Nombre</th>'+
        '<th scope="col">Descripción</th>'+
        '<th scope="col">Ponderación Individual</th>'+
        '<th scope="col">Ponderación Grupal</th>'+
        '<th scope="col">Atributo</th>'+
        '<th scope="col">Tipo</th>'+
        '<th scope="col">Acciones</th></tr>');
        $("#table_atrib_mate tbody").append(data);
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
  datos_sesion = localStorage.getItem('depto');//****el del admin */
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
  localStorage.setItem('depto', data);
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

      getAllatrib_mate();
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

      //getAllatrib_mate();
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
          getAllatrib_mate();
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