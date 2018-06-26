<?php
$accueil = "index.php?view=accueil";
$connexion = "index.php?view=connexion";
include_once "libs/maLibUtils.php";
include_once "libs/maLibSQL.pdo.php";
include_once "libs/maLibSecurisation.php";
include_once "libs/modele.php";

if ($action = valider("action")) {
    session_start();
    ob_start();
    echo "Action = '$action' <br/>";

    switch ($action) {


        case 'Rechercher':
        $objet = valider("objet");
        $objet = preg_replace("#[^a-zA-Z -]#", '', iconv('UTF-8', 'ASCII//TRANSLIT', $objet));
        $objet = preg_replace("# #", "+", $objet);
        //nettoyage de la chaine de recherche
        break;

        case 'Ajouter':
        switch ($_POST['type']) {
          case 'modeles':

          $rempli = true;
          valider('nom') ? $name = valider('nom') : $rempli = false;
          valider('description') ? $description = valider('description') : $rempli = false;
          valider('fonctions') ? $fonctions = valider('fonctions') : $rempli = false;
          valider('categorie') ? $categorie = valider('categorie') : $rempli = false;

          if ($rempli) {
          $strFct = "";
          foreach ($fonctions as $value) {
            $strFct .= $value . ',';
          }
          $strFct = substr($strFct, 0, -1);
          newModele($name,$description,$strFct);
          $modeles = selectbdd('modeles','categories',"nom like '" . $categorie . "'");
          $modeles .= "," . $name;
          updatebdd('categories',"modeles = '" . $modeles . "'","WHERE nom like '".$categorie . "'");
          rediriger('index.php?view=add&q=modeles');
        }else{
          rediriger('index.php?view=add&q=modeles&msg=Veuillez%20remplir%20tous%20les%20champs.');
        }
            break;
          case 'fonctions':
          $rempli = true;
            valider('nom') ? $name = valider('nom') : $rempli = false;
            valider('description') ? $description = valider('description') : $rempli = false;
            valider('champs') ? $champs = valider('champs') : $rempli = false;

            if ($rempli) {
            $strChmps = "";
            foreach ($champs as $value) {
              $strChmps .= $value . ',';
            }
            $strChmps = substr($strChmps, 0, -1);
            newFonction($name,$description,$strChmps);
            rediriger('index.php?view=add&q=fonctions');
          }else{
            rediriger('index.php?view=add&q=fonctions&msg=Veuillez%20remplir%20tous%20les%20champs.');
          }

            break;
          case 'champs':
          $rempli = true;
            valider('nom') ? $name = valider('nom') : $rempli = false;
            valider('label') ? $label = valider('label') : $rempli = false;
            valider('typeinput') ? $typeinput = valider('typeinput') : $rempli = false;
            $unit = valider('unit');

            if ($rempli) {
            newChamps($name,$label,$typeinput,$unit);
            rediriger('index.php?view=add&q=champs');
          }else{
            rediriger('index.php?view=add&q=champs&msg=Veuillez%20remplir%20tous%20les%20champs.');
          }

            break;


            case 'categories':
            $rempli = true;
              valider('nom') ? $name = valider('nom') : $rempli = false;
              valider('modeles') ? $modeles = valider('modeles') : $rempli = false;
              if ($rempli) {
                $strCat = "";
                foreach ($modeles as $value) {
                  $strCat .= $value . ',';
                }
                $strCat = substr($strCat, 0, -1);
                newCategory($name,$strCat);
                rediriger('index.php?view=add&q=categories');
              }else{
                rediriger('index.php?view=add&q=categories&msg=Veuillez%20remplir%20tous%20les%20champs.');
              }
              break;

        }

          break;

    }
}
