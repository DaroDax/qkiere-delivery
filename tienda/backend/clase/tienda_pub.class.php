<?php

require_once("utilidad.class.php");


	class tienda_pub extends utilidad {
public $texto;
public $rif;
public $tip_doc_tie;
public $raz_tie;
public $razon;
public $ema_tie;
public $email;
public $newpass;



public function consulta_email(){
	

			$this->que_dba="
			SELECT COUNT(*) AS total 
			FROM tienda
			WHERE ema_tie like '%".$this->texto."%'; ";



		return $a=$this->ejecutar();
		echo $a;

}

public function consulta_rif(){
	

			$this->que_dba="
			SELECT COUNT(*) AS total_rif 
			FROM tienda
			WHERE 
			tip_doc_tie = '".$this->tip_doc_tie."'
			AND rif_tie like '%".$this->rif."%';";



		return $a=$this->ejecutar();
		echo $a;

}

public function consulta_nombre(){
			
		$this->que_dba="
			SELECT COUNT(*) AS nombres 
			FROM tienda
			WHERE raz_tie like '%".$this->razon."%'; ";


		return $a=$this->ejecutar();
		echo $a;

}


public function consulta(){
	

			$this->que_dba="
			SELECT * FROM tienda";



		return $a=$this->ejecutar();
		echo $a;
}

public function cam_pas(){

	$this->que_dba="
	SELECT COUNT(*) as ema FROM tienda WHERE ema_tie = '".$this->email."';";

		return $b = $this->ejecutar();
		echo $b;
	/*$this->que_dba="
	INSERT INTO recuperar_pass(
	token_rec_pass,
	tienda_cod_tie)
	VALUES(
		12345678,
		2
	);";
	return $this->ejecutar();*/

}

public function cambio_clave(){
	
	$pass=MD5($this->newpass);
			
		$this->que_dba="UPDATE tienda SET pas_tie='".$pass."' WHERE ema_tie= '".$this->ema_tie."'; ";

		return $this->ejecutar();
}
		
} /// FIN DE CLASE
	
?>