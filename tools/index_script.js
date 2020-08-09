$(function() {
	$('#menu_left_principale').height($(window).height());
	if ($('#principale_cours').height()<$(window).height()*0.9) {
		$('#principale_cours').height($(window).height()*0.9);
	}
	var a=$(window).width();
	if(a<=800){
		$('#menu_left_principale').fadeOut('slow');
	}
	$('body').css('min-width', $(window).width()+'px');
});
function out(){
	$('#pub').fadeOut('slow');
}