<?php 

class utilidad {
	
	//date_default_timezone_set("America/caracas");
	
	private $nom_ser="localhost"; //Nombre del Servidor
	private $usu_ser="root"; //Usuario del Servidor
	private $cla_ser="12345678"; //Clave del Servidor
	private $nom_bda="qkiere"; //Conexion de la base de datos
	public  $que_dba; //query que quiero ejecutar
	public  $resultado;
	public $puntero; // sirve para apuntar a una fila luego de un select
	public $charset="utf8mb4";

	public function __construct()
	{
		$this->conectar();
	}

	public function conectar()
	{
		$this->con_bda= new mysqli($this->nom_ser,$this->usu_ser,
			$this->cla_ser,$this->nom_bda);
		mysqli_set_charset($this->con_bda, $this->charset);

	}

	public function ejecutar()
	{             //echo $this->que_dba;
	                //exit();
		return $this->con_bda->query($this->que_dba);
	}

	public function mensaje()
	{ 
		if($this->resultado==true){
			echo "Registro ";
		}else {
			
		echo "Error";
			
		}
	}


	public function asignar_valor()
	{

		foreach ($_REQUEST AS $atributo  => $valor) 
		{
		
		$this->$atributo=$valor;
		}
	}

	public function extraer_dato()
	{
		return $this->puntero->fetch_assoc();
	}
	



}
?>