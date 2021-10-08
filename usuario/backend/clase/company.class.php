<?php
 if(!session_id())
session_start();

if (isset($_SESSION['idusuarios'],$_SESSION['idcompany'])){

require_once("utilidad.class.php");


	class company extends utilidad {

public $idcompany;
public $razon_social;
public $tipo;
public $rif;
public $direccion;
public $punto_ref;
public $telef;
public $telef_fijo;
public $email;
public $web;
public $logo;
public $instagram;
public $fanspage;
public $twitter;


	public function insertar(){

			$this->que_dba="INSERT INTO tienda 
			(tipo,
			cedula,
			nombres,
			telef,
			telef2,
			email,
			fecha_creacion,
			estatus_idestatus,
			usuarios_idusuarios)
			VALUES ('".$this->tipo."',
			'".$this->cedula."',
			'".$this->nombres."', 
			'".$this->telefono."',
			'".$this->telefono2."',
			'".$this->email."',
			'".$this->fecha_ingreso."',
			'7',
			'".$_SESSION['idusuarios']."'); ";

		return $this->ejecutar();

	}

	public function modificar(){

			$this->que_dba="UPDATE  company SET
			razon_social='".$this->razon_social."',
			tipo='".$this->tipo."',
			rif='".$this->rif."',
			direccion='".$this->direccion."',
			punto_ref='".$this->punto_ref."',
			telef='".$this->telef."',
			telef_fijo='".$this->telef_fijo."',
			email='".$this->email."',
			web='".$this->web."',
			logo='".$this->logo."',
			instagram='".$this->instagram."',
			fanspage='".$this->fanspage."',
			twitter='".$this->twitter."'
			WHERE idcompany='".$this->idcompany."'; ";


		return $this->ejecutar();

	}


	public function listar(){

			$this->que_dba="SELECT *
			FROM company 
      		WHERE idcompany='".$this->idcompany."'; ";

		return $this->ejecutar();

	}



	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>