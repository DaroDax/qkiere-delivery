/*--------------BUSCADOR--------------------------------------------*/
function busqueda(cod_mun){
        texto = $("#consultar").val();
        
        parametros="municipio="+cod_mun+"&&texto="+texto;

        $.ajax({ 
		data:parametros,
		url:"../../../usuario/frontend/pages/buscador-resultado.php",
		type:"POST",
		success: function(response){
			$("#resultados").html(response);
		}
	});
}
/*-----------------------------------------------------------------------------*/

//Botones-------------------------------------------------------------------------

function tiendas(){
    $(".sitios-buscados").show();

    $(".productos-buscados").hide();
    $(".categorias-buscadas").hide();
}

function producto(){
    $(".productos-buscados").show();
    
    $(".sitios-buscados").hide();
    $(".categorias-buscadas").hide();
}

function categoria(){
    $(".categorias-buscadas").show();
    
    $(".sitios-buscados").hide();
    $(".productos-buscados").hide();
}

//----------------------------------------------------------------------------------//

