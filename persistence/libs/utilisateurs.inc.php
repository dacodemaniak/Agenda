<?php
/**
* @name utilisateurs.inc.php : Services de contrôle des utilisateurs
* (Modèle)
**/

/**
* boolean utilisateurAutorise(string $url)
*	@param string $url L'URL pour laquelle tester si l'utilisateur dispose d'une autorisation
*	@return boolean Vrai si l'utilisateur a les droits d'accès, faux sinon
**/
function utilisateurAutorise($url){
	//1. Connexion à la base de données
	$connexion = dbConnect();
	if($connexion !== false){
		$requete = "SELECT COUNT(*) AS autorise
			FROM utilisateurs AS u INNER JOIN groupes_modules AS um USING(groupe_id)
			INNER JOIN modules AS m USING(module_id)
			WHERE u.utilisateur_id = " . $_SESSION["utilisateur"]["id"] . "
			AND m.libelle_url = '" . $url . "'
		";
		
		// 2. Exécute la requête
		$resultats = $connexion->query($requete);
		
		//3. On s'assure que la requête a bien été exécutée
		if($resultats !== false){
			//3. Charge la seule et unique ligne du jeu de résultats $resultats
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			$ligne = $resultats->fetch();
			if($ligne->autorise > 0){
				$resultats->closeCursor();
				return true; // L'utilisateur courant a bien le droit sur cette url
			}
			$resultats->closeCursor();
		}
	}
	
	return false; // L'utilisateur n'a pas le droit d'accès
}

/**
* boolean verifierLogin(string $identifiantSaisi)
*	@param string $identifiantSaisi : Identifiant saisi par l'utilisateur dans le formulaire inscription
*	@return boolean Vrai si on peut créer l'utilisateur, faux sinon
**/
function verifierLogin($identifiantSaisi){
	$selectSQL		= ""; // Chaîne de requête de type SELECT
	
	$selectSQL .= "SELECT COUNT(*) AS nb FROM utilisateurs WHERE identifiant = '" . $identifiantSaisi . "';";
	
	// On se connecte à la base de données
	$connexion = dbConnect();
	
	// On teste si la connexion a réussi
	if($connexion !== false){
		// Exécuter la requête
		$resultats = $connexion->query($selectSQL); // $resultats contient l'ensemble des lignes retournées par la requête $selectSQL
		$resultats->setFetchMode(PDO::FETCH_OBJ); // Indique qu'on veut récupérer les résultats sous forme d'objets
		// Charger la seule ligne de résultat de notre requête
		$ligne = $resultats->fetch(); // fetch() retourne dans $ligne le résultat de la requête
		if($ligne->nb == 0){
			$resultats->closeCursor(); // Pour éviter des erreurs dans d'autres requêtes
			return true; // Aucun utilisateur dans la table avec cet identifiant
		}
	}
	$resultats->closeCursor();
	return false; // Soit la connexion a échoué, soit il existe déjà un utilisateur avec cet identifiant
}

/**
* bool identification()
*	Exécuter une requête sur la table utilisateurs avec le login et le mot de passe saisi
*	Créer une variable de session si l'authentification a réussi et retourner vrai
*	Retourne faux sinon
* @return boolean
**/
function identification(){
	$requeteSQL = "SELECT utilisateur_id FROM utilisateurs WHERE identifiant = '" . $_POST["identifiant"] . "' AND password = '" . $_POST["password"] . "';";
	
	$connexion = dbConnect(); // On se connecte à la base de données
	
	if($connexion !== false){
		$resultats = $connexion->query($requeteSQL);
		
		if($resultats){ // On s'assure qu'on a bien exécuté la requête
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			$ligne = $resultats->fetch();
			if($ligne){ // Il y a bien une ligne de résultat
				$_SESSION["utilisateur"]["connecte"] = true;
				$_SESSION["utilisateur"]["id"] = $ligne->utilisateur_id;
				$resultats->closeCursor();
				return true;
			}
		}
	}
	$resultats->closeCursor();
	return false;
}

/**
* array droits()
*	Retourne un tableau avec les droits de l'utilisateur courant
* @return array
**/	
function droits(){
	$droits = array(); // Tableau contenant le libellé des modules, l'URL des modules
	$requeteDroits = ""; // Stocke la requête de récupération des droits
	
	//1. Connexion à la base de données
	$connexion = dbConnect();
	if($connexion !== false){
		$requeteDroits .= "
			SELECT libelle, libelle_url
			FROM utilisateurs INNER JOIN groupes_modules USING(groupe_id)
			INNER JOIN modules USING(module_id)
			WHERE utilisateurs.utilisateur_id = " . $_SESSION["utilisateur"]["id"] . ";
		";
		
		//2. Exécuter la requête vers le serveur
		$resultats = $connexion->query($requeteDroits);
		
		if($resultats !== false){ // La requête a bien renvoyé un résultat...
			$resultats->setFetchMode(PDO::FETCH_OBJ);
			while($ligne = $resultats->fetch()){
				// Alimente le tableau à chaque occurrence trouvée
				$droits[] = array("url" => $ligne->libelle_url, "label" => $ligne->libelle);
			}
			$resultats->closeCursor();
		} else {
			echo "La requête : <pre><code>" . $requeteDroits . "</code></pre> a échoué. Contactez votre administrateur";
			die();
		}
		
	}
	
	return $droits;
}

/**
* string menu(array $droits)
*	Crée et retourne une chaîne contenant les options autorisées pour l'utilisateur courant
*	@param array $droits Contient les droits de l'utilisateur
*	@see droits() Fonction de récupération des droits de l'utilisateur
*	@return string Menu sous la forme <ul><li>...</li></ul>
**/
function menu($droits){
	$menu = "";
	
	// Initialise le menu
	$menu .= "<ul>\n";
	
	foreach($droits as $droit){
		$menu .= "<li>";
		$menu .= "<a href=\"" . $droit["url"] . "\" title=\"" . $droit["label"] . "\">";
		$menu .= $droit["label"];
		$menu .= "</a>";
		$menu .= "</li>";
	}
	
	// Ajouter un élément commun : déconnexion
	$menu .= "<li><a href=\"signout.php\" title=\"Déconnexion\">Déconnexion</a></li>";
	
	$menu .= "</ul>";
	
	return $menu;
}