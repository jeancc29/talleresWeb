<?php




header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$data=json_decode(file_get_contents("php://input"));

//$serverName = "paginaweb1.database.windows.net";
$serverName = "servidor3.database.windows.net";
$conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "jean29", "Jean06091929");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select * from terceros"); //exec sp_clientes_obtener_por_identificacion_nombre  :datos
  $cmd->execute(array(':datos'=>$data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);

/* Connect using Windows Authentication. */

if(!empty($data) && $data->action == "clientes")
{
   // echo $data->data;
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_clientes_obtener_por_identificacion_nombre  :datos");
  $cmd->execute(array(':datos'=>$data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

?>