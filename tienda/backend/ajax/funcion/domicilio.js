$(document).ready(function() {

	notificacion_telegram('<?php echo $_SESSION ["cha_id_tie"];?>')
	setInterval(function(){ notificacion_telegram('<?php echo $_SESSION ["cha_id_tie"];?>'); }, 2000);

});

function busqueda(){

	var texto=document.getElementById("consultar").value;
	var parametros = {
		"texto": texto
	};
	

	$.ajax({ 
		data:parametros,
		url:"../../backend/ajax/query_clientes/query.php",
		type:"POST",
		success: function(response){
			$("#datos").html(response);
		}
	});

}




function actualizar_dom(cod_dom){
	
	nombre=$('#name_dom').val();
	apellido=$('#apel_dom').val();
	cedula=$('#cedu_dom').val();
	telefono=$('#tele_dom').val();
	email=$('#email_dom').val();
	direcion=$('#dire_dom').val();
	

	 var inp = document.getElementById ("file");
            
            total = inp.value;
           nueva = total.substr(12,undefined);

            if (nueva == "") {
           	nueva = $("#con_img").val();
           }

           


	dataString="cod_dom="+cod_dom+"&&nom_dom="+nombre+"&&ape_dom="+apellido+"&&ced_dom="+cedula+"&&tel_dom="+telefono+"&&ema_dom="+email+"&&dir_dom="+direcion+"&&img_dom="+nueva+"&&accion=actualizar_delivery";
	
	Swal.fire({
	  title: 'Desea Actualizar los Datos?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/delivery/domicilio.php",
					data:dataString,
					success:function(r){
						validarForm();

						Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Producto Actualizado Correctamente',
						showConfirmButton: false,
						timer: 1500
					});
					}
				});
					
		  	} 
	})

}

/*---------------------------------------------------------------------------------------------------------*/


function add_domiciliario(cod_dom){
	
	nom_dom=$('#nom_dom').val();
	ape_dom=$('#ape_dom').val();
	ced_dom=$('#ced_dom').val();
	tel_dom=$('#tel_dom').val();
	ema_dom=$('#ema_dom').val();
	pas_dom=$('#pas_dom').val();
	sec_dom=$('#cod_sector').val();
	cod_area_dom=$('#cod_area_dom').val();
	
	

	
	
	
	 var inp = document.getElementById ("files");
            
            total = inp.value;
           nueva = total.substr(12,undefined);

	dataString="nom_dom="+nom_dom+"&&ape_dom="+ape_dom+"&&ced_dom="+ced_dom+"&&tel_dom="+cod_area_dom+tel_dom+"&&ema_dom="+ema_dom+"&&pas_dom="+pas_dom+"&&sec_dom="+sec_dom+"&&img_dom="+nueva+"&&accion=agregar";



	Swal.fire({
	  title: 'Desea Agregar al Domiciliario?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/delivery/domicilio.php",
					data:dataString,
					success:function(r){
						validarForm();



						Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Domiciliario Agregado Correctamente',
						showConfirmButton: false,
						timer: 1500
					});
						
					}
				});
					
		  	} 
	})

}



/*-----------------------------------------------------------------------------------------------------------*/
/*  FUNCIONES PARA MUNICIPIO Y SECTOR */
function Consultar_sector(){

	$.ajax({
			type:"POST",
			url:"../../backend/ajax/query_direccion/sector.php",
			data:"cod_mun=" + $('#municipio').val(),
			success:function(r){
				$('#sector').html(r);

					}
				});
}
/* ACTIVA E INACTIVA EL PRODUCTO */
function estatu_producto(cod_dom,estatu){


if(estatu=='1'){
	estatu2=2;
	est="Domiciliario Inactivo";
	est2="Desactivar";
}else{
	estatu2=1;
	est="Domiciliario Activo";
	est2="Activar";
}

Swal.fire({
	  title: '¿Desea '+est2+" al Domiciliario?",
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below*/ 
		  if (result.isConfirmed) {

				$.ajax({
						type:"POST",
						url:"../../backend/controlador/delivery/domicilio.php",
						data:"estatu_cod_est="+estatu2+"&&cod_dom="+cod_dom+"&&accion=estatu_producto",
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

/*------------------------------------------------------------------*/
function eliminar_logico(id){

	
	
	Swal.fire({
	  title: '¿Desea Eliminar Al Domiciliario?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below*/ 
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/delivery/domicilio.php",
					data:"cod_dom="+id+"&&accion=eliminar_logico",
					success:function(r){
						
					}
				});
					Swal.fire({
						position: 'top-end',
						icon: 'warning',
						title: 'Domiciliario Eliminado',
						showConfirmButton: false,
						timer: 1500
					});
		  	} 
	})


}

/*--------------------------Guardar Foto----------------------*/

 function validarForm(sender)
{
  //obtengo mi formulario por ID
   form = document.getElementById('formul');
  //MUESTRO CONFIRMACION PARA HACER EL SUBMIT
    form.submit();

    
  


  
}

