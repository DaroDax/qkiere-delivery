function load_fav() {
        
        
    destac();
    
   
     
        
    }

    function destac(){
        var valida_check=document.getElementById("cod_cli_fav").checked;
        var outro = document.getElementById('des_bot');
         if (valida_check==true){ 
		outro.style.color = '#F4D03F';
	}else{
        outro.style.color = '#000000';
        }
    }

   /* function favor(act,intro){
         var act; 
         var intro;
        if (act==true){ 	
		intro.style.color = '#E74C3C';
	}else{
        intro.style.color = '#000000';
        }

    }*/