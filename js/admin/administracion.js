phpPath = "../php/administracion.php";
var elemento = "";
var accion = "";

var proyectos_lista;
var colaboradores_lista = [];
var investigadores_lista;
var linea_lista = [];
var publicaciones_lista;
var link_publicacion_edt;
var congresos_lista;
var anuncios_lista;

inicializacion();

//constructor de la pagina
function inicializacion() {
    cargar_proyectos("", "", "", 1);
    cargar_componentes();
    cargar_investigadores("", "", 1);
    cargar_publicaciones("", "", 1);
    cargar_congresos("", "");
    cargar_anuncios();
}

//Funcion que selecciona un id y la accion realiza
function seleccion(opcion, id) {
    accion = opcion;
    elemento = id;
    switch (opcion) {
        case "edt_proy":
            $("#titulo_modal_proyecto").text("Editar Proyecto");
            colaboradores_lista = [];
            proyectos_lista.forEach(element => {
                if (element["id_proyecto"] == id) {
                    $("#in_titulo_proyecto").val(element["titulo_proyecto"]);
                    $("#select_lider_proyecto_registro").val(element["lider_proyecto"]);
                    $("#select_linea_proyecto_registro").val(element["linea_investigacion"]);
                    $("#check_financiado").val(element["financiamiento"]);
                    $("#img_proyecto_ref").val("");
                    $("#in_img_proyecto").val("");
                    $("#in_fecha_inicio").val(element["fecha_inicio"]);
                    $("#in_fecha_fin").val(element["fecha_fin"]);
                    $("#txt_resumen_proyecto").val(element["resumen"]);
                    $.ajax({
                        method: "POST",
                        url: phpPath,
                        data: { funcion: "consulta_lista_colaboradores", id_proyecto: element["id_proyecto"] },
                        dataType: "json"
                    }).done(function (jsonObjet) {
                        console.log(jsonObjet)
                        jsonObjet.forEach(element2 => {
                            colaboradores_lista.push(element2["id_investigador"]);
                        });
                        listar_colaboradores();
                    }).fail(function () {
                        console.log("Error");
                    });

                }
            });
            break;
        case "edt_inv":
            $("#titulo_modal_investigador").text("Editar Invetigador");
            linea_lista = [];
            investigadores_lista.forEach(element => {
                if (element["id_investigador"] == id) {
                    $("#in_titulo_investigador_registro").val(element["nivel_estudios"]);
                    $("#in_nombre_investigador_registro").val(element["nombre"]);
                    $("#in_apellido_patertno").val(element["apellido_paterno"]);
                    $("#in_apellido_matertno").val(element["apellido_materno"]);
                    $("#img_investigador").val("");
                    $("#in_foto_investigador").val("");
                    $("#in_correo_registro").val(element["correo"]);
                    $("#in_edificio_ubicacion").val(element["ubicacion"]);
                    $.ajax({
                        method: "POST",
                        url: phpPath,
                        data: { funcion: "consultar_lineas_investigador", id_investigador: element["id_investigador"] },
                        dataType: "json"
                    }).done(function (jsonObjet) {
                        jsonObjet.forEach(element2 => {
                            linea_lista.push(element2["id_linea"]);
                        });
                        listar_lineas_investigador();
                    }).fail(function () {
                        console.log("Error");
                    });

                }
            });
            break;
        case "edt_cong":
            $("#tutulo_reg_congreso").text("Editar congreso");
            congresos_lista.forEach(element => {
                if (element["id_evento"] == id) {
                    $("#in_titulo_congreso").val(element["nombre_evento"]);
                    $("#in_link_congreso").val(element["link_externo"]);
                    $("#select_linea_congreso_registro").val(element["linea_investigacion"]);
                    $("#img_congreso_reg").val("");
                    $("#in_img_congreso").val("");
                }
            });
            break;
        case "edt_publ":
            $("#titulo_modal_publicacion").text("Editar publicación");
            publicaciones_lista.forEach(element => {
                if (element["id_publicaciones"] == id) {
                    $("#in_titulo_publicacion_registro").val(element["titulo_publicacion"]);
                    $("#select_autor_publicacion_registro").val(element["id_investigador"]);
                    $("#in_foro_publicacion").val(element["foro_publicacion"]);
                    $("#select_linea_publicacion_registro").val(element["linea_invetigacion"]);
                    $("#achivo_pdf").val("");
                    $("#in_doc_publicacion").val("");
                    $("#in_fecha_publicacion").val(element["fecha_chida"]);
                }
            });
            break;
        case "edt_anun":
            $("#titulo_registro_anuncio").text("Editar anuncio");
            anuncios_lista.forEach(element => {
                if (element["id_anuncio"] == id) {
                    $("#in_cantidad_alumno").val(element["Cantidad_alumnos"]);
                    $("#in_semestre_alumno").val(element["Semestre"]);
                    $("#select_proyecto_anuncio").val(element["id_proyecto"]);
                    $("#txt_perfil_anuncio").val(element["Perfil"]);
                    $("#in_recompensa_alumno").val(element["Recompensa"]);
                }
            });
            break;
    }
    //console.log(accion, elemento);
}

//Evento de confirmacion de accion seleccionada 
$("#btn_si").click(function (evt) {
    $("#btn_cerrar").click();
    realizar_accion();
});

