formData2 = new Array();
$(document).ready(function(){
	$(".limpeza").click(function(){
		var elementoClicado = $(this);
		var modulo = $(this).attr("modulo");
		//desabilita todos os outros buttons
		$("fieldset.scheduler-border").find(".list-group-item a").each(function(index,value){
			if(!$(this).is(elementoClicado))
			{
				$(this).addClass("previous disabled");
			}
		});
		//com base no modulo vamos postar para a controller a informação e limpar a base
		$(".well-lg").html('<div class="progress progress-striped active" style="width:100% !important;">'+
  								'<div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">'+
  								'<span class="sr-only">45% Complete</span>'+
  								'</div></div>');
									
		$.ajax({
			url: $("#base_site").val()+"admin/"+$("#base_site").attr("module")+"/limpezaModulo",
			type: "POST",
			dataType: "json",
			data: {"modulo": modulo},
			success: function(data){
				
				if(data.status)
				{
					$(".well-lg").html(data.log);
					elementoClicado.removeClass("btn-primary").addClass("btn-success");
				}else
				{
					$(".well-lg").html(data.log);
					elementoClicado.removeClass("btn-primary").addClass("btn-warning");
				}
				$("fieldset.scheduler-border").find(".list-group-item a").each(function(index,value){
					if(!$(this).is(elementoClicado))
					{
						$(this).removeClass("previous disabled");
					}
				});
				//troca a clase do botao
				
				
			},
			error: function()
			{
				$(".well-lg").html("Erro ao processar a limpeza.");
			}
		});
	});
});
