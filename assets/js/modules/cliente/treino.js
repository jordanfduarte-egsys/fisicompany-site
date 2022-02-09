
$('.bxslider').bxSlider({
  infiniteLoop: false,
  hideControlOnEnd: true,
  width: 800,
  onBeforeSlide: function($slideElement, oldIndex, newIndex){
  
  }
});
$(".bx-viewport").css("position","static");


$(document).ready(function() {
	$(".fancybox-button").fancybox({
		prevEffect		: 'none',
		nextEffect		: 'none',
		closeBtn		: true,
		width           : "100%",
		height          : "100%",
		helpers		: {
			title	: { type : 'inside' },
			buttons	: {}
		}
	});
});