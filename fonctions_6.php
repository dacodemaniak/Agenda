<?php
/**
* fonctions_6.php : une même fonction, des contextes différents
**/

function ajouteElement($tableau, $valeur){
	// Le paramètre $tableau est-il un tableau ?
	if(!is_array($tableau)){
		$tableau = array(); // Je force $tableau à devenir un array
		$tableau[] = $valeur; // Affecte $valeur à $tableau
	} else {
		// Il s'agit déjà d'un tableau... on contrôle l'unicité de la valeur
		if(!in_array($valeur, $tableau)){ // Fonction in_array($var, $array) Teste si la variable $var est dans le tableau $array
			$tableau[] = $valeur;
		}
	}
	
	return $tableau; // Le tableau complété d'une valeur supplémentaire
}

/**
* Des contextes différents
**/
$numsecus = null; // Au départ, la variable est nulle
$numsecus = ajouteElement($numsecus,"1 68 04 03 254 074 62");
$numsecus = ajouteElement($numsecus,"2 85 07 71 325 222 52");
$numsecus = ajouteElement($numsecus,"2 85 07 71 325 222 52");
// A la fin de l'exécution de ces deux lignes, le tableau $numsecus devrait contenir "1 68 04 03 254 074 62" et "2 85 07 71 325 222 52"
var_dump($numsecus); // La fonction var_dump($var) affiche de manière brute le contenu de $var

$citations = null;
$citations = ajouteElement($citations, "Plus tu pédales moins vite, plus tu as de chances d'avancer plus lentement");
$citations = ajouteElement($citations, "L'avenir est devant toi, sauf quand tu fais demi-tour");

$temperatures = null;
$temperatures = ajouteElement($temperatures, 12);
$temperatures = ajouteElement($temperatures, 8);
$temperatures = ajouteElement($temperatures, 5);
$temperatures = ajouteElement($temperatures, 10);

/**
$candidats = null;
$candidats = ajouteElement($candidats, array("Aubert", 50)); // <=> $candidats[] = array("Aubert", 50)
$candidats = ajouteElement($candidats, array("Dupont", 20));
$candidats = ajouteElement($candidats, array("Durant", 75));
var_dump($candidats);
**/