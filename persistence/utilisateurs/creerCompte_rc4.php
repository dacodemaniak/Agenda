<?php
/**
* @name creerCompte.php : Script de création du compte dans la base de données
* rc2 : Utilise une bibliothèque de fonctions pour traiter à la fois la connexion
*	et la création de la requête d'insertion
**/
include("../libs/db.inc.php"); // Charger le fichier libs/db.inc.php
include("../libs/utilisateurs.inc.php"); // Services spécifiques à la gestion de la table utilisateurs

if(sizeof($_POST)) { // On ne peut pas exécuter l'insertion si aucune donnée n'est postée
	// Avant d'exécuter la requête de création, on doit vérifier qu'il n'y a pas déjà une ligne dans la table avec cet identifiant
	$creationAutorisee = verifierLogin($_POST["identifiant"]);
	if($creationAutorisee === true){
		$resultat = createAndExec("signin","utilisateurs");
	} else {
		// Soit la connexion à la base n'est pas valide, soit il existe déjà un utilisateur avec cet identifiant
		header("Location:inscription.php"); // Redirige vers le formulaire d'inscription
	}
} else {
		// L'utilisateur a essayé de charger le script sans venir du formulaire, on le renvoie au login
		header("Location: login.php");
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Création de votre compte</title>
	</head>
	
	<body>
		<?php if($resultat !== false){ ?>
			<blockquote>Votre compte a bien été créé. Vous pouvez désormais vous identifier en cliquant <a href="login.php" title="Identification">ici</a></blockquote>
		<?php } else { ?>
			<blockquote>Une erreur est survenue lors de la création de votre compte.<br />
			Essayez à nouveau en cliquant <a href="inscription.php" title="Inscription">ici</a></blockquote>
		<?php } ?>
	</body>
</html>