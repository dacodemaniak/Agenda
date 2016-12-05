<?php
/**
* @name majeur.php : Landing page pour les visiteurs majeurs
**/

// On récupère les données transmises dans l'URL
$nom = $_GET["nom"];
$prenom = $_GET["prenom"];
$age = $_GET["age"];

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Version pour les grands !</title>
	</head>
	
	<body>
		<h1>Visitez le site pour les grands !</h1>
		<h2>Bonjour <?php echo $prenom . " " . $nom; ?>, vous avez l'âge requis [<?php echo $age; ?>] pour accéder à cette partie de site.</h2>
	</body>
</html>