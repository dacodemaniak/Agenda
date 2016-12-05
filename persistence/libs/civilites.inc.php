<?php
/**
* @name civilites.inc.php Services de gestion de la table "civilites"
**/

/**
* string lister(string $forme)
**/
function lister($forme){
	$civilites = listerCivilites(); // Appelle la fonction listerCivilites()
	
	switch(strtoupper($forme)){
		case "OPTION":
		case "OPTIONS":
			$retour = toOptions($civilites);
		break;
		
		case "RADIO":
		case "RADIOS":
			$retour = toRadio($civilites);
		break;
		
		case "CHECKBOX":
		case "CHECKBOXES":
			$retour = toCheckbox($civilites);
		break;
		
		case "TABLE":
			$retour = toTable($civilites);
		break;
		
		default:
			$retour = toOptions($civilites);
		break;
	}
	return $retour;
}

/**
* string lister(string $forme)
*	Dispatche la demande vers les fonctions spécifiques de traitement des civilités
*	@param string $forme : Identifie la forme sous laquelle retourner les données
*	@return string Chaîne HTML permettant l'affichage dans la vue
**/
function listerV0($forme){
	$connexion = dbConnect();
	
	if($connexion !== false){
		// Définir la variable qui va contenir le résultat attendu
		$civilites = array();
		
		$requeteSQL = "SELECT civilite_id,libelle FROM civilites;";
		$resultats = $connexion->query($requeteSQL);
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		
		$compteur = 1;
		
		while($ligne = $resultats->fetch()){
			$uneLigneDeCivilite = array();
			
			#begin_debug : petit tableau à l'origine
			#echo "uneLigneDeCivilite (ligne 25 - Occurrence : " . $compteur . ") : <br />";
			#var_dump($uneLigneDeCivilite);
			#echo "<br />";
			#end_debug
			
			$uneLigneDeCivilite[] = $ligne->civilite_id;
			$uneLigneDeCivilite[] = $ligne->libelle;
			
			#begin_debug Petit Tableau après récupération des données de la table
			#echo "uneLigneDeCivilite (ligne 31 - " . $compteur . ") : <br />";
			#var_dump($uneLigneDeCivilite);
			#echo "<br />";
			#end_debug
			
			$civilites[] = $uneLigneDeCivilite;
			
			$compteur++;
		}
		
		#begin_debug Grand tableau après avoir parcouru
		#var_dump($civilites);
		#end_debug
		
		// Filtrage de paramètres
		$exactForme = strtoupper($forme); // Convertir la chaîne $forme en Majuscules
		// ucfirst($chaine) => Première lettre de chaque mot en majuscules
		// strtolower($chaine) => convertit la chaîne en minuscules
		
		// Déterminer la fonction à utiliser pour créer la chaîne HTML
		switch($exactForme){
			case "OPTION":
			case "OPTIONS":
				// Appeler la fonction toOptions()
				$retour = toOptions($civilites);
			break;
			
			case "RADIO":
				// Appeler la fonction toRadio()
				$retour = toRadio($civilites);
			break;
			
			case "TABLE":
			break;
			
			case "CHECKBOX":
			break;
			
			default: // $forme ne vaut ni option, ni radio
				// Appeler par défaut toOptions()
			break;
		}
	} else {
		// Pas possible de me connecter...
	}
	return $retour; // Retourne la chaîne contenant les civilités sous la forme souhaitée
}


/**
* string toOptions()
*	Traite le tableau des options et construit
*	une chaîne contenant <option>...</option>
*	Le tableau est construit sous la forme :
*	array(
*		array(
			1, [indice 0]
			Monsieur [indice 1]
		),
		...,
*		array(
			2,
			Madame
		),		
*	)
*	@return string Chaîne HTML avec les options
**/
function toOptions($civilites){
	$options = ""; // Chaîne HTML contenant la structure <select><option>...</option></select>
	
	$options .= "<label for=\"civilite\">Civilité</label>\n";
	$options .= "<select name=\"civilite\" id=\"civilite\" class=\"required\" data-label=\"Civilité\">\n";
	
	foreach($civilites as $civilite){
		$options .= "<option value=\"" . $civilite["id"] . "\">" . $civilite["libelle"] . "</option>\n";
	}
	
	$options .= "</select>";
	return $options;
}

/**
* string toRadio(array $civilites)
*	Boucle sur le tableau des civilités et retourne un ensemble de boutons radio
* @return string Chaîne HTML avec <input type="radio">...
**/
function toRadio($civilites){
	$radios = ""; // Chaine HTML de type <label><input type="radio"...></label>
	
	foreach($civilites as $civilite){
		$radios .= "<label for=\"civilite\">";
		$radios .= "<input type=\"radio\" name=\"civilite\" id=\"civilite\" value=\"" . $civilite["id"] . "\">" . $civilite["libelle"] . "</label>";
	}
	
	return $radios;
}

/**
* string toCheckbox(array $civilites)
*	Boucle sur le tableau des civilités et retourne un ensemble de boîtes à cocher
* @return string Chaîne HTML avec <input type="checkbox">...
**/
function toCheckbox($civilites){
	$checkboxes = ""; // Chaine HTML de type <label><input type="radio"...></label>
	
	foreach($civilites as $civilite){
		$checkboxes .= "<label for=\"civilite\">";
		$checkboxes .= "<input type=\"checkbox\" name=\"civilite\" id=\"civilite\" value=\"" . $civilite["id"] . "\">" . $civilite["libelle"] . "</label>";
	}
	
	return $checkboxes;
}

