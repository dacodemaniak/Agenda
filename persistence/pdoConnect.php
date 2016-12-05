<?php
/**
* @name pdoConnect.php : Instance de connexion à une base de données via un objet PDO
**/
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
	die("La connexion est impossible au serveur de données. Exécution stoppée");
}

// Utiliser la méthode exec() pour les requêtes de type INSERT, UPDATE, DELETE
$creationUtilisateur = "
	INSERT INTO utilisateurs(
		civilite,
		nom,
		prenom,
		email,
		identifiant,
		password,
		valide
	) VALUES (
		1,
		'Aubert',
		'Jean-Luc',
		'jean-luc.aubert@web-projet.com',
		'jean-luc.aubert',
		'admin',
		0
	);	
";
// Exécution de la requête, on utilise la méthode exec() de l'objet PDO
$result = $connexion->exec($creationUtilisateur);
if($result === false){
	echo "Une erreur est survenue dans la requête : <pre><code>" . $creationUtilisateur . "</code></pre>";
}