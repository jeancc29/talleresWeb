<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");


$data=json_decode(file_get_contents("php://input"));

//$serverName = "prestamoserver.database.windows.net";
$serverName = "DESKTOP-B2JEHIP";

/* Connect using Windows Authentication. */
if(!empty($data) && $data->action == "prueba")
{
    // $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
    // $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    // $cmd = $conn->prepare("exec persona_actualizar  :data");
    // $cmd->execute(array(
    //     ':data'=>json_encode($data->data)
    // ));
    // $r  =  $cmd->fetchAll();

    $r = $arrayName = array('saludo' => 'Hola jean');
    
    echo json_encode($r);
}


if(!empty($data) && $data->action == "persona_actualizar")
{
    $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $cmd = $conn->prepare("exec persona_actualizar  :data");
    $cmd->execute(array(
        ':data'=>json_encode($data->data)
    ));
    $r  =  $cmd->fetchAll();
    
    echo json_encode($r);
}

if(!empty($data) && $data->action == "persona_buscar")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_persona_buscar  :data");
  $cmd->execute(array(':data'=>json_encode($data->data)));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "clientes")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_clientes_obtener_por_identificacion_nombre  :datos");
  $cmd->execute(array(':datos'=>$data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}


if(!empty($data) && $data->action == "cobrador")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_cobradores_obtener_por_identificacion_nombre  :datos");
  $cmd->execute(array(':datos'=>$data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}



if(!empty($data) && $data->action == "reportes_prestamos")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $consulta = "";
  $cmd = $conn->prepare("exec sp_reportes_prestamos
                            @fechaIni = :fechaIni,
                            @fechaFin = :fechaFin,
                            @codigo_cliente = :codigo_cliente,
                            @codigo_garante = :codigo_garante,
                            @codigo_registro = :codigo_registro,
                            @tipo_prestamo = :tipo_prestamo,
                            @forma_pago = :forma_pago,
                            @tipo_interes = :tipo_interes,
                            @tipo_cliente = :tipo_cliente

                ");
  $cmd->execute(array(
    // ":fechaIni" => (isset($data->fechaIni)) ? $data->fechaIni : null,
    // ":fechaFin" => (isset($data->fechaFin)) ? $data->fechaFin : null,
    // ":codigo_cliente" => (isset($data->codigo_cliente)) ? $data->codigo_cliente : null,
    // ":codigo_garante" => (isset($data->codigo_garante)) ? $data->codigo_garante : null,
    // ":tipo_prestamo" => (isset($data->tipo_prestamo)) ? $data->tipo_prestamo : null,
    // ":forma_pago" => (isset($data->forma_pago)) ? $data->forma_pago : null
    ":fechaIni" =>  $data->fechaIni,
    ":fechaFin" =>  $data->fechaFin,
    ":codigo_cliente" =>  $data->codigo_cliente,
    ":codigo_garante" =>  $data->codigo_garante,
    ":codigo_registro" =>  $data->codigo_registro,
    ":tipo_prestamo" =>  $data->tipo_prestamo,
    ":forma_pago" =>  $data->forma_pago,
    ":tipo_interes" =>  $data->tipo_interes,
    ":tipo_cliente" =>  $data->tipo_cliente
  ));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "reportes_pagos")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $consulta = "";
  $cmd = $conn->prepare("exec sp_reportes_pagos
                            @fechaIni = :fechaIni,
                            @fechaFin = :fechaFin,
                            @codigo_cliente = :codigo_cliente,
                            @codigo_garante = :codigo_garante,
                            @codigo_registro = :codigo_registro,
                            @tipo_prestamo = :tipo_prestamo,
                            @forma_pago = :forma_pago

                ");
  $cmd->execute(array(
    // ":fechaIni" => (isset($data->fechaIni)) ? $data->fechaIni : null,
    // ":fechaFin" => (isset($data->fechaFin)) ? $data->fechaFin : null,
    // ":codigo_cliente" => (isset($data->codigo_cliente)) ? $data->codigo_cliente : null,
    // ":codigo_garante" => (isset($data->codigo_garante)) ? $data->codigo_garante : null,
    // ":tipo_prestamo" => (isset($data->tipo_prestamo)) ? $data->tipo_prestamo : null,
    // ":forma_pago" => (isset($data->forma_pago)) ? $data->forma_pago : null
    ":fechaIni" =>  $data->fechaIni,
    ":fechaFin" =>  $data->fechaFin,
    ":codigo_cliente" =>  $data->codigo_cliente,
    ":codigo_garante" =>  $data->codigo_garante,
    ":codigo_registro" =>  $data->codigo_registro,
    ":tipo_prestamo" =>  $data->tipo_prestamo,
    ":forma_pago" =>  $data->forma_pago
  ));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}



if(!empty($data) && $data->action == "reportes_ganancias")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

  $consulta = "";
  $cmd = $conn->prepare("exec sp_reportes_ganancias
                            @fechaIni = :fechaIni,
                            @fechaFin = :fechaFin
                ");
  $cmd->execute(array(
   
    ":fechaIni" =>  $data->fechaIni,
    ":fechaFin" =>  $data->fechaFin
  ));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}






if(!empty($data) && $data->action == "personas")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_personas_obtener_por_identificacion_nombre  :datos");
  $cmd->execute(array(':datos'=>$data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "personas_obtener_por_id")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select * from usuarios where codigo_usuario = :data");
  $cmd->execute(array(':data'=>$data->data));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "interes")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select * from tipos_registros where renglon = :r");
  $cmd->execute(array(':r'=>'interes'));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "tipos_registros_obtener_todos_json")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_tiposRegistros_obtener_todos_json");
  $cmd->execute();
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "tipos_registros")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select * from tipos_registros where renglon = :r");
  $cmd->execute(array(':r'=>$data->renglon));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "clientes_eliminar")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_clientes_eliminar :datos");
  $cmd->execute(array(':datos'=>$data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}



if(!empty($data) && $data->action == "prestamos_guardar")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_prestamos_actualizar :data
                        ");
  $cmd->execute(array(
                        ':data'=>json_encode($data->data)
      ));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}





