<?php
include "../libs/CreateJson.php";


/* On reçoit un objet du type :
{
    "nom": "Ajouter blanc en bas",
    "typeinput": "text",
    "unit": "mm",
    "name": "AddBlancDown",
    "valeur": "non",
    "default_select": [
        ""
    ]
}
*/
$champ = json_decode($_POST['json']);
if (!$champ->valeur) {
  $champ->valeur = "false";
}
newChamps($champ->name,$champ->nom,$champ->typeinput,$champ->unit,$champ->valeur,$champ->default_select);
CreateChamp();
