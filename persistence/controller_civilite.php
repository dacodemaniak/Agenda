<?php
/**
* @name controller_civilite.php Traite la mise à jour de la base de données
*	et retourne à index_civilite.php
**/
include("libs/db.inc.php");

// Vérifier que des données ont été postées
if(sizeof($_POST)) {
	// Vous connecter à la base de données
	$connexion = dbConnect();
	if($connexion !== false){
		// Créer la requête de mise à jour UPDATE civilites SET libelle = '????' WHERE civilite_id = ??
		$requete = "UPDATE civilites SET libelle = '" . $_POST["libelle"] . "'
			WHERE civilite_id = " . $_POST["key"] . ";";
		// Exécuter la requête : utiliser la méthode exec() de l'objet PDO
		if($connexion->exec($requete)){
			// Si la requête de mise à jour a réussi rediriger vers index_civilite.php?maj=ok
			header("Location: index_civilite.php?maj=ok");
		}
	}
}
// Sinon rediriger vers index_civilite.php?maj=ko
echo "La requête " . $requete . " a échoué !";
die();
header("Location: index_civilite.php?maj=ko");