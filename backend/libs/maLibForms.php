<?php


/*
Ce fichier definit diverses fonctions permettant de faciliter la production de mises en formes complexes :
tableaux, formulaires, ...
*/
// Exemple d'appel :  mkLigneEntete($data,array('pseudo', 'couleur', 'connecte'));
function mkLigneEntete($tabAsso, $listeChamps = false)
{
    // Fonction appelee dans mkTable, produit une ligne d'entete
    // contenant les noms des champs e afficher dans mkTable
    // Les champs e afficher sont definis e partir de la liste listeChamps
    // si elle est fournie ou du tableau tabAsso

    if (!$listeChamps)    // listeChamps est faux  : on utilise le not : '!'
    {
        // tabAsso est un tableau associatif dont on affiche TOUTES LES CLES
        echo "\t<tr>\n";
        foreach ($tabAsso as $cle => $val) {
            echo "\t\t<th>$cle</th>\n";
        }
        echo "\t</tr>\n";
    } else        // Les noms des champs sont dans $listeChamps
    {
        echo "\t<tr>\n";
        foreach ($listeChamps as $nomChamp) {
            echo "\t\t<th>$nomChamp</th>\n";
        }
        echo "\t</tr>\n";
    }
}

function mkLigne($tabAsso, $listeChamps = false)
{
    // Fonction appelée dans mkTable, produit une ligne
    // contenant les valeurs des champs e afficher dans mkTable
    // Les champs e afficher sont definis e partir de la liste listeChamps
    // si elle est fournie ou du tableau tabAsso

    if (!$listeChamps)    // listeChamps est faux  : on utilise le not : '!'
    {
        // tabAsso est un tableau associatif
        echo "\t<tr>\n";
        foreach ($tabAsso as $cle => $val) {
            echo "\t\t<td>$val</td>\n";
        }
        echo "\t</tr>\n";
    } else    // les champs à afficher sont dans $listeChamps
    {
        echo "\t<tr>\n";
        foreach ($listeChamps as $nomChamp) {
          // vérifie l'existance du nomChamp dans tabAsso
          if (!isset($tabAsso[$nomChamp])) {
            if ($nomChamp === 'Actions') {
              echo "\t\t<td><button>Supprimer</button></td>\n";
            }
          }else {
            echo "\t\t<td>$tabAsso[$nomChamp]</td>\n";
          }
        }
        echo "\t</tr>\n";
    }
}

// Exemple d'appel :  mkTable($users,array('pseudo', 'couleur', 'connecte'));
function mkTable($tabData, $listeChamps = false, $attrs = "")
{

    // Attention : le tableau peut etre vide
    // On produit un code ROBUSTE, donc on teste la taille du tableau
    if (count($tabData) == 0) return;

    echo "<table $attrs border=\"1\">\n";
    // afficher une ligne d'entete avec le nom des champs
    mkLigneEntete($tabData[0], $listeChamps);

    //tabData est un tableau indice par des entier
    foreach ($tabData as $data) {
        // afficher une ligne de donnees avec les valeurs, e chaque iteration
        mkLigne($data, $listeChamps);
    }
    echo "</table>\n";

    // Produit un tableau affichant les donnees passees en parametre
    // Si listeChamps est vide, on affiche toutes les donnees de $tabData
    // S'il est defini, on affiche uniquement les champs listes dans ce tableau,
    // dans l'ordre du tableau

}


/**
 * @param string $action
 * @param $name
 * @param string $method
 * @param string $attrs
 */
function mkForm($action = "", $name, $method = "get", $attrs = "")
{
    if ($name) {
        // Produit une balise de formulaire NB : penser e la balise fermante !!
        echo "<form  $attrs action=\"$action\" method=\"$method\" >\n<legend class='title'>" . $name . "</legend>\n";
    } else {
        echo "<form  $attrs action=\"$action\" method=\"$method\" >\n";
    }
}

/**
 *
 */
function endForm()
{
    // produit la balise fermante
    echo "</form>\n";
}

/**
 * @param $type
 * @param $name
 * @param string $value
 * @param string $attrs
 * @param int $surround
 */
function mkInput($type, $name, $value = "",$placeholder = "", $attrs = "", $surround = 0)
{
    if ($type === 'text' || $type === "password") {
        echo "<div><label for=\"$name\">$value</label>\n<div><input $attrs type=\"$type\" name=\"$name\" value = \"$placeholder\"/></div></div>\n";
    } else if ($type === 'textarea') {
        echo "<div $attrs><label for=\"$name\">$name</label>\n<div><textarea style='resize: none;' cols=\"100\" rows=\"10\" name=\"$name\">$value</textarea></div></div>\n";
    } else if ($surround == 0) {
        // Produit un champ formulaire
        echo "<input $attrs type=\"$type\" name=\"$name\" value=\"$value\"/>\n";
    } else {
        echo "<div><input type=\"$type\" name=\"$name\" value=\"$value\" $attrs /></div>\n";
    }
}


function mkLien($url, $label, $qs = "", $attrs = "")
{
    if ($qs) {
        echo "<a $attrs href=\"$url&$qs\">$label</a>\n";
    } else {
        echo "<a $attrs href=\"$url\">$label</a>\n";
    }
}

function mkTitle($titre,$attrs ="")
{
    echo "<hr>
    <div class=\"title\" $attrs >$titre</div>
    <hr>";
}
?>
