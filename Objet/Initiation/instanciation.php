<?php
/**
 * @name instanciation.php Exemple d'instanciation d'objets de la classe Personne
**/

/**
 * Charger la définition de la classe Personne : require, include, require_once, include_once
**/
require("Classes/Personne/Personne.class.php");

/**
* On peut donc instancier un premier objet de la classe Personne
**/
$formateur = new Personne;
$formateur->nom = "Aubert"; // Affecte Aubert à la propriété publique nom de la classe Personne
$formateur->prenom = "Jean-Luc"; // Affecte Jean-Luc à la propriété publique prenom de la classe Personne
$formateur->setAge(48);

/**
* On instancie un second objet de la classe Personne
**/
$stagiaire = new Personne;
$stagiaire->nom = "Martin";
$stagiaire->prenom = "Arthur";
$stagiaire->setAge("Je suis âgé de 25 ans");

$autreStagiaire = new Personne;
$autreStagiaire->nom = "Talut";
$autreStagiaire->prenom = "Jean";
if($autreStagiaire->definitAge("35")){
	echo "C'est bon, l'âge a bien été défini.<br />";
} else {
	echo "Il y a un problème de définition de l'âge<br />";
}


/**
 * On peut afficher un Hello des deux instances (objets)
 **/
echo "Hello " . $formateur->prenom . " " . $formateur->nom . "<br /> Mon âge : " . $formateur->getAge() . "<br />";
echo "Hello aussi à toi : " . $stagiaire->prenom . " " . $stagiaire->nom . "<br />Mon âge : " . $stagiaire->getAge() . "<br />";