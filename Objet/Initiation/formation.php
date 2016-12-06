<?php
/**
 * Ajouter des objets dans un tableau, pour faciliter le travail
**/
require("Classes/Formation/Formation.class.php");
require("Classes/Formation/FormationInformatique.class.php");

/**
 * Définit un tableau avec les intitulés des chapitres
 **/
$intitules = array(
		"Programmation Orientée Objet",
		"Héritage",
		"Polymorphisme"
);

/**
 * On définit une variable de type tableau
 **/
$chapitres = array();

foreach($intitules as $titreChapitre){
	if($titreChapitre == "Héritage"){
		$chapitres[] = new FormationInformatique($titreChapitre, 45); // Stocke l'objet $formation dans une nouvelle ligne du tableau des chapitres
	} else {
		$chapitres[] = new FormationInformatique($titreChapitre); // Stocke l'objet $formation dans une nouvelle ligne du tableau des chapitres
	}
}

/**
 * Boucle sur le tableau des formations pour affichage
 **/
foreach($chapitres as $formation){
	echo "Titre : " . $formation->getTitre() . "<br />"; // Méthode getTitre() de la classe parente Formation/Formation
	echo "Chapitre : " . $formation->getChapitre() . "<br />"; // Méthode getChapitre() de la classe courante
	echo "Durée : " . $formation->getDuree() . "<br />"; // Méthode getDuree() de la classe parente
}