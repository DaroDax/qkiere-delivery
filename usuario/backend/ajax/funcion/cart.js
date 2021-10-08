///AGREGAR AL CARRITO
function add_cart(cod_inv,cod_cli){


	var can_tem_ped = document.getElementById('can_tem_ped').value;
	var obs_tem_ped = document.getElementById('area').value;
	var pre_tem_ped = document.getElementById('pre_inv').value;
	var tot_tem_ped = document.getElementById('tot_tem_ped').value;



	if(can_tem_ped=='' || pre_tem_ped==''  || tot_tem_ped=='')
	{ 
		Swal.fire("Error!", "Tienes Campos Vacios", "warning");
		return false;
	}else{
		 	var dataString="can_tem_ped="+can_tem_ped+"&&obs_tem_ped="+obs_tem_ped+"&&pre_tem_ped="+pre_tem_ped+"&&tot_tem_ped="+tot_tem_ped+"&&inventario_cod_inv="+cod_inv+"&&accion=insertar";

						
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/cart/cart.php",
					data:dataString,
					success:function(responde){

							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Agregado al Carrito',
								showConfirmButton: false,
								timer: 1500
								});
			
					}
				
				});
				    			
						
	}//CIERRE DE ELSE 
}


/*EDITAR CARRITO */

function edit_cart(cod_tem_ped){


	var can_tem_ped = document.getElementById('can_tem_ped').value;
	var obs_tem_ped = document.getElementById('area').value;
	var pre_tem_ped = document.getElementById('pre_inv').value;
	var tot_tem_ped = document.getElementById('tot_tem_ped').value;


	if(can_tem_ped=='' || pre_tem_ped==''  || tot_tem_ped=='')
	{ 
		Swal.fire("Error!", "Tienes Campos Vacios", "warning");
		return false;
	}else{

		 	
		//alert(valor);
		 	var dataString="can_tem_ped="+can_tem_ped+"&&obs_tem_ped="+obs_tem_ped+"&&pre_tem_ped="+pre_tem_ped+"&&tot_tem_ped="+tot_tem_ped+"&&cod_tem_ped="+cod_tem_ped+"&&accion=editar_carrito";
						
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/cart/cart.php",
					data:dataString,
					success:function(responde){}
				
				});
									Swal.fire({
									  position: 'top-end',
									  icon: 'success',
									  title: 'Producto Actualizado Correctamente',
									  showConfirmButton: false,
									  timer: 1500
								});
								
			
				    			
						
	}//CIERRE DE ELSE 
}


function eliminar_producto_carrito(id,nom_inv){

	Swal.fire({
	  title: 'Desea Eliminar '+nom_inv+ '?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
	 
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/cart/cart.php",
					data:"cod_tem_ped="+id+"&&accion=eliminar_producto_carrito",
					success:function(r){
						
					Swal.fire({
						position: 'top-end',
						icon: 'warning',
						title: 'Producto Eliminado',
						showConfirmButton: false,
						timer: 1500
					});
					}
				});
		  	} 
	})

}

function vaciar_carrito(cod_tie){

	Swal.fire({
	  title: 'Desea Vaciar el Carrito ?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/cart/cart.php",
					data:"accion=vaciar_carrito&&cod_tie="+cod_tie,
					success:function(r){
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: 'Carrito Vacio',
							showConfirmButton: false,
							timer: 1500
						});
					}
				});
		  	} 
	})

}