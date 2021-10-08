$('.add_product').click(function(e)){

	e.preventDefault();
	var producto = $(this).attr('product');
	alert(producto);
}