//Funcion que actualiza o elimina el proyecto, investigador, publicacion, congreso con id seleccionado en el metodo seleccion()
function realizar_accion() {
    switch (accion) {
        case "elm_proy":
            $.ajax({
                method: "POST",
                url: phpPath,
                data: { funcion: "eliminar_proyectos", id_proyecto: elemento, status: (($('#check_proyectos').val() == '1') ? "0" : "1") }
            }).done(function (resultado) {
                if (resultado == "Exito") alert("Accion realizada exitosamente");
                recargar_proyectos();
            }).fail(function () {
                console.log("Error");
            });
            break;
        case "reg_proy":
            if (colaboradores_lista.length != 0) {
                var inputFileImage = document.getElementById("img_proyecto_ref");
                var file = inputFileImage.files[0];
                var data = new FormData();

                data.append("archivo", file);
                data.append("funcion", "registrar_proyecto")
                data.append("titulo_proyecto", $("#in_titulo_proyecto").val());
                data.append("lider_proyecto", $("#select_lider_proyecto_registro").val());
                data.append("linea_investigacion", $("#select_linea_proyecto_registro").val());
                data.append("fecha_inicio", $("#in_fecha_inicio").val());
                data.append("fecha_fin", $("#in_fecha_fin").val());
                data.append("financiamiento", $("#check_financiado").val());
                data.append("resumen", $("#txt_resumen_proyecto").val());
                $.ajax({
                    url: phpPath,
                    type: "POST",
                    contentType: false,
                    data: data,
                    processData: false,
                    cache: false
                }).done(function (jsonObjet) {
                    alert(jsonObjet);
                    if (jsonObjet == "Exito") {
                        colaboradores_lista.forEach(element => {
                            $.ajax({
                                method: "POST",
                                url: phpPath,
                                data: {
                                    funcion: "registrar_colaboradores",
                                    id_investigador: element
                                }
                            }).done(function (resultado) {
                                console.log(resultado);
                            }).fail(function () {
                                console.log("Error");
                            });
                        });
                        $(function () {
                            $('#registrar_proyecto').modal('toggle');
                        });
                        recargar_proyectos();
                    }

                }).fail(function () {
                    console.log("Error");
                });
            } else {
                alert("No se ha seleccionado algun de colaboradores");
            }
            break;
        case "edt_proy":
            if ($("#img_proyecto_ref").val() == "") {
                if (colaboradores_lista.length != 0) {
                    var data = new FormData();

                    data.append("funcion", "editar_proyecto_sin");
                    data.append("id_proyecto", elemento);
                    data.append("titulo_proyecto", $("#in_titulo_proyecto").val());
                    data.append("lider_proyecto", $("#select_lider_proyecto_registro").val());
                    data.append("linea_investigacion", $("#select_linea_proyecto_registro").val());
                    data.append("fecha_inicio", $("#in_fecha_inicio").val());
                    data.append("fecha_fin", $("#in_fecha_fin").val());
                    data.append("financiamiento", $("#check_financiado").val());
                    data.append("resumen", $("#txt_resumen_proyecto").val());
                    $.ajax({
                        url: phpPath,
                        type: "POST",
                        contentType: false,
                        data: data,
                        processData: false,
                        cache: false
                    }).done(function (jsonObjet) {
                        console.log(jsonObjet);
                        if (jsonObjet == "Exito") {
                            $.ajax({
                                method: "POST",
                                url: phpPath,
                                data: {
                                    funcion: "eliminar_colaboradores",
                                    id_proyecto: elemento,
                                }
                            }).done(function (resultado) {
                                console.log(resultado);
                            }).fail(function () {
                                console.log("Error");
                            });
                            colaboradores_lista.forEach(element => {
                                $.ajax({
                                    method: "POST",
                                    url: phpPath,
                                    data: {
                                        funcion: "editar_colaboradores",
                                        id_proyecto: elemento,
                                        id_investigador: element
                                    }
                                }).done(function (resultado) {
                                    console.log(resultado);
                                }).fail(function () {
                                    console.log("Error");
                                });
                            });
                            alert(jsonObjet);
                            $(function () {
                                $('#registrar_proyecto').modal('toggle');
                            });
                            recargar_proyectos();
                        }

                    }).fail(function () {
                        console.log("Error");
                    });
                } else {
                    alert("No se ha seleccionado alguna linea de invetigación")
                }
            } else {
                if (colaboradores_lista.length != 0) {
                    var inputFileImage = document.getElementById("img_proyecto_ref");
                    var file = inputFileImage.files[0];
                    var data = new FormData();

                    data.append("archivo", file);
                    data.append("funcion", "editar_proyecto_con");
                    data.append("id_proyecto", elemento);
                    data.append("titulo_proyecto", $("#in_titulo_proyecto").val());
                    data.append("lider_proyecto", $("#select_lider_proyecto_registro").val());
                    data.append("linea_investigacion", $("#select_linea_proyecto_registro").val());
                    data.append("fecha_inicio", $("#in_fecha_inicio").val());
                    data.append("fecha_fin", $("#in_fecha_fin").val());
                    data.append("financiamiento", $("#check_financiado").val());
                    data.append("resumen", $("#txt_resumen_proyecto").val());
                    $.ajax({
                        url: phpPath,
                        type: "POST",
                        contentType: false,
                        data: data,
                        processData: false,
                        cache: false
                    }).done(function (jsonObjet) {
                        console.log(jsonObjet);
                        if (jsonObjet == "Exito") {
                            $.ajax({
                                method: "POST",
                                url: phpPath,
                                data: {
                                    funcion: "eliminar_colaboradores",
                                    id_proyecto: elemento,
                                }
                            }).done(function (resultado) {
                                console.log(resultado);
                            }).fail(function () {
                                console.log("Error");
                            });
                            colaboradores_lista.forEach(element => {
                                $.ajax({
                                    method: "POST",
                                    url: phpPath,
                                    data: {
                                        funcion: "editar_colaboradores",
                                        id_proyecto: elemento,
                                        id_investigador: element
                                    }
                                }).done(function (resultado) {
                                    console.log(resultado);
                                }).fail(function () {
                                    console.log("Error");
                                });
                            });
                            alert(jsonObjet);
                            $(function () {
                                $('#registrar_proyecto').modal('toggle');
                            });
                            recargar_proyectos();
                        }

                    }).fail(function () {
                        console.log("Error");
                    });
                } else {
                    alert("No se ha seleccionado alguna linea de invetigación")
                }
            }
            break;
        case "reg_inv":
            if(validarEmail($("#in_correo_registro").val())){
            if (linea_lista.length != 0) {
                var inputFileImage = document.getElementById("img_investigador");
                var file = inputFileImage.files[0];
                var data = new FormData();

                data.append("archivo", file);
                data.append("funcion", "registrar_investigador")
                data.append("nivel_estudios", $("#in_titulo_investigador_registro").val());
                data.append("nombre", $("#in_nombre_investigador_registro").val());
                data.append("apellido_paterno", $("#in_apellido_patertno").val());
                data.append("apellido_materno", $("#in_apellido_matertno").val());
                data.append("correo", $("#in_correo_registro").val());
                data.append("ubicacion", $("#in_edificio_ubicacion").val());
                $.ajax({
                    url: phpPath,
                    type: "POST",
                    contentType: false,
                    data: data,
                    processData: false,
                    cache: false
                }).done(function (jsonObjet) {
                    console.log(jsonObjet);
                    if (jsonObjet == "Exito") {
                        linea_lista.forEach(element => {
                            $.ajax({
                                method: "POST",
                                url: phpPath,
                                data: {
                                    funcion: "registrar_lineas_inv",
                                    id_linea: element
                                }
                            }).done(function (resultado) {
                                console.log(resultado);
                            }).fail(function () {
                                console.log("Error");
                            });
                        });
                        alert(jsonObjet);
                        $(function () {
                            $('#registrar_investigador').modal('toggle');
                        });
                        recargar_investigadores();
                    }

                }).fail(function () {
                    console.log("Error");
                });
            } else {
                alert("No se ha seleccionado alguna linea de invetigación")
            }
            }else{
                alert("correo incorrecto");
            }
            break;
        case "edt_inv":
        if(validarEmail($("#in_correo_registro").val())){
            if ($("#img_investigador").val() == "") {
                if (linea_lista.length != 0) {
                    var data = new FormData();

                    data.append("id_investigador", elemento);
                    data.append("funcion", "editar_investigador_sin")
                    data.append("nivel_estudios", $("#in_titulo_investigador_registro").val());
                    data.append("nombre", $("#in_nombre_investigador_registro").val());
                    data.append("apellido_paterno", $("#in_apellido_patertno").val());
                    data.append("apellido_materno", $("#in_apellido_matertno").val());
                    data.append("correo", $("#in_correo_registro").val());
                    data.append("ubicacion", $("#in_edificio_ubicacion").val());
                    $.ajax({
                        url: phpPath,
                        type: "POST",
                        contentType: false,
                        data: data,
                        processData: false,
                        cache: false
                    }).done(function (jsonObjet) {
                        console.log(jsonObjet);
                        if (jsonObjet == "Exito") {
                            $.ajax({
                                method: "POST",
                                url: phpPath,
                                data: {
                                    funcion: "eliminar_lineas_inv",
                                    id_investigador: elemento,
                                }
                            }).done(function (resultado) {
                                console.log(resultado);
                            }).fail(function () {
                                console.log("Error");
                            });
                            linea_lista.forEach(element => {
                                $.ajax({
                                    method: "POST",
                                    url: phpPath,
                                    data: {
                                        funcion: "editar_lineas_inv",
                                        id_investigador: elemento,
                                        id_linea: element
                                    }
                                }).done(function (resultado) {
                                    console.log(resultado);
                                }).fail(function () {
                                    console.log("Error");
                                });
                            });
                            alert(jsonObjet);
                            $(function () {
                                $('#registrar_investigador').modal('toggle');
                            });
                            recargar_investigadores();
                        }

                    }).fail(function () {
                        console.log("Error");
                    });
                } else {
                    alert("No se ha seleccionado alguna linea de invetigación")
                }
            } else {
                if (linea_lista.length != 0) {
                    var inputFileImage = document.getElementById("img_investigador");
                    var file = inputFileImage.files[0];
                    var data = new FormData();

                    data.append("archivo", file);
                    data.append("id_investigador", elemento);
                    data.append("funcion", "editar_investigador_con")
                    data.append("nivel_estudios", $("#in_titulo_investigador_registro").val());
                    data.append("nombre", $("#in_nombre_investigador_registro").val());
                    data.append("apellido_paterno", $("#in_apellido_patertno").val());
                    data.append("apellido_materno", $("#in_apellido_matertno").val());
                    data.append("correo", $("#in_correo_registro").val());
                    data.append("ubicacion", $("#in_edificio_ubicacion").val());
                    $.ajax({
                        url: phpPath,
                        type: "POST",
                        contentType: false,
                        data: data,
                        processData: false,
                        cache: false
                    }).done(function (jsonObjet) {
                        console.log(jsonObjet);
                        if (jsonObjet == "Exito") {
                            $.ajax({
                                method: "POST",
                                url: phpPath,
                                data: {
                                    funcion: "eliminar_lineas_inv",
                                    id_investigador: elemento,
                                }
                            }).done(function (resultado) {
                                console.log(resultado);
                            }).fail(function () {
                                console.log("Error");
                            });
                            linea_lista.forEach(element => {
                                $.ajax({
                                    method: "POST",
                                    url: phpPath,
                                    data: {
                                        funcion: "editar_lineas_inv",
                                        id_investigador: elemento,
                                        id_linea: element
                                    }
                                }).done(function (resultado) {
                                    console.log(resultado);
                                }).fail(function () {
                                    console.log("Error");
                                });
                            });
                            alert(jsonObjet);
                            $(function () {
                                $('#registrar_investigador').modal('toggle');
                            });
                            recargar_investigadores();
                        }

                    }).fail(function () {
                        console.log("Error");
                    });
                } else {
                    alert("No se ha seleccionado alguna linea de invetigación")
                }
            }
        }else{
            alert("correo incorrecto");
        }
            break;
        case "elm_inv":
            $.ajax({
                method: "POST",
                url: phpPath,
                data: { funcion: "eliminar_investigador", id_investigador: elemento, status: (($('#check_investigador').val() == '1') ? "0" : "1") }
            }).done(function (resultado) {
                if (resultado == "Exito") alert("Accion realizada exitosamente");
                recargar_investigadores();
            }).fail(function () {
                console.log("Error");
            });
            break;//placeholder="https://www.example.com"
        case "reg_publ":
            var inputFileImage = document.getElementById("achivo_pdf");
            var file = inputFileImage.files[0];
            var data = new FormData();

            data.append("archivo", file);
            data.append("funcion", "registrar_publicacion")
            data.append("titulo_publicacion", $("#in_titulo_publicacion_registro").val());
            data.append("id_investigador", $("#select_autor_publicacion_registro").val());
            data.append("foro_publicacion", $("#in_foro_publicacion").val());
            data.append("fecha_publicacion", $("#in_fecha_publicacion").val());
            data.append("linea_invetigacion", $("#select_linea_publicacion_registro").val());
            $.ajax({
                url: phpPath,
                type: "POST",
                contentType: false,
                data: data,
                processData: false,
                cache: false
            }).done(function (jsonObjet) {
                alert(jsonObjet);
                if (jsonObjet == "Exito") {
                    $(function () {
                        $('#registrar_publicacion').modal('toggle');
                    });
                    recargar_publicaciones();
                }
            }).fail(function () {
                console.log("Error");
            });
            break;
        case "elm_publ":
            $.ajax({
                method: "POST",
                url: phpPath,
                data: { funcion: "eliminar_publicacion", id_publicacion: elemento, status: (($('#check_publicacion').val() == '1') ? "0" : "1") }
            }).done(function (resultado) {
                if (resultado == "Exito") alert("Accion realizada exitosamente");
                recargar_publicaciones();
            }).fail(function () {
                console.log("Error");
            });
            break;
        case "edt_publ":
            if ($("#achivo_pdf").val() == "") {
                var data = new FormData();
                data.append("funcion", "editar_publicacion_sin")
                data.append("id_publicaciones", elemento);
                data.append("titulo_publicacion", $("#in_titulo_publicacion_registro").val());
                data.append("id_investigador", $("#select_autor_publicacion_registro").val());
                data.append("foro_publicacion", $("#in_foro_publicacion").val());
                data.append("fecha_publicacion", $("#in_fecha_publicacion").val());
                data.append("linea_invetigacion", $("#select_linea_publicacion_registro").val());
                $.ajax({
                    url: phpPath,
                    type: "POST",
                    contentType: false,
                    data: data,
                    processData: false,
                    cache: false
                }).done(function (jsonObjet) {
                    alert(jsonObjet);
                    if (jsonObjet == "Exito") {
                        $(function () {
                            $('#registrar_publicacion').modal('toggle');
                        });
                        recargar_publicaciones();
                    }
                }).fail(function () {
                    console.log("Error");
                });
            } else {
                var inputFileImage = document.getElementById("achivo_pdf");
                var file = inputFileImage.files[0];
                var data = new FormData();

                data.append("archivo", file);
                data.append("id_publicaciones", elemento);
                data.append("funcion", "editar_publicacion_con")
                data.append("titulo_publicacion", $("#in_titulo_publicacion_registro").val());
                data.append("id_investigador", $("#select_autor_publicacion_registro").val());
                data.append("foro_publicacion", $("#in_foro_publicacion").val());
                data.append("fecha_publicacion", $("#in_fecha_publicacion").val());
                data.append("linea_invetigacion", $("#select_linea_publicacion_registro").val());
                $.ajax({
                    url: phpPath,
                    type: "POST",
                    contentType: false,
                    data: data,
                    processData: false,
                    cache: false
                }).done(function (jsonObjet) {
                    alert(jsonObjet);
                    if (jsonObjet == "Exito") {
                        $(function () {
                            $('#registrar_publicacion').modal('toggle');
                        });
                        recargar_publicaciones();
                    }
                }).fail(function () {
                    console.log("Error");
                });
            }
            break;
        case "reg_cong":
            var inputFileImage = document.getElementById("img_congreso_reg");
            var file = inputFileImage.files[0];
            var data = new FormData();

            data.append("archivo", file);
            data.append("funcion", "registrar_congreso")
            data.append("nombre_evento", $("#in_titulo_congreso").val());
            data.append("linea_investigacion", $("#select_linea_congreso_registro").val());
            data.append("link_externo", $("#in_link_congreso").val());
            $.ajax({
                url: phpPath,
                type: "POST",
                contentType: false,
                data: data,
                processData: false,
                cache: false
            }).done(function (jsonObjet) {
                alert(jsonObjet);
                if (jsonObjet == "Exito") {
                    $(function () {
                        $('#registrar_congreso').modal('toggle');
                    });
                    recargar_congresos();
                }
            }).fail(function () {
                console.log("Error");
            });
            break;
        case "elm_cong":
            $.ajax({
                method: "POST",
                url: phpPath,
                data: { funcion: "eliminar_congreso", id_congreso: elemento }
            }).done(function (resultado) {
                if (resultado == "Exito") alert("Accion realizada exitosamente");
                recargar_congresos();
            }).fail(function () {
                console.log("Error");
            });
            break;
        case "edt_cong":
            if ($("#img_congreso_reg").val() == "") {
                var data = new FormData();
                data.append("id_evento", elemento);
                data.append("funcion", "editar_congreso_sin")
                data.append("nombre_evento", $("#in_titulo_congreso").val());
                data.append("linea_investigacion", $("#select_linea_congreso_registro").val());
                data.append("link_externo", $("#in_link_congreso").val());
                $.ajax({
                    url: phpPath,
                    type: "POST",
                    contentType: false,
                    data: data,
                    processData: false,
                    cache: false
                }).done(function (jsonObjet) {
                    alert(jsonObjet);
                    $(function () {
                        $('#registrar_congreso').modal('toggle');
                    });
                    recargar_congresos();
                }).fail(function () {
                    console.log("Error");
                });
            } else {
                var inputFileImage = document.getElementById("img_congreso_reg");
                var file = inputFileImage.files[0];
                var data = new FormData();

                data.append("archivo", file);
                data.append("id_evento", elemento);
                data.append("funcion", "editar_congreso_con")
                data.append("nombre_evento", $("#in_titulo_congreso").val());
                data.append("linea_investigacion", $("#select_linea_congreso_registro").val());
                data.append("link_externo", $("#in_link_congreso").val());
                $.ajax({
                    url: phpPath,
                    type: "POST",
                    contentType: false,
                    data: data,
                    processData: false,
                    cache: false
                }).done(function (jsonObjet) {
                    alert(jsonObjet);
                    $(function () {
                        $('#registrar_congreso').modal('toggle');
                    });
                    recargar_congresos();
                }).fail(function () {
                    console.log("Error");
                });
            }
            break;
        case "elm_anun":
            console.log('eliminado');
            $.ajax({
                method: "POST",
                url: phpPath,
                data: { funcion: "eliminar_anuncio", id_anuncio: elemento }
            }).done(function (resultado) {
                if (resultado == "Exito") alert("Accion realizada exitosamente");
                cargar_anuncios();
            }).fail(function () {
                console.log("Error");
            });
            break;
        case "edt_anun":
            $.ajax({
                method: "POST",
                url: phpPath,
                data: {
                    funcion: "editar_anuncio",
                    id_anuncio: elemento,
                    cantidad: $("#in_cantidad_alumno").val(),
                    semestre: $("#in_semestre_alumno").val(),
                    id_proyecto: $("#select_proyecto_anuncio option:selected").val(),
                    perfil: $("#txt_perfil_anuncio").val(),
                    recompensa: $("#in_recompensa_alumno option:selected").text()
                }
            }).done(function (resultado) {
                console.log(resultado);
                if (resultado == "Exito") alert("Accion realizada exitosamente");
                cargar_anuncios();
            }).fail(function () {
                console.log("Error");
            });
            $("#btn_cerrar_registro_anuncio").click();
            break;
        case "reg_anun":
            $.ajax({
                method: "POST",
                url: phpPath,
                data: {
                    funcion: "registrar_anuncio",
                    cantidad: $("#in_cantidad_alumno").val(),
                    semestre: $("#in_semestre_alumno").val(),
                    id_proyecto: $("#select_proyecto_anuncio option:selected").val(),
                    perfil: $("#txt_perfil_anuncio").val(),
                    recompensa: $("#in_recompensa_alumno option:selected").text()
                }
            }).done(function (resultado) {
                console.log(resultado);
                if (resultado == "Exito") alert("Accion realizada exitosamente");
                cargar_anuncios();
            }).fail(function () {
                console.log("Error");
            });
            $("#btn_cerrar_registro_anuncio").click();
            break;
    }
}

