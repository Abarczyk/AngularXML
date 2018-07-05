
App.controller('XMLController', ['$scope','AjaxService','AddDOM',function ($scope,$AjaxService,$AddDOM) {

    var ctrl = this
    ctrl.getlocalStorage = getlocalStorage


    /*
      objet de transition avec la bdd
    */
    $scope.master = {}

    init()


    function getlocalStorage(data){
        return JSON.parse(localStorage.getItem(data))
    }

    function init(){
          /* rechargement de la base de donnée */
        let promise = $AjaxService.get("backend/reload.php")
        promise.then(function(response){
            /* on attend que reload.php ai fini de créer les Json*/

            loadLibrairie().then(function(response){
              loadCategories().then(function(response){
                loadModels().then(function(response) {
                  loadFct().then(function(response){
                    loadChamps()
                  })
                })
              })
            })


        })
    }

    function loadLibrairie(){
      var librairie = "assets/json/librairie.json"
      let promise = $AjaxService.get(librairie)
      return promise.then(function(response){
          /* on attend que les données soient récupérées puis on les ranges dans la librairie*/
          $scope.librairie = angular.copy(response.data)
          console.log("librairie " + librairie + " chargée")

      })
    }

    function loadCategories(){
      var categories = "assets/json/categories.json"
      let promise = $AjaxService.get(categories)
      return promise.then(function(response){
          $scope.categories = angular.copy(response.data)
          console.log("librairie " + categories + " chargée")
      })
    }

    function loadModels(){
      var modeles = "assets/json/models.json"

      let promise = $AjaxService.get(modeles)
      return promise.then(function(response){
          $scope.modeles = angular.copy(response.data)
          console.log("librairie " + modeles + " chargée")

      })
    }

    function loadChamps(){
      var champs = "assets/json/champs.json"


      let promise = $AjaxService.get(champs)
      return promise.then(function(response){
          $scope.champs = angular.copy(response.data)
          console.log("librairie " + champs + " chargée")
      })
    }

    function loadFct(){
      var fonctions = "assets/json/fonctions.json"

      let promise = $AjaxService.get(fonctions)
      return promise.then(function(response){
          $scope.fonctions = angular.copy(response.data)
          console.log("librairie " + fonctions + " chargée")

      })
    }

    /*
      Edition d'un modèle avant création de l'xml
    */
    $scope.edit = function(item){
        $scope.modele = item
        console.log('modele :', $scope.modele)
    }

    /*
      Creation de l'xml
    */
    $scope.update = function(item) {
        console.log('envoi : ', item);
        $scope.master = angular.copy(item)
        $AjaxService.post('backend/ecrire.php',$scope.master)
    }

    /*
      Copie d'un modèle
    */
    $scope.copy = function(item) {
        var copy = angular.copy(item)
        copy.nom = copy.nom + '_2'
        console.log("copie :",copy)
        var lib = $scope.librairie

        /*
          on modifie le nom suivant les doublons
        */
        for (var i = 0; i < lib.length; i++) {
            for (var k = 0; k < lib[i].modeles.length; k++) {
                if (lib[i].modeles[k].nom === copy.nom) {
                    copy.nom += '_2'
                }
            }
        }
        /*
          on pousse la copie dans la librairie
        */
        for (var i = 0; i < lib.length; i++) {
            for (var k = 0; k < lib[i].modeles.length; k++) {
              if (lib[i].modeles[k].nom === item.nom) {
                  lib[i].modeles.push(copy)
                  copy.category = { "nom" : lib[i].nom }
                  console.log('librairie :', $scope.librairie)
                  $AjaxService.post('backend/addModel.php',copy)
                  return
              }
            }
        }

    }

    /*
      Suppression d'un modèle
    */

    $scope.remove = function(item) {

        let i = 0
        let k = 0
        let lib = $scope.librairie

        for (i; i < lib.length; i++) {
            for (k; k < lib[i].modeles.length; k++) {
                if (lib[i].modeles[k].nom == item.nom) {
                    lib[i].modeles.splice(k,1)
                }
          }
          k = 0
        }
        $AjaxService.post('backend/remove.php',item.nom)
    }
    /*
      Ajout d'un modèle
    */

    $scope.addModel = function(item){
        console.log('envoi : ', item);
        $scope.master = angular.copy(item)
        $AjaxService.post('backend/addModel.php',$scope.master)
        init()
    }
    /*
      Ajout d'une fonction
    */

    $scope.addFct = function(item){
        console.log('envoi : ', item);
        $scope.master = angular.copy(item)
        $AjaxService.post('backend/addFonction.php',$scope.master)
        init()
    }
    /*
      Ajout d'une catégorie
    */

    $scope.addCat = function(item){
        console.log('envoi : ', item);
        $scope.master = angular.copy(item)
        $AjaxService.post('backend/addCategory.php',$scope.master)
        init()
    }
    /*
      Ajout d'un champ
    */

    $scope.addChps = function(item){
        console.log('envoi : ', item);
        $scope.master = angular.copy(item)
        $AjaxService.post('backend/addChamp.php',$scope.master)
        init()
    }


}])
