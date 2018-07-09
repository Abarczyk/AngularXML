<?php
include_once("maLibSQL.pdo.php");


function selectbdd($champ, $table, $condition = "1", $order = "1",$distinct = "")
{
    if ($distinct != ""){
        $distinct = "Select DISTINCT";
    }else{
        $distinct = "Select";
    }
    if ($champ == "*") {
        $SQL = "$distinct $champ from $table WHERE $condition ORDER BY $order";
        return parcoursRs(SQLSelect($SQL));
    }else if(stristr($champ,',') !== false) {
      $SQL = "$distinct $champ FROM $table WHERE $condition ORDER BY $order";
      return parcoursRs(SQLSelect($SQL));
    } else {
        $SQL = "$distinct $champ FROM $table WHERE $condition ORDER BY $order";

            return SQLGetChamp($SQL);
    }

}

function deletebdd($table, $condition = "WHERE 0")
{
    $SQL = "DELETE FROM $table $condition";
    return SQLDelete($SQL);
}

function updatebdd($table, $champs, $condition = "WHERE 1")
{
    $SQL = "UPDATE $table SET $champs $condition";
    return SQLUpdate($SQL);
}

function newModele($name,$description,$fonctions){
  $description = checkRequest($description);

    $SQL = "INSERT INTO modeles(nom,description,fct) VALUES('$name','$description','$fonctions')";
    return SQLInsert($SQL);
}

function newFonction($name,$description,$champs){
  $description = checkRequest($description);

    $SQL = "INSERT INTO fonctions(nom,description,champs) VALUES('$name','$description','$champs')";
    return SQLInsert($SQL);
}

function newChamps($name,$modele,$nom,$typeinput,$unit,$valeur,$default_select){
  $description = checkRequest($description);
    $SQL = "INSERT INTO champs(name,modele,nom,typeinput,unit,valeur,default_select) VALUES('$name','$modele','$nom','$typeinput','$unit','$valeur','$default_select')";
    return SQLInsert($SQL);
}

function newCategory($name,$modeles){
    $SQL = "INSERT INTO categories(nom,modeles) VALUES('$name','$modeles')";
    return SQLInsert($SQL);
}

function checkRequest($str){
  $str = str_replace("'","<apstrph>", $str);
  $str = str_replace('"',"<apstrph>", $str);
  return $str;
}
function loadRequest($str){
  return str_replace("<apstrph>","'", $str);
}
