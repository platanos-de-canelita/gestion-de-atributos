var a=0;
var name;
var datos_sesion;
var pk_sesion;


   function revisaGrupo(){
    var grupo = $("#group_nvo").val();
    var carrera=$('#group_carreras').val();
    var materia=$('#group_materias').val();
    
    if (carrera==null || materia==null || grupo.trim()=="") {
      alert("Todos los datos son obligatorios.")
    }
    else{
      profesor = pk_sesion;
      data ='func=revisaGrupo';
      data =data + '&grupo='+grupo +'&carrera='+carrera +'&materia='+materia+'&profesor='+localStorage.getItem('depto');
      console.log(data);
      $.ajax({
        type: "POST",
        async: true,
        url: "../function/funciones_profesores/getDataGroups.php",
        timeout: 12000,
        data: data,
        success: function(response)
        {
          console.log(response);
         if(response=="Sin resultados"){
          insertarGrupo(grupo,carrera, materia,localStorage.getItem('depto'));
         }
         else{
          revisaGrupo2(response);
         }
        },
        error: function(jqXHR, textStatus, errorThrown){
         alert("ERROR");
        }
      });
    }
  }
  function revisaGrupo2(resp){
      data ='func=revisaGrupo2';
      data =data + '&idg='+resp;
      console.log(data);
      $.ajax({
        type: "POST",
        async: true,
        url: "../function/funciones_profesores/getDataGroups.php",
        timeout: 12000,
        data: data,
        success: function(response)
        {
          console.log(response);
          if(response == "Hecho"){
            alert("Se ha dado de alta grupo");
            limpia();
           }
           else{
            alert("Ya existe el grupo no se puede dar de alta");
            limpia();
           }
        },
        error: function(jqXHR, textStatus, errorThrown){
         alert("ERROR");
        }
      });
    
  }


  function insertarGrupo(grupo,carrera,materia,profesor){
    data ='func=insertarGrupo';
    data =data + '&grupo='+grupo +'&carrera='+carrera +'&materia='+materia+'&profesor='+profesor;
    console.log(data);
    $.ajax({
      type: "POST",
      async: true,
      url: "../function/funciones_profesores/getDataGroups.php",
      timeout: 12000,
      data: data,
      success: function(response)
      {
       $("#group_carreras").html("");
      $("#group_carreras").append("<option disabled selected>Seleccionar carrera</option>");
      $("#carreras_alu").html("");
      $("#carreras_alu").append("<option disabled selected>Seleccionar carrera</option>");
      console.log(response);
      alert(response);
      limpia();
      },
      error: function(jqXHR, textStatus, errorThrown){
    //   console.log(errorThrown);
      }
    });
}


function revisaAlumno(){
  profesor = pk_sesion;
  var carrera=$('#carreras_alu').val();
  var materia=$('#materias_alu').val();
  var grupo=$('#group_names').val();
  var alumno = $("#group_alumnos").val();
  
  if (carrera==null || materia==null || grupo==null || alumno==null) {
    alert("Todos los campos son obligatorios. Selecciones alguna opción")
  }
  else{
    data ='func=revisaAlu';
    data =data +'&carrera='+carrera +'&materia='+materia+'&profesor='+localStorage.getItem('depto')+'&alumno='+alumno;
  console.log(data);
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/funciones_profesores/getDataGroups.php",
    timeout: 12000,
    data: data,
    success: function(response)
    {
      console.log(response);
      if(response=="Sin resultados"){
        insertarAlumno(grupo,alumno);
       }else{
        alert("Ya se registro el alumno en otro grupo de trabajo");
        limpia();
       }
      
    },
    error: function(jqXHR, textStatus, errorThrown){
  //   console.log(errorThrown);
    }
  });
  }
}



function insertarAlumno(grupo,alumno){
  data ='func=insertarAlu';
  data =data + '&grupo='+grupo +'&alumno='+alumno;
  console.log(data);
  $.ajax({
    type: "POST",
    async: true,
    url: "../function/funciones_profesores/getDataGroups.php",
    timeout: 12000,
    data: data,
    success: function(response)
    {
      alert(response);
      limpia();
    },
    error: function(jqXHR, textStatus, errorThrown){
  //   console.log(errorThrown);
    }
  });
}


