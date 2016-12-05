<?php

/**
* @name corrige_election.php Corrigé de l'affichage sous forme de tableau HTML des résultats aux élections
**/

/**
* sommeTableau(array $tableau) : Retourne la somme des valeurs de chaque élément du tableau
**/
function sommeTableau($tableau){
	$somme = 0; // Somme totale, qui sera retournée par la fonction
	
	for($indice = 0; $indice < sizeof($tableau); $indice++){
		$donnee = $tableau[$indice]; // $donnee est un tableau
		
		// On peut effectuer le cumul des votes en traitant l'indice 1 du tableau $donnee
		$somme = $somme + $donnee[1]; // L'indice 1 du tableau $donnee contient le nombre de voix pour le candidat concerné
		
	}
	return $somme;
}

/**
* score(int $voteExprime, int $totalVote)
*	@param int $voteExprime : Nombre de voix obtenues par un candidat
*	@param int $totalVote : Nombre total de voix
**/
function score($voteExprime, $totalVote){
	return ($voteExprime / $totalVote) * 100;
}

/**
* resultat(int $voteExprime, int $totalVote)
*	@param int $voteExprime : Nombre de voix obtenues par un candidat
*	@param int $totalVote : Nombre total de voix
**/
function resultat($voteExprime, $totalVote){
	$score = ($voteExprime / $totalVote) * 100;
	
	if($score > 50){
		return "Elu au premier tour"; // On utilise le mot-clé return, on sort de la fonction
	} elseif($score > 12.5){
		return "Eligible au second tour";
	}
	
	return "Eliminé au premier tour";
}

/**
* Variante plus... élégante
**/
function resultat2($score){
	if($score > 50){
		return "Elu au premier tour"; // On utilise le mot-clé return, on sort de la fonction
	} elseif($score > 12.5){
		return "Eligible au second tour";
	}
	
	return "Eliminé au premier tour";
}
/**
* Variable de base : tableau contenant les informations des résultats obtenus par candidat
**/
$resultats = array(

	array(
		"Aubert",
		50
	),
	array(
		"Martin", 
		30
	),
	array(
		"Dupont", 
		20
	),
	array(
		"Durand", 
		25
	),
	array(
		"Dujardin", 
		75
	),
	array(
		"Dejean", 
		50
	)
);

/**
* Calcul le nombre total de voix exprimé
**/
$totalVoix = sommeTableau($resultats);
echo "Total des voix exprimées : " . $totalVoix . "<br />";

/**
* Création de la sortie sous la forme d'un tableau HTML
**/
echo "<table>\n";
// Première ligne, en-tête du tableau
echo "<thead>\n";
echo "<tr>\n";
echo "<th>Candidat</th>\n";
echo "<th>% des suffrages</th>\n";
echo "<th>Résultat</th>\n";
echo "</tr>\n";
echo "</thead>\n";

// Corps du tableau
echo "<tbody>\n";

// Boucle pour afficher les résultats de chaque candidat
for($i = 0; $i < sizeof($resultats) ; $i++){
	echo "<tr>\n";
	// Première colonne : Nom du candidat
	echo "<td>";
	echo $resultats[$i][0]; // Indice 0 du second tableau
	echo "</td>";
	// Seconde colonne : % exprimé (appelle la fonction de calcul du pourcentage)
	echo "<td>";
	echo score($resultats[$i][1],$totalVoix); // Indice 0 du second tableau
	echo "</td>";
	// Troisième colonne : Résultat final
	echo "<td>";
	echo resultat($resultats[$i][1],$totalVoix); // Indice 0 du second tableau
	// ou...
	//echo resultat2(score($resultats[$i][1],$totalVoix));
	echo "</td>";	
	echo "</tr>\n";
}
echo "</tbody>\n";
echo "</table>";