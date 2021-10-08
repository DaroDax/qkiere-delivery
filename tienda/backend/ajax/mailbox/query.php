<?php

session_start();

if (isset($_SESSION ["idusuarios"],$_SESSION ["nombres"],$_SESSION ["idcompany"])){



  ?>
  <script>
  $(document).ready(function () {
    $("#tablaMensajes").load('../../backend/ajax/mailbox/tabla_inbox.php');
    setInterval(function() {
      
            $("#tablaMensajes").load('../../backend/ajax/mailbox/tabla_inbox.php');
            
        
    }, 3000);
    
    
    
});
    
    

</script>
  
  <div class="table-responsive" id="tablaMensajes">
    
       
  </div>



<?php 
 
}
else{
    header("location: ../index.php");
    exit();

}
  ?>