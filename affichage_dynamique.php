<?php
/**
* @name tableaux_avances.php
**/

/**
* affiche(array $tableau, array $indices)
*	@param array $tableau : Tableau contenant les données
*	@param array $indices : Tableau contenant les indices à retourner du tableau de données
**/
function affiche($tableau, $indices){
	$sortie	= ""; // La chaîne finale à retourner
	for($i = 0; $i < sizeof($indices); $i++){
		if($indices[$i] <= sizeof($tableau) - 1){
			$sortie .= $tableau[$indices[$i]] . " ";
		}
	}
	return $sortie;
}


// Un tableau peut contenir d'autres tableaux
$tableauDeTableaux = array(
	array(
		"Formateur", 
		"Jean-Luc", 
		48, 
		"Développeur"
	),
	array(
		"Stagiaire", 
		"Anne-Cécile", 
		25, 
		"Futur Dév."
	),
	array(
		"Stagiaire", 
		"Stéphanie", 
		22
	),
	array(
		"Stagiaire", 
		"Jean-Philippe", 
		30
	),
	array(
		"stagiaire", 
		"Cyril", 
		28
	),
	array(
		"Stagiaire", 
		"Elodie", 
		23
	),
	array(
		"Stagiaire", 
		"Thalia", 
		19
	),
	array(
		"Stagiaire", 
		"Abdouramhane", 
		18
	)
);

echo "<ul>\n";
for($indice1 = 0; $indice1 < sizeof($tableauDeTableaux); $indice1++){ // Boucle sur le premier tableau
	$ligne = $tableauDeTableaux[$indice1]; // Stocke le tableau de la ligne correspondante
	/**
	$ligne à chaque tour dans la boucle vaut respectivement :
		array("Formateur", "Jean-Luc") pour $indice1 valant 0
		array("Stagiaire", "Anne-Cécile") pour $indice1 valant 1
		array("Stagiaire", "Stéphanie") pour $indice1 valant 2
		...
		array("Stagiaire", "Abdouramhane") pour $indice1 valant 7
	**/
	echo "<li>"; // Début de la ligne LI
	echo affiche($ligne, array(1,3));	
	echo "</li>"; // Fin de la ligne LI après avoir traité toutes les informations

}
echo "</ul>\n";