//funcion que carga los proyetos como parametros recibe los filtros de la buqueda
function cargar_proyectos(palabra_clave_proyecto, id_investigador, id_linea_investigacion_proyecto, proyecto_activo) {
    $.ajax({
        method: "POST",
        url: phpPath,
        data: { funcion: "consulta_proyectos_adm", palabra_clave: palabra_clave_proyecto, id_inv: id_investigador, id_linea_investigacion: id_linea_investigacion_proyecto, activo: proyecto_activo },
        dataType: "json"
    }).done(function (jsonObjet) {
        proyectos_lista = jsonObjet;
        console.log(jsonObjet);
        var btn_color;
        var btn_texto;
        if (proyecto_activo == 1) {
            btn_color = "btn btn-outline-danger";
            $("#btn_si").attr("class", "btn btn-lg btn-outline-danger")
            btn_texto = "Eliminar";
        } else {
            btn_color = "btn btn-outline-info";
            $("#btn_si").attr("class", "btn btn-lg btn-outline-info")
            btn_texto = "Activar";
        }
        $("#contenedor_proyectos").empty();
        $("#select_proyecto_anuncio").empty();
        jsonObjet.forEach(element => {
            $("#select_proyecto_anuncio").append("<option value=" + element["id_proyecto"] + ">" + element["titulo_proyecto"] + "</option>");
            $.ajax({
                method: "POST",
                url: phpPath,
                data: { funcion: "consulta_lista_colaboradores", id_proyecto: element["id_proyecto"] },
                dataType: "json"
            }).done(function (jsonObjet2) {
                cad = "<div class='card col-lg-4 col-md-6 col-sm-12'><img class='card-img-top' src='../" + element["link_imagen"] + "' alt='Card image cap'><div class='card-body'><h5 class='card-title cortar_t'>" + element["titulo_proyecto"] + "</h5><p>Lider: " + element["nombre_completo"] + "</p><p>Inicio: " + element["fecha_inicio"] + " Fin: " + element["fecha_fin"] + "</p><p>Linea: " + element["nombre_linea"] + "</p><p>Financiado: " + ((element["financiamiento"] == '1') ? "Si" : "No") + "</p><p class='card-text cortar'>Colaboradores<br>"
                jsonObjet2.forEach(element2 => {
                    cad += element2["nombre"] + "<br>";
                });
                cad += "</p><p class='card-text cortar'>" + element["resumen"] + "</p></div><div class='card-footer text-right blanco'><button class='btn btn-outline-success' type='button' data-toggle='modal' href='#registrar_proyecto' onclick='seleccion(\"edt_proy\"," + element["id_proyecto"] + ");'>Editar</button><button href='#confirmacion' class='" + btn_color + " mx-sm-3' type='button' data-toggle='modal' onclick='seleccion(\"elm_proy\"," + element["id_proyecto"] + ");'>" + btn_texto + "</button></div></div>"
                $("#contenedor_proyectos").append(cad);

            }).fail(function () {
                console.log("Error");
            });
        });
    }).fail(function () {
        console.log("Error");
    });
}

