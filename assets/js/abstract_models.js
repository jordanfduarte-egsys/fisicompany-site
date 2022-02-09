//Inicialização do tinyMCE
tinymce.init({
    selector: "textarea"
    
});
$(document).ready(function() {
    //chamada dos handler
    handlerRemoveImagem();
    handlerImagemFavorita();
    handlerSortableImagem();
    //Data table padrão
    
    
    var oTable = $('#exampleCliente').dataTable({
        "bPaginate" : true,
        "bJQueryUI" : true,
        
        "aaSorting": [[ 4, "desc" ]],
        "sDom" : '<"H"Tlfr>t<"F"ip>',
        "oTableTools": {
            "aButtons": [
            
                {
                    "sExtends":    "text",
                    'sButtonText':  "<span class='icoprint glyphicon glyphicon-print'></span>",
                    "fnClick": function ( nButton, oConfig, oFlash ) {     
                        
                        //popup('<table cellpadding="0" cellspacing="0" border="0" class="display dataTable" id="exampleCliente" aria-describedby="exampleCliente_info">'+$("#exampleCliente").html()+"</table>");
                        var elementoMedidas = $("#todo_content").html();
                        $("#iframa").contents().find("#iframeContent").html(elementoMedidas);                        
                        $(".ui-widget-header:first", $("#iframa").contents().find("#iframeContent")).hide();
                        $("table", $("#iframa").contents().find("#iframeContent")).next().hide();
                        $("#iframa").get(0).contentWindow.print();    
                        //popup(elementoMedidas);
                        //$("#iframa").contents().find("#iframeContent").html(elementoMedidas);
                    }
                },
                {
                    "sExtends":    "text",
                    'sButtonText':  "<span class='icocalender glyphicon glyphicon-calendar'><input id='calender2' type='text' style='position: relative;margin-left: -22px;background: transparent;border: none;width: 148px;padding-right: -24px;padding-left: 22px;' /></span>",
                    "fnClick": function ( nButton, oConfig, oFlash ) {
                        
                    }
                }
            ]
        },
    
           
        // "sDom" : '<"H"Tlfr>t<"F"ip>',
        // "oTableTools" : {
        // "sSwfPath": "../../assets/js/DataTables-1.9.4/extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
                // "aButtons" : [{
                                // "sExtends" : "xls",
                                // "sButtonText" : "<img src='../../assets/js/DataTables-1.9.4/media/images/excel.png' width='20' title='Exportar para Excel'/>",
                                // "sTitle" : "Arquivo",
                                // "mColumns" : [0, 1, 2, 3]
                            // },{
                                // "sExtends" : "pdf",
                                // "sButtonText" : "<img src='../../assets/js/DataTables-1.9.4/media/images/pdf.png' width='20' title='Exportar para PDF'/>",
                                // "sTitle" : "Arquivo",
                                // "sPdfOrientation" : "landscape",
                                // "mColumns" : [0, 1, 2, 3]
                            // }]
        // },
        "sPaginationType" : "full_numbers",
        "oLanguage" : {
                    "sProcessing" : "Processando...",
                    "sLengthMenu" : "Mostrar _MENU_ registros",
                    "sZeroRecords" : "Não foram encontrados resultados",
                    "sInfo" : "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty" : "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered" : "(filtrado de _MAX_ registros no total)",
                    "sInfoPostFix" : "",
                    "sSearch" : "Buscar:",
                    "sUrl" : "",
                    "oPaginate" : {
                    "sFirst" : "Primeiro",
                    "sPrevious" : "Anterior",
                    "sNext" : "Seguinte",
                    "sLast" : "Último"
            }
        }
    });
    $("#exampleCliente_length").css('display','none');
    $(".icoprint, .icocalender").css("font-size", "20px");
    $(".icoprint , .icocalender").css("margin-right", "10px");
    $(".icocalender, .icoprint").parent().css("position", "relative");
    $(".icocalender, .icoprint").parent().css("top", "24px");
    $("#calender2").datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'mm/yy', 
        closeText: 'Buscar',
        currentText: 'Hoje',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        nextText: 'Próximo',
        prevText: 'Anterior',
        onClose: function(dateText, inst) {            
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $(".ui-datepicker-year").find("option:selected").html();
            $("#calender2").val(convertMesDataPicker(month)+"/"+year);
             $.ajax({
                     url: $("#base_site").val()+"cliente/index/getMedidaDate",
                     type: "POST",
                     dataType:"json",
                     data: {"data":convertMesDataPicker(month)+"/"+year},
                     success: function(data)
                     {
                         var html = '';
                         $(data).each(function(index,value){
                             html += "<tr class='gradeX'>";                                    
                                html += "<td>"+value.data_br+"</td>";    
                                html += "<td>"+value.braco+"</td>";    
                                html += "<td>"+value.antebraco+"</td>";    
                                html += "<td>"+value.peitoral+"</td>";
                                html += "<td class='sorting_1'>"+value.cintura+"</td>";    
                                html += "<td>"+value.abdomen+"</td>";    
                                html += "<td>"+value.quadril+"</td>";
                                html += "<td>"+value.coxa+"</td>";    
                                html += "<td>"+value.pantorrilha+"</td>";
                                html += "<td>"+value.peso+"</td>";
                            html += "</tr>";                             
                         });
                         $("#exampleCliente tbody").html(html);
                         $("#exampleCliente tbody").find("tr").each(function(index,value){
                             if(index%2==0)
                                 $(this).addClass("odd");
                             else
                                 $(this).addClass("even");
                         });
                         
                     }
             });
        }      
    });    
    function convertMesDataPicker(data)
    {
        switch(data)
        {
            case '0': return '01'; break;
            case '1': return '02'; break;
            case '2': return '03'; break;
            case '3': return '04'; break;
            case '4': return '05'; break;
            case '5': return '06'; break;
            case '6': return '07'; break;
            case '7': return '08'; break;
            case '8': return '09'; break;
            case '9': return '10'; break;
            case '10': return '11'; break;
            case '11': return '12'; break;
            
                
        }
    }
    
    var oTable = $('#example').dataTable({
        "bPaginate" : true,
        "bJQueryUI" : true,
        "aaSorting": [[ 4, "desc" ]],        
        "sDom" : '<"H"Tlfr>t<"F"ip>',
        "oTableTools" : {
                "sSwfPath": "/assets/js/DataTables-1.9.4/extras/TableTools/media/swf/copy_csv_xls_pdf.swf",
                "aButtons" : [{
                                "sExtends" : "xls",
                                "sButtonText" : "<img src='/assets/js/DataTables-1.9.4/media/images/excel.png' width='20' title='Exportar para Excel'/>",
                                "sTitle" : "Arquivo",
                                "mColumns" : [0, 1, 2, 3]
                            },{
                                "sExtends" : "pdf",
                                "sButtonText" : "<img src='/assets/js/DataTables-1.9.4/media/images/pdf.png' width='20' title='Exportar para PDF'/>",
                                "sTitle" : "Arquivo",
                                "sPdfOrientation" : "landscape",
                                "mColumns" : [0, 1, 2, 3]
                            }]
        },
        "sPaginationType" : "full_numbers",
        "oLanguage" : {
                    "sProcessing" : "Processando...",
                    "sLengthMenu" : "Mostrar _MENU_ registros",
                    "sZeroRecords" : "Não foram encontrados resultados",
                    "sInfo" : "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty" : "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered" : "(filtrado de _MAX_ registros no total)",
                    "sInfoPostFix" : "",
                    "sSearch" : "Buscar:",
                    "sUrl" : "",
                    "oPaginate" : {
                    "sFirst" : "Primeiro",
                    "sPrevious" : "Anterior",
                    "sNext" : "Seguinte",
                    "sLast" : "Último"
            }
        }
    });

    
    //Botão para adiconar no datatale
    $("#example_filter").after("<div class='novo-registro'><a class='btn-lg btn btn-success' href='" + $("#base_site").val()+"admin/"+ $("#base_site").attr("module")+"/novo"+(typeof $("#segmentos").val() !== 'undefined' ? $("#segmentos").val() : "")+"'><span class='glyphicon glyphicon-plus'></span>&nbsp;Novo</a></div>");
    //Sortable
    
    $(".sortable > tbody").sortable({
              handle : '.handle',
              stop   : function(event, ui) {
                  $(ui.item[0]).css("border","none");              
                if(!confirm("Deseja trocar a ordem?"))
                    return false;
                  
              },
              start    : function(event, ui){
                  $(ui.item[0]).css("border","1px dashed black");
              },
              update : function () {
                  var order = $('.sortable > tbody').sortable('serialize');
                    $.ajax({
                            url: $("#base_site").attr("module")+"/sortable",
                            type: "post",
                            dataType: "json",
                            data: {"order": order},
                            success: function(data)
                            {
                                //mudar a cor
                                $('.sortable > tbody')    .find("tr").each(function(index,value){
                                    if($(this).hasClass("odd"))
                                        $(this).removeClass("odd");
                                    if($(this).hasClass("even"))
                                        $(this).removeClass("even");
                                    
                                    if(index%2==0)
                                        $(this).addClass("odd");
                                    else
                                        $(this).addClass("even");
                                        //trocando os valores da ordem
                                        $(this).find(".ordem").html((index+1));
                                });
                            }
                    });
              }
              
        });

    
    $('.selectpicker').selectpicker({
        'selectedText' : 'cat'
    });
    //busca avançada
    $("input[name=busca]").keydown(function(e){
        if(e.which == 13)
            $(this).parent().next().trigger("click");
    });
    // $('.selectpicker').selectpicker('hide');
    /**
     *@author Jordan Duarte
     * @todo Função padrão para deletar registros do datatable 
     */
    $(".deletar_instancia").click(function(e) {
        e.preventDefault();
        var idinstancia = $(this).attr("idinstancia");
        //id do elemento que vai ser deletado
        var nome_deletado = $(this).attr("nome_deletado");
        //nome identificador para mensagem
        var modulo = $(this).attr("modulo");
        
        var return3 = typeof $(this).attr("return") !== 'undefined' ? $(this).attr("return") : null;
        
        
        //nome do modulo que vai deletar
        $(".view_dialog").text("Deseja realmente deletar o registro `" + nome_deletado+"`?").dialog({
            title : "Deletar",
            width : "500",            
            resizable: false,        
            show: { effect: "bounce", times: 3 },
            buttons : [{
                text : "Sim",
                click : function() {
                    $.ajax({
                        url : $("#base_site").val()  + "admin/"+modulo + "/deletar",
                        type : "post",
                        dataType : "json",
                        data : {
                            "idinstancia" : idinstancia
                        },
                        success : function(data) {
                            if(typeof(data.isShowMessage) === "boolean")
                            {
                                jNotify(data.msg,{VerticalPosition:"center",HorizontalPosition:"center"});
                                return false;
                            }
                            
                            if(return3 != null)
                                window.location.reload();
                            else
                            window.location.href = modulo+(typeof($("#segmentos").val()) !== 'undefined' ? $("#segmentos").val() : "");
                        }
                    });
                    $(this).dialog("close");
                }
            }, {
                text : "Cancelar",
                click : function() {
                    $(this).dialog("close");
                }
            }]            
        });
    });
    /**
     *@author Jordan Duarte
     * @todo Somente faz upload de uma imagem
     *  
     */    
     
    if(typeof(formData2) != "undefined") {
        $("#fileuploader").uploadFile({
                    url: $("#base_site").val()+"assets/media/index.php",//Local para onde deve fazer uplaod
                    allowedTypes:        "png,gif,jpg,jpeg",//formato aceito
                    multiple:            false,         //seleciona somente ums
                    returnType:            "json", //retorno
                    maxFileCount:        1,//somente uma imagems    
                    uploadButtonClass:  "btn btn-primary",//classe do botão
                    formData://form data
                    {
                        
                                        0: formData2,//dados dos formatos e copias que devem ser feitas
                                        'dir':     $("#base_site").attr("module")//diretorio do modulo
                    },
                    onSuccess:function(files,data,xhr)//handler de retorno
                    {    
                                        $(".progress").css("width","95%");//Processo 95%
                                        if(data.status)
                                        {
                                                $(".clear_both").html('');
                                                $("#imagem_pos_upload img").attr("src",$("#base_site").val()+"assets/media/"+$("#base_site").attr("module")+"/"+data.arquivo);
                                                   $("#imagem").val(data.arquivo);
                                                   
                                                   if (typeof callbackPosUpload == "function") {
                                                       callbackPosUpload(files,data,xhr);
                                                   }
                                        }else        
                                                $(".clear_both").html("<span style='color:red'>"+data.exception+"<span>");
                    },
                    deleteCallback: function(data,pd)//handler para deletar
                    {
                    
                    },    
                    fileName:"myfile",//nome da variavel file
                    showStatusAfterSuccess:false,//Nem rela daqui para baixo
                    dragDropStr: "<span><b>Arraste e solte aqui</b></span>",
                    abortStr:'<div class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%"> <span class="sr-only">45% Complete</span></div></div>',
                    cancelStr:"Cancelado",
                    doneStr:"Falha",
                    multiDragErrorStr: "Selecione somente um arquivo",
                    extErrorStr:"não é permitido. Extensões permitidas:",
                    sizeErrorStr:"não é permitido. Tamanho máximo permitido:",
                    uploadErrorStr:"Carregar não é permitido"    
        });
    }
    /**
     *@author Jordan Duarte
     * @todo Multiplo arquivos para upload
     *  
     */    
     if(typeof(formData2) != "undefined")    
    $("#fileuploaderMultiplo").uploadFile({
                url: $("#base_site").val()+"assets/media/index.php",//Local para onde deve fazer uplaod
                allowedTypes:        "png,gif,jpg,jpeg",//formato aceito
                multiple:            false,         //seleciona somente ums
                returnType:            "json", //retorno
                maxFileCount:        1,//somente uma imagems    
                uploadButtonClass:  "btn btn-primary",//classe do botão
                formData://form data
                {
                    
                                     0: formData2,//dados dos formatos e copias que devem ser feitas
                                    'dir':     $("#base_site").attr("module")//diretorio do modulo
                },
                onSuccess:function(files,data,xhr)//handler de retorno
                {    
                                    $(".progress").css("width","95%");//Processo 95%
                                    if(data.status)
                                    {
                                            $(".clear_both").html('');//Zera a menssagem
                                            //Adiciona a imagem na tela imagens
                                            var html = '';
                                            html += "<div class='imagem_mini'>";
                                                html += "<div class='imagem_mini_remove'>";
                                                html += "<a class='imagem_mini_remove_a' href='javascript:void(0)' title='Remover imagem'>";
                                                html += "<img class='imagem_mini_favorito_a_img' src='"+$("#base_site").val()+"assets/img/remover.png'/></a>";                                                    
                                                html += "</div>";
                                                
                                                html += "<img src='"+$("#base_site").val()+"assets/media/"+$("#base_site").attr("module")+"/"+data.arquivo+"'/>";
                                                html += "<input type='hidden' name='imagem[]' value='"+data.arquivo+"'/>";
                                                
                                                html += "<div class='imagem_mini_favorito'>";
                                                    html += "<a href='javascript:void(0)' class='imagem_mini_favorito_a' title='Adicionar como favorito'>";
                                                    html += "<img class='imagem_mini_favorito_a_img' src='"+$("#base_site").val()+"assets/img/favorito_over.png'/></a>";
                                                html += "</div>";
                                            html += "</div>";
                                            $("#imagens").append(html);
                                            
                                            
                                            $("#imagem_pos_upload img").attr("src",$("#base_site").val()+"assets/media/"+$("#base_site").attr("module")+"/"+data.arquivo);
                                               $("#imagem").val(data.arquivo);    
                                               $(".imagem_mini_favorito_a").off();
                                               $(".imagem_mini_remove_a").off();
                                               handlerImagemFavorita();
                                               handlerRemoveImagem();
                                               handlerSortableImagem();
                                    }else        
                                            $(".clear_both").html("<span style='color:red'>"+data.exception+"<span>");
                },
                deleteCallback: function(data,pd)//handler para deletar
                {
                
                },    
                fileName:"myfile",//nome da variavel file
                showStatusAfterSuccess:false,//Nem rela daqui para baixo
                dragDropStr: "<span><b>Arraste e solte aqui</b></span>",
                abortStr:'<div class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%"> <span class="sr-only">45% Complete</span></div></div>',
                cancelStr:"Cancelado",
                doneStr:"Falha",
                multiDragErrorStr: "Selecione somente um arquivo",
                extErrorStr:"não é permitido. Extensões permitidas:",
                sizeErrorStr:"não é permitido. Tamanho máximo permitido:",
                uploadErrorStr:"Carregar não é permitido"    
    });    
    
    $(".print").click(function(){
        var html = '<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Treino do dia</h2>';
        html += $("#todo_content .panel:first").html();
        return popup(html);
        window.close(); 
        
    });
    $(".print2").click(function(){
        var elementoEmTela = 1;
        var html = '<h2><span class="glyphicon glyphicon-align-justify"></span>&nbsp;Treinos</h2>';
        $(".bx-default-pager").find(".bx-pager-item a").each(function(){
            if($(this).hasClass("active"))
                elementoEmTela = $(this).html();
        });        
        $("#todo_content .panel:first .bx-wrapper:first .bx-viewport .bxslider").find("li").each(function(index,value){
            if(parseInt(index)+1 == parseInt(elementoEmTela))
                html += $(this).html();
        });
        return popup(html);
        window.close();
        
    });
    
    
});
function popup(data) 
{
    $("#iframa").contents().find("#iframeContent").html(data);
    $(".panel-heading", $("#iframa").contents().find("#iframeContent")).find('button').hide();        
    $("#iframa").get(0).contentWindow.print();
}

