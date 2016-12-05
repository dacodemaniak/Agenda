<?php
/**
* @name tableaux_avances.php
**/

// Définition d'un tableau simple
$tableau = array("Jean-Luc", "Anne-Cécile", "Stéphanie", "Jean-Philippe", "Cyril", "Elodie", "Thalia", "Abdouramhane");

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
		
		for($indice2 = 0; $indice2 < sizeof($ligne); $indice2++){
			echo $ligne[$indice2][0] . " ";
		}
		
		echo "</li>"; // Fin de la ligne LI après avoir traité toutes les informations

}
echo "</ul>";
