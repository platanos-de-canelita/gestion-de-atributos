var a=0;
var del;
var mod;
var name;

$( document ).ready(function() {
  $("#paginas").empty();
  index();
});

function index(p){
  $("#filas").empty();
  $("#paginas").empty();
  if(p==null)p=1;
  a=p;
  $.ajax({
    type: "GET",
    async: true,
    url: "../function/get_carga.php",
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
              "<a href='' onclick='modificarMateria("+value.sub_id+")'>Modificar</a>"+
              "|<a href='#' id='href"+value.sub_id+"' onclick='eliminarMateria("+value.sub_id+")'>Eliminar</a>"+
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
