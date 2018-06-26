
App.controller('XMLController', ['$scope','AjaxService','AddDOM',function ($scope,$AjaxService,$AddDOM) {
var ctrl = this

ctrl.getlocalStorage = getlocalStorage
  var libraires = [
    { "path" : "backend/reload.php"},
    { "path" : "assets/json/categories.json"},
    { "path" : "assets/json/models.json"},
    { "path" : "assets/json/fonctions.json"},
    { "path" : "assets/json/champs.json"}
  ]

/* rechargement de la base de donnée */
libraires.forEach(function(value) {
      $AjaxService.get(value.path)
      console.log("librairie " + value.path + " chargée")
})

$scope.categories = getlocalStorage('categories')
$scope.models = getlocalStorage('models')
$scope.fonctions = getlocalStorage('fonctions')
$scope.champs = getlocalStorage('champs')



function getlocalStorage(data){
  return JSON.parse(localStorage.getItem(data))
}


$scope.master = {}
$scope.input = {}

$scope.update = function(model) {
  $scope.master = angular.copy(input)
  console.log($scope.master)
}

$scope.reset = function() {
  $scope.input = angular.copy($scope.master)
}

$scope.reset()

$scope.add = function(champ) {
  $AddDOM.mdl(champ)
}

}])