//funcion que carga los invetigadores como parametros recibe los filtros de la busqueda
function cargar_investigadores(palabra_clave_invetigador, id_linea_investigacion_ivestigador, investigador_activo) {
    $.ajax({
        method: "POST",
        url: phpPath,
        data: { funcion: "consulta_investigadores_adm", palabra_clave: palabra_clave_invetigador, id_linea_investigacion: id_linea_investigacion_ivestigador, activo: investigador_activo },
        dataType: "json"
    }).done(function (jsonObjet) {
        investigadores_lista = jsonObjet;
        console.log(jsonObjet);
        var btn_color;
        var btn_texto;
        if (investigador_activo == 1) {
            btn_color = "btn btn-outline-danger";
            $("#btn_si").attr("class", "btn btn-lg btn-outline-danger")
            btn_texto = "Eliminar";
        } else {
            btn_color = "btn btn-outline-info";
            $("#btn_si").attr("class", "btn btn-lg btn-outline-info")
            btn_texto = "Activar";
        }
        $("#contenedor_investigadores").empty();
        var cad;
        jsonObjet.forEach(element => {
            $.ajax({
                method: "POST",
                url: phpPath,
                data: { funcion: "consultar_lineas_investigador", id_investigador: element["id_investigador"] },
                dataType: "json"
            }).done(function (jsonObjet2) {
                cad = "<div class='card col-lg-4 col-md-6 col-sm-12'><img class='card-img-top' src='../" + element["url_foto"] + "' alt='Card image cap'><div class='card-body'><h5 class='card-title'>" + element["nivel_estudios"] + " " + element["nombre"] + " " + element["apellido_paterno"] + " " + element["apellido_materno"] + " " + "</h5><p>" + element["correo"] + "</p><p>" + element["ubicacion"] + "</p><p class='cortar'>Linea(s):<br>";
                jsonObjet2.forEach(element2 => {
                    cad += element2["nombre_linea"] + "<br>";
                });
                cad += "</p></div><div class='card-footer text-right blanco'><button href='#registrar_investigador' class='btn btn-outline-success' type='button' data-toggle='modal' onclick='seleccion(\"edt_inv\"," + element["id_investigador"] + ");'>Editar</button><button href='#confirmacion' class='" + btn_color + " mx-sm-3' type='button' data-toggle='modal' onclick='seleccion(\"elm_inv\"," + element["id_investigador"] + ");'>" + btn_texto + "</button></div></div>";
                $("#contenedor_investigadores").append(cad);
            }).fail(function () {
                console.log("Error");
            });
            //cad+="</div><div class='card-footer text-right blanco'><button href='#' class='btn btn-outline-success' type='button' data-toggle='modal' onclick='seleccion(\"edt_inv\"," + element["id_investigador"] + ");'>Editar</button><button href='#confirmacion' class='" + btn_color + " mx-sm-3' type='button' data-toggle='modal' onclick='seleccion(\"elm_inv\"," + element["id_investigador"] + ");'>" + btn_texto + "</button></div></div>";
        });
    }).fail(function () {
        console.log("Error");
    });
}

