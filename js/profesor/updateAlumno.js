/* FUNCIONES PARA MODIFICAR CRITERIOS */

function modificarCriterio(value, nombre, descripcion, tipo, pondI, pondG){

    $('#modificarCrit').modal('show');
  
    $("#txnombreCrit").val(nombre);
  
    $("#txdesCrit").val(descripcion);
  
    $("#modifTipoCriterio").val(tipo);
  
    $("#txpondCrit").val(pondI);
    
    $("#txpondCritG").val(pondG);
  
    mod = value;
  
  }
  
  
  
  function confirmModCriterio(){
    var name = $("#txnombreCrit").val();
  
    var desc = $("#txdesCrit").val();
  
    var tipo = $("#modifTipoCriterio").val();
    var pondI = 0;
    var pondG = 0;
    if(tipo == "individual/grupal"){
      pondI = $("#txpondCrit").val();
      pondG = $("#txpondCritG").val();
    }
    else{
      if(tipo == "Individual"){
        pondI = 100;
      }
      else{
        pondG = 100;
      }
    }
    
    if((parseInt(pondI, 10) + parseInt(pondG, 10)) == 100){
      $.ajax({
          type: "POST",
          async: true,
          url: "../function/criterios.php",
          timeout: 12000,
          data: {
              "func": "actualizar",
              "Criterio": mod,
              "Nombre": name,
              "Descripcion": desc,
              "PonderacionI": pondI,
              "PonderacionG": pondG,
              "tipo" : tipo
          },
          success: function(response)
          {
            alert(response);
            $('#modificarCrit').modal('hide');
            getAllCriterios();
          },
          error: function(jqXHR, textStatus, errorThrown){
              console.log(errorThrown);
          }
      });
    }
    else{
      alert("Ponderaciones invalidas");
    }
  }


  /*-------------------------------------------------*/
  function modificarAtributo(value, nombre, id, ap_p, ap_m, esp){
    $('#updateAlumno').modal('show');
    $("#txnombreAlumno").val(nombre);
    $("#txapellidoP").val(ap_p);
    $("#txapellidoM").val(ap_m);
    $("#txEspecialidad").val(esp);
    mod = id;
  }
  
  function confirmMod(){
    var name = $("#txnombreAlumno").val();

    var app = $("#txapellidoP").val();
  
    var apm = $("#txapellidoM").val();

    var espec = $("#txEspecialidad").val();
  
    $.ajax({
      type: "POST",
      async: true,
      url: "../function/funciones_profesores/update_alumno.php",
      timeout: 12000,
      data: {func:"actualizar",
            nControl:mod,
            Nombre:name, 
            Apellido_p:app,
            Apellido_m:apm,
            Especialidad:espec
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
  
  