
function chat_window(id){
	$("#chat_msj").load('./chat_ventana.php?cod_tie='+id);
    //dataString="cod_tie="+id;
    $('.chat-mensajes').show();
    $('.chat-content').hide();
    $('.chat-people').hide();

    $('.domis').hide();
    /*$.ajax({
			type:"POST",
			url:"../../../usuario/frontend/pages/chat_ventana.php",
			data:dataString,
			success:function(r){
				$('#chat_msj').html(r);
					}
				});*/
}

//------------------------------------------------------------------------------------------//


