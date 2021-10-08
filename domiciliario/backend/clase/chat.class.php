<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_dom'])){

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

public $men_chat_tie;





	public function listar(){

			$this->que_dba="SELECT * FROM chat_dom cd, usuario u WHERE usuario_cod_usu = '".$this->usuario_cod_usu."' 
			AND cd.domiciliario_cod_dom = '".$_SESSION['cod_dom']."'
			AND u.cod_usu = cd.usuario_cod_usu
			AND estatu_pedido_cod_est_ped = 1
			ORDER BY cod_chat_dom ASC; ";

		return $this->ejecutar();

	}

	public function listar_dom(){

			$this->que_dba="SELECT * FROM chat_tie ct, tienda t WHERE ct.domiciliario_cod_dom = '".$_SESSION['cod_dom']."' 
			AND tienda_cod_tie = '".$this->tienda_cod_tie."' 
			AND t.cod_tie = ct.tienda_cod_tie
			AND estatu_pedido_cod_est_ped = 1
			ORDER BY cod_chat_tie ASC; ";

		return $this->ejecutar();

	}

	public function ult_men(){

			$this->que_dba="SELECT * FROM chat_usu WHERE usuario_cod_usu = '".$_SESSION['cod_usu']."' AND tienda_cod_tie = '".$this->cod_tie."' ORDER BY cod_chat_usu DESC; ";

		return $this->ejecutar();

	}

	public function nom_usu(){

			$this->que_dba="SELECT * FROM chat_usu cu, usuario u WHERE usuario_cod_usu = '".$this->usuario_cod_usu."' 
			AND u.cod_usu = '".$this->usuario_cod_usu."'
			GROUP BY nom_usu; ";

		return $this->ejecutar();

	}

	public function nom_dom(){

			$this->que_dba="SELECT * FROM chat_tie ct, tienda t WHERE tienda_cod_tie = '".$this->tienda_cod_tie."' 
			AND t.cod_tie = '".$this->tienda_cod_tie."' 
			GROUP BY raz_tie; ";

		return $this->ejecutar();

	}


	public function usu_dis(){

			$this->que_dba="SELECT *, MAX(lei_chat_dom) AS new_usu FROM usuario u, chat_dom cd WHERE estatu_cod_est = 1 
			AND cd.usuario_cod_usu = u.cod_usu 
			AND cd.estatu_pedido_cod_est_ped = 1 
			AND domiciliario_cod_dom = '".$_SESSION['cod_dom']."'
			GROUP BY cod_usu ; ";

		return $this->ejecutar();

	}

	public function tie_dis(){

			$this->que_dba="SELECT *, MAX(lei_chat_tie) AS new FROM tienda t, chat_tie ct WHERE estatu_cod_est = 1 
			AND ct.tienda_cod_tie = t.cod_tie 
			AND ct.estatu_pedido_cod_est_ped = 1 
			AND ct.domiciliario_cod_dom = '".$_SESSION['cod_dom']."'
			GROUP BY cod_tie ; ";

		return $this->ejecutar();

	}

	public function new_contador(){

			$this->que_dba="SELECT COUNT(*) AS new_msj FROM chat_dom
			WHERE domiciliario_cod_dom = '".$_SESSION['cod_dom']."'
			AND per_chat_dom = 'U'
			AND lei_chat_dom = 1; ";

		return $this->ejecutar();

	}

	public function msj_ent(){

			$this->que_dba="SELECT * FROM tienda ti, chat_tie ct WHERE ct.tienda_cod_tie = ti.cod_tie 
			AND ct.estatu_pedido_cod_est_ped = 1 
			AND domicilairio_cod_dom = '".$_SESSION['cod_dom']."'
			AND lei_chat_usu = 1
			AND per_chat_usu ='U'; ";

		return $this->ejecutar();

	}


	public function new_msj(){

			$fecha=date("Y-m-d H:m:s");

			$this->que_dba="INSERT INTO chat_dom(
			men_chat_dom,
			domiciliario_cod_dom,
			usuario_cod_usu,
			per_chat_dom,
			lei_chat_dom,
			fec_chat_dom,
			estatu_pedido_cod_est_ped) VALUES(
			'".$this->men_chat_dom."',
			'".$_SESSION['cod_dom']."',
			'".$this->usuario_cod_usu."',
			'T',
			'1',
			'".$fecha."',
			'1'); ";

		return $this->ejecutar();

	}

	public function new_msj_dom(){

			$fecha=date("Y-m-d H:m:s");

			$this->que_dba="INSERT INTO chat_tie(
			men_chat_tie,
			tienda_cod_tie,
			domiciliario_cod_dom,
			per_chat_tie,
			lei_chat_tie,
			fec_chat_tie,
			estatu_pedido_cod_est_ped) VALUES(
			'".$this->men_chat_tie."',
			'".$this->tienda_cod_tie."',
			'".$_SESSION['cod_dom']."',
			'U',
			'1',
			'".$fecha."',
			'1'); ";

		return $this->ejecutar();

	}

	public function msj_leido(){
			
		 $this->que_dba="
			UPDATE chat_dom SET 
			lei_chat_dom= 0
			WHERE domiciliario_cod_dom = '".$_SESSION['cod_dom']."'
			AND usuario_cod_usu='".$this->usuario_cod_usu."';"; 	
			    
		return $this->ejecutar();
	}

	public function msj_leido_dom(){
			
		 $this->que_dba="
			UPDATE chat_tie SET 
			lei_chat_tie= 0
			WHERE domiciliario_cod_dom = '".$_SESSION['cod_dom']."'
			AND tienda_cod_tie = '".$this->tienda_cod_tie."';"; 	
			    
		return $this->ejecutar();
	}
		
		
	public function borrado_logico(){
			
		 $this->que_dba="
			UPDATE chat_dom SET 
			estatu_pedido_cod_est_ped = 3
			WHERE domiciliario_cod_dom='".$_SESSION['cod_dom']."'
			AND usuario_cod_usu = '".$this->usuario_cod_usu."' ;"; 	
			    
		return $this->ejecutar();
	}

	public function borrado_logico_dom(){
			
		 $this->que_dba="
			UPDATE chat_tie SET 
			estatu_pedido_cod_est_ped = 3
			WHERE domiciliario_cod_dom='".$_SESSION['cod_dom']."'
			AND tienda_cod_tie = '".$this->tienda_cod_tie."' ;"; 	
			    
		return $this->ejecutar();
	}

		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>