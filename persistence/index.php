<?php
/**
* @name index.php : Page d'accueil de l'application
**/
session_start();

// Charger les librairies de connexion à la base, et de gestion des utilisateurs
include("libs/db.inc.php");
include("libs/utilisateurs.inc.php");

// Vérifier si la variable de session $_SESSION["utilisateur"] est bien définie
if(!isset($_SESSION["utilisateur"])){
	header("Location: login.php"); // Redirige vers la page d'identification
}

// Récupérer les droits de l'utilisateur identifié
$droits = droits(); // La fonction libs/utilisateurs.inc.php/droits() retourne un tableau contenant les droits de l'utilisateur connecté

$menu = menu($droits); // Stocke le menu dans la variable $menu, pour utilisation multiples
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Intranet - Bienvenue</title>
	</head>
	
	<body>
		<header>
			<nav>
				<?php echo $menu; ?>
			</nav>
		</header>
		
		<main>
			Blah blah blah
		</main>
		
		<footer>
			<nav>
				<?php echo $menu; ?>
			</nav>
		</footer>
	</body>
</html>