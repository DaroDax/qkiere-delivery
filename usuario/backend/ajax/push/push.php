<?php
  if(!session_id())
session_start();

if (isset($_SESSION ["cod_usu"])){
	require_once("../../clase/inventario.class.php");

 $obj_inbox= new inventario;
 date_default_timezone_set("UTC");

$array=array(); 
$rows=array(); 
$obj_inbox->cliente_cod_cli=2;
$obj_inbox->asignar_valor();
$obj_inbox->puntero=$obj_inbox->listar2();
$record = 0;                                 
while(($key=$obj_inbox->extraer_dato())>0){
//foreach ($notifList as $key) {
 $data['title'] = $key['asu_inb'];
 $data['msg'] = $key['men_inb'];
 $data['icon'] = 'images/avatar.png';
 $data['url'] = 'https://www.baulphp.com';
 $rows[] = $data;
 $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+(1*60));
 $obj_inbox->listar2();
 $record++;
}
$array['notif'] = $rows;
$array['count'] = $record;
$array['result'] = true;
echo json_encode($array);
  

}
else{
    header("location: ../../index.php");
    exit();

}
?>