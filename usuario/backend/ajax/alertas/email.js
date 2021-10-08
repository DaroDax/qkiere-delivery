/* CONSULTA DE INICIO */
function consulta_inicio(){

	if($('#municipio').val()=="")
	{	
		Swal.fire("Error!", "Seleccione Tu municipio", "warning");
		return false;
	}
	var texto=document.getElementById("consultar").value;
	var municipio=document.getElementById("municipio").value;
	var parametros = {
		"texto": texto,
		"municipio":municipio
	};

		$.ajax({ 
		data:parametros,
		url:"../../backend/ajax/query_inventario/query_barra_busqueda.php",
		type:"POST",
		success: function(response){
			$("#datos").html(response);
		}
	});


}

/* CONSULTA MUNICIPIO Y CATEGORIA CLIENTE */


function consulta_mun_cat(){
var boton_municipio=$('#municipio').val();

if(boton_municipio==''){
 	$('#cat_tienda').hide(); 
}else{
	$('#cat_tienda').show(); 
}
$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_select/query_cat_tienda.php",
			data:"cod_mun=" + $('#municipio').val(),
			success:function(r){
				$('#cod_cat_tie').html(r);
			}
		});

$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_select/query_sitios_disponibles.php",
			data:"cod_mun=" + $('#municipio').val(),
			success:function(r){
				$('#sitios_disponibles').html(r);
			}
		});

	$(".H_banner").hide();

}


function consulta_sitios(cod){
	var cod_mun=$('#municipio').val();
	var valor=$('#cat_tienda').val();
	 var dataString ="cod_cat_tie="+valor+'&cod_mun='+cod_mun;
	 alert(dataString); 
$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_select/query_sitios_disponibles.php",
			data:dataString,
			success:function(r){
				$('#sitios_disponibles').html(r);
			}
		});
}




/* AGREGAR SITIOS FAVORITOS */
function add_sitios_favoritos(raz_tie){

	var valida_check=document.getElementById("cod_tie_fav").checked;
	var outro = document.getElementById('des_bot');
	if (valida_check==true){ 
		accion="insertar";
		outro.style.color = '#F4D03F';
		
	}else{

		accion="eliminar";
		outro.style.color = '#000000';
	}

	 var dataString = 'cod_tie='+$('#cod_tie_fav').val()+'&&accion='+accion;

	$.ajax({
			type:"POST",
			url:"../../backend/controlador/sitio_favorito/sitio_favorito.php",
			data:dataString,
			success:function(r){
				if(r!=''){
					
    			Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: raz_cli+'<br> Eliminado de Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				
				}else{
				
					Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: raz_cli+'<br> Agregado a Favoritos',
						  showConfirmButton: false,
						  timer: 1500
						});
				

				}
			}
		});


}



/* AGREGAR PRODUCTOS FAVORITOS */
function add_producto_favorito(id,dato){
	var intro = document.getElementById('fav_bot');
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

/*------------------------ CARRITO -----------------------------------*/
/* SELECT DE MUNICIPIO Y SECTOR */



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
					success:function(responde){}
				
				});
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Agregado al Carrito',
								showConfirmButton: false,
								timer: 1500
								});
			
				    			
						
	}//CIERRE DE ELSE 
}


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
					data:"cod_tem_ped=" +id+"&&accion=eliminar_producto_carrito",
					success:function(r){
						
					}
				});
					Swal.fire({
						position: 'top-end',
						icon: 'warning',
						title: 'Producto Eliminado',
						showConfirmButton: false,
						timer: 1500
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


/* AGREGAR MIS DIRECCIONES USUARIO */
function add_usuario_dir(){


	var sector=document.getElementById('cod_sector').value;
	
      if($("#nom_dir_usu").val()=='' || $("#dir_dir_usu").val()=='' || sector==''){
		Swal.fire("Error!", "Tienes Campos Vacios", "warning");

			return false;
      }else{
	
			var dataString = 'nom_dir_usu='+$("#nom_dir_usu").val()+'&&dir_dir_usu='+$("#dir_dir_usu").val()+'&&sector='+sector+'&&accion=insertar';

			$.ajax({
						type:"POST",
						url:"../../backend/controlador/usuario/usuario.php",
						data:dataString,
						success:function(r){
							if(r!=''){
					

    			Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: 'Dirección Añadida',
						  showConfirmButton: false,
						  timer: 1500
						});
    			$("#nom_dir_usu").val(''); 
    			$("#dir_dir_usu").val('');
    			$("#cod_sector").val('');
    			$("#municipio").val('');
				}else{
					Swal.fire({
						  position: 'top-end',
						  icon: 'warning',
						  title: 'Dirección Eliminada',
						  showConfirmButton: false,
						  timer: 1500
						});
				

				}
						}
					});
		}
		

}


function eliminar_direccion(id){
	Swal.fire({
	  title: 'Desea Eliminar la Dirección?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/usuario/usuario.php",
					data:"cod_dir_usu=" +id+"&&accion=eliminar_direccion",
					success:function(r){
						
					}
				});
					Swal.fire({
						position: 'top-end',
						icon: 'warning',
						title: 'Dirección Eliminada',
						showConfirmButton: false,
						timer: 1500
					});
		  	} 
	})

}


/*---------------------------------------------------------------------------------*/

/* SELECT DE MUNICIPIO Y SECTOR */

