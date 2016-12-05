<?php
/**
* fonctions_5.php : encore des fonctions
**/

/**
* coupe(string $citation)
* @param $citation : Chaîne à vérifier et à couper le cas échéant
* @param $nbCaractereAAfficher : Nombre de caractères à afficher
**/
function coupe($chaine, $nbCaractereAAfficher){
	if(strlen($chaine) > $nbCaractereAAfficher){
		return substr($chaine, 0, $nbCaractereAAfficher) . "...<br />";
	}
	
	return $chaine . "<br />";
}


$citations = array(
	"Nous partîmes 500, mais par un prompt renfort, nous nous vîmes 5000 en arrivant au port",
	"Un pic ? C'est un peu faible, un roc, une péninsule",
	"Droit au but",
	"Se coucher tard nuit"
);

$numsecus = array(
	"1 68 04 03 254 074 62",
	"2 85 07 71 325 222 52",
	"1 82 09 58 444 333 48",
	"2 98 01 75 333 222 52"
);

// Version procédurale...
for($i = 0; $i<sizeof($citations); $i++){
	if(strlen($citations[$i]) > 12){ // la fonction strlen($string) retourne la longueur de la chaîne $string
		echo substr($citations[$i], 0, 12) . "..."; // La fonction substr($string, $debut, $longueur) retourne une sous-chaine débutant à $debut et s'étendant sur $longueur caractères
	} else {
		echo $citations[$i];
	}
	echo "<br />\n";
}

// Version fonctionnelle
$nbCaractereAAfficher = 30;
for($i = 0; $i<sizeof($citations); $i++){
	echo coupe($citations[$i], $nbCaractereAAfficher);
}

// Afficher les numéros de sécu sans la clé
for($i = 0; $i < sizeof($numsecus); $i++){
	echo coupe($numsecus[$i], 18);
}