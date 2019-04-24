var a=0;
var name;
var datos_sesion;


function updateAllPlatform(){
  getAllgroups_t();

}


   function revisaGrupo(){
    var grupo = trim($("#group_nvo").val());
    var carrera=$('#group_carreras').val();
    var materia=$('#group_materias').val();
    
    if (carrera==null || materia==null || grupo=="") {
      alert("Todos los datos son obligatorios.")
    }
    else{
      insertarGrupo(grupo,carrera, materia);
    }
  }
  function insertarGrupo(grupo,carrera,materia){
    profesor = localStorage.getItem('usr_pk');
    data ='func=insertarGrupo';
    data =data + '&grupo='+grupo +'&carrera='+carrera +'&materia='+materia+'&profesor='+profesor;
    console.log(data);
    $.ajax({
      type: "POST",
      async: true,
      url: "../function/funciones_profesores/getDataGroups.php",
      timeout: 12000,
      data: data,
      success: function(response)
      {
        alert(response);
       // getAllgroups_t();//-------------------get all
      },
      error: function(jqXHR, textStatus, errorThrown){
    //   console.log(errorThrown);
      }
    });
}

function revisaAlumno(){
  var carrera=$('#carreras_alu').val();
  var materia=$('#materias_alu').val();
  var grupo=$('#group_names').val();
  var alumno = $("#group_alumnos").val();
  
  if (carrera==null || materia==null || grupo==null || alumno==null) {
    alert("Todos los campos son obligatorios. Selecciones alguna opción")

  }
  else{
    insertarAlumno(grupo,alumno);
  }
}
function insertarAlumno(grupo,alumno){
  
  
  data ='func=insertarAlu';
  data =data + '&grupo='+grupo +'&alumno='+alumno;
  console.log(data);
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/funciones_profesores/getDataGroups.php",
    timeout: 12000,
    data: data,
    success: function(response)
    {
      $("#group_carreras").html("");
      $("#group_carreras").append("<option disabled selected>Seleccionar carrera</option>");
      $("#carreras_alu").html("");
      $("#carreras_alu").append("<option disabled selected>Seleccionar carrera</option>");

      alert(response);
     // getAllgroups_t();//-------------------get all
     getCarreras();
    },
    error: function(jqXHR, textStatus, errorThrown){
  //   console.log(errorThrown);
    }
  });
}


function getCarreras(){
  datos_sesion = localStorage.getItem('depto');
  $.ajax({
    type: 'POST',
    url: '../function/getDataAtribMat.php',
    timeout: 12000,
    async: true,
    data : {departamento: datos_sesion},
    success: function(data){
      if(data=="")
        alert("No existen carreras registradas para su departamento");
      $("#group_carreras").append(data);
      $("#carreras_alu").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}
function getMateria(carrera){//---------GET MATERIA(Carrera) otro método
  alert(carrera+"************");
  $("#group_materias").html("");
  $("#group_materias").append("<option disabled selected>Seleccionar materia</option>");
  $("#materias_alu").html("");
  $("#materias_alu").append("<option disabled selected>Seleccionar materia</option>");
  console.log(carrera);
  $.ajax({
    type: 'POST',
    url: '../function/getDataAtribMat.php',
    timeout: 12000,
    async: true,
    data : {carre: carrera},
    success: function(data){
      if(data=="")
        alert("No existen materias registradas para esta carrera");
      $("#group_materias").append(data);
      $("#materias_alu").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}
function getGrupos(materia){//---------
  $("#group_names").html("");
  $("#group_names").append("<option disabled selected>Seleccionar grupo</option>");
  console.log(materia);
  $.ajax({
    type: 'POST',
    url: '../function/funciones_profesores/getDataGroups.php',
    timeout: 12000,
    async: true,
    data : {materiag: materia},
    success: function(data){
      if(data=="")
        alert("No existen grupos registrados para esta materia");
      $("#group_names").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){
    }
  });
}
function getAlumnos(materia){//---------
  $("#group_alumnos").html("");
  $("#group_alumnos").append("<option disabled selected>Seleccionar alumno</option>");
  console.log(materia);
  $.ajax({
    type: 'POST',
    url: '../function/funciones_profesores/getDataGroups.php',
    timeout: 12000,
    async: true,
    data : {materia: materia},
    success: function(data){
      if(data=="")
        alert("No existen alumnos registrados para esta materia");
      $("#group_alumnos").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){
    }
  });
}




//-----------------pppppppppppppppppppppppppppppppppppppppppp



function getAllgroups_t(){
  datos_sesion = localStorage.getItem('depto');
  $("#atrib_mate_form")[0].reset();//------todo en blanco
  $("#carreras_criterio").html("");
  $("#carreras_criterio").append("<option disabled selected>Seleccionar carrera</option>");
  $("#group_materias").html("");
  $("#group_materias").append("<option disabled selected>Seleccionar materia</option>");
  $("#group_alumnos").html("");
  $("#group_alumnos").append("<option disabled selected>Seleccionar alumno</option>");
  getCarreras();
//-------------------------------------------------------------------------

//Necesita id_criterio,nombre_criterio

function eliminarAtribMat(idmat,idatr,idcarr){
  $('#eliminarc').modal('show');
  del1 = idmat;
  del2=idatr;
  del3=idcarr;

}

function confirmDeleteC(){
  var fun = "eliminarC";
  console.log(del);
  $.ajax({

    type: "POST",

    async: true,

    url: "../function/atribMat.php",

    timeout: 12000,

    data:{func:fun,idM:del1,idA:del2,idC:del3},

    success: function(response)

    {

      var obj = JSON.parse(response);
      console.log(response);
      alert(obj.msg);

      updateAllPlatform();
      $('#eliminarc').modal('hide');

    },

    error: function(jqXHR, textStatus, errorThrown){

      //console.log(errorThrown);

    }

  });

}

  $("#table_atrib_mate > tbody").html("");
  $.ajax({
    type: 'POST',
    url: '../function/getDataAtribMat.php',
    timeout: 12000,
    async: true,
    data: {"Allatr_mat": datos_sesion},
  
    success: function(data){
      if(data == "Sin Atributos"){
        $("#table_atrib_mate > thead").html("<tr><th class='center'>No se encontrarón atributos relacionados con la busqueda</th></tr>");
        $("#table_atrib_mate tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
      }
      else
      {
        $("#table_atrib_mate > thead").html("");
        $("#table_atrib_mate thead").append('<tr><th scope="col">Carrera</th>'+
        '<th scope="col">Materia</th>'+
        '<th scope="col">Atributo</th>'+
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
}/*
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
*/




function setdata_sesion(data){
  localStorage.setItem('depto', data);
}
function get_datos_sesion(){
  $.ajax({

      url:"../function/get_datos_sesion.php",//-----------------------SESIÓN----------------

      method: "POST",

      data:{usuario:myvar},

      success: function (data) {
        setdata_sesion(data);
      }

  });
}

function setdata_sesionPK(data){
  localStorage.setItem('usr_pk', data);
}
function get_datos_sesionPK(){
  $.ajax({
      url:"../function/funciones_profesores/getDataGroups.php",//-----------------------SESIÓN----------------
      method: "POST",
      data:{usuario:myvar},
      success: function (data) {
        setdata_sesionPK(data);
      }

  });
}









