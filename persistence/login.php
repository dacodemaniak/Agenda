<?php
/**
* @name login.php Formulaire d'identification d'un utilisateur et lien vers le formulaire de création de compte
(Vue)
**/
session_start(); // Démarrer la session
if(isset($_SESSION["utilisateur"])){
	header("Location: index.php");
}

$showMsg = false;
if(isset($_GET["err"])){
	$showMsg = true;
}
?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		
		<title>Intranet - Identification</title>
		
		<!-- Intégration de la librairie jQuery (Content Delivery Network) dans le document HTML //-->
		<script src="../javascript/jquery/3.1.1/jquery.min.js"></script>
		<!-- Intégration de la librairie UI de jQuery : ajoute des fonctionnalités à jQuery en matière d'interface utilisateur //-->
		<script src="../javascript/jquery/ui/1.12.1/jquery-ui.min.js"></script>
	</head>
	
	<body>
		<header>
			<h1>Intranet Webdev - Identification</h1>
		</header>
		
		<?php if($showMsg){ ?>
			<blockquote>Une erreur est survenue lors de votre identification.<br />
			Vérifiez votre identifiant et votre mot de passe avant de vous connecter.</blockquote>
		<?php } ?>
		
		<form name="login" id="login" method="post" action="signin.php">
			<div class="form-group">
				<label for="identifiant">Identifiant</label>
				<input type="text" name="identifiant" id="identifiant" size="30" maxlength="32" class="form-control required" value="" autocomplete="off" data-label="Identifiant de connexion" />
			</div>
			
			<div class="form-group">
				<label for="password">Mot de passe :</label>
				<input type="password" name="password" id="password" size="30" maxlength="32" class="form-control required" autocomplete="off" value="" data-label="Mot de passe de connexion" />
			</div>
			
			<div class="form-group">
				<button type="submit" name="signin" id="signin">Connexion</button>
			</div>
		</form>
		
		<div>
			<p>
				Pas encore inscrit ? <a href="inscription.php" title="Formulaire d'inscription">Inscrivez-vous</a>
			</p>
		</div>
		
		<!-- Gérer les messages d'erreurs //-->
		<div id="errors">
		</div>
		
		<script src="../javascript/checkOnSubmit.js"></script>
	</body>
</html>