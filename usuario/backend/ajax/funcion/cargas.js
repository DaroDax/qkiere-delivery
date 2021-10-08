
//Cargar Inicio------------------------------//
function inicio(cod_mun){
	$(".content").load('./inicio.php');
 //alert(cod_mun);
    $.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/inicio.php",
			data:"cod_mun="+cod_mun,
			success:function(r){
                 $('.inicio_content').html(r);				 
			}
	});    
}

function municipio(){
cod_mun = $("#municipio").val();
location.href="./menu.php?mun="+cod_mun;
//document.getElementById("inicio").value=cod_mun;
//newURL = updateURLParameter(window.location.href);
//alert(newURL);
//location.href="./menu.php?mun="+cod_mun;
/*$(".content").load('./inicio.php');
    $.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/inicio.php",
			data:"cod_mun="+cod_mun,
			success:function(r){
                 $('.inicio_content').html(r);
			}
	});   
                 //inicio(cod_mun);*/				 
}



//Cargar Tienda------------------------------//
function tienda(cod_tie) {
	$(".content").load('./tienda.php?cod_tie='+cod_tie);
	//alert(cod_tie);

	/*$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/tienda.php",
			data:"cod_tie="+cod_tie,
			success:function(r){
                 $('.tienda_content').html(r);				 
			}
	});*/
}
//Cargar Productos De La Tienda------------------------------//
function producto(cod_inv){
	tie = $("#codigo").val();
	$(".content").load('./tienda_producto.php?cod_tie='+tie+"&cod_inv="+cod_inv);
	//alert(cod_inv+" "+tie);

	/*$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/tienda_producto.php?tienda=",
			data:"cod_inv="+cod_inv+"&&cod_tie="+tie,
			success:function(r){
                 $('.tienda_content').html(r);				 
			}
	});*/
}
//Buscador-------------------------------------------------//

function buscador(cod_mun){
	//alert(cod_mun);
	$(".content").load('./buscador.php?mun='+cod_mun);
}

//Cargar Categorias-------------------------------------------------//
function categorias(cod_cat_tie){
	$(".content").load('./categorias.php');
	//alert(cod_cat_tie);
	$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/categorias.php",
			data:"cod_cat_tie="+cod_cat_tie,
			success:function(r){
                 $('.categoria_content').html(r);				 
			}
	});
}

//Cargar Carrito-------------------------------------------------//
function carrito(){
	$(".content").load('./carrito.php');
	/*$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/carrito.php",
			data:"cod_cat_tie="+cod_cat_tie,
			success:function(r){
                 $('.carrito_content').html(r);				 
			}
	});*/
}

//Cargar Recibo-------------------------------------------------//
function recibo(id){
	//alert(id);
	$(".content").load('./recibo.php?cod_tie='+id);

}


//Insertar pedido y redireccionar a mis pedidos------------------------------------//
function pedir(){
	$(".content").load('./mis_pedidos.php');
}
//Mirar pedidos
function pedidos(){
	$(".content").load('./mis_pedidos.php');
}

//Cargar Usuario------------------------------------//
function usuario(){
	$(".content").load('./user.php');
}

//Cargar Favoritos------------------------------------//
function favorito(){
	$(".content").load('./favorito.php');
}

//Cargar Chat------------------------------------//
function chat(){
	$(".content").load('./chat.php');
}

























//Cambiar Categoria-----------------------------------------------------------------//

function cam_cat(cod_tie) {
    cod_cat_pro = $("#cat_pro").val();

	$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/tienda-inventario.php",
			data:"cod_cat_pro="+cod_cat_pro+"&&cod_tie="+cod_tie,
			success:function(r){
                $('.inv_list').html(r);
         		 
			}
	});
    
}