/**
* string toTable(array $civilites)
* Crée un tableau HTML à partir des données de $civilites
* Affiche le nombre de lignes total des civilités dans la base de données
* @return string Structure de type <table>...</table>
**/
function toTable($civilites){
	// Créer la variable qui contiendra toute la structure HTML finale
	$table				= "";
	
	// Créer le tableau HTML
	$table .= "<table>";
	
	// Créer la structure <thead></thead>
	$table .= "<thead>";
	$table .= "<tr>";
	$table .= "<th>Identifiant</th>";
	$table .= "<th>Libellé</th>";
	$table .= "</tr>";
	$table .= "</thead>";
	
	// Boucler sur le tableau PHP des civilités, pour définir chacune des lignes
	$table .= "<tbody>";
	foreach($civilites as $key => $value){
		// Créer une ligne à chaque occurrence de la boucle
		$table .= "<tr>";
		// Créer les deux colonnes associées
		$table .= "<td>" . $value["id"] . "</td>";
		// @update : Ajout du lien pointant vers update_civilite.php
		$table .= "<td><a href=\"update_civilite.php?id=" . $value["id"] . "\" title=\"Mettre à jour\">" . $value["libelle"] . "</a></td>";
		$table .= "</tr>";
	}
	$table .= "</tbody>";
	
	// Créer la structure <tfoot></tfoot>
	$table .= "<tfoot>";
	$table .= "<tr>";
	$table .= "<td colspan=\"2\">" . sizeof($civilites) . " lignes dans la table civilites</td>";
	$table .= "</tr>";
	$table .= "</tfoot>";
	
	$table .= "</table>";
	
	return $table;
}

/**
* string obsoleteLister()
*	Exécute une requête SELECT pour récupérer les données de la table "civilites"
*	@param string $forme Détermine la forme sous laquelle retourner les données : option ou radio
* @return string La chaîne contenant la structure html <option>...</option>
**/
function obsoleteLister($forme){
	$connexion = dbConnect();
	
	if($connexion !== false){
		#echo "La connexion à la base de données est ok !<br />\n";
		// On crée la requête SELECT sur tous les champs de la table civilites
		$requete = "SELECT civilite_id, libelle FROM civilites;";
		#echo "Requête générée : <pre><code>" . $requete . "</code></pre>";
		
		// On exécute la requête vers le serveur en utilisant la méthode "query()" de l'objet PDO $connexion
		$resultats = $connexion->query($requete);
		#echo "Contenu de l'objet résultat : <br />";
		#var_dump($resultats);
		if($resultats !== false){
			// Ma requête a bien été exécutée
			// Il faut que j'arrive à lister les résultats
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			
			$options = ""; // Initialise la chaîne finale, contenant la structure <option></option>
			
			// On boucle tant que fetch() me retourne des résultats
			while($ligne = $resultats->fetch()){
				#echo "<br />Après appel à la méthode fetch() sur resultats : <br />";
				#var_dump($ligne);
				#echo "<br />";
				if($forme == "option"){
					$options .= "<option value=\"" . $ligne->civilite_id . "\">";
					$options .= $ligne->libelle; // Contenu de la structure <option>...</option>
					$options .= "</option>"; // fin de la structure <option>...</option>
					#echo "<pre><code>" . $options . "</code></pre>";
				} elseif ($forme == "radio") {
					$options .= "<label for=\"civilite\">";
					$options .= "<input type=\"radio\" name=\"civilite\" value=\"" . $ligne->civilite_id . "\">" . $ligne->libelle;
					$options .= "</label>\n";
				} else {
					// On va définir un tableau HTML pour afficher le tout
				}
			}
			// Fermer le curseur PDO
			$resultats->closeCursor(); // Pour éviter les erreurs lors d'une nouvelle requête
			
			// Retourner la chaîne contenant la structure <option>...</option>
			if($forme == "option"){ // On génère le champ HTML complet <select><option>...</option></select>
				$options = "<select name=\"civilite\" id=\"civilite\" class=\"required\" data-label=\"Civilités\">" . $options . "</select>";
			}
			
			return $options;
		} else {
			echo "La méthode query() de connexion a échoué avec la requête " . $requete . "<br />";
		}
	}
}

/**
* array listerCivilites()
*	Exécute une requête sur la table "civilites" et définir un tableau avec le contenu de la table
* @return array
**/
function listerCivilites(){
	$civilites = array(); // Tableau de stockage des lignes de résultat de la requête
	
	//1. On se connecte à la base de données
	$connexion = dbConnect(); // Appelle la fonction de connexion
	
	if($connexion !== false) { // Le serveur mySQL a répondu correctement
		// ORDER BY permet de trier le résultat d'une requête SQL
		$selectSQL = "SELECT civilite_id,libelle FROM civilites ORDER BY civilite_id;";
		
		// Exécution de la requête
		$resultats = $connexion->query($selectSQL); // Exécution de la requête
		$resultats->setFetchMode(PDO::FETCH_OBJ); // On récupère les lignes sous forme d'objets
		
		// Alimenter le tableau avec les données
		while($ligne = $resultats->fetch()){
			$civilites[] = array(
				"id" => $ligne->civilite_id, 
				"libelle" => $ligne->libelle
			);
		}
		
		// Fermer le curseur : pour libérer le jeu de résultats en attente du suivant
		$resultats->closeCursor();
	}
	
	// En fin de parcours, on retourne le tableau avec les civilités
	
	return $civilites;
}