if(!empty($data) && $data->action == "pagos")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select *, ROW_NUMBER() OVER(ORDER BY idAmortizacion ASC) AS fila, dbo.calcularMora((balance + capital), mora_porcentaje, fecha_pago, idAmortizacion) as mora from vw_pagos where id_prestamo = :datos and pagado != :pagado");
  $cmd->execute(array(':datos'=>$data->datos, ':pagado' => "pagado"));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "pagos_consultar")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select *, ROW_NUMBER() OVER(ORDER BY idAmortizacion ASC) AS fila, dbo.calcularMora((balance + capital), mora_porcentaje, fecha_pago, idAmortizacion) as mora from vw_pagos_consulta where id_prestamo = :datos");
  $cmd->execute(array(':datos'=>$data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "sp_pagos_guardar")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_pagos_guardar :datos");
  
  $cmd->execute(array(
                        ':datos'=>json_encode($data->datos)
      ));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "vw_prestamos_pagos")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select * from vw_prestamos_pagos where id_prestamo = :datos");
  $cmd->execute(array(':datos'=>$data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "estadisticas")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_estadisticas");
  $cmd->execute();
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "prestamos_obtener_todos")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("select * from vw_prestamos");
  $cmd->execute();
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "prestamos_codigo_usuario")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_prestamos_obtenerpor_codigo_usuario :codigo_usuario");
  $cmd->execute(array(':codigo_usuario'=>$data->codigo_usuario));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}


if(!empty($data) && $data->action == "prestamos_obtenerpor_id")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_prestamos_obtenerpor_id :id_registro");
  $cmd->execute(array(':id_registro'=>$data->id_registro));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "pagos_codigo_usuario")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_pagos_obtenerpor_codigo_usuario :codigo_usuario");
  $cmd->execute(array(':codigo_usuario'=>$data->codigo_usuario));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}


