
//<![CDATA[ 
<!-- JS for left slider menu and auto resize map width (alif)-->
$(window).load(function(){
$(".right-section").width($(window).width()-300);
$(".right-section").height($(window).height()-30);


$('.left-section .tab').toggle(function(){
    $('.left-section').animate({'left':-140},"slow");
	$('.right-section').animate({'left':20},"slow");
	 var nextWidth = $(window).width()-20;
	$(".right-section").animate({'width':nextWidth},600);
	
}, function(){
    $('.left-section').animate({'left':0},"slow");
	$('.right-section').animate({'left':299},"slow");
	var nextWidth = $(window).width()-299;
	$(".right-section").animate({'width':nextWidth},600);
});
});//]]>  

//function to reset map size(right-section) if user change windows size
$(window).resize(function() {
  $(".right-section").width($(window).width()-300);
$(".right-section").height($(window).height()-30);
});
<!-- End JS for left slider menu and auto resize map width-->

		
/*set map height 100%-40%, 40 for top bar menu
$(document).ready(function() {
$("#PinItMap").height($(document).height()-90);
});*/

//js for toggle button for calling top slider menu, and rotate icon by calling .rotate CSS class
$(window).load(function(){
$('#userBar .toggle').toggle(function(){
    $('#topSlider').animate({'top':33});
    $("#tggleBtn").toggleClass("rotate");
}, function(){
    $('#topSlider').animate({'top':-130});
    $("#tggleBtn").toggleClass("rotate");
});
});//]]> 