function handlerImagemFavorita()
{    
    //Adiciona as imagens como padrão
    $(".imagem_mini_favorito_a").on("click",function(){
        var imagem = $(this).parent().prev().val();
        $("#imagens").find(".imagem_mini .imagem_mini_favorito").each(function() {            
            $("img",$(this)).attr("src",$("#base_site").val()+"assets/img/favorito_over.png");
        });            
        $("#imagem_principal").val(imagem);
        $("img",$(this)).attr("src",$("#base_site").val()+"assets/img/favorito.png");
    });
}
function handlerRemoveImagem()
{    
    $(".imagem_mini_remove_a").on("click",function(){
        var imagem = $(this).parent().next().next().val();
        
        if(imagem == $("#imagem_principal").val())
                $("#imagem_principal").val("");
        $(this).parent().parent().remove();
        $.ajax({
            url: $("#base_site").val()+$("#base_site").attr("module")+"/deletaImagem",
            type: "POST",
            dataType: "json",
            data: {"imagem":imagem,"formData":formData2},
            success: function(data){
                //evento    
            }
        });
    });
}
function handlerSortableImagem()
{
    $("#imagens").sortable({
        start: function(event,ui){
            
            $(ui.item[0]).css("border","1px dashed black");
        },
        stop: function(event,ui){
            $(ui.item[0]).css("border","1px solid black");
        }
        
    });
    $("#imagens").disableSelection();
}
