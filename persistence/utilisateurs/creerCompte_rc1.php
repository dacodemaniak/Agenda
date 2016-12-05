<?php
/**
* @name creerCompte.php : Script de création du compte dans la base de données
* rc1 : Modifier la manière dont la requête va être écrite
**/

if(sizeof($_POST)) { // On ne peut pas exécuter l'insertion si aucune donnée n'est postée
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
		die("La connexion est impossible au serveur de données. La création du compte ne peut aboutir");
	}
	
	$creation = "INSERT INTO utilisateurs (";
	// Créer un tableau à partir des indices de $_POST
	// ATTENTION, il faut que les indices soient exactement les noms des colonnes dans la table utilisateurs
	$colonnes = array_keys($_POST); // array_keys stocke les clés d'un tableau dans un autre tableau
	
	var_dump($colonnes);
	
	// ATTENTION, la dernière colonne est le bouton Valider, on doit la supprimer
	//array_pop($colonnes);
	
	// Alternative si on ne connaît pas array_pop
	for($i=0; $i < sizeof($colonnes); $i++){
		if($colonnes[$i] != "signin"){
			$creation .= $colonnes[$i] . ",";
		}
	}
	$creation = substr($creation,0, strlen($creation)-1);
	
	//$creation .= implode(",",$colonnes); // implode() assemble les données d'un tableau dans une chaîne de caractères
	$creation .= ") VALUES (";
	// Boucle sur les données postées et ajout des caractères nécessaires
	foreach($_POST as $indice => $value){
		// ATTENTION, ne pas traiter la clé du bouton de validation
		if($indice != "signin"){
			$creation .= "'" . $value . "',";
		}
	}
	// Attention, supprimer la dernière virgule inutile
	$creation = substr($creation,0,strlen($creation)-1);
	$creation .= ");"; // Ma requête est prête
	
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
			<?php echo $creation; ?>
			Essayez à nouveau en cliquant <a href="inscription.php" title="Inscription">ici</a></blockquote>
		<?php } ?>
	</body>
</html>