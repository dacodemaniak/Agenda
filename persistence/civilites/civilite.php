<?php
/**
* @name civilite.php Formulaire de création des civilités
(Vue)
**/
$statut = false;
if(isset($_GET["insert"])){
	$statut = $_GET["insert"]; // J'ai soit ok soit ko
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
		
		<form name="civilite" id="civilite" method="post" action="creerCivilite.php">
			<div class="form-group">
				<label for="libelle">Libellé</label>
				<input type="text" name="libelle" id="libelle" size="30" maxlength="50" class="form-control required" value="" autocomplete="off" data-label="Libellé de la civilité" />
			</div>
			
			<div class="form-group">
				<button type="submit" name="ajouter" id="ajouter">Ajouter</button>
			</div>
		</form>
		
		<!-- Gérer les messages d'erreurs //-->
		<div id="errors">
		</div>
		
		<div class="toast">
			<?php if($statut == "ok") { ?>
				La civilité a bien été ajoutée...
			<?php } else { ?>
				Une erreur est survenue lors de l'ajout
			<?php } ?>
		</div>
		
		<script src="../javascript/checkOnSubmit.js"></script>
		
		<?php if($statut){ ?>
			<script>
				$(".toast").fadeIn("fast"); // Affiche le toast
				setTimeout(function() {
					$(".toast").fadeOut("slow");
				}, 2000); // <-- Durée en millisecondes
			</script>
		<?php } ?>
	</body>
</html>