<?php
/**
/* @name index_civilite.php Accueil de la gestion des civilités
/*	Affiche l'ensemble des données de civilités sous la forme d'un tableau
/* @see civilites.inc.php::lister("table")
**/
session_start();

// Inclure les librairies utiles
include("../libs/db.inc.php");
include("../libs/utilisateurs.inc.php");
include("../libs/civilites.inc.php");

// Vérification des droits des utilisateurs
if(!isset($_SESSION["utilisateur"])){
	header("Location: login.php"); // On ne peut pas accéder à cette page sans identification préalable
}

// L'utilisateur identifié dispose-t-il du droit d'accès à cette page
if(utilisateurAutorise("index_civilite.php") === false){
	header("Location: index.php"); // On ramène l'utilisateur à la page d'accueil
}

// On récupère les droits de l'utilisateur courant
$droits = droits();

// Lister l'ensemble des civilités sous la forme d'un tableau HTML
$civilites = lister("table");

// Récupère les options de menu disponibles pour l'utilisateur
$menu = menu($droits); // Stocke le menu dans la variable $menu, pour utilisation multiples
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Intranet - Gestion des civilités</title>
	</head>
	
	<body>
		<header>
			<h1>Gestion des Civilités</h1>
			<nav>
				<?php echo $menu; ?>
			</nav>			
		</header>
		
		<main>
			<?php echo $civilites; ?>
			<!-- Ajouter le bouton permettant la création d'une nouvelle civilité //-->
			<a href="civilite.php" title="Ajouter une civilité">Ajouter</a>
		</main>
	</body>
</html>