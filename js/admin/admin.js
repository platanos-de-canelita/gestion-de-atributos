var a=0;
var del;
var mod;
var name;

$( document ).ready(function() {
  $("#paginas").empty();
  verAtributos();

});




function consultar_atributo(){
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/atributos.php",
  });
}
function insertarAtributo(){
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/registrar_Atributo.php",
    timeout: 12000,
    data: {func:"consultar",},
    dataType:json,
    success: function(response)
    {
      alert("Atributo cargada.");
    },
    error: function(jqXHR, textStatus, errorThrown){
      console.log(errorThrown);
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
    type: "GET",
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
              "<td>"+"1"+"</td>"+
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
      console.log(errorThrown);
    }
  });
}
function getPaginas(){
  $("#paginas").empty();
  $.ajax({
    type: "GET",
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
      console.log(errorThrown);
    }
  });
}
function modificarAtributo(value){
  $('#modificar').modal('show');

}
function confirmMod(){
  $.ajax({
    type: "GET",
    async: true,
    url: "../function/modificar_Atributo.php",
    timeout: 12000,
    data:{Atributo:del},
    success: function()
    {
      alert("Atributo eliminada");
    },
    error: function(jqXHR, textStatus, errorThrown){
      console.log(errorThrown);
    }
  });
}


function eliminarAtributo(value){
  $('#eliminar').modal('show');
  $("#dato").append(value);
  del = value;
}
function confirmDelete(){
  $.ajax({
    type: "GET",
    async: true,
    url: "../function/borrar_Atributo.php",
    timeout: 12000,
    data:{Atributo:del},
    success: function()
    {
      alert("Atributo eliminada");
    },
    error: function(jqXHR, textStatus, errorThrown){
      console.log(errorThrown);
    }
  });
}