if(!empty($data) && $data->action == "pagos_eliminar")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_pagos_eliminar @id_registro = :id");
  $cmd->execute(array(':id'=>$data->id));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "pagos_obtener_todos")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_pagos_obtener_todos");
  $cmd->execute();
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "clientes_datos_resumen")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_clientes_datos_resumen :codigo_cliente");
  $cmd->execute(array(':codigo_cliente'=>$data->codigo_cliente));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}


if(!empty($data) && $data->action == "prestamos_buscar")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_prestamos_buscar :datos");
  $cmd->execute(array(':datos' => $data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "pagos_buscar")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_pagos_buscar :datos");
  $cmd->execute(array(':datos' => $data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "prestamos_buscar_para_cliente")
{
    $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $cmd = $conn->prepare("exec sp_prestamos_buscar_para_cliente :datos, :codigo_cliente");
    $cmd->execute(array(':datos' => $data->datos, ':codigo_cliente' => $data->codigo_cliente));
    $r  =  $cmd->fetchAll();
    echo json_encode($r);
}

if(!empty($data) && $data->action == "pagos_buscar_para_cliente")
{
    $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $cmd = $conn->prepare("exec sp_pagos_buscar_para_cliente :datos, :codigo_cliente");
    $cmd->execute(array(':datos' => $data->datos, ':codigo_cliente' => $data->codigo_cliente));
    $r  =  $cmd->fetchAll();
    echo json_encode($r);
}

if(!empty($data) && $data->action == "pagos_siguienteid")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_pagos_siguienteid");
  $cmd->execute();
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "pagos_obtener_por_prestamo")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_pagos_obtener_por_prestamo @idPrestamo = :datos");
  $cmd->execute(array(":datos" => $data->datos));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "pagos_perdonar_mora")
{
  $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
  $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  $cmd = $conn->prepare("exec sp_pagos_perdonar_mora :idAmortizacion,:mora_perdonada");
  $cmd->execute(array(":mora_perdonada" => $data->mora_perdonada, ":idAmortizacion" => $data->idAmortizacion));
  $r  =  $cmd->fetchAll();
  echo json_encode($r);
}

if(!empty($data) && $data->action == "amortizar")
{
    $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $cmd = $conn->prepare("exec sp_prestamo_amortizacion  :data");
    $cmd->execute(array(
        ':data'=>json_encode($data->data)
    ));
    $r  =  $cmd->fetchAll();
    
    echo json_encode($r);
}



if(isset($_POST['login']))
{
    $u = $_POST['usuario'];
    $c = $_POST['pass'];
    $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $cmd = $conn->prepare("exec sp_usuarios_acceder @usuario = :usuario, @clave = :clave");
    $cmd->execute(array(':usuario'=>$u, ':clave'=>$c));
    $r  = array('resultados' => $cmd->fetchAll(), 'error' => '' );
    echo json_encode($r);
    //print_r($data->cmd);
    //echo $_FILES[$data->cmd];

   // echo "holaaaaaaaaa";
}

if(isset($_POST['buscar_cliente'])){
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $cmd = $conn->prepare("SELECT * FROM usuarios u INNER JOIN tipos_registros t ON u.tipo_registro_usuario = t.tipo_registro WHERE t.descripcion = :cliente and (u.identificacion like '%' + :datos + '%' or u.nombre  like '%' + :datos1 + '%' ) ");
    $cmd->execute(array(':cliente'=> 'Cliente', ':datos'=>$post['buscar_cliente'], ':datos1'=>$post['buscar_cliente'])); //AND u.identificacion = :datos AND u.nombre = :datos AND u.codigo_usuario = :datos
    $r  = array('resultados' => $cmd->fetchAll(), 'error' => '' );
    echo json_encode($r);
}

if(isset($_POST['cmd'])){
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $conn = new PDO( "sqlsrv:server=$serverName ; Database=prestamos2", "sa", "123");
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $cmd = $conn->prepare($post['cmd']);
    $cmd->execute();
    //$r  = array('resultados' => $cmd->fetchAll(), 'error' => '' );
    $r = $cmd->fetchAll();
    echo json_encode($r);
}

//select * from usuarios u inner join tipos_registros t on u.tipo_registro_usuario = t.tipo_registro where t.descripcion = Cliente
