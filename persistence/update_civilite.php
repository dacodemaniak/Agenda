<?php
/**
* @name update_civilite.php Formulaire de mise à jour d'une civilité
(Vue)
**/
include("libs/db.inc.php");

//1. On récupère les données correspondant à l'ID passé en paramètre dans la table civilites
if(isset($_GET["id"])){
	$civilite_id = $_GET["id"];
	#begin_debug
	#echo "On travaille avec l'identifiant : " . $civilite_id . " dans la table civilites";
	#end_debug
	
	// A partir de l'identifiant, on peut récupérer les données de la table
	$connexion = dbConnect();
	if($connexion !== false){
		$select = "SELECT libelle FROM civilites WHERE civilite_id = " . $civilite_id . ";";
		$resultats = $connexion->query($select);
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		$ligne = $resultats->fetch(); // $ligne contient la colonne libelle avec sa valeur
		// ATTENTION, la requête a bien été exécutée, mais a-t-elle retourné une ligne ?
		if(!$ligne){
			// Quelqu'un a essayé d'exécuter ce script avec un identifiant inconnu dans la base de données
			// Où que sur un autre poste connecté à l'application, quelqu'un a supprimé l'info entre temps
			header("Location: index_civilite.php"); // On demande à Apache d'exécuter le fichier index_civilite.php
		}
	}
} else { // Quelqu'un a essayé d'exécuter le script sans transmettre l'ID dans la requête HTTP
	// ATTENTION : ce script ne peut pas être appelé directement sur le serveur
	// sans que la requête HTTP m'ai transmis une information sous la forme $_GET["id"]
	header("Location: index_civilite.php");
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<title>Intranet - Paramètres - Civilités</title>
		
		<style>
			.toast{
				background-color:rgba(86, 255, 86, 0.9);
				display: none;
			}
		</style>
		
		<!-- Intégration de la librairie jQuery (Content Delivery Network) dans le document HTML //-->
		<script src="../javascript/jquery/3.1.1/jquery.min.js"></script>
		<!-- Intégration de la librairie UI de jQuery : ajoute des fonctionnalités à jQuery en matière d'interface utilisateur //-->
		<script src="../javascript/jquery/ui/1.12.1/jquery-ui.min.js"></script>
	</head>
	
	<body>
		<header>
			<h1>Intranet Webdev - Gestion des civilités</h1>
		</header>
		
		<form name="civilite" id="civilite" method="post" action="controller_civilite.php">
			<div class="form-group">
				<label for="libelle">Libellé</label>
				<input type="text" name="libelle" id="libelle" size="30" maxlength="50" class="form-control required" value="<?php echo $ligne->libelle; ?>" autocomplete="off" data-label="Libellé de la civilité" />
			</div>
			
			<div class="form-group">
				<button type="submit" name="modifier" id="modifier">Mettre à jour</button>
				<input type="hidden" name="key" id="key" value="<?php echo $civilite_id; ?>" />
			</div>
		</form>
		
		<!-- Gérer les messages d'erreurs //-->
		<div id="errors">
		</div>
		
		<script src="../javascript/checkOnSubmit.js"></script>
		

	</body>
</html>