 function carga_ajax(id,div,url) 
        {
          ///  alert("HOLA ENTRO");
          // alert(ruta );
           $.post
            (
                url,
                {id:id},
                function(resp)
               {
                    $("#"+div+"").html(resp);
               }
            );
        }


