<?php
/**
* @name fonction_4.php : Définir, utiliser les fonctions, passer des paramètres à une fonction
**/

function deuxPlusDeux(){
	$leCalcul = 2 + 2;
	return (2 + 2) . "<br />";
}

function plusDeux($chiffreDepart){
	$lAddition = $chiffreDepart + 2;
	return $lAddition . "<br />";
}

function addition($valeur1, $valeur2){
	return $valeur1 + $valeur2 . "<br />";
}

function age($anneeNaissance, $anneeCourante){
	return $anneeCourante - $anneeNaissance;
}

function annee($tableau, $indice){
	if($indice <= sizeof($tableau) - 1){
		return $tableau[$indice];
	}
	
	return "Demande invalide !";
}

// Utiliser la fonction
echo deuxPlusDeux();

// Utiliser la fonction plusDeux
echo plusDeux(2);
echo plusDeux(10);

// Utiliser la fonction
echo addition(5, 3);
echo addition(12, 7);

// Deux variables définies
$naissance = 1968;
$anneeCourante = 2016;
echo age($naissance,$anneeCourante);
echo age(1991, 2016);

$naissances = array(
	1968,
	1991,
	1988,
	1975,
	2002
);
// Affiche les âges pour chaque ligne de tableau
for($i = 0; $i < sizeof($naissances); $i++){
	echo age($naissances[$i], 2016);
}

echo annee($naissances, 5);
echo $naissances[5];
