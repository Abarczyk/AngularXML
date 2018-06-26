<?php

include_once "maLibUtils.php";	// Car on utilise la fonction valider()
include_once "modele.php";	// Car on utilise la fonction connecterUtilisateur()

/**
 * @file email.php
 * Fichier contenant des fonctions de verification de emails
 */

/**
 * Cette fonction verifie si le email/mdp passes en parametre sont legaux
 * Elle stocke les informations sur la personne dans des variables de session : session_start doit avoir ete appele...
 * Infos e enregistrer : email, idUser, heureConnexion, isAdmin
 * Elle enregistre l'etat de la connexion dans une variable de session "connecte" = true
 * @pre email et mdp ne doivent pas etre vides
 * @param string $email
 * @param $mdp
 * @return false ou true ; un effet de bord est la creation de variables de session
 */
function verifUser($email,$mdp)
{

    $salt = selectbdd('salt','utilisateur',"email LIKE \"$email\"");

    $mdp = crypt($mdp,$salt);
    $id = verifUserBdd($email,$mdp);
    echo $id;

	if (!$id) return false;

    $blacklist = selectbdd("blacklist","utilisateur","id = $id");
	if ($blacklist != 1){
        // Cas succes : on enregistre email, idUser dans les variables de session
        // il faut appeler session_start !
        // Le controleur le fait deje !!
        $_SESSION["email"] = $email;
        $_SESSION["id"] = $id;
        $_SESSION["connecte"] = true;
	    connectBdd($id);
        return true;
    }
}



/**
 * Fonction e placer au debut de chaque page privee
 * Cette fonction redirige vers la page $urlBad en envoyant un message d'erreur
 * et arrete l'interpretation si l'utilisateur n'est pas connecte
 * Elle ne fait rien si l'utilisateur est connecte, et si $urlGood est faux
 * Elle redirige vers urlGood sinon
 */
function securiser($urlBad,$urlGood=false)
{

	if(valider("connecte","SESSION"))
	{
		if($urlGood)
		{
			rediriger($urlGood);

		}
	}
	else
	{
        mkTitle("Connectez vous pour accéder à ce contenu");
    }
}


function isAdmin($id){
    return selectbdd('admin','utilisateur',"id = $id");
}
