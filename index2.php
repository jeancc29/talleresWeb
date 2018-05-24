<?php




header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$data=json_decode(file_get_contents("php://input"), true);

//$serverName = "paginaweb1.database.windows.net";


/* Connect using Windows Authentication. */

//echo $data->action;

$serverName = "servidor3.database.windows.net";
$conn = new PDO( "sqlsrv:server=$serverName ; Database=talleresAzure", "jean29", "Jean06091929");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select * from terceros"); //exec sp_clientes_obtener_por_identificacion_nombre  :datos
  $cmd->execute();
  $r  =  $cmd->fetchAll();
  //$d = array(array("codTercero" => 23, "nombre" => $data), array("codTercero" => 5, "nombre" => "Contreras"))
  echo json_encode($r);




// if(!empty($data) && $data["action"] == "datos")
// {
//    // echo $data->data;
// //   $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
// //   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
// //   $cmd = $conn->prepare("exec sp_clientes_obtener_por_identificacion_nombre  :datos");
// //   $cmd->execute(array(':datos'=>$data->datos));
// //   $r  =  $cmd->fetchAll();
// //   echo json_encode($r);

// $serverName = "servidor3.database.windows.net";
// $conn = new PDO( "sqlsrv:server=$serverName ; Database=talleresAzure", "jean29", "Jean06091929");
//   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//   $cmd = $conn->prepare("select * from terceros"); //exec sp_clientes_obtener_por_identificacion_nombre  :datos
//   $cmd->execute();
//   $r  =  $cmd->fetchAll();
//   echo json_encode($r);


// }


?>