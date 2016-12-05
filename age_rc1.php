<?php
/**
* @name age_rc1.php : Contrôle les données du formulaire "age_confirmation.php" et en fonction de l'âge, redirige vers une autre page
* Utilisation d'une variable de session
**/

// Pour pouvoir utiliser une variable de sessions, on doit démarrer la session
session_start(); // Le tableau $_SESSION peut être utilisé

/**
* Récupère les données postées directement dans le tableau $_POST et stocke dans la variable de session
**/
$_SESSION["nom"] = $_POST["nom"];
$_SESSION["prenom"] = $_POST["prenom"];
$annee = $_POST["annee"];

/**
* Calculer l'âge de l'internaute à partir de son année de naissance
**/
$_SESSION["age"] = date("Y") - $annee; // date() retourne la date courante, avec le paramètre "Y" vous récupérez l'année de la date courante

/**
* Rediriger vers une page si l'internaute est majeur ou une autre page, si ce n'est pas le cas
**/
if($_SESSION["age"] >= 18){
	header("Location:majeur_rc1.php");
} else {
	header("Location:mineur_rc1.php");
}