function getCarreras(){
  datos_sesion = localStorage.getItem('depto');
  $("#group_carreras").html("<option disabled selected>Seleccione una carrera</option>");
  $("#carreras_alu").html("<option disabled selected>Seleccione una carrera</option>");
  $.ajax({
    type: 'POST',
    url: '../function/getDataAtribMat.php',
    timeout: 12000,
    async: true,
    data : {departamento: datos_sesion},
    success: function(data){
      if(data=="")
        alert("No existen carreras registradas para su departamento");
      $("#group_carreras").append(data);
      $("#carreras_alu").append(data);
     
    },
    error: function (jqXHR, textStatus, errorThrown){
    }
  });
}
function getMateria(carrera){//---------GET MATERIA(Carrera) otro método
  $("#group_materias").html("");
  $("#group_materias").append("<option disabled selected>Seleccionar materia</option>");
  $("#materias_alu").html("");
  $("#materias_alu").append("<option disabled selected>Seleccionar materia</option>");
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
      $("#group_materias").append(data);
      $("#materias_alu").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){

    }
  });
}
function getGrupos(materia){//---------
  $("#group_names").html("");
  $("#group_names").append("<option disabled selected>Seleccionar grupo</option>");
  console.log(materia);
  $.ajax({
    type: 'POST',
    url: '../function/funciones_profesores/getDataGroups.php',
    timeout: 12000,
    async: true,
    data : {materiag: materia},
    success: function(data){
      if(data=="")
        alert("No existen grupos registrados para esta materia");
      $("#group_names").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){
    }
  });
}
function getAlumnos(materia){//---------
  $("#group_alumnos").html("");
  $("#group_alumnos").append("<option disabled selected>Seleccionar alumno</option>");
  console.log(materia);
  $.ajax({
    type: 'POST',
    url: '../function/funciones_profesores/getDataGroups.php',
    timeout: 12000,
    async: true,
    data : {materia: materia},
    success: function(data){
      if(data=="")
        alert("No existen alumnos registrados para esta materia");
      $("#group_alumnos").append(data);
    },
    error: function (jqXHR, textStatus, errorThrown){
    }
  });
}


function limpia(){
  $("#group_materias").html("");
  $("#group_materias").append("<option disabled selected>Seleccionar materia</option>");
  $("#materias_alu").html("");
  $("#materias_alu").append("<option disabled selected>Seleccionar materia</option>");
  $("#group_carreras").html("");
  $("#group_carreras").append("<option disabled selected>Seleccionar carrera</option>");
  $("#carreras_alu").html("");
  $("#carreras_alu").append("<option disabled selected>Seleccionar carrera</option>");
  $("#group_nvo").val("");
  $('#group_names').html("");
  $('#group_names').append("<option disabled selected>Seleccionar grupo</option>");
  $("#group_alumnos").html("");
  $("#group_alumnos").append("<option disabled selected>Seleccionar alumno</option>");
  getCarreras();
}

//-----------------pppppppppppppppppppppppppppppppppppppppppp





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



function setdata_sesion(data){
  localStorage.setItem('depto', data.split('\n')[1]);
  getCarreras();
}
function get_datos_sesion(){
  $.ajax({

      url:"../function/get_datos_sesion.php",//-----------------------SESIÓN----------------

      method: "POST",

      data:{usuario:myvar, tipo : localStorage.getItem('tipo_usuario')},

      success: function (data) {
        setdata_sesion(data);
      }

  });
}


function get_datos_sesionPK(){
  $.ajax({
      url:"../function/get_datos_sesionpk.php",//-----------------------SESIÓN----------------
      method: "POST",
      data:{func:"getDatPk",usuario:myvar},
      success: function (data) {
        pk_sesion=data;
      }

  });
}









