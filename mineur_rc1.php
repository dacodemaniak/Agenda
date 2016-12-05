<?php
/**
* @name mineur_rc1.php : Landing page pour les visiteurs mineurs
* 	Utilise la variable de session $_SESSION
**/

session_start();

// On récupère les données de la session courante
if(isset($_SESSION["nom"]) && isset($_SESSION["prenom"]) && isset($_SESSION["age"])){
	$nom = $_SESSION["nom"];
	$prenom = $_SESSION["prenom"];
	$age = $_SESSION["age"];
} else {
	// La variable de session n'existe pas, on renvoie vers le formulaire d'identification
	header("Location: age_confirmation.php");
}

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Version pour les petits !</title>
	</head>
	
	<body>
		<header>
			<?php echo $prenom . " " . $nom; ?>
			<form name="deconnexion" method="post" action="deconnexion.php">
				<button id="deconnexion" name="deconnexion">Déconnexion</button>
			</form>
		</header>
		<h1>Visitez le site pour les petits !</h1>
		<h2>Bonjour <?php echo $prenom . " " . $nom; ?>, ton âge de <?php echo $age; ?> ne t'autorise qu'à cette partie de site.</h2>
	</body>
</html>