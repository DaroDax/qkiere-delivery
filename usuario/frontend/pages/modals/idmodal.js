 function carga_ajax(id,div,url) 
        {
       //alert(id);
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


