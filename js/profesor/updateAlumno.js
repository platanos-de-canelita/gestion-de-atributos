/* FUNCIONES PARA MODIFICAR CRITERIOS */
  /*-------------------------------------------------*/
  function modificarAtributo(value, nombre, id, ap_p, ap_m){
    $('#updateAlumno').modal('show');
    $("#txnombreAlumno").val(nombre);
    $("#txapellidoP").val(ap_p);
    $("#txapellidoM").val(ap_m);
    mod = id;
  }
  
  function confirmMod(){
    var name = $("#txnombreAlumno").val();

    var app = $("#txapellidoP").val();
  
    var apm = $("#txapellidoM").val();
  
    $.ajax({
      type: "POST",
      async: true,
      url: "../function/funciones_profesores/update_alumno.php",
      timeout: 12000,
      data: {func:"actualizar",
            nControl:mod,
            Nombre:name, 
            Apellido_p:app,
            Apellido_m:apm
        },
      dataType:"json",
      success: function(response)
      {
        //var obje = JSON.parse(response);
        JSON.stringify(response);
        alert(response.msga);
        $('#updateAlumno').modal('hide');
      },
      error: function(jqXHR, textStatus, errorThrown){
        console.log(errorThrown);
        //console.log(errorThrown);
      }
    });
  }
  