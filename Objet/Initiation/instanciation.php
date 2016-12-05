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
$formateur = new Personne("Aubert", "Jean-Luc");
//$formateur->nom = "Aubert"; // Affecte Aubert à la propriété publique nom de la classe Personne
//$formateur->prenom = "Jean-Luc"; // Affecte Jean-Luc à la propriété publique prenom de la classe Personne
$formateur->age(48);
echo $formateur;
echo $formateur->getAnneeNaissance();

/**
* On instancie un second objet de la classe Personne
**/
$stagiaire = new Personne("Martin", "Arthur");
//$stagiaire->nom = "Martin";
//$stagiaire->prenom = "Arthur";
$stagiaire->setAge("Je suis âgé de 25 ans");
echo $stagiaire;
$stagiaire->anneeNaissance = "2012";
echo $stagiaire->getAnneeNaissance();

$autreStagiaire = new Personne("Talut", "Jean");
//$autreStagiaire->nom = "Talut";
//$autreStagiaire->prenom = "Jean";
if($autreStagiaire->definitAge("35")){
	echo "C'est bon, l'âge a bien été défini.<br />";
} else {
	echo "Il y a un problème de définition de l'âge<br />";
}
echo $autreStagiaire; // ON voit que l'année de naissance sera incorrect, le calcul ayant été fait avant la définition de l'âge
echo $autreStagiaire->getAnneeNaissance();

/**
* On peut afficher un Hello des deux instances (objets)
**/
echo "Hello " . $formateur->getPrenom() . " " . $formateur->getNom() . "<br /> Mon âge : " . $formateur->age() . "<br />";
echo "Hello aussi à toi : " . $stagiaire->getPrenom() . " " . $stagiaire->getNom() . "<br />Mon âge : " . $stagiaire->getAge() . "<br />";
echo "Hello le dernier objet : " . $autreStagiaire->getNomComplet() . "<br />";
echo $formateur;