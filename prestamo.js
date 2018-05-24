var myApp = angular
    .module("myModulePrestamo", [])
    .controller("myController", function($scope,$http, $log){


      $scope.busqueda = "";
      $scope.cliente = "";
      $scope.garante = "";
      $scope.titulo = "";
      $scope.titulo_seleccionado = "";
      $scope.cliente_o_garante = true;
      $scope.seleccionado = [];
      $scope.tasa = 0;
      $scope.interes = 0;
      $scope.monto = 0;
      $scope.cuotas = 0;
      $scope.formapago = 0;
      $scope.tipoprestamo = 0;
      $scope.fechaapertura = new Date();
      var d = [];

        //$scope.optionsTipoInteres = [{name: "Personal", id: 1}, {name: "Hipotecario", id: 2}, {name: "Estudio", id: 3}];
        //$scope.selectedTipoInteres = $scope.optionsTipoInteres[0];

      $scope.optionsFormaPago = [{name:"Diario", id:1}, {name:"Semanal", id:2}, {name:"Quincenal", id:3}, {name:"Mensual", id:4}, {name:"Anual", id:5}];
      $scope.selectedFormaPago = $scope.optionsFormaPago[3]

        $scope.optionsTipoPrestamo = [{name:"Soluto directo", id:1}, {name:"Insoluto", id:2}, {name:"Amortizacion", id:3}];
        $scope.selectedTipoPrestamo = $scope.optionsTipoPrestamo[0];

        $http.post("/./clases/consultaajax.php", {'action':'interes'})
             .then(function(response){
                 $scope.optionsTipoInteres=response.data;
                $scope.selectedTipoInteres = $scope.optionsTipoInteres[1];
                 $scope.inicializarComponentes();
             })

        $scope.prestamoDatos = {
            id_registro:null,
            tipo_interes:null,
            codigo_cliente:null,
            codigo_garante:null,
            tasa:null,
            cuotas:null,
            fechaapertura:null,
            montoprestamo:null,
            mora:null,
            tipoprestamo:$scope.selectedTipoPrestamo.id,
            formapago:$scope.selectedFormaPago.id,
            detalle:null
        };




      $scope.buscarcliente=function(){
    		$http.post("/./clases/consultaajax.php",{'datos':$scope.busqueda, 'action':'clientes'})
    		.then(function(data){
    			$scope.data=data;
          console.log($scope.data);
    		})

    	}


        $scope.displayStud=function(){
      		$http.get("../clases/consultaajax.php")
      		.success(function(data){
      			$scope.data=data
      		})
      	}

        $scope.agregarCliente = function(data){
            if($scope.cliente_o_garante){
                $scope.cliente = data;
                $scope.prestamoDatos.codigo_cliente = parseFloat(data.codigo_usuario);
            }
            else{
                $scope.garante = data;
                  $scope.prestamoDatos.codigo_garante = parseFloat(data.codigo_usuario);
            }
          alert("Se ha agregado correctamente");

          $scope.data = [];

        }


        $scope.seleccionar= function(data){
            $scope.seleccionado = d = data;
            if($scope.cliente_o_garante){
                $scope.cliente = d ;
            }
            else{
                $scope.garante = d ;
            }


        }

        $scope.datosForumario = function(cliente_o_garante){
            if(cliente_o_garante){
                $scope.titulo = "Clientes";
                $scope.titulo_seleccionado = "Cliente seleccionado";
                $scope.cliente_o_garante = cliente_o_garante;
                $scope.data = [];
                $scope.seleccionado = [];
            }
            else{
                $scope.titulo = "Garantes";
                $scope.titulo_seleccionado = "Garante seleccionado";
                $scope.cliente_o_garante = cliente_o_garante;
                $scope.data = [];
                $scope.seleccionado = [];
            }
        }

        $scope.amortizar = function(){

            console.log( "tipoprestamo: ",$scope.selectedTipoPrestamo.tipo_registro);
            if(!angular.isNumber($scope.prestamoDatos.tasa)){
                alert("Error: El interes o tasa debe ser numerico y no debe estar vacio");
                return;
            }
            else if($scope.prestamoDatos.tasa <= 0){
                alert("Error: El interes o tasa debe ser mayor que cero");
                return;
            }

            if(!angular.isNumber($scope.prestamoDatos.cuotas)){
                alert("Error: El numero de cuotas debe ser numerico y no debe estar vacio");
                return;
            }
            else if($scope.prestamoDatos.cuotas <= 0){
                alert("Error: El numero de cuotas debe ser mayor que cero");
                return;
            }

            if(!angular.isNumber($scope.prestamoDatos.montoprestamo)){
                alert("Error: El monto debe ser numerico y no debe estar vacio");
                return;
            }
            else if($scope.prestamoDatos.montoprestamo <= 0){
                alert("Error: El monto debe ser mayor que cero");
                return;
            }

            $http.post("/./clases/consultaajax.php",
                                            {'tasa':$scope.prestamoDatos.tasa,
                                                'cuotas':$scope.prestamoDatos.cuotas,
                                                'interes':$scope.prestamoDatos.tasa,
                                                'monto':$scope.prestamoDatos.montoprestamo,
                                                'tipoprestamo':$scope.selectedTipoPrestamo.id,
                                                'formapago':$scope.selectedFormaPago.id,
                                                'fecha_pago':$scope.prestamoDatos.fechaapertura,
                                                'action':'amortizar'})
                .then(function(data){
                    $scope.data=data;
                    console.log($scope.data);
                })
        }


    $scope.verPrestamo = function(data){
        $scope.tasa = data.porciento_interes;
        $scope.cuotas = data.cantidad_cuotas;
        $scope.monto = data.monto_prestamo;
        $scope.balance_pendiente = data.balance_pendiente;
        $scope.interes_pendiente = data.interes_pendiente;
        $scope.monto_pagado = data.monto_pagado;
        $scope.cuotas_pagadas = data.cuotas_pagadas;
        $scope.fecha_ultimo_pago = data.fecha_ultimo_pago;
        $scope.detalle = data.detalle;
        $scope.selectedFormaPago = $scope.optionsFormaPago[data.formapago - 1];
        $scope.selectedTipoPrestamo= $scope.optionsTipoPrestamo[data.tipo_registro_tipoprestamo - 1];
            // console.log(data.porciento_interes);
            // $scope.tasa = data.porciento_interes;
            // $scope.cuotas = data.cantidad_cuotas;
            // $scope.monto = data.monto_prestamo;
            // $scope.detalle = data.detalle;
            // $scope.selectedFormaPago = $scope.optionsFormaPago[data.formapago - 1];
            // $scope.selectedTipoPrestamo= $scope.optionsTipoPrestamo[data.tipo_registro_tipoprestamo - 1];
            //
            // console.log( "interes: ",$scope.interes);
            // console.log( "cuotas: ",$scope.cuotas);
            // console.log( "monto: ",$scope.monto);
            // console.log( "tipoprestamo: ",$scope.tipoprestamo);
            // console.log( "formapago: ",$scope.formapago);

            // $http.post("/./clases/consultaajax.php",
            //                                 {'tasa':$scope.tasa,
            //                                     'cuotas':$scope.cuotas,
            //                                     'interes':$scope.interes,
            //                                     'monto':$scope.monto,
            //                                     'tipoprestamo':$scope.tipoprestamo,
            //                                     'formapago':$scope.formapago,
            //                                     'action':'amortizar'})
            //     .then(function(data){
            //         $scope.data=data;
            //         console.log($scope.data);
            //     })
        }


       $scope.prestamos = $http.post("/./clases/consultaajax.php", {'action':'prestamos_obtener_todos'})
            .then(function(response){
                $scope.prestamos=response.data;
                console.log(Date());
                console.log($scope.fechaapertura);
            })


        $scope.buscarprestamo=function(){
            $http.post("/./clases/consultaajax.php",{'datos':$scope.busqueda, 'action':'prestamos_buscar'})
                .then(function(response){
                    $scope.prestamos=response.data;
                    console.log($scope.data);
                })

        }



          $scope.prestamoGuardar = function(codigo_usuario_registro){
            console.log($scope.prestamoDatos.formapago);
            console.log('Primero: ',$scope.prestamoDatos);
            if(!angular.isNumber($scope.prestamoDatos.codigo_cliente)){
                alert("Error: Debe seleccionar un cliente");
                return;
            }


            if(!angular.isNumber($scope.prestamoDatos.tasa)){
                alert("Error: El interes o tasa debe ser numerico y no debe estar vacio");
                return;
            }
            else if($scope.prestamoDatos.tasa <= 0){
                alert("Error: El interes o tasa debe ser mayor que cero");
                return;
            }

            if(!angular.isNumber($scope.prestamoDatos.cuotas)){
                alert("Error: El numero de cuotas debe ser numerico y no debe estar vacio");
                return;
            }
            else if($scope.prestamoDatos.cuotas <= 0){
                alert("Error: El numero de cuotas debe ser mayor que cero");
                return;
            }

            if(!angular.isNumber($scope.prestamoDatos.montoprestamo)){
                alert("Error: El monto debe ser numerico y no debe estar vacio");
                return;
            }
            else if($scope.prestamoDatos.montoprestamo <= 0){
                alert("Error: El monto debe ser mayor que cero");
                return;
            }







            $http.post("/./clases/consultaajax.php", {'action':'prestamos_guardar',
              'id_registro':$scope.prestamoDatos.id_registro,
              'codigo_usuario':$scope.prestamoDatos.codigo_cliente,
              'codigo_usuario_registro':codigo_usuario_registro,
              'capital':$scope.prestamoDatos.montoprestamo,
              'porciento_interes':$scope.prestamoDatos.tasa,
              'cantidad_cuotas':$scope.prestamoDatos.cuotas,
              'codigo_usuario_garante':$scope.prestamoDatos.codigo_garante,
              'monto_prestamo':$scope.prestamoDatos.montoprestamo,
              'tipo_prestamo':$scope.selectedTipoPrestamo.id,
              'detalle':$scope.prestamoDatos.detalle,
              'formapago':$scope.selectedFormaPago.id,
              'fechaapertura':$scope.prestamoDatos.fechaapertura,
              'mora':$scope.prestamoDatos.mora,
              'tipo_interes':$scope.selectedTipoInteres.tipo_registro})
                .then(function(response){
                    alert("Se ha guardado correctamente");
                    $scope.inicializarComponentes();
                })


            // $http.post("/./clases/consultaajax.php",
            //                                 {'action':'prestamos_guardar',
            //                                   ':codigo_usuario':$scope.prestamoDatos.codigo_cliente,
            //                                   ':codigo_usuario_registro':codigo_usuario_registro,
            //                                   ':capital':$scope.prestamoDatos.montoprestamo,
            //                                   ':porciento_interes':$scope.prestamoDatos.tasa,
            //                                   ':cantidad_cuotas':$scope.prestamoDatos.cuotas,
            //                                   ':codigo_usuario_garante':$scope.prestamoDatos.codigo_garante,
            //                                   ':monto_prestamo':$scope.prestamoDatos.montoprestamo,
            //                                   ':tipo_prestamo':$scope.prestamoDatos.tipoprestamo,
            //                                   ':detalle':$scope.prestamoDatos.detalle,
            //                                   ':formapago':$scope.prestamoDatos.formapago,
            //                                   ':fechaapertura':$scope.prestamoDatos.fechaapertura,
            //                                   ':mora':$scope.prestamoDatos.mora,
            //                                   ':tipo_interes':$scope.prestamoDatos.tipo_interes
            //                                   })
            //     .then(function(response){
            //
            //         console.log(response.data);
            //     })
        }

          $scope.prestamoEditar = function(id_registro){
            //id_registro = parseFloat(id_registro);

            console.log("Prestamo: ", id_registro);

            if(id_registro === '' || id_registro == null){
              //  alert("Error: El id debe ser valido");
                return;
            }
            id_registro = parseFloat(id_registro);
            console.log("Despues de convertir: ", id_registro);
            if(!angular.isNumber(id_registro)){
              alert("Error: El id debe ser valido");
              return;
            }








            $http.post("/./clases/consultaajax.php", {'action':'prestamos_obtenerpor_id',
              'id_registro':id_registro
            })
                .then(function(response){
                    console.log(response.data[0]);
                    if(response.data.length < 1) return;
                    if(response.data[0].fecha_ultimo_pago != "No tiene"){
                      alert("No se puede editar porque ya tiene pago");
                      $scope.inicializarComponentes();
                      return;
                    }

                    $scope.inicializarComponentes();
                    $scope.prestamoDatos.id_registro=response.data[0].id_registro;
                    $scope.prestamoDatos.tipo_interes=response.data[0].tipo_interes;
                    $scope.prestamoDatos.codigo_cliente= parseFloat(response.data[0].codigo_usuario_cliente);
                    $scope.prestamoDatos.codigo_garante=response.data[0].codigo_usuario_garante;
                    $scope.prestamoDatos.tasa= parseFloat(response.data[0].porciento_interes);
                    $scope.prestamoDatos.cuotas= parseFloat(response.data[0].cantidad_cuotas),
                    $scope.prestamoDatos.fechaapertura= new Date(response.data[0].fecha);
                    $scope.prestamoDatos.montoprestamo= parseFloat(response.data[0].monto_prestamo);
                    $scope.prestamoDatos.mora= parseFloat(response.data[0].mora);

                    $scope.selectedTipoPrestamo = $scope.optionsTipoPrestamo[response.data[0].tipo_registro_tipoprestamo - 1]
                    $scope.prestamoDatos.tipoprestamo=$scope.selectedTipoPrestamo.id;

                    $scope.selectedFormaPago = $scope.optionsFormaPago[response.data[0].formapago - 1]
                    $scope.prestamoDatos.formapago=$scope.selectedFormaPago.id;
                    
                    $scope.prestamoDatos.detalle=response.data[0].detalle;
                    $scope.cliente = {"codigo_usuario":response.data[0].codigo_usuario_cliente, "nombre":response.data[0].nombre_cliente};
                    $scope.garante = {"codigo_usuario":response.data[0].codigo_usuario_garante, "nombre":response.data[0].nombre_garante};
                })



        }

       $scope.inicializarComponentes =  function(){
          $scope.prestamoDatos.id_registro=null;
          $scope.prestamoDatos.tipo_interes=$scope.selectedTipoInteres.tipo_registro;
          $scope.prestamoDatos.codigo_cliente=null;
          $scope.prestamoDatos.codigo_garante=null;
          $scope.prestamoDatos.tasa=null;
          $scope.prestamoDatos.cuotas=null,
          $scope.prestamoDatos.fechaapertura=null;
          $scope.prestamoDatos.montoprestamo=null;
          $scope.prestamoDatos.mora=null;
          $scope.prestamoDatos.tipoprestamo=$scope.selectedTipoPrestamo.id;
          $scope.prestamoDatos.formapago=$scope.selectedFormaPago.id;
          $scope.prestamoDatos.detalle=null;
          $scope.cliente = null;
          $scope.garante = null;
        }


    })
