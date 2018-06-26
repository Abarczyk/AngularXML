<?php


/**
 * @file maLibUtils.php
 * Ce fichier définit des fonctions d'acces ou d'affichage pour les tableaux superglobaux
 */

/**
 * Verifie l'existence (isset) et la taille (non vide) d'un parametre dans un des tableaux GET, POST, COOKIES, SESSION
 * Renvoie false si le parametre est vide ou absent
 * @note l'utilisation de empty est critique : 0 est empty !!
 * Lorsque l'on teste, il faut tester avec un ===
 * @param string $nom
 * @param string $type
 * @return string|boolean
 */
function valider($nom,$type="REQUEST")
{	
	switch($type)
	{
		case 'REQUEST': 
		if(isset($_REQUEST[$nom]) && !($_REQUEST[$nom] == "")) 	
			return proteger($_REQUEST[$nom]); 	
		break;
		case 'GET': 	
		if(isset($_GET[$nom]) && !($_GET[$nom] == "")) 			
			return proteger($_GET[$nom]); 
		break;
		case 'POST': 	
		if(isset($_POST[$nom]) && !($_POST[$nom] == "")) 	
			return proteger($_POST[$nom]); 		
		break;
		case 'COOKIE': 	
		if(isset($_COOKIE[$nom]) && !($_COOKIE[$nom] == "")) 	
			return proteger($_COOKIE[$nom]);	
		break;
		case 'SESSION': 
		if(isset($_SESSION[$nom]) && !($_SESSION[$nom] == "")) 	
			return $_SESSION[$nom]; 		
		break;
		case 'SERVER': 
		if(isset($_SERVER[$nom]) && !($_SERVER[$nom] == "")) 	
			return $_SERVER[$nom]; 		
		break;
	}
	return false; // Si pb pour recuperer la valeur 
}


/**
 * Verifie l'existence (isset) et la taille (non vide) d'un parametre dans un des tableaux GET, POST, COOKIE, SESSION
 * Prend un argument definissant la valeur renvoyee en cas d'absence de l'argument dans le tableau considere
 * @param string $nom
 * @param bool $defaut
 * @param string $type
 * @return string
 */
function getValue($nom,$defaut=false,$type="REQUEST")
{
	// NB : cette commande affecte la variable resultat une ou deux fois
	if (($resultat = valider($nom,$type)) === false)
		$resultat = $defaut;

	return $resultat;
}

/**
 *
 * Evite les injections SQL en protegeant les apostrophes par des '\'
 * Attention : SQL server utilise des doubles apostrophes au lieu de \'
 * ATTENTION : LA PROTECTION N'EST EFFECTIVE QUE SI ON ENCADRE TOUS LES ARGUMENTS PAR DES APOSTROPHES
 * Y COMPRIS LES ARGUMENTS ENTIERS !!
 * @param string $str
 * @return array|string
 */
function proteger($str)
{
	// attention au cas des select multiples !
	// On pourrait passer le tableau par reference et eviter la creation d'un tableau auxiliaire
	if (is_array($str))
	{
		$nextTab = array();
		foreach($str as $cle => $val)
		{
			$nextTab[$cle] = addslashes($val);
		}
		return $nextTab;
	}
	else 	
		return addslashes ($str);
	//return str_replace("'","''",$str); 	//utile pour les serveurs de bdd Crosoft
}


/**
 * @param $tab
 */
function tprint($tab)
{
	echo "<pre>\n";
	print_r($tab);
	echo "</pre>\n";	
}


/**
 * @param $url
 */
function rediriger($url)

{
	//redirection e l'url envoye
	header("Location:$url");
	die(""); // interrompt l'interpretation du code 

}