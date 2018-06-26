<?php

include "maLibSQL.pdo.php";
include "modele.php";

function CreateCategorie(){
  // création du Json
  $Tabmodels = [];
  $Json = fopen('../assets/json/categories.json', 'w+');
  $categories = selectbdd('nom,modeles','categories');

  for ($i=0; $i < count($categories); $i++) {
    $categories[$i]['modeles'] = explode(',',$categories[$i]['modeles']);
  }



  $categories = json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  fwrite($Json, $categories);
  fclose($Json);
}

function CreateModels(){
  // création du Json
  $Tabmodels = [];
  $Json = fopen('../assets/json/models.json', 'w+');
  $models = selectbdd('nom,description,fct','modeles');

  for ($i=0; $i < count($models); $i++) {
    $models[$i]['fct'] = explode(',',$models[$i]['fct']);
  }
  $models = json_encode($models, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  fwrite($Json, $models);
  fclose($Json);
}

function CreateFonctions(){
  // création du Json
  $Tabmodels = [];
  $Json = fopen('../assets/json/fonctions.json', 'w+');
  $fonctions = selectbdd('nom,description,champs','fonctions');

  for ($i=0; $i < count($fonctions); $i++) {
    $fonctions[$i]['champs'] = explode(',',$fonctions[$i]['champs']);
  }

  for ($i=0; $i < count($fonctions); $i++) {
    for ($k=0; $k < count($fonctions[$i]['champs']); $k++) {
        $fonctions[$i]['champs'][$k] = selectbdd('name,nom,typeinput,unit','champs',"name like '" . $fonctions[$i]['champs'][$k] . "'");
      }
  }



  $fonctions = json_encode($fonctions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  fwrite($Json, $fonctions);
  fclose($Json);
}

function CreateChamps(){
  // création du Json
  $Tabmodels = [];
  $Json = fopen('../assets/json/champs.json', 'w+');
  $champs = selectbdd('nom,typeinput,name,unit','champs');



  $champs = json_encode($champs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  fwrite($Json, $champs);
  fclose($Json);
}



 ?>
