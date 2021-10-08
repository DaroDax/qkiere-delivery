<?php
 if(!session_id())
session_start();

if (isset($_SESSION['idusuarios'])){

require_once("utilidad.class.php");


	class estatu extends utilidad {

public $idestatus;
public $estatus;
public $grupo;


	public function insertar(){

			$this->que_dba="INSERT INTO clientes 
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
			'".$this->telef."',
			'".$this->telef2."',
			'".$this->email."',
			'now()',
			'7',
			'".$_SESSION['idusuarios']."'); ";

		return $this->ejecutar();

	}
	


	public function listar(){

			$this->que_dba="SELECT * FROM estatus; ";

		return $this->ejecutar();

	}

	public function query_cliente_simple(){
	
			$this->que_dba="SELECT 
			clientes.*, 
			datos_habitacion.*
			FROM 
			   clientes,
			   datos_habitacion
			   
			   WHERE clientes.idclientes=datos_habitacion.clientes_idclientes
			  AND clientes.idclientes = '".$this->idclientes."'; ";

		return $this->ejecutar();

	}

	public function filtrar(){
		
			$filtro1=($this->cedula!="")?" * FROM clientes WHERE cedula='$this->cedula'":"";
			$filtro3=($this->idclientes!="")?" clientes.*, datos_habitacion.* FROM clientes, datos_habitacion
			 WHERE
			 clientes.idclientes=datos_habitacion.clientes_idclientes
			 AND datos_habitacion.iddatos_habitacion='$this->iddatos_habitacion' 
			 AND clientes.idclientes='$this->idclientes'":"";
			$filtro2=($this->contrato!="")?" 
			clientes.*,
			datos_habitacion.*, 
			estudios.*,
			contratos.*,
			sector.*,
			estatus.*
    	FROM 
		    clientes,
		    datos_habitacion,
		    estudios,
		    contratos,
		    sector,
		    estatus
			    WHERE clientes.idclientes=datos_habitacion.clientes_idclientes
			    AND datos_habitacion.iddatos_habitacion=estudios.datos_habitacion_iddatos_habitacion
			    AND estudios.idestudios=contratos.estudios_idestudios
			    AND datos_habitacion.sector_cod_sec=sector.cod_sec
			    AND contratos.estatus_idestatus=estatus.idestatus
			    AND contratos.idcontratos='".$this->contrato."';":"";
			
			$filtro4=($this->texto!="")?" 
			clientes.*, 
			datos_habitacion.*, 
			estudios.*, 
			contratos.*, 
			detalles_contratos.*,
			ips.*, 
			planes.*
				FROM 
			clientes,
			datos_habitacion, 
			estudios, 
			contratos,
			detalles_contratos,
			ips,
			planes
   				WHERE 
   			clientes.idclientes=datos_habitacion.clientes_idclientes
			AND datos_habitacion.iddatos_habitacion=estudios.datos_habitacion_iddatos_habitacion
			AND estudios.idestudios=contratos.estudios_idestudios
			AND contratos.idcontratos=detalles_contratos.contratos_idcontratos
			AND detalles_contratos.planes_idplanes=planes.idplanes
			AND detalles_contratos.ips_idips=ips.idips
			AND contratos.estatus_idestatus = '1'
			AND clientes.nombres LIKE '%".$this->texto."%'; ":"";
			
			
			
    $this->que_dba="SELECT $filtro1 $filtro2 $filtro3 $filtro4;"; 
		return $this->ejecutar();
	}



	
		
} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>