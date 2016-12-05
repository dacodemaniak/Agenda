<?php
/**
* @name inscription.php Formulaire de création d'un compte
**/
session_start();

include("../libs/db.inc.php");
include("../libs/civilites.inc.php");

#begin_debug : tester les fonctions
$options = lister("options"); // Test d'appel à la fonction lister de civilites.inc.php
#echo "<pre><code>" . $options . "</code></pre>";
# Test de la fonction listerCivilite()
#$civilites = listerCivilites();
#end_debug

$showMsg = false;
$civilite = "";

if(isset($_SESSION["inscription"])){
	// Si le clé "inscription" est définie, cela signifie que je suis passé dans creerCompte_rc5.php et que l'identifiant saisi existait déjà...
	$showMsg = true; // On décidera d'afficher un message
	
	// Pour faciliter l'affichage de la civilité sélectionnée
	$civilite = $_SESSION["inscription"]["civilite"];
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<title>Intranet - Créer un compte</title>
		
		<!-- Intégration de la librairie jQuery (Content Delivery Network) dans le document HTML //-->
		<script src="../javascript/jquery/3.1.1/jquery.min.js"></script>
		<!-- Intégration de la librairie UI de jQuery : ajoute des fonctionnalités à jQuery en matière d'interface utilisateur //-->
		<script src="../javascript/jquery/ui/1.12.1/jquery-ui.min.js"></script>
	</head>
	
	<body>
		<header>
			<h1>Intranet Webdev - Inscription</h1>
		</header>
		
		<?php if($showMsg){
			echo "<blockquote class=\"erreur\">Cet identifiant existe déjà, veuillez en choisir un nouveau</blockquote>";
		}
		?>
		<form name="inscription" id="inscription" method="post" action="creerCompte_rc5.php">
			
			<fieldset id="compte">
				<legend>Votre compte</legend>
				<div class="form-group">
						<!-- Remplacer par une boucle sur le tableau des civilités //-->
						<?php
							//echo lister("options");
							echo $options;
						?>
				</div>
				
				<div class="form-group">
					<label for="nom">Nom :</label>
					<input type="text" name="nom" id="nom" size="30" maxlength="75" class="form-control required" autocomplete="off" value="<?php echo isset($_SESSION["inscription"]) ? $_SESSION["inscription"]["nom"] : "";?>" placeholder="Votre nom" data-label="Nom d'utilisateur" />
				</div>

				<div class="form-group">
					<label for="prenom">Prénom :</label>
					<input type="text" name="prenom" id="prenom" size="30" maxlength="75" class="form-control required" autocomplete="off" value="<?php echo isset($_SESSION["inscription"]) ? $_SESSION["inscription"]["prenom"] : "";?>" placeholder="Votre nom" />
				</div>

				<div class="form-group">
					<label for="email">E-mail :</label>
					<input type="email" name="email" id="email" size="30" maxlength="150" class="form-control required" autocomplete="off" value="<?php echo isset($_SESSION["inscription"]) ? $_SESSION["inscription"]["email"] : "";?>" placeholder="Adresse e-mail" data-label="E-mail valide pour la communication" />
				</div>
			</fieldset>
			
			<fieldset id="connexion">
				<legend>Vos identifiants de connexion</legend>
				<div class="form-group">
					<label for="identifiant">Identifiant :</label>
					<input type="text" name="identifiant" id="identifiant" size="30" maxlength="32" class="form-control required" autocomplete="off" placeholder="Votre identifiant" data-label="Identifiant de connexion" value="" />
				</div>

				<div class="form-group">
					<label for="password">Mot de passe :</label>
					<input type="password" name="password" id="password" size="30" maxlength="32" class="form-control required" autocomplete="off" data-label="Mot de passe de connexion" value="<?php echo isset($_SESSION["inscription"]) ? $_SESSION["inscription"]["password"] : "";?>" />
				</div>
			</fieldset>
			
			
			<div class="form-group">
				<button type="submit" name="signin" id="signin">Créer un compte</button>
			</div>
		</form>
		
		<!-- Gérer les messages d'erreurs //-->
		<div id="errors">
		</div>
		
		<script src="../javascript/checkOnSubmit.js"></script>
	</body>
</html>
<?php
if(isset($_SESSION["inscription"])){
	unset($_SESSION["inscription"]); // On n'oublie pas de supprimer la variable de session
}
?>