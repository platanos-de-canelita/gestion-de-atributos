var a=0;
var del;
var mod;
var name;

$( document ).ready(function() {
  $("#paginas").empty();


});



<<<<<<< HEAD
function consultar_atributo(){
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/atributos.php",
=======
function insertarAtributo(){
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/registrar_Atributo.php",
>>>>>>> 409a5792a636ec2038806a7303c8a51b7e80fbbf
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
  $("#filas").empty();
  $("#paginas").empty();
  if(p==null)p=1;
  a=p;
  $.ajax({
    type: "GET",
    async: true,
    url: "../function/get_Atributos.php",
    timeout: 12000,
    data:{pagina:p},
    dataType: "json",
    success: function(response)
    {
      var i=0;
      $.each(response, function(key, value) {
          $("#filas").append(
            "<tr>"+
              "<th scope='row'>"+ value.sub_id +"</th>"+
              "<td>"+value.sub_name+"</td>"+
              "<td>"+
              "<a href='' onclick='modificarAtributo("+value.sub_id+")'>Modificar</a>"+
              "|<a href='#' id='href"+value.sub_id+"' onclick='eliminarAtributo("+value.sub_id+")'>Eliminar</a>"+
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
