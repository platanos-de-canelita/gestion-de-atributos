var a=0;
var del;
var mod;
var name;
var datos_sesion;

function eliminarEval(){
  $.ajax({
    type : 'POST',
    async : true,
    timeout : 12000,
    url : '../function/responsable/load_data_evaluaciones.php',
    data : 'id='+localStorage.getItem('id_eval')+'&accion=delete',
    success : function(response){
      alert(response);
      $("#Evaluaciones").modal("hide");
      getEvaluaciones('All');
    }
  });
}

function deleteEval(id){
  localStorage.setItem('id_eval', id);
  $("#Evaluaciones").modal("show");
}
function getEvaluaciones(accion){
  var datos = "accion=select&depto="+localStorage.getItem('depto');
  if(accion == ""){
    datos = datos + "&" + $("#formFiltEv").serialize();
  }
  else{
    $("#formFiltEv").trigger("reset");
  }
  $("#tabla_Evaluaciones > tbody").html("");

  $.ajax({
    type : 'POST',
    async : true,
    timeout : 12000,
    url : '../function/responsable/load_data_evaluaciones.php',
    data : datos,
    success : function(response){
      if(response == "Sin Resultados"){
        $("#tabla_Evaluaciones > thead").html("<tr><th class='center'>No hay evaluaciones registradas</th></tr>");
        $("#tabla_Evaluaciones tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png'>"+"</td></tr>");
      }
      else{      
        $("#tabla_Evaluaciones > thead").html("");
        $("#tabla_Evaluaciones thead").append("<tr>"+
        "<th scope='col'>ID</th>"+
        "<th scope='col'>Carrera</th>"+
        "<th scope='col'>Materia</th>"+
        "<th scope='col'>Profesor</th>"+
        "<th scope='col'>Tipo</th>"+
        "<th scope='col'>Acciones</th>"
      +"</tr>");
        $("#tabla_Evaluaciones tbody").append(response); 
      }
    }
  });
}

function load_carreras(){
  $("#carrera_ev").html("");
  $("#carrera_ev").append('<option disabled selected>Selecciona una carrera</option>');
  $("#carrera_ev_fil").html("");
  $("#carrera_ev_fil").append('<option disabled selected>Selecciona una carrera</option>');
  $.ajax({
    type: 'POST',
    async : true,
    url: "../function/responsable/load_data_evaluaciones.php",
    timeout: 12000,
    data: 'accion=Ccarrera&depto='+localStorage.getItem('depto'),
    success : function(response){
      console.log(response);
      $("#carrera_ev").append(response);
      $("#carrera_ev_fil").append(response);
    }
  });
}

function getAllMaterias(){
  $("#materia_ev_fil2").html('');
  $("#materia_ev_fil2").append("<option disabled selected>Selecciona una materia</option>");  
  $.ajax({
    type : 'POST',
    async : true,
    url : '../function/responsable/load_data_evaluaciones.php',
    timeout : 12000,
    data : 'accion=Cmateria&depto='+localStorage.getItem('depto'),
    success : function(response){
      $("#materia_ev_fil2").append(response);
    } 
  });
}

function getMateriasFil(){
  $("#materia_ev_fil").html('');
  $("#materia_ev_fil").append("<option disabled selected>Selecciona una materia</option>");  
      
  $.ajax({
    type : 'POST',
    async : true,
    url : '../function/responsable/load_data_evaluaciones.php',
    timeout : 12000,
    data : 'accion=Cmateria&depto='+localStorage.getItem('depto')+'&id_carrera='+$("#carrera_ev_fil").val(),
    success : function(response){
      $("#materia_ev_fil").append(response);
    } 
  });
}

function SetEval(){
  var data = $("#formEv").serialize()+"&accion=insert&depto="+localStorage.getItem('depto');
  $.ajax({
    type : 'POST',
    async : true,
    timeout : 12000,
    data : data,
    url : '../function/responsable/load_data_evaluaciones.php',
    success : function(response){
      alert(response);
      if(response == "Evaluación registrada con éxito"){
        $("#formEv").trigger('reset');
        getEvaluaciones("All");
      }
    }
  });
}
 