//funcion que carga las piblicaciones como parametros recibe los filtros de la busqueda
function cargar_publicaciones(palabra_clave_publicacion, id_linea_investigacion_publicacion, publicacion_activa) {
    $.ajax({
        method: "POST",
        url: phpPath,
        data: { funcion: "consulta_publicaciones_adm", palabra_clave: palabra_clave_publicacion, id_linea_investigacion: id_linea_investigacion_publicacion, activo: publicacion_activa },
        dataType: "json"
    }).done(function (jsonObjet) {
        //console.log(jsonObjet);
        publicaciones_lista = jsonObjet;
        var btn_color;
        var btn_texto;
        if (publicacion_activa == 1) {
            btn_color = "btn btn-outline-danger";
            $("#btn_si").attr("class", "btn btn-lg btn-outline-danger")
            btn_texto = "Eliminar";
        } else {
            btn_color = "btn btn-outline-info";
            $("#btn_si").attr("class", "btn btn-lg btn-outline-info")
            btn_texto = "Activar";
        }
        $("#contenedor_publicaciones").empty();
        jsonObjet.forEach(element => {
            $("#contenedor_publicaciones").append("<div class='card col-lg-4 col-md-6 col-sm-12'><div class='card-body'><h5 class='card-title'>" + element["titulo_publicacion"] + "</h5><p>" + element["fecha_publicacion"] + "</p><p>" + element["foro_publicacion"] + "</p><a class='btn btn-link' href='../" + element["link_publicacion"] + "'>Documento</a><p>" + element["nombre_linea"] + "</p></div><div class='card-footer text-right blanco'><button href='#registrar_publicacion' class='btn btn-outline-success' type='button' data-toggle='modal' onclick='seleccion(\"edt_publ\"," + element["id_publicaciones"] + ");'>Editar</button><button href='#confirmacion' class='" + btn_color + " mx-sm-3' type='button' data-toggle='modal' onclick='seleccion(\"elm_publ\"," + element["id_publicaciones"] + ");'>" + btn_texto + "</button></div></div>");
        });
    }).fail(function () {
        console.log("Error");
    });
}

