<?php
/**
* @name age.php : Contrôle les données du formulaire "age_confirmation.php" et en fonction de l'âge, redirige vers une autre page
**/

/**
* Récupère les données postées directement dans le tableau $_POST
**/
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$annee = $_POST["annee"];

/**
* Calculer l'âge de l'internaute à partir de son année de naissance
**/
$age = date("Y") - $annee; // date() retourne la date courante, avec le paramètre "Y" vous récupérez l'année de la date courante

/**
* Rediriger vers une page si l'internaute est majeur ou une autre page, si ce n'est pas le cas
**/
if($age >= 18){
	header("Location:majeur.php?nom=" . $nom . "&prenom=" . $prenom . "&age=" . $age);
} else {
	header("Location:mineur.php?nom=" . $nom . "&prenom=" . $prenom . "&age=" . $age);
}