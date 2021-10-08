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




function edit_producto(cod_inv){
	
	can_inv=$('#can_inv').val();
	nom_inv=$('#nom_inv').val();
	des_inv=$('#des_inv').val();
	cod_cat_pro=$('#cod_cat_pro').val();
	pre_inv=$('#pre_inv').val();
	estatu=$('#estatu').val();
	tie_inv=$('#tie_inv').val();



	 var inp = document.getElementById ("file");
            
            total = inp.value;
           nueva = total.substr(12,undefined);

           if (nueva == "") {
           	nueva = $("#cons_img").val();
           }

          


	dataString="can_inv="+can_inv+"&&nom_inv="+nom_inv+"&&des_inv="+des_inv+"&&cod_cat_pro="+cod_cat_pro+"&&pre_inv="+pre_inv+"&&cod_inv="+cod_inv+"&&img_inv="+nueva+"&&estatu="+estatu+"&&tie_inv="+tie_inv+"&&accion=actualizar";

	Swal.fire({
	  title: 'Desea Actualizar los Datos?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/inventario/inventario.php",
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
					//	location.href="inventario.php";
					}
				});
					
		  	} 
	})

}

/*---------------------------------------------------------------------------------------------------------*/


function add_producto(cod_inv,img){
	
	can_inv=$('#can_inv').val();
	nom_inv=$('#nom_inv').val();
	des_inv=$('#des_inv').val();
	cod_cat_pro=$('#cod_cat_pro').val();
	pre_inv=$('#pre_inv').val();
	tie_inv=$('#tie_inv').val();


	 var inp = document.getElementById ("files");
            
            total = inp.value;
           nueva = total.substr(12,undefined);

	dataString="can_inv="+can_inv+"&&nom_inv="+nom_inv+"&&des_inv="+des_inv+"&&cod_cat_pro="+cod_cat_pro+"&&pre_inv="+pre_inv+"&&img_inv="+nueva+"&&tie_inv="+tie_inv+"&&accion=agregar";

	
	//alert(dataString);
	Swal.fire({
	  title: 'Desea Agregar el Producto?',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below */
		  if (result.isConfirmed) {

		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/inventario/inventario.php",
					data:dataString,
					success:function(r){
						validarForm();

						
						Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: 'Producto Agregado Correctamente',
						showConfirmButton: false,
						timer: 1500
					});
					//	location.href="inventario.php";
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
function estatu_producto(cod_inv,estatu){

if(estatu=='1'){
	estatu2=2;
	est="Producto Inactivo";
	est2="Desactivar";
}else{
	estatu2=1;
	est="Producto Activo";
	est2="Activar";
}

Swal.fire({
	  title: '¿Desea '+est2+" Su Producto?",
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below*/ 
		  if (result.isConfirmed) {

				$.ajax({
						type:"POST",
						url:"../../backend/controlador/inventario/inventario.php",
						data:"estatu_cod_est="+estatu2+"&&cod_inv="+cod_inv+"&&accion=estatu_producto",
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
	  title: '¿Desea Eliminar? ¡No podra restaurar su Producto!',
	  showCancelButton: true,
	  confirmButtonText: 'Si'
		}).then((result) => {
	  /* Read more about isConfirmed, isDenied below*/ 
		  if (result.isConfirmed) {
		    	$.ajax({
					type:"POST",
					url:"../../backend/controlador/inventario/inventario.php",
					data:"cod_inv=" +id+"&&accion=eliminar_logico",
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

/*--------------------------Guardar Foto----------------------*/

 function validarForm(sender)
{
  //obtengo mi formulario por ID
   form = document.getElementById('formul');
  //MUESTRO CONFIRMACION PARA HACER EL SUBMIT
    form.submit();


  
}

