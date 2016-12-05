<?php
/**
* @name creerCivilite.php : Script de création d'une civilite dans la base de données
* (contrôleur)
**/
session_start(); // Démarrer la session

include("libs/db.inc.php"); // Charger le fichier libs/db.inc.php

if(sizeof($_POST)) { // On ne peut pas exécuter l'insertion si aucune donnée n'est postée
		$resultat = createAndExec("ajouter","civilites");
		if($resultat){
			header("Location: index_civilite.php?insert=ok");
		} else {
			header("Location: index_civilite.php?insert=ko");
		}
} else {
		// L'utilisateur a essayé de charger le script sans venir du formulaire, on le renvoie au login
		header("Location: index_civilite.php");
}
?>