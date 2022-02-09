$(function() {
	
	$('.gallery-grid a, .gallery-grid h4').click(function(e) {
		e.preventDefault();
		var idgaleria = $(this).attr("idgaleria");
		$.ajax({
			url : "galeria/getGaleria",
			type : "post",
			dataType : "json",
			data : {
				'idgaleria' : idgaleria
			},
			success : function(data) {
				var html = '';
				$(data).each(function(index, value) {
					html += '<a href="' + $("#base_site").val() + 'assets/media/galeria/' + value.imagem + '">' +
					 '<img src="' + $("#base_site").val() + 'assets/media/galeria/' + value.imagem + '" alt="'+value.nome+'" rel="'+value.nome+'">' + 
					 '</a>';
				});
				$('.gallery_show').html(html);
				$('.gallery_show a').lightBox({rel:'gal'});
				$('.gallery_show').find("a:first").trigger("click");
								
			}
		});
	});

});

