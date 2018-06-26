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
  $Json = fopen('../assets/json/models.json', 'w+');
  $models = selectbdd('nom,description,fct','modeles');

  for ($i=0; $i < count($models); $i++) {
    $models[$i]['fct'] = explode(',',$models[$i]['fct']);
    for ($k=0; $k < count($models[$i]['fct']); $k++) {
      $models[$i]['fct'][$k] = selectbdd('nom,champs','fonctions', "nom like '". $models[$i]['fct'][$k]. "'");
      $models[$i]['fct'][$k][0]['champs'] = explode(',',$models[$i]['fct'][$k][0]['champs']);
        for ($l=0; $l < count($models[$i]['fct'][$k][0]['champs']); $l++) {
          $models[$i]['fct'][$k][0]['champs'][$l] = selectbdd('nom,typeinput,name,unit,valeur','champs',"name like '" . $models[$i]['fct'][$k][0]['champs'][$l] ."'");
        }
    }
  }

  $models = json_encode($models, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  fwrite($Json, $models);
  fclose($Json);
}

/*
  fonction de création de la librairie entiere (categories -> modeles -> fonctions -> champs)
*/
function createLibrairie(){
  // création du Json

  $Json = fopen('../assets/json/librairie.json', 'w+');
  $categories = selectbdd('id,nom,modeles','categories');

  for ($p=0; $p < count($categories); $p++) {
    /*
      $categories[$p]['modeles'] contient la chaine de caractère des modèles de la catégorie
      on transforme cette chaine en un tableau donné par explode(',',$categories[$p]['modeles']) qui range chaque modele dans une case
    */
    $categories[$p]['modeles'] = explode(',',$categories[$p]['modeles']);
    for ($j=0; $j < count($categories[$p]['modeles']); $j++) {
      /*
        $categories[$p]['modeles'][$j] contient le nom du modèle en case J
        on recherche toutes les informations liées à ce nom dans la table modeles et on remplace le nom par toutes les données
      */
      $categories[$p]['modeles'][$j] = selectbdd('nom,description,fct','modeles',"nom like '" . $categories[$p]['modeles'][$j] . "'");
        /*
          $categories[$p]['modeles'][$j][$i]['fct'][0] contient la chaine de caractères des fonctions du modèle n°j de la catégorie n°p
          [0] à  cause de la fonction selectbdd
          on transforme cette chaine en un tableau donné par explode(',',$categories[$p]['modeles'][$j][0]['fct']) qui range chaque fonction dans une case
        */
        $categories[$p]['modeles'][$j][0]['fct'] = explode(',',$categories[$p]['modeles'][$j][0]['fct']);
        for ($k=0; $k < count($categories[$p]['modeles'][$j][0]['fct']); $k++) {
          /*
            $categories[$p]['modeles'][$j][0]['fct'][$k] contient le nom du fonction en case k
            on recherche toutes les informations liées à ce nom dans la table fonctions et on remplace le nom par toutes les données
          */
          $categories[$p]['modeles'][$j][0]['fct'][$k] = selectbdd('nom,champs','fonctions', "nom like '". $categories[$p]['modeles'][$j][0]['fct'][$k]. "'");

          /*
            $categories[$p]['modeles'][$j][0]['fct'][$k][0]['champs'] contient la chaine de caractères des champs de al fonction n°k du modèle n°j de la catégorie n°p
            [0] à  cause de la fonction selectbdd
            on transforme cette chaine en un tableau donné par explode(',',$categories[$p]['modeles'][$j][0]['fct'][$k][0]['champs']) qui range chaque champ dans une case
          */
          $categories[$p]['modeles'][$j][0]['fct'][$k][0]['champs'] = explode(',',$categories[$p]['modeles'][$j][0]['fct'][$k][0]['champs']);
            for ($l=0; $l < count($categories[$p]['modeles'][$j][0]['fct'][$k][0]['champs']); $l++) {
              /*
                $categories[$p]['modeles'][$j][0]['fct'][$k][0]['champs'][$l] contient le nom du fonction en case l
                on recherche toutes les informations liées à ce nom dans la table champs et on remplace le nom par toutes les données
              */

              $categories[$p]['modeles'][$j][0]['fct'][$k][0]['champs'][$l] = selectbdd('nom,typeinput,name,unit,valeur','champs',"name like '" . $categories[$p]['modeles'][$j][0]['fct'][$k][0]['champs'][$l] ."'");
            }
        }
    }
  }


  /*
   on transforme ce tableau en un Json
  */
  $categories = json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
  /*
    on écrit dans le fichier
  */
  fwrite($Json, $categories);
  /*
    on ferme le fichier
  */
  fclose($Json);
}

 ?>
