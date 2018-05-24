


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="/./angular.min.js" ></script>
</head>
<body ng-app="myModulePrestamo">
<div ng-controller="myController">
</div>
  

  <script>
      var myApp = angular
    .module("myModulePrestamo", [])
    .controller("myController", function($scope,$http, $log){

        $http.post("/./index2.php", )
             .then(function(response){
                 console.log(response.data);
                
             })

    })
  </script>
</body>
</html>