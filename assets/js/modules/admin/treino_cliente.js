	formData2 = {'largura':    '1920',
		 			'altura':   '493',
		 			'pasta': 	 'thumb',
		 			'opcao': 	 'crop',
		 			'dir':   	 $("#base_site").attr("module")};

//$(document).ready(function()
//{
	//imagens deve ser inserida em um array

	
	// $("#fileuploader").uploadFile({
				// url: $("#base_site").val()+"assets/media/index.php",//Local para onde deve fazer uplaod
				// allowedTypes:		"png,gif,jpg,jpeg",//formato aceito
				// multiple:			false,	 	//seleciona somente ums
			    // returnType:			"json", //retorno
			    // maxFileCount:		1,//somente uma imagems    
			    // uploadButtonClass:  "btn btn-primary",//classe do botão  
				// formData://form data
				// {
									// 0: formData,//dados dos formatos e copias que devem ser feitas
									// 'dir': 	$("#base_site").attr("module")//diretorio do modulo
				// },
				// onSuccess:function(files,data,xhr)//handler de retorno
			    // {    
							    	// $(".progress").css("width","95%");//Processo 95%
							    	// if(data.status)
							    	// {
							    			// $(".clear_both").html('');
							    			// $("#imagem_pos_upload img").attr("src",$("#base_site").val()+"assets/media/"+$("#base_site").attr("module")+"/"+data.arquivo);
							       			// $("#imagem").val(data.arquivo);	
							    	// }else    	
							    			// $(".clear_both").html("<span style='color:red'>"+data.exception+"<span>");
			    // },
			    // deleteCallback: function(data,pd)//handler para deletar
				// {
// 			    
			    // },    
				// fileName:"myfile",//nome da variavel file
				// showStatusAfterSuccess:false,//Nem rela daqui para baixo
				// dragDropStr: "<span><b>Arraste e solte aqui</b></span>",
				// abortStr:'<div class="progress progress-striped active"><div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%"> <span class="sr-only">45% Complete</span></div></div>',
				// cancelStr:"Cancelado",
				// doneStr:"Falha",
				// multiDragErrorStr: "Selecione somente um arquivo",
				// extErrorStr:"não é permitido. Extensões permitidas:",
				// sizeErrorStr:"não é permitido. Tamanho máximo permitido:",
				// uploadErrorStr:"Carregar não é permitido"	
	// });
//});