function Consultar_sector(){

	$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_select_direccion/sector.php",
			data:"cod_mun=" + $('#municipio').val(),
			success:function(r){
				$('#sector').html(r);

					}
				});
}


/* SELECT DE MUNICIPIO Y SECTOR */

function act_usuario(){
  
   var cod_area=document.getElementById('cod_area').value;
      var telefono=document.getElementById('telefono').value;
	
	alert(sector);
      if($("#cod_area").val()=='' || $("#telefono").val()==''){
		Swal.fire("Error!", "Tienes Campos Vacios", "warning");

			return false;
      }else{
	
	
			$.ajax({
					type:"POST",
					url:"../../backend/controlador/query_select_estado/query_sector.php",
					data:"cod_mun=" + $('#municipio').val(),
					success:function(r){
						$('#sector').html(r);
							}
						});
			
		}
}




function cambiar_clave(){

		Swal.fire({
		  title: 'Cambiar Clave',
		  html:
		    '<input type="password" id="swal-input1" class="swal2-input" placeholder="Nueva Clave">' +
		    '<input type="password" id="swal-input2" class="swal2-input" placeholder="Confirme la Clave">',
		  focusConfirm: false,
		  preConfirm: () => {

		    let clave1=document.getElementById('swal-input1').value;
		    let clave2=document.getElementById('swal-input2').value;
		    if(clave1=='' || clave2==''){
		    	Swal.fire("Error!", "Tienes Campos Vacios", "warning");
				return false;
			}else{
				    if(clave1==clave2){
				    
				    	var dataString="Newpas_usu="+clave2+"&&accion=cambio_clave";
				    	 $.ajax({
									type:"POST",
									url:"../../backend/controlador/usuario/usuario.php",
									data:dataString,
									success:function(r){
										
										Swal.fire({
												  position: 'top-end',
												  icon: 'success',
												  title: 'Su Clave se Actualizo Correctamente',
												  showConfirmButton: false,
												  timer: 1500
												});
											}
							});
							
				    }else{
				    	Swal.fire("Error!", "Error la clave no coincide", "warning");
				return false;
				    
				    }
			}
		  }
		})


}

function new_usuario_dir(){

		Swal.fire({
		  title: 'Escribe tu dirección',
		  html:
		    '<input type="text" id="nom_dir" class="swal2-input" placeholder="Nombre Dirección" value="">' +
			'<input type="text" id="des_dir" class="swal2-input" placeholder="Descripción" value="">'+
			'<input type="text" id="sec_dir" class="swal2-input" placeholder="Sector" value="1" readonly>',
		  focusConfirm: false,
		  preConfirm: () => {

		    let nom=document.getElementById('nom_dir').value;
			let des=document.getElementById('des_dir').value;
			let sec=document.getElementById('sec_dir').value;
			
			if(nom=='' || des=='' || sec==''){
		    	Swal.fire("Error!", "Tienes Campos Vacios", "warning");
				return false;
			}else{

			var dataString = 'nom_dir_usu='+nom+'&&dir_dir_usu='+des+'&&sector='+sec+'&&accion=insertar';

			$.ajax({
						type:"POST",
						url:"../../backend/controlador/usuario/usuario.php",
						data:dataString,
						success:function(r){
							Swal.fire({
						  position: 'top-end',
						  icon: 'success',
						  title: 'Dirección Añadida',
						  showConfirmButton: false,
						  timer: 1500
						});
						}
				  
			})
		}}
 	})		
}		  


/* ORDEN DE COMPRA */		
function crear_orden_compra(cod_tie,mon_ord_ped,mon_del_ord_ped){

let dir=document.getElementById('dir').value;
	if(dir==''){
		   Swal.fire("Error!", "Seleccione Dirección de Entrega", "warning");
				return false;
	}else{
		Swal.fire({
		  title: 'Desea Confirmar su Compra?',
		  showCancelButton: true,
		  confirmButtonText: 'Si'
			}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
			  if (result.isConfirmed) {
			    	$.ajax({
						type:"POST",
						url:"../../backend/controlador/orden_compra/orden_compra.php",
						data:"direccion=" +dir+"&&cod_tie="+cod_tie+"&&mon_ord_ped="+mon_ord_ped+"&&mon_del_ord_ped="+mon_del_ord_ped+"&&accion=insertar",
						success:function(r){
							
						}
					});
					Swal.fire("Bien hecho", "Orden Creada Con Exito en Breve te Contacta la Tienda", "success");
					window.location.href = "orden_pedido.php?cod_tie="+cod_tie;

			  	} 
		})
	}//CIERRE ELSE 
}

function cancelar_orden_compra(cod_ord_com){

Swal.fire({
		  title: 'Desea Cancelar la Orden de Compra # '+cod_ord_com+' ?',
		  showCancelButton: true,
		  confirmButtonText: 'Si'
			}).then((result) => {
		  /* Read more about isConfirmed, isDenied below */
		  dataString="cod_ord_com="+cod_ord_com+"&&accion=eliminar_orden_compra";

			  if (result.isConfirmed) {
			    	$.ajax({
						type:"POST",
						url:"../../backend/controlador/orden_compra/orden_compra.php",
						data:dataString,
						success:function(r){
							Swal.fire({
								position: 'top-end',
								icon: 'success',
								title: 'Orden de Compra Eliminada con Exito.',
								showConfirmButton: false,
								timer: 1500
							});
						}
					});
						

			  	} 
		})
}	