//funcion que carga los congresos como parametros recibe los filtros de la busqueda
function cargar_congresos(palabra_clave_congreso, id_linea_investigacion_congreso) {
    $.ajax({
        method: "POST",
        url: phpPath,
        data: { funcion: "consulta_congresos_adm", palabra_clave: palabra_clave_congreso, id_linea_investigacion: id_linea_investigacion_congreso },
        dataType: "json"
    }).done(function (jsonObjet) {
        //console.log(jsonObjet);
        congresos_lista = jsonObjet;
        var btn_color;
        var btn_texto;
        btn_color = "btn btn-outline-danger";
        $("#btn_si").attr("class", "btn btn-lg btn-outline-danger")
        btn_texto = "Eliminar";
        $("#contenedor_congresos").empty();
        jsonObjet.forEach(element => {
            $("#contenedor_congresos").append("<div class='card col-lg-4 col-md-6 col-sm-12'><img class='card-img-top' src='../" + element["link_imagen"] + "' alt='Card image cap'><div class='card-body'><h5 class='card-title'>" + element["nombre_evento"] + "</h5>" + ((element["link_externo"] != null) ? ("<a class='btn btn-link cortar_t' href='" + element["link_externo"] + "'>" + element["link_externo"] + "</a>") : "") + "<p>" + element["nombre_linea"] + "</p></div><div class='card-footer text-right blanco'><button href='#registrar_congreso' class='btn btn-outline-success' type='button' data-toggle='modal' onclick='seleccion(\"edt_cong\"," + element["id_evento"] + ");'>Editar</button><button href='#confirmacion' class='" + btn_color + " mx-sm-3' type='button' data-toggle='modal' onclick='seleccion(\"elm_cong\"," + element["id_evento"] + ");'>" + btn_texto + "</button></div></div>");
        });
    }).fail(function () {
        console.log("Error");
    });
}

//funcion que carga los anuncios
function cargar_anuncios() {
    $.ajax({
        method: "POST",
        url: phpPath,
        data: { funcion: "consulta_anuncios_adm" },
        dataType: "json"
    }).done(function (jsonObjet) {
        anuncios_lista = jsonObjet;
        //console.log(jsonObjet);
        var btn_color;
        var btn_texto;
        btn_color = "btn btn-outline-danger";
        $("#btn_si").attr("class", "btn btn-lg btn-outline-danger")
        btn_texto = "Eliminar";
        $("#contenedor_anuncios").empty();
        jsonObjet.forEach(element => {
            $("#contenedor_anuncios").append("<div class='card col-lg-4 col-md-6 col-sm-12'><div class='card-body'><h5 class='card-title cortar_t'>" + element["titulo_proyecto"] + "</h5><p>Cantidad alumnos: " + element["Cantidad_alumnos"] + "</p><p>Semestre " + element["Semestre"] + "</p><p>Recompensa: " + element["Recompensa"] + "</p><p class='cortar'>Perfil: <br>" + element["Perfil"] + "</p> </div><div class='card-footer text-right blanco'><button href='#registrar_anuncio' class='btn btn-outline-success' type='button' data-toggle='modal' onclick='seleccion(\"edt_anun\"," + element["id_anuncio"] + ");'>Editar</button><button href='#confirmacion' class='" + btn_color + " mx-sm-3' type='button' data-toggle='modal' onclick='seleccion(\"elm_anun\"," + element["id_anuncio"] + ");'>" + btn_texto + "</button></div></div>");
        });
    }).fail(function () {
        console.log("Error");
    });
}

$("#btn_guardar_proyecto").click(function (evt) {
    realizar_accion();
});

$("#btn_guardar_congreso").click(function (evt) {
    realizar_accion();
});


$("#btn_guardar_publicacion").click(function (evt) {
    realizar_accion();
});

$("#btn_guardar_investigador").click(function (evt) {
    realizar_accion();
});

