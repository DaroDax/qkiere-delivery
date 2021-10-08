function busqueda(){

	var texto=document.getElementById("consultar").value;
	var parametros = {
		"texto": texto
	};
	

	$.ajax({ 
		data:parametros,
		url:"../ajax/query_clientes/query.php",
		type:"POST",
		success: function(response){
			$("#datos").html(response);
		}
	});

}