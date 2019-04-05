$( document ).ready(function() {
  getAllAtributos();
  get_atributos_criterio();
});

function getAtributos(){

  $("#atributos_table > tbody").html("");
  console.log('En getAtributos');
  $.ajax({
    type: 'POST',
    url: '../function/getdata.php',
    timeout: 12000,
    async: true,
    data: $("#Atributos").serialize(),
    success:function(data){
      console.log(data);
      if(data != ''){
        if(data == "Sin Atributos"){
          $("#atributos_table > thead").html("<tr><th class='center'>No se encontrarón atributos relacionados con la busqueda</th></tr>");
          $("#atributos_table tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.png"+"'>"+"</td></tr>");
        }
        else{
          $("#atributos_table > thead").html("");
          $("#atributos_table thead").append("<tr>"+
          "<th scope='col'>id</th>"+
          "<th scope='col'>Nombre</th>"+
          "<th scope='col'>Descripción</th>"+
          '<th scope="col">Ponderación</th>'+
          "<th scope='col'>Acciones</th>"
        +"</tr>");
          $("#atributos_table tbody").append(data);
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
  $("#atributos_table > tbody").html("");
  $.ajax({
    type: 'POST',
    url: '../function/getdata.php',
    timeout: 12000,
    async: true,
    data: {'filtro':"All"},
    success:function(data){
      if(data != ''){
        if(data == "Sin Atributos"){
          $("#atributos_table > thead").html("<tr><th class='center'>No hay atributos registrados</th></tr>");
          $("#atributos_table tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.jpg"+"'>"+"</td></tr>");
        }
        else{
          $("#atributos_table > thead").html("");
          $("#atributos_table thead").append("<tr>"+
          "<th scope='col'>id</th>"+
          "<th scope='col'>Nombre</th>"+
          "<th scope='col'>Descripción</th>"+
          '<th scope="col">Ponderación</th>'+
          "<th scope='col'>Acciones</th>"
        +"</tr>");
          $("#atributos_table tbody").append(data);
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
  alert("entre aqui");
  let data = $('#form').serialize();
  data = data + '&func=insertar';
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


function eliminarAtributo(value){
  $('#eliminar').modal('show');
  $("#dato").append(value);
  del = value;
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
    },
    error: function(jqXHR, textStatus, errorThrown){
      //console.log(errorThrown);
    }
  });
}


function modificarAtributo(value){
  $('#modificar').modal('show');
  mod = value;

}
function confirmMod(){
  var name = $("#txnombre").val();
  var desc = $("#txdesc").val();
  var pond = $("#txpond").val();
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/atributos.php",
    timeout: 12000,
    data: {func:"actualizar",Atributo:mod,Nombre:name, Descripcion:desc,Ponderacion:pond},
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
      //console.log(errorThrown);
    }
  });
}
setInterval(cons1,2000);
  function cons1 (){
    $.ajax({
        url:"../function/funciones_profesores/consulta_na.php",
        method: "POST",
        dataType:"text",
        success: function (data) {
         const contenido=document.getElementById('filas1');
         contenido.innerHTML=data;
        }
    });
  }
//Recargar consulta de profesores en index
  setInterval(cons2,2000);
    function cons2 (){
      $.ajax({
          url:"../function/funciones_profesores/consulta_sa.php",
          method: "POST",
          dataType:"text",
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
function get_datos_sesion(){
  $.ajax({
      url:"../function/get_datos_sesion.php",
      method: "POST",
      data:{usuario:myvar},
      success: function (data) {
        return data;
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
