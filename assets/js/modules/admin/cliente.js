
$(document).ready(function(){
	$("select[name=treino]").change(function(){		
		var idtreino = $(this).val();
			$.ajax({
					url: $("#base_site").val()+"admin/cliente/editarTreino",
					type: "POST",
					dataType: "json",
					data: {id_usuario: $("#id_cliente").val(),
						   id_treino: idtreino	
						 },
						 
					beforeSend: function(){
						$.isLoading({
							text : ""
						});
					},
					success: function(call){
						if(call.status){
							if(typeof call.treino == "object"){
								$(".fildImagemTreino").html('<img class="img-thumbnail" src="'+$("#base_site").val()+'assets/media/treino_cliente/'+call.treino.imagem+'" />');
								jSuccess("Treino alterado com sucesso!",{VerticalPosition:"center",HorizontalPosition: "center"});	
							}else{
								$(".fildImagemTreino").html("<span>Nenhum treino configurado para o cliente "+$("legend.scheduler-border nome").html()+"</span>");
								jNotify("Nenhum treino configurado para o cliente "+$("legend.scheduler-border nome").html()+".",{VerticalPosition:"center",HorizontalPosition: "center"});
							}
							
						}else{
							jError(call.msg,{VerticalPosition:"center",HorizontalPosition: "center"});
						}		
					},complete: function(){
						$.isLoading("hide");
					}				
			});		
	});
	
	
});
