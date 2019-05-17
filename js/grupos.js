$( document ).ready(function() {
  getAllGrupos();
});
function getAllGrupos(){
  $("#grupos_table > tbody").html("");
  $.ajax({
    type: 'POST',
    url: '../function/funciones_profesores/grupos.php',
    timeout: 12000,
    async: true,
    data: {'filtro':"All",'func':"consultar"},
    success:function(data){
      if(data != ''){
        if(data == "Sin Atributos") {
          $("#grupos_table > thead").html("<tr><th class='center'>No hay atributos registrados</th></tr>");
          $("#grupos_table tbody").append("<tr><td style='width:50%; height:50%; margin-top:20%; margin-left:20%;'>"+"<img style='width:50%;margin-left: 25%;' src='"+"../image/kisspng-drawing-clip-art-not-found-5b2e77b6deffe8.2356212115297719589134.jpg"+"'>"+"</td></tr>");
        }
        else{
          $("#grupos_table > thead").html("");
          $("#grupos_table thead").append("<tr>"+
          "<th scope='col'>Id_grupo</th>"+
          "<th scope='col'>Nombre</th>"+
          "<th scope='col'>Carrera</th>"+
          '<th scope="col">Materia</th>'+
          '<th scope="col">Profesor</th>'+
          "<th scope='col'>Acciones</th>"
        +"</tr>");
          $("#grupos_table tbody").append(data);
        }
      }
    },
    error:function(jqXHR, textStatus, errorThrown){
      console.log(textStatus);
      alert(jqXHR);
    }
  });
}
