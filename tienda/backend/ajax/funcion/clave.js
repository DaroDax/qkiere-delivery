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

/*------------------------------------------*/

/* ACTIVA E INACTIVA EL PRODUCTO */
function actualizar_dia(cod_tie,estatu,dia){

	

	switch(dia){

		case 1: semana="lun_hor_tie="; 
				day="lun_hor_tie";
		break;

		case 2: semana="mar_hor_tie="; 
				day="mar_hor_tie";
		break;

		case 3: semana="mie_hor_tie="; 
				day="mie_hor_tie";
		break;

		case 4: semana="jue_hor_tie="; 
				day="jue_hor_tie";
		break;

		case 5: semana="vie_hor_tie="; 
				day="vie_hor_tie";
		break;

		case 6: semana="sab_hor_tie="; 
				day="sab_hor_tie";
		break;

		case 7: semana="dom_hor_tie="; 
				day="dom_hor_tie";
		break;

	}

if(estatu>0){
	estatu2=0;
	est="Dia Inactivo";
	est2="Desactivar";
}

else{
	estatu2=1;
	est="Dia Activo";
	est2="Activar";	
}


Swal.fire({
	  title: '¿Desea '+est2+" Este Dia?",
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below*/ 
		  if (result.isConfirmed) {

				$.ajax({
						type:"POST",
						url:"../../backend/controlador/horario/hora.php",
						data: semana+estatu2+"&&tienda_cod_tie="+cod_tie+"&&opcion="+day+"&&estatu="+estatu2+"&&accion=actualizar_dia",
						success:function(r){
								
								Swal.fire({
									position: 'top-end',
									icon: 'success',
									title: est,
									showConfirmButton: false,
									timer: 1500
								});

						}
				});

		  	} 
	})
}

