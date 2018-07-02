<?php
include "libs/CreateJson.php";


/* On reçoit un objet du type :
  [
    {
      "nom": "modele4444",
      "description": "début juillet 2018",
      "fct": [
        [
          {
            "nom": "nom",
            "champs": [
              [
                {
                  "nom": "nom",
                  "typeinput": "text",
                  "name": "name",
                  "unit": "unit",
                  "valeur": "non"
                }
              ],
              [
                {
                  "nom": "nom",
                  "typeinput": "typeinput",
                  "name": "name",
                  "unit": "unit",
                  "valeur": "non"
                }
              ]
            ]
          }
        ]
      ]
    }
  ]
*/

$modele = json_decode($_POST['json']);

$strFct = "";
for ($i=0; $i < count($modele->fonction); $i++) {
  $strFct .= $modele->fonction[$i]->nom . ',';
}
/*
  on enleve la virgule de la fin
*/
$strFct = substr($strFct, 0, -1);

$mdls = selectbdd('modeles','categories',"nom like '" . $modele->category->nom . "'");
if ($mdls != "") {
$mdls .= ',' . $modele->nom;
}else{
  $mdls = $modele->nom;
}
var_dump($mdls);
updatebdd('categories',"modeles = '" . $mdls . "'","WHERE nom like '" . $modele->category->nom . "'");

newModele($modele->nom,$modele->description,$strFct);

CreateModels();
