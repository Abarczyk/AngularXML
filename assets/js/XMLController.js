
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
        })
        console.log("librairie " + index.path + " chargée")
  })

})



$scope.edit = function(item){
  $scope.modele = item
  console.log('modele :', $scope.modele)
}


function getlocalStorage(data){
  return JSON.parse(localStorage.getItem(data))
}


$scope.master = {}

$scope.update = function(item) {
  console.log('envoi : ', item);
  $scope.master = angular.copy(item)
  $AjaxService.post('backend/ecrire.php',$scope.master)
}

$scope.reset = function() {
  $scope.modele = angular.copy($scope.master)
}

$scope.copy = function(item) {
  var copy = angular.copy(item)
  copy.nom = copy.nom + '_2'
  console.log("copie :",copy)
  var lib = $scope.librairie
  for (var i = 0; i < lib.length; i++) {
    for (var k = 0; k < lib[i].modeles.length; k++) {
      if (lib[i].modeles[k].nom === item.nom) {
        lib[i].modeles.push(copy)
        console.log('librairie :', $scope.librairie)
        return
      }
    }
  }
}


$scope.remove = function(item) {
  var i = 0
  var k = 0
  var lib = $scope.librairie
  for (i; i < lib.length; i++) {
    for (k; k < lib[i].modeles.length; k++) {
      if (lib[i].modeles[k].nom === item.nom) {
        lib[i].modeles.splice(k,1)
      }
    }
  }
}

}])
