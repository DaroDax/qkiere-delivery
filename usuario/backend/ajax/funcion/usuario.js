function insertar_chat() {
    chat = $("#chat_usu").val();
    dataString = "chat_id_usu=" + chat + "&&accion=add_chat_id";
    $.ajax({
        type: "POST",
        url: "../../backend/controlador/usuario/usuario.php",
        data: dataString,
        success: function(r) {}
    });
}
//------------------------------------------------------------//
function cambiar_clave() {
    Swal.fire({
        title: 'Cambiar Clave',
        html: '<input type="password" id="swal-input1" class="swal2-input" placeholder="Nueva Clave">' + '<input type="password" id="swal-input2" class="swal2-input" placeholder="Confirme la Clave">',
        focusConfirm: false,
        preConfirm: () => {
            let clave1 = document.getElementById('swal-input1').value;
            let clave2 = document.getElementById('swal-input2').value;
            if (clave1 == '' || clave2 == '') {
                Swal.fire("Error!", "Tienes Campos Vacios", "warning");
                return false;
            } else {
                if (clave1 == clave2) {
                    var dataString = "Newpas_usu=" + clave2 + "&&accion=cambio_clave";
                    $.ajax({
                        type: "POST",
                        url: "../../backend/controlador/usuario/usuario.php",
                        data: dataString,
                        success: function(r) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Su Clave se Actualizo Correctamente',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                } else {
                    Swal.fire("Error!", "Error la clave no coincide", "warning");
                    return false;
                }
            }
        }
    })
}
//------------------------------------------------------------//
function modificar_datos() {
    $("#tel_usu").attr("readonly", "readonly");
    $("#cod_usu").attr("disabled", "disabled");
    $("#tel_usu").css("border", "1px solid #FF6A00");
    $("#cod_usu").css("border", "1px solid #FF6A00");
    tel_usu = $("#tel_usu").val();
    cod_usu = $("#cod_usu").val();
    dataString = "cod_area_usu=" + cod_usu + "&&tel_usu=" + tel_usu + "&&accion=modificar_datos";
    //alert(dataString);
    Swal.fire({
        title: 'Desea actualizar sus Datos?',
        showCancelButton: true,
        confirmButtonText: 'Si'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "../../backend/controlador/usuario/usuario.php",
                data: dataString,
                success: function(r) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Sus Datos se Actualizaron con Exito.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    })
}
//----------------------------------------------------//
function notificacion_confir() {
    let chat_id = document.getElementById("chat_usu").value;
    let nom_usu = document.getElementById("nam_usu").value;
    //alert(chat_id + nom_usu);
    var mensaje = "\u2705 Hola, " + nom_usu + " acabas de enviar una Comprobacion del sistema de notificaciones de <b>Q' Kiere</b>, por favor no eliminar este chat para recibir todas las alertas. ";
    var JSON = $.ajax({
        url: "https://api.telegram.org/bot1535776476:AAEdRM9FJsoSp035-ElmQw96WJaBzSQDvU0/sendMessage?chat_id=" + chat_id + "&text=" + mensaje + "&parse_mode=HTML",
        dataType: 'json',
        async: false
    }).responseText;
    var Respuesta_mensaje = jQuery.parseJSON(JSON);
    console.log("Aqui" + Respuesta_mensaje.ok);
    if (Respuesta_mensaje.ok == true) {
        console.log("aqui.true20");
        Swal.fire("Bien Hecho", "Comprobacion exitosa", "success");
    }
}
//----------------------------------------------------------------------//
function eliminar_direccion(id) {
    Swal.fire({
        title: 'Desea Eliminar la Dirección?',
        showCancelButton: true,
        confirmButtonText: 'Si'
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: "../../backend/controlador/usuario/usuario.php",
                data: "cod_dir_usu=" + id + "&&accion=eliminar_direccion",
                success: function(r) {}
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
//---------------------------------------------------------------------------//
function editar_direccion(cod_dir) {
    var sector = document.getElementById('cod_sector').value;
    var cod_dir_usu = cod_dir;
    if ($("#nom_dir_usu").val() == '' || $("#dir_dir_usu").val() == '' || sector == '') {
        Swal.fire("Error!", "Tienes Campos Vacios", "warning");
        return false;
    } else {
        var dataString = 'nom_dir_usu=' + $("#nom_dir_usu").val() + '&&dir_dir_usu=' + $("#dir_dir_usu").val() + '&&sector=' + sector + '&&cod_dir_usu=' + cod_dir_usu + '&&accion=modificar_direccion';
        $.ajax({
            type: "POST",
            url: "../../backend/controlador/usuario/usuario.php",
            data: dataString,
            success: function(r) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Dirección Actualizada',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }
}