function updateAllPlatform(){
  getAllatrib_mate();
  getAllAtributos();
 

}


   function revisaAsigmat(){
    var carrera=$('#carreras_criterio').val();
    var materia=$('#materias_criterio').val();
    var atributo = $("#atributos_criterio").val();
    
    if (carrera==null || materia==null || atributo==null) {
      alert("Todos los campos son obligatorios. Selecciones alguna opción")

    }
    else{
      verifE(carrera, materia,atributo);
    }
  }
  function verifE(carrera,materia,atributo){
    data ='func=verifE';
    data =data + '&carrera='+carrera +'&materia='+materia +'&atributo='+atributo;
    console.log(data);
    $.ajax({
      type: "POST",
      async: true,
      url: "../function/atribMat.php",
      timeout: 12000,
      data: data,
      success: function(response)
      {
        if(response == "Sin resultados"){
          insertarAtribMate(carrera, materia,atributo);
        }
        else
        {
          alert(response);
          getAllatrib_mate();
        }
      },
      error: function(jqXHR, textStatus, errorThrown){
    //   console.log(errorThrown);
      }
    });
}

  function insertarAtribMate(carrera,materia,atributo){
    data ='func=insertarAtribMate';
    data =data + '&carrera='+carrera +'&materia='+materia +'&atributo='+atributo;
    console.log(data);
    $.ajax({
      type: "POST",
      async: true,
      url: "../function/atributos.php",
      timeout: 12000,
      data: data,
      success: function(response)
      {
        alert(response);
        getAllatrib_mate();//-------------------get all
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
      $("#carreras_criterio").append(data);
      $("#carreras_atributoo").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}

function getAtributo(carrera){//---------
  $("#atributos_criterio").html("");
  $("#atributos_criterio").append("<option disabled selected>Selecciona un atributo</option>");
  console.log(carrera);
  $.ajax({
    type: 'POST',
    url: '../function/getDataAtribMat.php',
    timeout: 12000,
    async: true,
    data : {carrera: carrera},
    success: function(data){
      if(data=="")
        alert("No existen atributos registrados para esta carrera");
      $("#atributos_criterio").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}

function getMateria(carrera){//---------GET MATERIA(Carrera) otro método
  $("#materias_criterio").html("");
  $("#materias_criterio").append("<option disabled selected>Selecciona una materia</option>");
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
      $("#materias_criterio").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}
//-----------------pppppppppppppppppppppppppppppppppppppppppp
function getatrib_mate(){
  datos_sesion = localStorage.getItem('depto');
  
  $("#table_atrib_mate > tbody").html("");
  var datos = $("#atrib_mate_form").serialize();
  datos = datos + '&Allatr_mat='+ datos_sesion;
  $.ajax({
    type: 'POST',
    url: '../function/getDataAtribMat.php',
    timeout: 12000,
    async: true,
    data: datos,
    success: function(data){
      if(data == "Sin resultados"){
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
  $("#atrib_mate_form")[0].reset();//------todo en blanco
  $("#carreras_atributoo").html("");
  $("#carreras_atributoo").append("<option disabled selected>Selecciona una carrera</option>");
  $("#carreras_criterio").html("");
  $("#carreras_criterio").append("<option disabled selected>Selecciona una carrera</option>");
  getCarreras();
//------------------
}


function getAllatrib_mate(){
  datos_sesion = localStorage.getItem('depto');
  $("#atrib_mate_form")[0].reset();//------todo en blanco
  $("#carreras_criterio").html("");
  $("#carreras_criterio").append("<option disabled selected>Selecciona una carrera</option>");
  $("#materias_criterio").html("");
  $("#materias_criterio").append("<option disabled selected>Selecciona una materia</option>");
  $("#atributos_criterio").html("");
  $("#atributos_criterio").append("<option disabled selected>Selecciona un atributo</option>");
  getCarreras();
//-------------------------------------------------------------------------

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


function setdata_sesion(data){
  console.log(data);
  localStorage.setItem('depto', data.split('\n')[1]);
  getEvaluaciones();
  load_carreras();
  getAllMaterias();
  getMateriasFil();
  getAllatrib_mate();
  getAllAtributos();
}
function get_datos_sesion(){
  console.log(myvar);
  $.ajax({

      url:"../function/get_datos_sesion.php",//-----------------------SESIÓN----------------

      method: "POST",

      data:{usuario:myvar, tipo : localStorage.getItem('tipo_usuario')},

      success: function (data) {
        console.log(data);
        setdata_sesion(data);
      }

  });

}

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



