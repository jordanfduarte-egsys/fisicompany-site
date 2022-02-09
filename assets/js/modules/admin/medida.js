
$(document).ready(function(){	
	$( ".centimetro").maskMoney({thousands:'', decimal:'.', allowZero:true,suffix: ' cm'});
	$( ".pesagem").maskMoney({thousands:'', decimal:'.', allowZero:true,suffix: ' Kg'});
	$( ".altura").maskMoney({thousands:'', decimal:'.', allowZero:true,suffix: ' m'});
});
