<?php



header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$data=json_decode(file_get_contents("php://input"));

/*
  Data desde flutter, aqui lo que hice fue insertar la funcion json_encode
  dentro de la funcion json_decode porque flutter esta enviando un string
  por lo tanto la funcion json_decode no lo reconoce, asi que lo primero que
  hago es convertir el string que recibo desde flutter en un json y luego entonces
  ya si puedo decodificarlo
*/
$d =   file_get_contents("php://input"); 
$d = json_decode($d);

//$serverName = "paginaweb1.database.windows.net";


/* Connect using Windows Authentication. */

// $serverName = "servidor3.database.windows.net";
// $conn = new PDO( "sqlsrv:server=$serverName ; Database=talleresAzure", "jean29", "Jean06091929");
//   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//   $cmd = $conn->prepare("select * from terceros"); //exec sp_clientes_obtener_por_identificacion_nombre  :datos
//   $cmd->execute();
//   $r  =  $cmd->fetchAll();
//   //$d = array(array("codTercero" => 23, "nombre" => $data['action']), array("codTercero" => 5, "nombre" => "Contreras"))
//   echo json_encode($data);


echo $d . " - " . $d->action;

if(!empty($d) && $d->action == "datos")
{
   // echo $data->data;
//   $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
//   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//   $cmd = $conn->prepare("exec sp_clientes_obtener_por_identificacion_nombre  :datos");
//   $cmd->execute(array(':datos'=>$data->datos));
//   $r  =  $cmd->fetchAll();
//   echo json_encode($r);

$serverName = "servidor3.database.windows.net";
$conn = new PDO( "sqlsrv:server=$serverName ; Database=talleresAzure", "jean29", "Jean06091929");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select * from terceros"); //exec sp_clientes_obtener_por_identificacion_nombre  :datos
  $cmd->execute();
  $r  =  $cmd->fetchAll();
  echo json_encode($r);


}


?>