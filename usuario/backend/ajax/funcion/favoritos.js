


/* AGREGAR SITIOS FAVORITOS */
function add_sitios_favoritos(raz_tie,cod_tie){


	var valida_check=document.getElementById("cod_tie_fav").checked;
	var outro = document.getElementById('cod_tie_fav');

	if (valida_check==true){ 
		accion="insertar";
		outro.style.color = '#F4D03F';
		
	}else{

		accion="eliminar";
		outro.style.color = '#000000';
	}

	 var dataString = "cod_tie="+cod_tie+"&&accion="+accion;

//alert(dataString);

	$.ajax({
			type:"POST",
			url:"../../backend/controlador/sitio_favorito/sitio_favorito.php",
			data:dataString,
			success:function(r){
				if(r!=''){
					
    			Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: raz_tie+'<br> Eliminado de Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				
				}else{
				
				
					Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: raz_tie+'<br> Agregado a Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				

				}
			}
		});


}

function quitar_sitios_favoritos(raz_tie, cod_tie){
	
	 var dataString = 'cod_tie='+cod_tie+'&&accion=eliminar';

	$.ajax({
			type:"POST",
			url:"../../backend/controlador/sitio_favorito/sitio_favorito.php",
			data:dataString,
			success:function(r){
				if(r!=''){
					
    			Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: raz_tie+'<br> Eliminado de Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				
				}
			}
		});


}



/* AGREGAR PRODUCTOS FAVORITOS */
function add_producto_favorito(id,dato){
	var intro = document.getElementById('cod_inv');
	if (dato==true){ 
		accion="insertar";
		intro.style.color = '#E74C3C';
	}else{

		accion="eliminar";
		intro.style.color = '#000000';
	}
	var dataString = 'cod_inv='+id+'&&accion='+accion;
	

$.ajax({
			type:"POST",
			url:"../../backend/controlador/producto_favorito/producto_favorito.php",
			data:dataString,
			success:function(r){
				if(r!=''){

    				Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: 'Producto Favorito Eliminado',
						  showConfirmButton: false,
						  timer: 1500
						});
				}else{
					Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: 'Agregado a Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				

				}
			}
		});

}

