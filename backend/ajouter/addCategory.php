<?php
include "libs/CreateJson.php";


/* On reçoit un objet du type :
{
    "nom": "cat1",
    "modeles": [
        "modele1575"
    ]
}
*/

$category = json_decode($_POST['json']);
$mdls = "";
newCategory($category->nom,$mdls);

CreateCategorie();
