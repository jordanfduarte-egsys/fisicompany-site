formData2 = {
    'largura'      : '200',
	'altura'       : '80',
	'pasta'        : 'thumb',
	'opcao'        : 'crop',
	'dir'          : "perfil"
};

callbackPosUpload = function(files, data, xhr) {
    data.id_usuario = $("input[name=id_usuario]").val();
    data.prefix = "/assets/media/perfil/";

    $.ajax({
        url         : '/cliente/index/upload',
        type        : 'post',
        dataType    : 'json',
        data        : data,
        beforeSend: function() {
            $.isLoading({
                text : "Movendo arquivo, aguarde..."
            });
        },
        success     : function(result) {
            if (result.result) {
                $(".clear_both").html('');
                $("#imagem_pos_upload img").attr("src", result.caminho);
                $("#imagem").val(result.arquivo);
            } else {
                $("#imagem_pos_upload img").attr("src", "/assets/img/sem_foto.gif");
                alert(result.message);
            }
        },
        complete    : function() {
            $.isLoading("hide");
        }
    });
}
