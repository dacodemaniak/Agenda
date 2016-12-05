<?php
/**
* @name mineur.php : Landing page pour les visiteurs mineurs
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
		<title>Version pour les petits !</title>
	</head>
	
	<body>
		<h1>Visitez le site pour les petits !</h1>
		<h2>Bonjour <?php echo $prenom . " " . $nom; ?>, ton âge de <?php echo $age; ?> ne t'autorise qu'à cette partie de site.</h2>
	</body>
</html>