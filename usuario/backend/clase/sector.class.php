<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class sector extends utilidad {

	public $cod_sec;
    public $nom_sec;
    public $municipio_cod_mun;

    /* VARIABLES EXTRAS*/
    public $cod_mun;



	public function insertar(){

			$this->que_dba="INSERT INTO sector 
			(nom_sec,
			municipio_cod_mun)
			VALUES (
			'".$this->nom_sec."',
			'".$this->municipio_cod_mun."'); ";

		return $this->ejecutar();

	}




	public function listar(){

			$this->que_dba="SELECT * FROM sector WHERE municipio_cod_mun='".$this->cod_mun."' ORDER BY nom_sec ASC ";

		return $this->ejecutar();

	}

	public function listar_2(){

			$this->que_dba="SELECT * FROM sector WHERE municipio_cod_mun='".$this->cod_mun."' ORDER BY nom_sec ASC ";

		return $this->ejecutar();

	}

	public function filtrar(){
		$this->que_dba="SELECT 
		tienda.*,
		datos_habitacion.*, 
		estudios.*,
		contratos.*
    FROM 
    tienda,
    datos_habitacion,
    estudios,
    contratos
    WHERE tienda.idtienda=datos_habitacion.tienda_idtienda
    AND datos_habitacion.iddatos_habitacion=estudios.datos_habitacion_iddatos_habitacion
    AND estudios.idestudios=contratos.estudios_idestudios
    AND contratos.idcontratos='".$this->contrato."';";

		return $this->ejecutar();
	}



	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>