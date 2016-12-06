<?php
/**
 * @name heritage.php : Comment une classe peut "étendre" une classe parente
**/
/**
 * Charger la définition de la classe Personne : require, include, require_once, include_once
**/
require("Classes/Personne/Personne.class.php");
require("Classes/Personne/Formateur.class.php");

/**
 * On peut donc instancier un formateur...
 **/
$formateur = new Formateur("Aubert", "Jean-Luc");
$formateur->setMatiere("Technologie Objet");
echo "Hello le formateur : " . $formateur->getNomComplet() . "<br />\n";
echo "Vous enseignez : " . $formateur->getMatiere() . "<br />\n";