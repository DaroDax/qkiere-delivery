/* ORDEN DE COMPRA */		
function crear_orden_compra(cod_tie,mon_ord_ped,mon_del_ord_ped,raz_tie, chat_id,nom_usu){
	
	let dir=document.getElementById('mi_ubi').value;

		if(dir==''){
			   Swal.fire("Error!", "Seleccione Dirección de Entrega", "warning");
					return false;
		}else{
				var	datos="direccion=" +dir+"&&cod_tie="+cod_tie+"&&mon_ord_ped="+mon_ord_ped+"&&mon_del_ord_ped="+mon_del_ord_ped+"&&accion=insertar";

				//alert(datos);

					Swal.fire({
					  title: 'Desea Confirmar su Compra?',
					  showCancelButton: true,
					  confirmButtonText: 'Si'
						}).then((result) => {

					 /* Read more about isConfirmed, isDenied below */
						if(result.isConfirmed){
						    	$.ajax({
									type:"POST",
									url:"../../backend/controlador/orden_compra/orden_compra.php",
									data:datos,
									success:function(r){
										Swal.fire("Bien hecho", "Orden Creada Con Exito en Breve te Contacta la Tienda", "success");
									pedidos();
									}
								});
						}
					});
					
			}
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
