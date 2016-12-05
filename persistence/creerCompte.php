<?php
/**
* @name creerCompte.php : Script de création du compte dans la base de données
**/

if(sizeof($_POST)) { // On ne peut pas exécuter l'insertion si aucune donnée n'est postée
	//1. Etablir la connexion à la base de données
	try{ // Essaye les instructions qui suivent
		$connexion = new PDO(
			"mysql:host=127.0.0.1;port=3306;dbname=authentification", // Chaîne de connexion
			"webdev_db_admin", // Nom de l'utilisateur de la base de données
			"" // Le mot de passe associé à l'utilisateur de la base de données
		);
	}
	catch(Exception $e){ // Si tu n'arrives pas à exécuter les instructions du try, intercepte moi l'Exception levée
		echo "Erreur levée : " . $e->getMessage() . "<br />";
		echo "N° d'erreur : " . $e->getCode() . "<br />";
		die("La connexion est impossible au serveur de données. La création du compte ne peut aboutir");
	}

	//2. On récupère les données postées dans le formulaire inscription.php
	$civilite = $_POST["civilite"];
	$nom = $_POST["nom"];
	$prenom = $_POST["prenom"];
	$email = $_POST["email"];
	$identifiant = $_POST["identifiant"];
	$password = $_POST["password"];


	//3. Créer la requête INSERT INTO
	$creation = "
		INSERT INTO utilisateurs (
			civilite,
			nom,
			prenom,
			email,
			identifiant,
			password
		) VALUES ( " .
		$civilite . ",'" . 
		$nom . "','" .
		$prenom . "','" .
		$email . "','" .
		$identifiant . "','" .
		$password . "');
	";

	//4. Exécute la requête
	$resultat = $connexion->exec($creation); // Exécute la requête sur le serveur
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