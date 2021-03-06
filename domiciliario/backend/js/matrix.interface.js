
$(document).ready(function(){
	
	// === jQuery Peity === //
	$.fn.peity.defaults.line = {
		strokeWidth: 1,
		delimeter: ",",
		height: 24,
		max: null,
		min: 0,
		width: 50
	};
	$.fn.peity.defaults.bar = {
		delimeter: ",",
		height: 24,
		max: null,
		min: 0,
		width: 50
	};
	$(".peity_line_good span").peity("line", {
		colour: "#B1FFA9",
		strokeColour: "#459D1C"
	});
	$(".peity_line_bad span").peity("line", {
		colour: "#FFC4C7",
		strokeColour: "#BA1E20"
	});	
	$(".peity_line_neutral span").peity("line", {
		colour: "#CCCCCC",
		strokeColour: "#757575"
	});
	$(".peity_bar_good span").peity("bar", {
		colour: "#459D1C"
	});
	$(".peity_bar_bad span").peity("bar", {
		colour: "#BA1E20"
	});	
	$(".peity_bar_neutral span").peity("bar", {
		colour: "#757575"
	});
	
	// === jQeury Gritter, a growl-like notifications === //
	$('#gritter-notify .normal').click(function(){
	$.gritter.add({
		title:	'Registro Exitoso..!!!',
		text:	'Todos Los datos se Han Guardado Correctamente..!!!',
		image: 	'img/demo/envelope.png',
		sticky: false
	});	
});
	
	
	$('.1').click(function(){
		$.gritter.add({
			title:	'Valor',
			text:	'This is a normal valores de prueba 12',
			sticky: false
		});		
	});

		$('.2').click(function(){
		$.gritter.add({
			title:	'Error..!!!',
			text:	'Algo Salio Mal',
			sticky: false
		});		
	});
	
	$('#gritter-notify .sticky').click(function(){
		$.gritter.add({
			title:	'Sticky notification',
			text:	'This is a sticky notification',
			sticky: true
		});		
	});
	
	$('#gritter-notify .image').click(function(){
		var imgsrc = $(this).attr('data-image');
		$.gritter.add({
			title:	'Important Unread messages',
			text:	'You have 15 unread messages.',
			image: imgsrc,
			sticky: false
		});		
	});
});
