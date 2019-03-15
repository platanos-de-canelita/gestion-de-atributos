function getAtributos(){
  $("#atributos_table > tbody").html("");
  $.ajax({
    type: 'POST',
    url: '../function/getdata.php',
    timeout: 12000,
    async: true,
    data: $("#Atributos").serialize(),
    success:function(data){
      if(data != null){
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
      if(data != null){
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

