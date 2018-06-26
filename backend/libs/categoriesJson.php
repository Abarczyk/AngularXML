<?php

include "maLibSQL.pdo.php";
include "modele.php";
// création du Json
$Tabmodels = [];
$categories = selectbdd('nom,modeles','categories');

for ($i=0; $i < count($categories); $i++) {
  $categories[$i]['modeles'] = explode(',',$categories[$i]['modeles']);
}



$categories = json_encode($categories, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
echo $categories;
