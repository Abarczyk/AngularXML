
App.controller('XMLController', ['$scope','AjaxService','AddDOM',function ($scope,$AjaxService,$AddDOM) {

var ctrl = this



ctrl.getlocalStorage = getlocalStorage

var librairie = [
  { "path" : "assets/json/librairie.json", "name" : "librairie", "valeur" : ""}
]
  /* rechargement de la base de donnée */
let promise = $AjaxService.get("backend/reload.php")
promise.then(function(response){
  /* on attend que reload.php ai fini de créer les Json*/
  librairie.forEach(function(index) {

        let promise = $AjaxService.get(index.path)
        promise.then(function(response){
          /* on attend que les données soient récupérées puis on les ranges dans la librairie*/
            $scope.librairie = response.data
            console.log($scope.librairie)
        })
        console.log("librairie " + index.path + " chargée")
  })

})



$scope.edit = function(item){
  $scope.modele = item

}


function getlocalStorage(data){
  return JSON.parse(localStorage.getItem(data))
}


$scope.master = {}

$scope.update = function(item) {
  $scope.master = angular.copy(item)
  console.log($scope.master)
}

$scope.reset = function() {
  $scope.modele = angular.copy($scope.master)
}

$scope.add = function(champ) {
  $AddDOM.mdl(champ)
}

}])
