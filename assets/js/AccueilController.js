App.controller('AccueilController', ['$scope', '$http','AjaxService', function($scope, $http, $AjaxService) {
  form = document.querySelector("#form");

  $AjaxService.request('GET',"assets/json/categories.json","json","")

  $http.get("assets/json/categories.json").then(function(response) {
          $scope.categories = response.data
      })
      .catch(function(error){
          console.log(error)
      })

  $http.get("assets/json/models.json").then(function(response) {
          $scope.models = response.data
      })
      .catch(function(error){
          console.log(error)
      })

  $http.get("assets/json/fonctions.json").then(function(response) {
          $scope.fonctions = response.data

      })
      .catch(function(error){
          console.log(error)
      })

  $scope.generer = function(){
    form.innerHTML = ""
    var model = this.findModel()
    var fct = []
    model.fct.forEach(function(value){
      fct.push($scope.findFct(value))
    })
    console.log()
    fct.forEach(function(value){
    $scope.field(value)
    })
    $scope.toggleShow()
    $scope.SubInput()
  }

  $scope.findModel = function(){
    for (var i = 0; i < this.models.length; i++) {
      if (this.models[i].nom === this.Model) {
        return this.models[i]
      }
    }
  }

  $scope.toggleShow = function(){
    angular.element(document.getElementById('btn_selection')).toggleClass('hidden')
    angular.element(document.getElementById('Selection')).toggleClass('hidden')
    angular.element(document.getElementById('form')).toggleClass('hidden')
  }


  $scope.findFct = function(name){
    for (var i = 0; i < this.fonctions.length; i++) {
      if (this.fonctions[i].nom === name) {
        return this.fonctions[i]
      }
    }
  }

  $scope.Input = function(item){
    //champ
    var br = document.createElement('br')
    var label = document.createElement('label')
    label.innerHTML = item[0].label
    form.append(label)
    form.append(br)
    var input = document.createElement('input')
    input.setAttribute('type',item[0].typeinput)
    input.setAttribute('name',item[0].name)
    form.append(input)
    form.append(br)
  }

  $scope.field = function(item){
    // fonction
    var br = document.createElement('br')
    var h1 = document.createElement('h1')
    h1.setAttribute('id',item.nom)
    h1.setAttribute('class','title')
    h1.innerHTML = item.description
    form.append(h1)
    form.append(br)
    item.champs.forEach(function(value){
      $scope.Input(value)
    })
  }

  $scope.SubInput = function(){
    //submit
    var submit = document.createElement('input')
    submit.setAttribute('type','submit')
    submit.setAttribute('name','action')
    submit.setAttribute('class','push_button')
    form.append(submit)
  }
}])
