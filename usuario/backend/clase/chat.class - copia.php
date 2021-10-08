<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class chat_usu extends utilidad {

public $cod_chat_usu;	
public $men_chat_usu;
public $usuario_cod_usu;
public $tienda_cod_tie;	
public $per_chat_usu;
public $lei_chat_usu;
public $estatu_pedido_cod_est_ped;
public $fec_men_usu;
public $cod_tie;

public $cod_chat_dom;	
public $men_chat_dom;
public $domiciliario_cod_dom;
public $per_chat_dom;
public $fec_men_dom;





	public function listar(){

			$this->que_dba="SELECT * FROM chat_usu cu, tienda t WHERE usuario_cod_usu = '".$_SESSION['cod_usu']."' 
			AND tienda_cod_tie = '".$this->tienda_cod_tie."' 
			AND t.cod_tie = cu.tienda_cod_tie
			AND estatu_pedido_cod_est_ped = 1
			ORDER BY cod_chat_usu ASC; ";

		return $this->ejecutar();

	}

	public function listar_dom(){

			$this->que_dba="SELECT * FROM chat_dom cd, domiciliario d WHERE usuario_cod_usu = '".$_SESSION['cod_usu']."' 
			AND domiciliario_cod_dom = '".$this->domiciliario_cod_dom."' 
			AND d.cod_dom = cd.domiciliario_cod_dom
			AND estatu_pedido_cod_est_ped = 1
			ORDER BY cod_chat_dom ASC; ";

		return $this->ejecutar();

	}

	public function ult_men(){

			$this->que_dba="SELECT * FROM chat_usu WHERE usuario_cod_usu = '".$_SESSION['cod_usu']."' AND tienda_cod_tie = '".$this->cod_tie."' ORDER BY cod_chat_usu DESC; ";

		return $this->ejecutar();

	}

	public function nom_tie(){

			$this->que_dba="SELECT * FROM chat_usu cu, tienda t WHERE tienda_cod_tie = '".$this->tienda_cod_tie."' 
			AND t.cod_tie = '".$this->tienda_cod_tie."'
			GROUP BY raz_tie; ";

		return $this->ejecutar();

	}

	public function nom_dom(){

			$this->que_dba="SELECT * FROM chat_dom cd, domiciliario d WHERE domiciliario_cod_dom = '".$this->domiciliario_cod_dom."' 
			AND d.cod_dom = '".$this->domiciliario_cod_dom."' 
			GROUP BY nom_dom; ";

		return $this->ejecutar();

	}


	public function tie_dis(){

			$this->que_dba="SELECT *, MAX(lei_chat_usu) AS new_tie FROM tienda ti, chat_usu cu WHERE estatu_cod_est = 1 
			AND cu.tienda_cod_tie = ti.cod_tie 
			AND cu.estatu_pedido_cod_est_ped = 1 
			AND usuario_cod_usu = '".$_SESSION['cod_usu']."'
			GROUP BY cod_tie ; ";

		return $this->ejecutar();

	}

	public function dom_dis(){

			$this->que_dba="SELECT *, MAX(lei_chat_dom) AS new_dom FROM domiciliario d, chat_dom cd WHERE estatu_cod_est = 1 
			AND cd.domiciliario_cod_dom = d.cod_dom 
			AND cd.estatu_pedido_cod_est_ped = 1 
			AND usuario_cod_usu = '".$_SESSION['cod_usu']."'
			GROUP BY cod_dom ; ";

		return $this->ejecutar();

	}

	public function new_contador(){

			$this->que_dba="SELECT COUNT(*) AS new_msj FROM chat_usu
			WHERE usuario_cod_usu = '".$_SESSION['cod_usu']."'
			AND per_chat_usu = 'T'
			AND lei_chat_usu = 1; ";

		return $this->ejecutar();

	}

	public function msj_ent(){

			$this->que_dba="SELECT * FROM tienda ti, chat_usu cu WHERE cu.tienda_cod_tie = ti.cod_tie 
			AND cu.estatu_pedido_cod_est_ped = 1 
			AND usuario_cod_usu = '".$_SESSION['cod_usu']."'
			AND lei_chat_usu = 1
			AND per_chat_usu ='T'; ";

		return $this->ejecutar();

	}


	public function new_msj(){

			$fecha=date("Y-m-d H:m:s");

			$this->que_dba="INSERT INTO chat_usu(
			men_chat_usu,
			usuario_cod_usu,
			tienda_cod_tie,
			per_chat_usu,
			lei_chat_usu,
			fec_men_usu,
			estatu_pedido_cod_est_ped) VALUES(
			'".$this->men_chat_usu."',
			'29',
			'".$this->tienda_cod_tie."',
			'U',
			'1',
			'".$fecha."',
			'1'); ";

		return $this->ejecutar();

	}

	public function new_msj_dom(){

			$fecha=date("Y-m-d H:m:s");

			$this->que_dba="INSERT INTO chat_dom(
			men_chat_dom,
			usuario_cod_usu,
			domiciliario_cod_dom,
			per_chat_dom,
			lei_chat_dom,
			fec_chat_dom,
			estatu_pedido_cod_est_ped) VALUES(
			'".$this->men_chat_dom."',
			'".$_SESSION['cod_usu']."',
			'".$this->domiciliario_cod_dom."',
			'U',
			'1',
			'".$fecha."',
			'1'); ";

		return $this->ejecutar();

	}

	public function msj_leido(){
			
		 $this->que_dba="
			UPDATE chat_usu SET 
			lei_chat_usu= 0
			WHERE usuario_cod_usu='".$_SESSION['cod_usu']."'
			AND tienda_cod_tie = '".$this->tienda_cod_tie."' ;"; 	
			    
		return $this->ejecutar();
	}

	public function msj_leido_dom(){
			
		 $this->que_dba="
			UPDATE chat_dom SET 
			lei_chat_dom= 0
			WHERE usuario_cod_usu='".$_SESSION['cod_usu']."'
			AND domiciliario_cod_dom = '".$this->domiciliario_cod_dom."' ;"; 	
			    
		return $this->ejecutar();
	}
		
	public function borrado_logico(){
			
		 $this->que_dba="
			UPDATE chat_usu SET 
			estatu_pedido_cod_est_ped = 3
			WHERE usuario_cod_usu='".$_SESSION['cod_usu']."'
			AND tienda_cod_tie = '".$this->tienda_cod_tie."' ;"; 	
			    
		return $this->ejecutar();
	}

	public function borrado_logico_dom(){
			
		 $this->que_dba="
			UPDATE chat_dom SET 
			estatu_pedido_cod_est_ped = 3
			WHERE usuario_cod_usu='".$_SESSION['cod_usu']."'
			AND domiciliario_cod_dom = '".$this->domiciliario_cod_dom."' ;"; 	
			    
		return $this->ejecutar();
	}

		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>