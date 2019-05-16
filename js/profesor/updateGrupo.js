

// Funcion para abrir el modal de modificar grupo
function updateGrupo(id, nombre, carrera, materia){
    $("#modificarGrupo").modal('show');
    $("#id_grupo").text(id);
    $("#txnombreGrupo").val(nombre);
    $("#modifCarrera").val(carrera);
    $("#modifMateria").val(materia);
  }


  // Funcion en donde guarda los datos del modal y los manda a una funcion php
  function confirmUpdateGrupo(){
    var datos = $("#formModGrupo").serialize()+'&id_grupo='+$("#id_grupo").text()+'&accion=update';
    console.log(datos);
    $.ajax({
      url: '../function/funcionUpdateGrupo/updateGrupo.php',
      type: 'POST',
      async: true,
      timeout: 12000,
      data: datos,
      success: function(response){
        alert(response);
        //getCarrerasFiltro('All');
        $("#modificarGrupo").modal('hide');
      },
      error: function(jqXHR, textStatus, errorThrown){

      }
    });
  }