<?php

?>

  <head>
    <link href="../css/tienda.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300&display=swap" rel="stylesheet">

    <script src="../../backend/ajax/funcion/cargas.js"></script>

    
  </head>

  <body>
    <div class="main">
      <div class="tienda_content">

        <script>
           function activar_push(){
            Push.create('Orden Aceptada', {
                    body:'Su orden fue aceptada :D',
                    icon:'../../../img/not_icons/ok.png',
                    //timeout:5000,
                    vibrate:[100,100,100],
                    
                });
        }
        </script>
      
      <button onclick="activar_push();">Push</button>

      </div>
    </div>

 <script src="../../backend/js/push_lib/push.min.js"></script>
<script src="../../backend/js/push.js"></script>

<script type="text/javascript">
    window.onload = function(){
        Push.Permission.request();
        if(Push.Permission.GRANTED){
            Push.Permission.request();
       }
    }
</script> 
</body>

  </html>
<?php //} ?>