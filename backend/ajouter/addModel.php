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

$flag = true;
while ($flag) {
  $nom = sprintf('%05u',rand(0,99999));
  $query = selectbdd('*','modeles',"nom like '" . $nom . "'");
  if (!$query) {
    $flag = false;
  }
}
$mdls = selectbdd('modeles','categories',"nom like '" . $modele->category->nom . "'");
if ($mdls != "") {
$mdls .= ',' . $nom;
}else{
  $mdls = $nom;
}

$strFct = "";
for ($i=0; $i < count($modele->fct); $i++) {
  $strFct .= $modele->fct[$i]->nom . ',';
  for ($k=0; $k < count($modele->fct[$i]->champs); $k++) {
    $champ = selectbdd('*','champs',"name like'" . $modele->fct[$i]->champs[$k] . "'");
    newChamps(
      $champ[0]['name'],
      $nom,
      $champ[0]['nom'],
      $champ[0]['typeinput'],
      $champ[0]['unit'],
      $champ[0]['valeur'],
      $champ[0]['default_select']);
  }
}
/*
  on enleve la virgule de la fin
*/
$strFct = substr($strFct, 0, -1);

var_dump($mdls);
updatebdd('categories',"modeles = '" . $mdls . "'","WHERE nom like '" . $modele->category->nom . "'");

newModele($nom,$modele->description,$strFct);

CreateModels();
