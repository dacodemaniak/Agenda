<?php
/**
* Omelette : exemple avec des fonctions dont les paramètres sont optionnels
**/

/**
* oeufs([$nbPersonnes])
* @param $nbPersonnes [optionnel, par défaut ce sera 4]
**/
function oeufs($nbPersonne=4){
	$oeufs = $nbPersonne; // Pour une omelette, on prend un oeuf par personne
	return $oeufs . " oeufs"; // Retourne donc le nombre d'oeufs
}

/**
* beurre([$nbPersonnes])
* @param $nbPersonnes [optionnel, par défaut 4]
*	Pour que ce soit bon, on mesure 5g de beurre par personne
**/
function beurre($nbPersonne=4){
	$qteBeurreParPersonne = 5; // Quantité de beurre par personne
	return $qteBeurreParPersonne * $nbPersonne . " g de beurre";
}

/**
* sel([$nbPersonne])
* @param $nbPersonne [Optionnel Nombre de personnes]
**/
function sel($nbPersonne=4){
	$qteSelParPersonne = 0.1;
	return $qteSelParPersonne * $nbPersonne . " g de sel";
}

/**
* Début du script PHP
**/
$nbPersonne = 12;
echo "Pour réussir une omelette pour " . $nbPersonne . " personnes, vous aurez besoin de :<br />";
echo "<ul>";
echo "<li>" . oeufs() . "</li>";
echo "<li>" . beurre($nbPersonne) . "</li>";
echo "<li>" . sel($nbPersonne) . "</li>";
echo "</ul>";