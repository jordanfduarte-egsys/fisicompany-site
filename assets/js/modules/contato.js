var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {

    directionsDisplay = new google.maps.DirectionsRenderer();
    var myLatlng = new google.maps.LatLng();

    var myOptions = {
        zoom : 7,
        mapTypeId : google.maps.MapTypeId.ROADMAP,
        //center: myLatlng
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);
    //directionsDisplay.setPanel(document.getElementById("directionsPanel"));
}

function calcRoute() {
    var end = $(".como_chegar").data("endereco");
    var start = document.getElementById("endereco").value;
    var request = {
        origin : start,
        destination : end,
        travelMode : google.maps.DirectionsTravelMode.DRIVING
    };

    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            alert(status);

        }

        document.getElementById('mapview').style.visibility = 'visible';
    });
}


$(document).ready(function() {
    $("input[name= telefone]").focusout(function() {
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(99) 99999-999?9");
        } else {
            element.mask("(99) 9999-9999?9");
        }
    }).trigger('focusout');
    //    $("input[name= telefone]").mask("(99) 9999-9999?9");
    $("#submitEndereco").click(function(e) {
        e.preventDefault();
        initialize();
        calcRoute();
    });

    $('#endereco').keydown(function(event) {
        if (event.keyCode == 13) {
            initialize();
            calcRoute();
            return false;
        }
    });
    $("#submitContato").click(function(e) {

        e.preventDefault();
        var valida = true;
        $(".contact-form form").find(".required").each(function() {
            $(this).css("border", "1px solid rgba(192, 192, 192, 0.41)");
            if (!$.trim($(this).val())) {
                valida = false;
                $(this).css("border", "1px solid red");
            }
        });
        if (valida) {
            $.isLoading({
                text : "Enviando..."
            });
            $.ajax({
                url : "contato/enviarEmail",
                type : "POST",
                dataType : "json",
                data : {
                    "data" : $(".contact-form form").serialize()
                },
                success : function(data) {
                    $.isLoading("hide");
                    if (data.result) {
                        $(".contact-form form").find(".required").val("");
                        $(".contact-form form").find(".not_required").val("");
                        jSuccess("<y><b>E-mail</b> enviado com sucesso. Logo entraremos em contato.<y>", {
                            autoHide : true, // added in v2.0
                            clickOverlay : false, // added in v2.0
                            MinWidth : 250,
                            TimeShown : 3000,
                            ShowTimeEffect : 200,
                            HideTimeEffect : 200,
                            LongTrip : 20,
                            HorizontalPosition : 'center',
                            VerticalPosition : 'top',
                            ShowOverlay : true,
                            ColorOverlay : '#000',
                            OpacityOverlay : 0.3,
                            onClosed : function() {// added in v2.0

                            },
                            onCompleted : function() {// added in v2.0

                            }
                        });
                    } else {
                        jError("<y><b>Erro</b> ao enviar o e-mail, tente novamente.<y>", {
                            autoHide : true, // added in v2.0
                            clickOverlay : false, // added in v2.0
                            MinWidth : 250,
                            TimeShown : 3000,
                            ShowTimeEffect : 200,
                            HideTimeEffect : 200,
                            LongTrip : 20,
                            HorizontalPosition : 'center',
                            VerticalPosition : 'top',
                            ShowOverlay : true,
                            ColorOverlay : '#000',
                            OpacityOverlay : 0.3,
                            onClosed : function() {// added in v2.0

                            },
                            onCompleted : function() {// added in v2.0

                            }
                        });
                    }
                }
            });
        }
    });
}); 