//funcion para inicializar los checkbox y cargar las las listas de los selects
function cargar_componentes() {
    $("#check_investigador").prop("checked", false);
    $("#check_proyectos").prop("checked", false);
    $("#check_publicacion").prop("checked", false);
    $("#in_palabra_proyecto").val("");
    $("#in_nombre_investigador").val("");
    $("#in_palabra_publicacion").val("");

    $.ajax({
        method: "POST",
        url: phpPath,
        data: { funcion: "consulta_lista_usuarios" },
        dataType: "json"
    }).done(function (jsonObjet) {
        $("#select_investigador_proyecto").empty();
        $("#select_colaboradores").empty();
        $("#select_lider_proyecto_registro").empty();
        $("#select_autor_publicacion_registro").empty();
        $("#select_investigador_proyecto").append("<option selected value=''>Investigador</option>");
        $("#select_lider_proyecto_registro").append("<option selected value=''>Investigador</option>");
        $("#select_colaboradores").append("<option selected value=''>Investigador</option>");
        jsonObjet.forEach(element => {
            $("#select_investigador_proyecto").append("<option value=" + element["id_investigador"] + ">" + element["nombre"] + "</option>");
            $("#select_lider_proyecto_registro").append("<option value=" + element["id_investigador"] + ">" + element["nombre"] + "</option>");
            $("#select_autor_publicacion_registro").append("<option value=" + element["id_investigador"] + ">" + element["nombre"] + "</option>");
            $("#select_colaboradores").append("<option value=" + element["id_investigador"] + ">" + element["nombre"] + "</option>");
        });
    }).fail(function () {
        console.log("Error");
    });

    $.ajax({
        method: "POST",
        url: phpPath,
        data: { funcion: "consulta_lista_lineas" },
        dataType: "json"
    }).done(function (jsonObjet) {
        $("#select_linea_proyecto").empty();
        $("#select_linea_proyecto_registro").empty();
        $("#select_linea_investigador").empty();
        $("#select_linea_congreso").empty();
        $("#select_linea_publicacion").empty();
        $("#select_linea_proyecto").append("<option value='' selected>Linea de investigacion</option>");
        $("#select_linea_investigador").append("<option value='' selected>Linea de investigacion</option>");
        $("#select_linea_congreso").append("<option value='' selected>Linea de investigacion</option>");
        $("#select_linea_publicacion").append("<option value='' selected>Linea de investigacion</option>");
        $("#select_linea_proyecto_registro").append("<option value='' selected>Linea de investigacion</option>");
        $("#select_lineas_investigacion_registro").empty();
        $("#select_lineas_investigacion_registro").append("<option value='' selected>Linea de investigacion</option>");
        $("#select_linea_publicacion_registro").empty();
        $("#select_linea_congreso_registro").empty();
        jsonObjet.forEach(element => {
            ;
            $("#select_lineas_investigacion_registro").append("<option  value=" + element["id_linea"] + ">" + element["nombre_linea"] + "</option>");
            $("#select_linea_proyecto_registro").append("<option  value=" + element["id_linea"] + ">" + element["nombre_linea"] + "</option>");
            $("#select_linea_congreso_registro").append("<option value=" + element["id_linea"] + ">" + element["nombre_linea"] + "</option>");
            $("#select_linea_proyecto").append("<option value=" + element["id_linea"] + ">" + element["nombre_linea"] + "</option>");
            $("#select_linea_publicacion_registro").append("<option value=" + element["id_linea"] + ">" + element["nombre_linea"] + "</option>");
            $("#select_linea_investigador").append("<option value=" + element["id_linea"] + ">" + element["nombre_linea"] + "</option>");
            $("#select_linea_congreso").append("<option value=" + element["id_linea"] + ">" + element["nombre_linea"] + "</option>");
            $("#select_linea_publicacion").append("<option value=" + element["id_linea"] + ">" + element["nombre_linea"] + "</option>");
        });
    }).fail(function () {
        console.log("Error");
    });

}

//Eventos de los para actualizar la lista de proyectos
//Evento para cambio de proyectos activos a inactivos o visceversa
$('#check_proyectos').change(function (event) {
    if (this.value == 1) {
        $('#check_proyectos').val("0");
        recargar_proyectos();
    } else {
        $('#check_proyectos').val("1");
        recargar_proyectos();
    }
});
//Evento que atualiza la lista por inveitgador
$('#select_investigador_proyecto').change(function (evt) {
    recargar_proyectos();
});
//Evento que atualiza la lista de proyectos linea de invetigacion
$('#select_linea_proyecto').change(function (evt) {
    recargar_proyectos();
});
//Evento que atualiza la lista por palabra
$('#in_palabra_proyecto').keyup(function (evt) {
    recargar_proyectos();
});
//Evento que restablece los fultros 
$('#tbn_refrescar_filtros_proyectos').click(function (evt) {
    $('#in_palabra_proyecto').val("");
    $("#select_investigador_proyecto").val("");
    $("#select_linea_proyecto").val("");
    recargar_proyectos();
});
//funcion que recarga los proyectos obteniendo los filtros
function recargar_proyectos() {
    cargar_proyectos($('#in_palabra_proyecto').val(), $('#select_investigador_proyecto').val(), $("#select_linea_proyecto").val(), $('#check_proyectos').val());
}

$('#check_financiado').change(function (event) {
    if (this.value == 1) {
        $('#check_financiado').val("0");
        //console.log("No financiado");
    } else {
        $('#check_financiado').val("1");
        //console.log("Financiado")
    }
});

//evento para crear un nuevo proyecto
$("#btn_nuevo_proyecto").click(function (evt) {
    colaboradores_lista = [];
    $("#titulo_modal_proyecto").text("Registrar Proyecto");
    $("#in_titulo_proyecto").val("");
    $("#select_lider_proyecto_registro").val("");
    $("#in_img_proyecto").val("");
    $("#img_proyecto_ref").val("");
    $("#in_fecha_inicio").val("");
    $("#in_fecha_fin").val("");
    $("#check_financiado").prop("checked", false);
    $("#txt_resumen_proyecto").val("");
    $("#select_colaboradores").val("");
    $("#lista_colaboradores").empty();
    /*$("#select_publicaciones").val("");
    $("#lista_publicaciones").empty();
    $("#select_congresos").val("");
    $("#lista_congresos").empty();*/
    elemento = "";
    accion = "reg_proy";


});

function quitar_elemento_p(num) {
    var index = colaboradores_lista.indexOf(num);
    colaboradores_lista.splice(index, 1);
    listar_colaboradores();
}

function listar_colaboradores() {
    $("#lista_colaboradores").empty();
    if (colaboradores_lista.length != 0) {
        colaboradores_lista.forEach(element => {
            $("#lista_colaboradores").append("<li class='list-group-item item list-group-item-success''>" + $("#select_colaboradores option[value=" + element + "]").text() + "<button onclick='quitar_elemento_p(" + element + ")' tyle='button' class='close' aria-hidden='true'>&times;</button></li>");
        });
    }
}

$("#select_colaboradores").change(function (evt) {
    console.log(colaboradores_lista);
    if (!contiene(colaboradores_lista, $("#select_colaboradores").val()) && $("#select_colaboradores").val() != "") {
        colaboradores_lista.push($("#select_colaboradores").val())
        listar_colaboradores();
    }
});

$("#btn_nuevo_congreso").click(function (evt) {
    $("#tutulo_reg_congreso").text("Nuevo congreso");
    $("#in_img_congreso").val("");
    $("#select_linea_congreso_registro").val("1");
    $("#in_titulo_congreso").val("");
    $("#img_congreso_reg").val("");
    $("#in_link_congreso").val("");
    elemento = "";
    accion = "reg_cong";
});


$("#btn_nuevo_anuncio").click(function (evt) {
    $("#titulo_registro_anuncio").text("Nuevo anuncio");
    $("#txt_perfil_anuncio").val("");
    $("#in_cantidad_alumno").val("1");
    $("#in_semestre_alumno").val("1");
    $("#select_proyecto_anuncio").val("1");
    $("#in_recompensa_alumno option:selected").val("Credito complementario")
    accion = "reg_anun";
});

