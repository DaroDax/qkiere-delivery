
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
	$(".content").load('./tienda.php');
	//alert(cod_tie);

	$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/tienda.php",
			data:"cod_tie="+cod_tie,
			success:function(r){
                 $('.tienda_content').html(r);				 
			}
	});
}
//Cargar Productos De La Tienda------------------------------//
function producto(cod_inv){
	$(".content").load('./tienda_producto.php');
	tie = $("#codigo").val();
	//alert(cod_inv+" "+tie);

	$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/tienda_producto.php?tienda=",
			data:"cod_inv="+cod_inv+"&&cod_tie="+tie,
			success:function(r){
                 $('.tienda_content').html(r);				 
			}
	});
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
	$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/carrito.php",
			data:"cod_cat_tie="+cod_cat_tie,
			success:function(r){
                 $('.carrito_content').html(r);				 
			}
	});
}

//Cargar Recibo-------------------------------------------------//
function recibo(id){
	alert(id);
	$(".content").load('./recibo.php');

	$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/recibo.php?tie="+id,
			data:"cod_tie="+id,
			success:function(response){
                 $('.recibo_content').html(response);
				 console.log(response);				 
			}
	});
}


//Insertar pedido y redireccionar a mis pedidos------------------------------------//
function historial(){
	$(".content").load('./history.php');
}
//Mirar pedidos
function cuenta(){
	$(".content").load('./cuenta.php');
}

//Cargar Usuario------------------------------------//
function domiciliario(){
	$(".content").load('./domiciliarios.php');
}

//Cargar Inventario------------------------------------//
function inventario(){
	$(".content").load('./inventario.php');
}

//Cargar Chat------------------------------------//
function chat(){
	$(".content").load('./chat.php');
}

























//Cambiar Categoria-----------------------------------------------------------------//

function cam_cat(cod_tie) {
    cod_cat_pro = $("#cat_pro").val();
    //alert(cod_cat_pro);

	$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/tienda-inventario.php",
			data:"cod_cat_pro="+cod_cat_pro+"&&cod_tie="+cod_tie,
			success:function(r){
                $('.inv_list').html(r);				 
			}
	});
    
}