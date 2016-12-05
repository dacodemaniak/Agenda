<?php
/**
* @name db.inc.php : Fonctions utiles pour la gestion des bases de données
* @package libs : dossier de stockage de la librairie
**/

/**
* PDO dbConnect()
*	Instancie une connexion PDO vers la base mySQL
*	@return Instance de connexion ou faux si la connexion n'a pas abouti
**/
function dbConnect(){
	//1. Etablir la connexion à la base de données
	try{ // Essaye les instructions qui suivent
		$connexion = new PDO(
			"mysql:host=127.0.0.1;port=3306;dbname=authentification", // Chaîne de connexion
			"webdev_db_admin", // Nom de l'utilisateur de la base de données
			"@UtH!" // Le mot de passe associé à l'utilisateur de la base de données
		);
	}
	catch(Exception $e){ // Si tu n'arrives pas à exécuter les instructions du try, intercepte moi l'Exception levée
		echo "Erreur levée : " . $e->getMessage() . "<br />";
		echo "N° d'erreur : " . $e->getCode() . "<br />";
		return false; // La fonction de connexion a échoué, on sort avec une valeur fausse
	}
		
	return $connexion; // Retourne l'instance de connexion PDO
}

/**
*	Service
*	@name mixed createAndExec(string $exclusion, string $nomTable)
*		Instancie une connexion à la base de données
*		Créer la requête d'insertion
*		Exécuter la requête
*	@param string $exclusion : Nom du champ à ne pas traiter
*	@param string $nomTable : nom de la table dans laquelle insérer les données
	@return statut de l'opération
**/
function createAndExec($exclusion, $nomTable){
	$connexion = dbConnect(); // Appelle la fonction dbConnect()
	
	if($connexion !== false){
		$insertSQL = getInsertSQLv3($exclusion, $nomTable);
		$resultat = $connexion->exec($insertSQL);
		if(!$resultat){
			die("Erreur dans la requête : <pre><code>" . $insertSQL . "</code></pre><br />\n");
		}
		return $resultat;
	}
	
	return false; // La connexion à la base de données a échoué
}

/**
* string getInsertSQL(string $champAExclure, string $nomTableATraiter)
*	Créer une chaîne contenant une requête SQL de type INSERT INTO
*	@param string $champAExclure Champ dont on ne doit pas tenir compte dans la requête
*	@param string $nomTableATraiter Nom de la table SQL dans laquelle réaliser l'insertion
**/
function getInsertSQL($champAExclure, $nomTableATraiter){
	$creation = "INSERT INTO " . $nomTableATraiter . " (";
	// Créer un tableau à partir des indices de $_POST
	// ATTENTION, il faut que les indices soient exactement les noms des colonnes dans la table utilisateurs
	$colonnes = array_keys($_POST); // array_keys stocke les clés d'un tableau dans un autre tableau
	
	// Boucle sur les colonnes, pour traiter la seconde partie de la requête d'insertion
	for($i=0; $i < sizeof($colonnes); $i++){
		if($colonnes[$i] != $champAExclure){
			$creation .= $colonnes[$i] . ",";
		}
	}
	$creation = substr($creation,0, strlen($creation)-1);
	
	// Traite les valeurs à insérer dans la table
	$creation .= ") VALUES (";
	
	// Boucle sur les données postées et ajout des caractères nécessaires
	foreach($_POST as $indice => $value){
		// ATTENTION, ne pas traiter la clé du bouton de validation
		if($indice != $champAExclure){
			$creation .= "'" . $value . "',";
		}
	}
	// Attention, supprimer la dernière virgule inutile
	$creation = substr($creation,0,strlen($creation)-1);
	$creation .= ");"; // Ma requête est prête, il faut la retourner
	
	// INSERT INTO nom_table (col1,col2,col3, ...) VALUES ('val1','val2','val3', ...); 
	return $creation;
}

function getInsertSQLv2($exclusion,$table){
	$creation 	= ""; // Chaîne finale
	$colonnes 	= ""; // Nom des colonnes séparés par des virgules, sauf le dernier
	$values		= ""; // Valeurs à insérer, entre cotes et séparés par des virgules, sauf la dernière
	
	foreach($_POST as $cle => $valeur){
		if($cle != $exclusion){
			$colonnes .= $cle . ",";
			$values .= "'" . $values . "',";
		}
	}
	// Concatène la chaîne finale
	$creation = "INSERT INTO " . $table . "(" . substr($colonnes,0, strlen($colonnes) - 1) . ") VALUES (" . substr($values,0, strlen($values) - 1) . ");";
	
	return $creation;
}

function getInsertSQLv3($exclusion,$table){
	$creation 	= ""; // Chaîne finale
	$colonnes 	= array(); // Nom des colonnes séparés par des virgules, sauf le dernier
	$values		= array(); // Valeurs à insérer, entre cotes et séparés par des virgules, sauf la dernière
	
	foreach($_POST as $cle => $valeur){
		if($cle != $exclusion){
			$colonnes[] = $cle;
			$values[] = "'" . $valeur . "'";
		}
	}
	// Concatène la chaîne finale
	$creation = "INSERT INTO " . $table . "(" . implode(",",$colonnes) . ") VALUES (" . implode(",", $values) . ");";
	
	return $creation;
}