//Eventos para actualizar la lista de investigadores
//Evento para cambio de invetigadores activos a inactivos o visceversa
$('#check_investigador').change(function (event) {
    if (this.value == 1) {
        $('#check_investigador').val("0")
        recargar_investigadores();
    } else {
        $('#check_investigador').val("1")
        recargar_investigadores();
    }
});
//Evento que atualiza la lista de investigadores por linea de invetigacion
$('#select_linea_investigador').change(function (evt) {
    recargar_investigadores();
});
//Evento que atualiza la lista por palabra
$('#in_nombre_investigador').keyup(function (evt) {
    recargar_investigadores();
});
//Evento que restablece los fultros lista investigador
$('#btn_refrescar_filtos_investigador').click(function (evt) {
    $('#select_linea_investigador').val("");
    $("#in_nombre_investigador").val("");
    recargar_investigadores();
});
//funcion que recarga los proyectos obteniendo los filtros
function recargar_investigadores() {
    cargar_investigadores($('#in_nombre_investigador').val(), $("#select_linea_investigador").val(), $('#check_investigador').val());
}
//Evento para crear un nuevo proyecto
$("#btn_nuevo_investigador").click(function (evt) {
    linea_lista = [];
    $("#titulo_modal_investigador").text("Registrar Investigador");
    $("#in_titulo_investigador").val("");
    $("#in_nombre_investigador_registro").val("");
    $("#in_apellido_patertno").val("");
    $("#in_apellido_matertno").val("");
    $("#in_foto_investigador").val("");
    $("#in_correo_registro").val("");
    $("#img_investigador").val("");
    $("#in_edificio_ubicacion").val("");
    $("#select_lineas_investigacion_registro").val("");
    $("#lista_lineas_investigador").empty();
    elemento = "";
    accion = "reg_inv";
});

function contiene(a, obj) {
    for (var i = 0; i < a.length; i++) {
        if (a[i] === obj) {
            return true;
        }
    }
    return false;
}

function quitar_elemento(num) {
    var index = linea_lista.indexOf(num);
    linea_lista.splice(index, 1);
    listar_lineas_investigador();
}

function listar_lineas_investigador() {
    $("#lista_lineas_investigador").empty();
    if (linea_lista.length != 0) {
        linea_lista.forEach(element => {
            $("#lista_lineas_investigador").append("<li class='list-group-item item list-group-item-success''>" + $("#select_lineas_investigacion_registro option[value=" + element + "]").text() + "<button onclick='quitar_elemento(" + element + ")' tyle='button' class='close' aria-hidden='true'>&times;</button></li>");
        });
    }
}

//Evento para actualizar lista por linea de investigacion
$("#select_lineas_investigacion_registro").change(function (evt) {
    if (!contiene(linea_lista, $("#select_lineas_investigacion_registro").val()) && $("#select_lineas_investigacion_registro").val() != "") {
        linea_lista.push($("#select_lineas_investigacion_registro").val())
        listar_lineas_investigador();
    }
});
//Eventos para actualizar la lista de publicacioneas
//Evento para cambio de publicaciones activas a inactivos o visceversa
$('#check_publicacion').change(function (evt) {
    if (this.value == 1) {
        $('#check_publicacion').val("0");
        recargar_publicaciones();
    } else {
        $('#check_publicacion').val("1");
        recargar_publicaciones();
    }
});
//Evento para actualizar lista por linea de investigacion
$("#select_linea_publicacion").change(function (evt) {
    recargar_publicaciones();
});
//Evento para actualizar lista por palabra clave
$("#in_palabra_publicacion").keyup(function (evt) {
    recargar_publicaciones();
});
$('#btn_refrescar_filtos_publicacion').click(function (evt) {
    $('#select_linea_publicacion').val("");
    $("#in_palabra_publicacion").val("");
    recargar_publicaciones();
});
$("#btn_nueva_publicacion").click(function (evt) {
    $("#titulo_modal_publicacion").text("Nueva publicación");
    $("#in_titulo_publicacion_registro").val("");
    $("#in_foro_publicacion").val("");
    $("#select_autor_publicacion_registro").val("1");
    $("#select_linea_publicacion_registro").val("1");
    $("#achivo_pdf").val("");
    $("#in_doc_publicacion").val("");
    $("#in_fecha_publicacion").val("");
    accion = "reg_publ";
    elemento = "";
})
//Funcion para recargar la pagina obteniendo los filtros que se han seleccionado
function recargar_publicaciones() {
    cargar_publicaciones($("#in_palabra_publicacion").val(), $("#select_linea_publicacion").val(), $("#check_publicacion").val());
}
//Evento que quira los filtros de los congresos
$('#btn_refrescar_filtros_congreso').click(function (evt) {
    $('#select_linea_congreso').val("");
    $("#in_palabra_congreso").val("");
    recargar_congresos();
});
$("#in_palabra_congreso").keyup(function (evt) {
    recargar_congresos();
});
$("#select_linea_congreso").change(function (evt) {
    recargar_congresos();
});
// Funcion que carga los congresos con los filtros seleccionados
function recargar_congresos() {
    cargar_congresos($("#in_palabra_congreso").val(), $('#select_linea_congreso').val());
}

//Constructores de los campo date(para la fecha)
$('#fecha_inicio').datepicker({
    format: "dd/mm/yyyy"
});
$('#fecha_fin').datepicker({
    format: "dd/mm/yyyy"
});
$('#in_fecha_publicacion').datepicker({
    format: "dd/mm/yyyy"
});

//Funciones para el campo imput file de las imagenes
$(document).on('change', ':file', function () {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});
$(document).ready(function () {
    $(':file').on('fileselect', function (event, numFiles, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;

        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }

    });
});


///////

$("#in_apellido_patertno").keyup(function (e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;

})
$("#in_apellido_patertno").blur(function () {
    var val = $("#in_apellido_patertno").val();
    var tam = val.length;
    for (i = 0; i < tam; i++) {
        if (!isNaN(val[i]))
            $("#in_apellido_patertno").val("");
    }
})

///

$("#in_nombre_investigador_registro").keyup(function (e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;

})
$("#in_nombre_investigador_registro").blur(function () {
    var val = $("#in_nombre_investigador_registro").val();
    var tam = val.length;
    for (i = 0; i < tam; i++) {
        if (!isNaN(val[i]))
            $("#in_nombre_investigador_registro").val("");
    }
})

//
$("#in_titulo_investigador_registro").keyup(function (e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;

})
$("#in_titulo_investigador_registro").blur(function () {
    var val = $("#in_titulo_investigador_registro").val();
    var tam = val.length;
    for (i = 0; i < tam; i++) {
        if (!isNaN(val[i]))
            $("#in_titulo_investigador_registro").val("");
    }
})

$("#in_apellido_matertno_registro").keyup(function (e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;

})
$("#in_apellido_matertno_registro").blur(function () {
    var val = $("#in_apellido_matertno_registro").val();
    var tam = val.length;
    for (i = 0; i < tam; i++) {
        if (!isNaN(val[i]))
            $("#in_apellido_matertno_registro").val("");
    }
})

function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )return false;
    else return true;

}