<?php
 if(!session_id())
session_start();

if (isset($_SESSION['cod_usu'])){

require_once("utilidad.class.php");


	class cart extends utilidad {
	
	public $cod_tem_ped;
	public $can_tem_ped;
	public $obs_tem_ped;
	public $pre_tem_ped;
	public $tot_tem_ped;
	public $fec_tem_ped;
	public $inventario_cod_inv;
	public $usuario_cod_usu;
	public $act_tem_ped;

	public $tienda_cod_tie;

	/*VARIABLES EXTERNAS*/
	public $cod_inv;
	public $cod_tie;


	
	public function insertar(){

		$fecha=date("Y-m-d H:m:s");
			$this->que_dba="INSERT INTO temp_pedido 
			(can_tem_ped,
			obs_tem_ped,
			pre_tem_ped,
			tot_tem_ped,
			fec_tem_ped,
			inventario_cod_inv,
			usuario_cod_usu,
			act_tem_ped)
			VALUES ('".$this->can_tem_ped."',
			'".$this->obs_tem_ped."',
			'".$this->pre_tem_ped."', 
			'".$this->tot_tem_ped."',
			'".$fecha."',
			'".$this->inventario_cod_inv."',
			'".$_SESSION['cod_usu']."',
			'".$fecha."'); ";

		return $this->ejecutar();

	}


	/* CONSULTA EL CARRO DE CADA TIENDA */
	public function consulta_carrito(){
			
	    $this->que_dba="SELECT * FROM  temp_pedido t, inventario i 
	    where 
	    t.inventario_cod_inv=i.cod_inv
	    AND t.usuario_cod_usu='".$_SESSION['cod_usu']."' AND t.cod_tem_ped='".$this->cod_tem_ped."'; "; 
		
		return $this->ejecutar();
	}

	public function listar_carrito(){
			
		 $this->que_dba="
			SELECT * FROM temp_pedido tp, inventario i
				WHERE tp.inventario_cod_inv=i.cod_inv
				AND i.tienda_cod_tie='".$this->cod_tie."'
				AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."'; "; 	
		return $this->ejecutar();
	}

		public function mostrar_carrito()
		{

			$this->que_dba = "
			SELECT * FROM temp_pedido tp, inventario i
				WHERE tp.inventario_cod_inv=i.cod_inv
				AND i.tienda_cod_tie='" . $this->cod_tie . "'
				AND tp.usuario_cod_usu='" . $_SESSION['cod_usu'] . "'; ";
			return $this->ejecutar();
		}

	public function sumatoria_tem_pedido(){
			
    $this->que_dba="SELECT SUM(tot_tem_ped) AS total_pedido 
    FROM temp_pedido tp, inventario i 
    WHERE 
    tp.inventario_cod_inv=i.cod_inv
    AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."'
    AND i.tienda_cod_tie='".$this->cod_tie."'; "; 
		return $this->ejecutar();
	}


	public function eliminar(){
			
    $this->que_dba="DELETE FROM  temp_pedido 
    where cod_tem_ped='".$this->cod_tem_ped."' AND usuario_cod_usu='".$_SESSION['cod_usu']."'; "; 
		return $this->ejecutar();
	}

	public function vaciar_carrito(){
			
    $this->que_dba="
    	DELETE tp FROM  temp_pedido tp JOIN  inventario i
		ON i.cod_inv=tp.inventario_cod_inv
    	WHERE i.tienda_cod_tie= '".$this->cod_tie."'
    AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."';"; 
		return $this->ejecutar();
	}

	

	public function editar_carrito(){
			
	    $this->que_dba="UPDATE temp_pedido SET 
	    can_tem_ped= '".$this->can_tem_ped."', 
	    obs_tem_ped='".$this->obs_tem_ped."',
	    pre_tem_ped='".$this->pre_tem_ped."',
	    tot_tem_ped='".$this->tot_tem_ped."'
	    where usuario_cod_usu='".$_SESSION['cod_usu']."' AND cod_tem_ped='".$this->cod_tem_ped."'; "; 
		return $this->ejecutar();
	}

	public function checkout(){
			
	    $this->que_dba="SELECT * FROM  temp_pedido tp, inventario i
	    WHERE tp.inventario_cod_inv=i.cod_inv 
	    AND tp.usuario_cod_usu='".$_SESSION['cod_usu']."' 
	    AND i.tienda_cod_tie='".$this->cod_tie."'; "; 
		return $this->ejecutar();
	}


	

} /// FIN DE CLASE
	

}else {
	header("location: ../../../index.php");
}
?>