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

function addElementAt($tableau, $valeur, $indice){
	
	// Le paramètre $tableau est-il un tableau ?
	if(!is_array($tableau)){
		$tableau = array(); // Je force $tableau à devenir un array
		$tableau[] = $valeur; // Affecte $valeur à $tableau sans tenir compte de l'indice, aucun n'existe
	} else {
		// Il s'agit déjà d'un tableau... on contrôle l'unicité de la valeur
		if(!in_array($valeur, $tableau)){ // Fonction in_array($var, $array) Teste si la variable $var est dans le tableau $array
			if($indice > sizeof($tableau) - 1){
				$tableau[] = $valeur;
			} else {
				// Il va falloir se débrouiller pour insérer la valeur à l'endroit précis
				$tempArray = array();
				for($i=0; $i<sizeof($tableau); $i++){
					if($i == $indice){
						// Récupère la valeur courante de l'indice
						$oldValue = $tableau[$i];
						
						// Place la valeur à cet endroit dans le tableau
						$tempArray[$indice] = $valeur;
						$tempArray[$indice+1] = $oldValue;
						
						// Décale le reste des valeurs
						for($j = $indice+2; $j<sizeof($tableau); $j++){
							$tempArray[] = $tableau[$j];
						}
						//$tempArray[] = $oldValue;
					} else {
						$tempArray[] = $tableau[$i];
					}
				}
				// En fin de parcours, on rétablit le tableau
				$tableau = $tempArray;
			}
		}
	}
	
	return $tableau; // Le tableau complété d'une valeur supplémentaire
}
/**
* Des contextes différents
**/
$numsecus = array(
	"1 68 04 03 254 074 62",
	"2 85 07 71 325 222 52"
); // Au départ, votre tableau contient 2 éléments
$numsecus = addElementAt($numsecus,"1 79 04 03 254 074 62", 1);
$numsecus = addElementAt($numsecus,"2 87 07 71 325 222 52", 0);
$numsecus = addElementAt($numsecus,"2 85 07 73 325 222 52", 2);

// En sortie on devrait avoir :
//"2 87 07 71 325 222 52",
//"1 79 04 03 254 074 62",
//"2 85 07 73 325 222 52"
//"1 68 04 03 254 074 62"
//"2 85 07 71 325 222 52"

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