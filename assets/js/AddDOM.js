App.service("AddDOM", ['$http', function ($http) {
  var add = this
  add.mdl = mdl            // donne l'acces à champ()

  var fonctions = getlocalStorage('fonctions')

  function mdl(data){
    /* on recoit un objet de type Json de la forme :
      {
          "nom": "bouh",
          "description": "bouh",
          "fct": [
              "rotate",
              "customerinfo"
          ]
      }
    */
    let dom = document.querySelector("#form")
    dom.innerHTML = ""
    let legend = document.createElement("legend")
    legend.innerHTML = data.nom
    dom.append(legend)
    for (var i = 0; i < data.fct.length; i++) {
      let index = findFct(data.fct[i])
      fct(fonctions[index])
    }

    endMdl();

  }

  function fct(data){
    /* on recoit un objet de type Json de la forme :
    {
        "nom": "AddBlanc",
        "description": "Ajouter des blancs sur les bords",
        "champs": [tableau de champs (voir ci dessous)]
    }
    */
    let dom = document.querySelector("#form")
    let title = document.createElement("h1")
    let para = document.createElement("p")
    para.innerHTML = data.description
    title.setAttribute("class","title")
    title.innerHTML = data.nom

    dom.append(title)
    dom.append(para)
    for (var i = 0; i < data.champs.length; i++) {
      champ(data.champs[i][0])
    }
  }

  function champ(data){
    /* on recoit un objet de type Json de la forme :
     {
          "nom": "Ajouter blanc en haut",
          "typeinput": "text",
          "name": "AddBlancUp",
          "unit": "mm"
        }
    */
    let dom = document.querySelector("#form")
    let label = document.createElement("label")
    let input = document.createElement("input")
    let br = document.createElement("br")

    input.setAttribute("name",data.name)
    input.setAttribute("type",data.typeinput)
    input.setAttribute("ng-model","input." + data.name)

    label.innerHTML = data.nom

    dom.append(label)
    dom.append(br)
    label.append(input)
    label.append(data.unit)
    dom.append(br)


  }

  function findFct(name){
    for (var i = 0; i < fonctions.length; i++) {
      if (fonctions[i].nom == name) {
        return i
      }
    }
  }

  function getlocalStorage(data){
    return JSON.parse(localStorage.getItem(data))
  }

  function endMdl(){
    let dom = document.querySelector("#form")
    let reset = document.createElement("input")
    reset.setAttribute("class","push_button")
    reset.setAttribute("type","submit")
    reset.setAttribute("ng-click","reset()")
    reset.setAttribute("value","Reset")
    let save = document.createElement("input")
    save.setAttribute("class","push_button")
    save.setAttribute("type","submit")
    save.setAttribute("ng-click","update(input)")
    save.setAttribute("value","Save")
    dom.append(reset)
    dom.append(save)




  }

}])
