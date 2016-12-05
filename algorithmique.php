<?php
/**
 * @name algorithmique.php : Traitement d'algorithmes divers en PHP
 * @version 1.0
**/
$chiffreDepart 	= 5; // Chiffre à partir duquel on va démarrer la table de multiplication
$resultat 		= 0; // Résultat à afficher

// Début de la boucle
for($indice = 1; $indice <= 10; $indice++){
	$resultat = $chiffreDepart * $indice; // Effectue la multiplication
	
	// Envoie le résultat vers la sortie courante
	echo "Résultat de " . $chiffreDepart . " * " . $indice . " = " . $resultat . "<br />\n";
}

/**
 * N'afficher que les résultats pairs
 */
$chiffreDepart = 5;
$resultat = 0;

for($indice = 1; $indice <= 10; $indice++){
	$resultat = $chiffreDepart * $indice;
	if($resultat % 2 == 0){
		echo "Résultat : " . $resultat . "<br />\n";
	}
}

//$chiffreDepart = 5;
$chiffreDepart = "le chiffre 5";
$resultat = 0;
$cssClass = "";

for($indice = 1; $indice <= 10; $indice++){
	$resultat = $chiffreDepart * $indice;
	
	// Traitement conditionnel : si pair => utiliser la class "pair", sinon, utiliser la classe "impair"
	if($resultat % 2 == 0){
		$cssClass = "#e6e6e6"; // Définit la couleur directement
	} else {
		$cssClass = "#6e6e6e";
	}
	
	// Afficher le résultat
	// <p style="background-color: #e6e6e6;">...</p>
	echo "<p style=\"background-color:" . $cssClass . ";\">Résultat : " . $resultat . "</p>\n";
}