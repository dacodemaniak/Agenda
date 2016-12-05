<?php

// Fonction n° 1 Calcul d'une moyenne
function moyenne($numericDatas){
	$nbLignesTableau = sizeof($numericDatas); // Nombre de lignes total du tableau $numericDatas
	
	// On boucle sur le tableau pour faire la somme de chacun des éléments
	$total = 0; // Variable qui va stocker le cumul des données du tableau
	for($i=0; $i < sizeof($numericDatas); $i++){
		$total = $total + $numericDatas[$i];
	}
	// En fin de boucle, on peut donc retourner la moyenne
	return $total / $nbLignesTableau;
}

function moyenne2($numericDatas){
	return round(array_sum($numericDatas) / sizeof($numericDatas), 2);
}

function factorielle($numericDatas){
	$total = 1; // Elément neutre de la multiplication en valeur de départ
	for($i=0; $i<sizeof($numericDatas); $i++){
		$total *= $numericDatas[$i];
	}
	return $total;
}

function tag($chaine,$tag){
	return "<" . $tag . ">" . $chaine . "</" . $tag . ">";
}

function numericVal($datas){
	$vals = array();
	
	var_dump($datas);

	for($i=0; $i<sizeof($datas); $i++){
		
		if(is_numeric($datas[$i])){
			$vals[] = $datas[$i];
		}
	}
	return sizeof($vals);
}

// Appel de la fonction moyenne
$moyenne = moyenne2(array(5, 10, 14, 12, 9));
echo "La moyenne du tableau (5, 10, 14, 12, 9) est de : " . $moyenne . "<br />";
$notes = array(10, 8, 5, 15, 19, 14);
$moyenneEleve = moyenne($notes);
echo "La moyenne obtenue par l'élève est de : " . $moyenneEleve . "<br />";

// Appel de la fonction factorielle
$factorielle5 = factorielle(array(1, 2, 3, 4, 5));
echo "La factorielle de 5 est : " . $factorielle5 . "<br />";

echo tag("Jean-Luc", "strong");
echo tag("Martin","em");
echo tag("Titre", "h1");

echo "Nombre de numériques : " . numericVal(array(1, "10 petits nègres", "15", 20, 25));
