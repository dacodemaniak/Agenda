<?php
//$_GET[]; // Contient l'ensemble des couples "variable / valeur" pass�s dans une URL
// Par exemple : $_GET["sujet"] retournera la valeur 1
// Cl� | Valeur
// sujet | 1
// verbe | 3
// complement | 0
// Tableau associatif parcque chacune des valeurs est accessible � partir de la cl� correspondante


/**
 * D�finition des fonctions
 **/
function limite($tableauOrigine, $valeurATester){
	// Corps de la fonction elle-m�me
	if($valeurATester < 0){
		return false; // return retourne une valeur au code qui a appel� la fonction
	}

	if($valeurATester > sizeof($tableauOrigine) - 1){
		return false;
	}

	// Dans tous les autres cas, je suis dans les limites, on retourne vrai
	return true;
}

// Fonction de traitement des limites v2
function limiteV2($tableauOrigine, $valeurATester, $libelleValeur){
	$retour = null; // Soit bool�en si tout est okay, soit un tableau avec le message d'erreur

	if($valeurATester < 0){
		$retour["message"] = "L'indice pour " . $libelleValeur . " est inf�rieur � 0 !";
	}

	if($valeurATester > sizeof($tableauOrigine) - 1){
		$retour["message"] = "L'indice pour " . $libelleValeur . " est sup�rieur � la taille du tableau !";
	}

	return is_array($retour) ? $retour : true;
}

/**
 * Fonction de test d'existence d'une clé dans un des tableaux $_GET, $_POST, ou n'importe quel autre tableau
 // $tableauATester est optionnel, on peut appeler la fonction soit :
 //	$variable = cleExiste("sujet")
 // ou $variable = cleExiste("sujet", $_GET); ou $variable = cleExiste("sujet", $monTableau)
  * @param unknown $cle
  * @param unknown $tableauATester
  * @return boolean
 **/
 function cleExiste($cle,$tableauATester=null){
 if(!is_null($tableauATester)){ // Le paramètre $tableauATester est bien passé par le script appelant
 if(array_key_exists($cle, $tableauATester)){
 return true;
 }
 } else {
 // Le second paramètre "$tableauATester" n'a pas été passé en paramètre
 // Effectuer mes tests sur les tableaux internes à PHP ($_GET et $_POST)
 if(array_key_exists($cle, $_GET)){
 return true;
 } else {
 if(array_key_exists($cle, $_POST)){
 return true;
 }
 }
 }

 return false; // La clé n'existe nulle part
 }
 
$sujets = array("Je", "Tu", "Il", "Vous");
/**
* indice | valeur
* 0 | Je
* 1 | Tu
* 2 | Il
* 3 | Vous
**/
$controle = null; // Pour tracer le type d'erreur retourn�e
$erreurs = array(); // Erreurs trac�es lors des diff�rents tests

$verbes = array("Mange", "Dors", "Travaille", "Fuis");
$complements = array("Un oiseau", "Comme une souche", "Beaucoup", "Pas assez");

// Variable permettant de d�terminer si le traitement peut �tre ex�cut� ou non
$processAutorise = true; // Par d�faut, le traitement est possible

$sujet = $_GET["sujet"]; // R�cup�re la valeur pour la cl� "sujet" transmise dans l'URL
$verbe = $_GET["verbe"]; // R�cup�re la valeur pour la cl� "verbe" transmise dans l'URL
$complement = $_GET["complement"]; // R�cup�re la valeur pour la cl� "complement" transmise dans l'URL

/**
* FAIRE ATTENTION � deux types d'erreurs possibles :
*	- la valeur de toute ou partie des cl�s est en dehors des limites du tableau concern� (ex. : &complement = 4)
*	- Une cl� manque pour pouvoir traiter la demande, par exemple : ?sujet=1&complement=0 (il manque la cl� verbe)
**/

/** Version 1 : Traiter les indices hors des limites

if($sujet < 0 || $sujet > sizeof($sujets)-1){ // la fonction "sizeof (ou count) retourne le nombre d'�l�ments d'un tableau)
	// Le traitement ne peut pas �tre effectu�, l'indice est en dehors des limites
	$processAutorise = false; // Pas possible d'ex�cuter
}

if($verbe < 0 || $verbe > sizeof($verbes)-1){ // la fonction "sizeof (ou count) retourne le nombre d'�l�ments d'un tableau)
	// Le traitement ne peut pas �tre effectu�, l'indice est en dehors des limites
	$processAutorise = false; // Pas possible d'ex�cuter
}

if($complement < 0 || $complement > sizeof($complements)-1){ // la fonction "sizeof (ou count) retourne le nombre d'�l�ments d'un tableau)
	// Le traitement ne peut pas �tre effectu�, l'indice est en dehors des limites
	$processAutorise = false; // Pas possible d'ex�cuter
}
**/

/**
 * Version 2, utiliser la fonction limite d�finie

if(!limite($sujets, $sujet) || !limite($verbes, $verbe) || !limite($complements, $complement)){
	$processAutorise = false;
	$message = "Une des valeurs (sujet, verbe ou compl�ment) est en dehors des limites !";
}
**/

/**
 * Version 3 : Fonction plus �volu�e
 */
$controle = limiteV2($sujets, $sujet, "Sujet");
if($controle !== true){
	$erreurs[] = $controle;
	$processAutorise = false;
}
$controle = limiteV2($verbes, $verbe, "Verbe");
if($controle !== true){
	$erreurs[] = $controle;
	$processAutorise = false;
}
$controle = limiteV2($complements, $complement, "Complement");
if($controle !== true){
	$erreurs[] = $controle;
	$processAutorise = false;
}

// Traiter l'existence et la d�finition de chacune de cl�s du tableau $_GET
if(!isset($_GET["sujet"])){ // La fonction isset permet de d�terminer si une variable a �t� d�finie ou pas ; ! est l'op�rateur NOT
	// La cl� sujet n'est pas d�finie, on ne peut pas traiter le probl�me
	$processAutorise = false; // Pas possible d'ex�cuter
}

// Traiter l'existence et la d�finition de chacune de cl�s du tableau $_GET
if(!isset($_GET["verbe"])){ // La fonction isset permet de d�terminer si une variable a �t� d�finie ou pas ; ! est l'op�rateur NOT
	// La cl� verbe n'est pas d�finie, on ne peut pas traiter le probl�me
	$processAutorise = false; // Pas possible d'ex�cuter
}

// Traiter l'existence et la d�finition de chacune de cl�s du tableau $_GET
if(!array_key_exists("complement", $_GET)){ // La fonction array_key_exists retourne vrai si la cl� donn�e existe dans un tableau, faux sinon
	// La cl� sujet n'est pas d�finie, on ne peut pas traiter le probl�me
	$processAutorise = false; // Pas possible d'ex�cuter
}

// Au final, on peut assembler la phrase idiote � partir des 3 indices r�cup�r�s en GET
// Pour rappel :
// = => op�rateur d'affectation
// == => op�rateur de comparaison
// === => op�rateur de comparaison avec une comparaison stricte de type
if($processAutorise === true){
	echo $sujets[$sujet] . " " . $verbes[$verbe] . " " . $complements[$complement];
} else {
	/** V1 : simple message d'erreur sans r��lle port�e
	echo "Une erreur est survenue lors du traitement, soit un ou plusieurs indices sont hors limite, soit une ou plusieurs cl�s manquent.";
	**/
	
	/** 
	 * V2 : on peut lister d�sormais les types d'erreurs
	 * */
	foreach($erreurs as $erreur => $message){
		echo $message["message"] . "<br />\n";
	}
}