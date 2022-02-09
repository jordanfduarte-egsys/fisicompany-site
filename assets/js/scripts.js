$(document).ready(function() {
    $(".logar_cliente").click(function() {
        window.location.href = "cliente/index/login";
    });
    $(".logoff_cliente").click(function() {
        logoff();
    });
    $("#cliente_senha").keydown(function(e){
        if(e.which == 13){
            $(".cliente_entrar").trigger("click");
        }
    });
    $(".cliente_entrar").click(function() {
        var usuario = $("#cliente_usuario").val();
        var senha = $("#cliente_senha").val();
        var valida = true;
        //ajax verificador de senha
        $("#dialogLogin").find("input").each(function() {
            $(this).css("border", "1px solid none");
            if ($.trim($(this).val()) == "") {
                valida = false;
                $(this).css("border", "1px solid red");
                $("#dialogLogin").effect("bounce", "show");
            }
        });

        if (valida) {
            $.ajax({
                url : $("#base_site").val() + "cliente/index/logon",
                type : "POST",
                dataType : "json",
                data : {
                    "login" : usuario,
                    "senha" : senha,
                    isCliene: true
                },
                success : function(data) {
                    if (data.status) {
                        $("h3", $("#espaco_cliente")).html("Sair");
                        $("a", $("#espaco_cliente")).removeClass("logar_cliente").addClass("logoff_cliente");
                        $("#status_cliente p").html("<a href='" + $("#base_site").val() + "cliente'>Óla, " + data.usuario.nome + " " + data.usuario.sobre_nome + "</a>");
                        $("#dialogLogin").toggle();
                        $("#dialogLogin").find("input").val("");
                        $(".logoff_cliente").off("click");
                        $(".logoff_cliente").on("click", function() {
                            logoff();
                        });
                        $.isLoading("hide");

                    } else {
                        $("#dialogLogin").effect("bounce", "show");
                        $(".errClienteLogin").html(data.msg);
                    }
                }
            });
        }
    });

    if(false && isMobile()) {
        $(".boxs, .top-link").width("1080px");
        document.getElementById("espaco_cliente").style.marginRight = "50%";
        document.getElementById("area_interna").style.width = "initial";
        document.getElementById("espaco_cliente").style.margin = "0 auto";
        document.getElementById("espaco_cliente").style.float = "none";
        document.getElementById("status_cliente").style.margin = "0 auto";
        document.getElementById("status_cliente").style.marginTop = "-26px";
        document.getElementById("status_cliente").style.marginLeft = "184px";
        document.getElementById("status_cliente").style.width = "320px";
        $(".image-slider, .header").width("1080px");
    }

    if (!isMobile()){
        // Calculo maior altura
        var h = 0;
        $.each($("#content > .wrap .content > .grids .grid"), function () {
            if ($(this).height() > 0) {
                $("#content > .wrap .content > .grids .grid").css("height", $(this).height() + "px");
            }
        });
    }
    
    
    $(".closeModalCliente").click(function(){
        $("#dialogLogin").hide();
        $.isLoading("hide");
    });
    
     // Slideshow 1
    $("#slider1").responsiveSlides({
        maxwidth : 1600,
        speed : 600
    });

    $(".scroll").click(function(event) {
        event.preventDefault();
        $('html,body').animate({
            scrollTop : $(this.hash).offset().top-30
        }, 1200);
    });
    
});

function isMobile() {
    var userAgent = navigator.userAgent.toLowerCase();
    if( userAgent.search(/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i)!= -1 ) {
        return true;
    }
}
function logoff() {
    $.ajax({
        url : $("#base_site").val() + "cliente/index/logoff",
        dataType : "json",
        success : function(data) {
            window.location.reload();
        }
    });
}