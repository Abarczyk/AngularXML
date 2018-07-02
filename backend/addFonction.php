<?php
include "libs/CreateJson.php";
/*
  on reçoit un objet du type :
  {
      "nom": "AddBlanc",
      "description": "Ajouter des blancs sur les bords",
      "champs": [
          "AddBlancUp",
          "AddBlancDown",
          "AddBlancLeft",
          "AddBlancRight"
      ]
  }
*/

$fonction = json_decode($_POST['json']);

$strChps = "";
for ($i=0; $i < count($fonction->champs); $i++) {
  $strChps .= $fonction->champs[$i]->name . ',';
}
/*
  on enleve la virgule de la fin
*/
$strChps = substr($strChps, 0, -1);

newFonction($fonction->nom,$fonction->description,$strChps);
CreateFonctions();
