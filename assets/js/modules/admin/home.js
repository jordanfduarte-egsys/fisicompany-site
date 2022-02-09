$(document).ready(function(){
	
    var div=$( ".jumbotron" );    
    div.animate({height:'50%',opacity:'0.4'},"slow");    
    div.animate({width:'25%',opacity:'0.8'},"slow");    
    div.animate({height:'100%',opacity:'0.4'},"slow");
    div.show("show");
    div.animate({width:'100%',opacity:'none'},"slow");

});
