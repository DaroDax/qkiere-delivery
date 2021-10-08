function cambiar_clave2(){

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
									url:"../../backend/controlador/tienda/tienda.php",
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

function aceptar_ped(){
	

}