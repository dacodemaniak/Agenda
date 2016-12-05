<?php
/**
* @name signin.php : Script d'identification d'un utilisateur
* (contrôleur)
**/
session_start(); // Démarrer la session

include("libs/db.inc.php"); // Charger le fichier libs/db.inc.php
include("libs/utilisateurs.inc.php"); // Services spécifiques à la gestion de la table utilisateurs

if(sizeof($_POST)){
	if(identification()){
		header("Location: index.php");
	} else {
		header("Location: login.php?err=1");
	}
}
header("Location: login.php?err=-1"); // On a essayé de m'appeler sans passer par le formulaire