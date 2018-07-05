<?php
include "libs/modele.php";
$nom = $_POST['json'];
if ($nom) {
    $nom = str_replace("\"","",$nom);
    deletebdd('modeles',"WHERE nom like '" . $nom . "'");
    deletebdd('champs',"WHERE modele like '" . $nom . "'");
    $modeles = selectbdd('modeles','categories',"modeles like '%" . $nom . "%'");
    echo "avant : ";
    var_dump($modeles);
    $modeles = explode(',',$modeles);
    $index = -1;
    for ($i=0; $i < count($modeles); $i++) {
      if ($modeles[$i] == $nom) {
        $index = $i;
      }
    }
    $strMdls = "";
    for ($i=0; $i < count($modeles); $i++) {
      if ($i != $index) {
        $strMdls .= $modeles[$i]  .',';
      }
    }
    $strMdls = substr($strMdls, 0, -1);
    echo "apres : ";
    var_dump($strMdls);
    updatebdd('categories',"modeles = '" . $strMdls . "'","WHERE modeles like '%" . $nom . "%'");
    array_map('unlink', glob("../assets/xml/" . $nom . ".xml"));
}
