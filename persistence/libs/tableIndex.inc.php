<?php
/**
* @name tableIndex.inc.php Ensemble de fonctions destiné à produire un tableau HTML présentant les données d'une table de base de données
* @author Moi-Même (moi@jesuislemeilleurdev.com)
* @version 1.0
* @package persistence/libs
**/

/**
* string afficheIndex(string $nomTableDB, array $colonnesDB, string $updateURL)
*	@param string $nomTableDB : nom de la table de la base de données à partir de laquelle récupérer les données
*	@param array $colonnesDB : l'ensemble des colonnes souhaitées pour l'affichage
*	@param string $updateURL : URL vers laquelle aller pour mettre à jour les données
**/
function afficheIndex($nomTableDB, $colonnesDB, $updateURL){
	$tableauHTML = ""; // Tableau final contenant les données à afficher

	#begin_debug
	echo "Lister les données de la table : " . $nomTableDB . "<br />";
	echo "Etablir le lien vers " . $updateURL . "<br />";
	foreach($colonnesDB as $indice => $colonne){
		echo "Afficher " . $colonne["colonne"] . " sous l'en-tête " . $colonne["th"] . "<br />";
	}
	#end_debug
	
	//1. Créer la requête de récupération des données de la table $nomTableDB @see creerRequete($nomTableDB, $colonnesDB)
	//1. Créer la requête de récupération des données de la table $nomTableDB @see creerRequete($nomTableDB, $colonnesDB)
	$resultat = creerRequete($nomTableDB, $colonnesDB);
	
	if($resultat){ // Résultat contient l'ensemble des lignes de la table à traiter, ou faux s'il y a eu une erreur
		echo "La requête a réussi, on dispose des résultats<br />";
		$tableauHTML .= toHTMLTable($resultat, $colonnesDB);
	}
	return $tableauHTML;
}

/**
* PDO creerRequete(string $nomTable, array $colonnesDB)
*	@param string $nomTable : Nom de la table de bases de données à traiter
*	@param array $colonnesDB : définition des colonnes de la table à traiter
**/
function creerRequete($nomTable, $colonnesDB){
	//1. Connexion à la base de données
	$connexion = dbConnect();
	if($connexion !== false){ // La connexion a réussi... on peut continuer
		//2. Création du SELECT sur la table $nomTable avec les colonnes définies dans $colonnesDB
		$select = "SELECT ";
		// Boucler sur le tableau $colonnesDB pour récupérer les colonnes de la table concernée
		foreach($colonnesDB as $indice => $value){
			$select .= $value["colonne"] . ",";
		}
		$select = substr($select, 0, strlen($select) - 1);
		
		// Ajoute le FROM
		$select .= " FROM " . $nomTable . ";";
		
		#begin_debug
		echo "Requête de sélection : " . $select . "<br />";
		
		// Exécution de la requête générée
		$resultat = $connexion->query($select);
		
		if($resultat !== false){
			return $resultat;
		}
	}
	
	return false;
}

/**
* string toHTMLTable(PDO $resultat, array $colonnes)
*	@param PDO $resultat : Jeu de résultat obtenu par la fonction creerRequete()
*	@param array $colonnes : Définition des colonnes à traiter pour ce jeu de résultat
*	@return string : structure <table>...</table> avec l'ensemble des données
**/
function toHTMLTable($resultat, $colonnes){
	$htmlTable = ""; // Chaîne finale, contenant le tableau HTML
	
	//1. On définit la manière dont récupérer chacune des lignes de $resultat
	$resultat->setFetchMode(PDO::FETCH_OBJ);
	
	//2. Créer l'en-tête du tableau final HTML
	$htmlTable = "<table>";
	
	$htmlTable .= "<thead>";
	$htmlTable .= "<tr>";
	// Boucler pour générer les TH correspondant à la définition des colonnes
	foreach($colonnes as $indice => $value){
		$htmlTable .= "<th>" . $value["th"] . "</th>";
	}
	$htmlTable .= "</tr>";
	$htmlTable .= "</thead>";
	
	$htmlTable .= "<tbody>";
	// Boucler sur le jeu de résultat $resultat, créer un TR à chaque fois et "n" TD correspondant à chaque colonne à traiter
	while($ligne = $resultat->fetch()){
		$htmlTable .= "<tr>";
		foreach($colonnes as $indice => $value){
			$htmlTable .= "<td>";
			// Afficher le contenu de la colonne correspondante issue de $ligne
			$htmlTable .= $ligne->$value["colonne"];
			$htmlTable .= "</td>";
		}
		$htmlTable .= "</tr>";
	}
	$htmlTable .= "</tbody>";
	
	$htmlTable .= "</table>";
	
	return $htmlTable;
}