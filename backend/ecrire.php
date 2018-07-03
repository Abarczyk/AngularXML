<?php
$Tab = json_decode($_POST['json']);
/*
  creation du nom : NOM_ANNEE_MOIS_JOUR_HEURE_MINUTE_SECONDE.xml

$date = new DateTime();
$tz = new DateTimeZone('Europe/Paris');
$date->setTimezone($tz);
$date  = explode(':',$date->format('Y:m:d:H:i:s'));
$Tab->nom = $Tab->nom . '_' . $date[0] . '_' . $date[1] . '_' . $date[2] . '_' . $date[3] . '_' . $date[4] . '_' . $date[5];

*/

$xml_fic = fopen("../assets/xml/" . $Tab->nom . ".xml",'w+');
/*
  creation de la structure du XML (en-tête)
*/
$xml_doc = new DOMDocument('1.0', 'utf-8');
/*
  Informations concernant le modèle choisi
*/
$xml_doc->appendChild($info_Modele = $xml_doc->createElement('Infos_Modele'));
$info_Modele->setAttribute('nom',$Tab->nom);
$info_Modele->setAttribute('description',$Tab->description);

foreach ($Tab->fct as $value) {
  echo "<pre> fonction : ";
  var_dump($value);
  echo "<pre>";
  /*
    on a acces à un objet contenant :
    - nom             (nom de la fonction)
    - champs          (tableau de sous champs de la fonction)
  */
  $xml_doc->appendChild($fct = $xml_doc->createElement($value->nom));
  foreach ($value->champs as $key) {
    echo "<pre> champs : ";
    var_dump($key);
    echo "<pre>";
    /*
      on a acces à un objet contenant :
      - nom           (affiché sur le web)
      - name          (nom technique du champ)
      - unit          (unité du champ)
      - typeinput     (type de l'input web)
      - valeur        (valeur remplie par l'utilisateur - non par defaut - )
    */
    $fct->appendChild($xml_doc->createElement($key->name,$key->valeur));
  }
}

/*
  auto indentation du xml (plus lisible)
*/
$xml_doc->formatOutput = TRUE;
/*
  on sauvegarde l'xml sous forme d'une chaine de caractère
*/
$xml_string = $xml_doc->saveXML();

/*
  on écrit dans le fichier
*/
fwrite($xml_fic, $xml_string);
/*
  on ferme le fichier
*/
fclose($xml_fic);
