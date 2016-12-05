<?php
/**
* age_confirmation.php : Une approche d'authentification
* Attention, si un utilisateur est déjà identifié, afficher un formulaire de déconnexion
**/
session_start();

// Reportez-vous à l'algèbre de Bool pour déterminer les résultats des opérations sur les booléens
$utilisateurDejaConnecte = isset($_SESSION["nom"]) && isset($_SESSION["prenom"]) && isset($_SESSION["age"]);
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $utilisateurDejaConnecte ? "Déconnexion" : "Identification"; ?></title>

		<style>
			label.error{
				color: rgba(168, 168, 168, 0.9);
			}
			
			#errors{
				background-color: rgba(125, 125, 125, 0.9);
				border: solid 1px rgb(128, 128, 128, 0);
				border-radius: 3px;
				box-shadow: 10px 10px 10px #000 3px;
				height: auto;
				width: 300px;
				display: none; /* Ne pas afficher tant qu'il n'y a pas d'erreurs */
			}
		</style>
		
		<!-- Intégration de la librairie jQuery (Content Delivery Network) dans le document HTML //-->
		<script src="javascript/jquery/3.1.1/jquery.min.js"></script>
		<!-- Intégration de la librairie UI de jQuery : ajoute des fonctionnalités à jQuery en matière d'interface utilisateur //-->
		<script src="javascript/jquery/ui/1.12.1/jquery-ui.min.js"></script>
		
	</head>
	
	<body>
		<?php if(!$utilisateurDejaConnecte) { ?>
			<form id="identification" method="post" action="age_rc1.php">
				<fieldset>
					<legend>Aidez-nous à vous connaître</legend>
					
					<div class="form-group">
						<label for="nom">Votre nom(*) :</label>
						<div>
							<input type="text" id="nom" name="nom" value="" placeholder="Nom" size="30" maxlength="255" class="required"  data-label="Nom" />
							<div class="erreur" id="error-nom"></div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="prenom">Votre prénom(*) :</label>
						<input type="text" id="prenom" name="prenom" value="" placeholder="Votre prénom" size="30" maxlength="150" class="required"  data-label="Prénom" />
						<div class="erreur" id="error-email"></div>
					</div>
					
					<div class="form-group">
						<label for="annee">Année de naissance :</label>
						<input type="text" name="annee" id="annee" size="4" maxlength="4" value="" placeholder="XXXX" data-label="Année de naissance" class="required" />
					</div>
					
					<div class="erreur" id="errors"></div>
					
					<div class="button-group">
						<button type="submit" name="valider" id="valider" disabled="disabled">Valider</button>
					</div>
				</fieldset>
			</form>
		<?php } else { ?>
			<form id="deconnexion" method="post" action="deconnexion.php">
				<?php echo $_SESSION["prenom"] . " " . $_SESSION["nom"] ?>
				êtes-vous sûr de vouloir déjà nous quitter ?
				<div class="button-group">
					<button type="submit" name="deconnexion">Déconnexion</button>
				</div>
				<nav id="navigation">
					<?php if($_SESSION["age"] >= 18){
						echo "<a href=\"majeur_rc1.php\">Retournez à votre page d'accueil</a>";
					} else {
						echo "<a href=\"mineur_rc1.php\">Retournez à votre page d'accueil</a>";
					}
					?>
				</nav>
			</form>
		<?php } ?>
		<!-- Intégration des scripts de contrôle de formulaire //-->
		<script src="javascript/check_form.js"></script>
	</body>
</html>