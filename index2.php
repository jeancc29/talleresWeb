<?php



//header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
$data=json_decode(file_get_contents("php://input"));

//$serverName = "paginaweb1.database.windows.net";


/* Connect using Windows Authentication. */

//echo $data->action;

if($_REQUEST['REQUEST_METHOD'] == "POST"){
  $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  echo "Post: " . $post;
}
else{
  echo "No: ". json_decode(file_get_contents("php://input")) ;
}

// $serverName = "servidor3.database.windows.net";
// $conn = new PDO( "sqlsrv:server=$serverName ; Database=talleresAzure", "jean29", "Jean06091929");
//   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//   $cmd = $conn->prepare("select * from terceros"); //exec sp_clientes_obtener_por_identificacion_nombre  :datos
//   $cmd->execute();
//   $r  =  $cmd->fetchAll();
//   //$d = array(array("codTercero" => 23, "nombre" => $data['action']), array("codTercero" => 5, "nombre" => "Contreras"))
//   echo json_encode($data);




// if(!empty($data) && $data->action == "datos")
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