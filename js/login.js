
function setTypeLogin(type){
    $("tipo-inicio").html("");
    localStorage.setItem('tipo_usuario', type);
    if(type == 'Administrador'){
        $("#tipo-inicio").html("Inicia sesión como administrador");
    }
    else{
        if(type == 'Encargado'){
            $("#tipo-inicio").html("Inicia sesión como encargado");
        }
        else{
            $("#tipo-inicio").html("Inicia sesión como profesor");
        }
    }
    $('#btn-login').attr("disabled", false);
}

function Login(){
    let data = 'tipoU='+localStorage.getItem('tipo_usuario')+'&'+$("#LoginForm").serialize();
    console.log(data);
    $.ajax({
        type : 'POST',
        async : true,
        timeout : 12000,
        url : '../function/login_bd.php',
        data : data,
        success : function(response){
            console.log(response);
            if(response == '0'){
                $("#message").html('<div class="alert alert-danger alert-dismissible fade show" style="margin-top:5%;" role="alert">'+
                '<strong>Error al iniciar Sesión</strong>'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                '<span aria-hidden="true">&times;</span>'+
                '</button>'+
                '</div>')
            }
            else{
                
                location.href = response;
            }
        },
        error : function(t,t2,t3){

        }
    })
}