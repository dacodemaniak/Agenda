<?php
/**
* @name formulaire.php : Permet la gestion d'un formulaire simple
**/

if(isset($_GET["process"])){
	$message = "Votre demande a bien été reçue, elle sera traitée par nos services dans les meilleurs délais...";
} else {
	$message = "";
}

/**
* array sujets : Stocke les sujets qui seront affichés dans le select du formulaire
**/
$sujets = array(
	"Demande de devis",
	"Demande de SAV",
	"Contact Technique"
);

$destinataires = array(
	"contact@societe.com",
	"administratif@societe.com",
	"commercial@societe.com"
);

/**
 * Le formulaire a-t-il été validé
**/
if(isset($_POST["valider"])){
	
}

/**
* string toSelectOptions(array $datas)
*	@param array $datas : Tableau contenant les données à afficher dans le formulaire
*	@return string Chaîne formatée <option>...</option>
**/
function toSelectOptions($datas){
	if($datas[0] != "Choisir..."){
		$options = "<option value=\"\">Choisir...</option>\n";
	}
	
	for($i=0; $i < sizeof($datas); $i++){
		$value = $i + 1;
		$options .= "<option value=\"" . $value . "\">" . $datas[$i] . "</option>\n";
		// $options = $options . "<option value=\"" . $i . "\">" . $datas[$i] . "</option>\n";
	}
	// En fin de boucle sur les données du tableau $datas
	return $options;
}
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Formulaire de contact</title>

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
		
		<link href="css/animate/animate.css" rel="stylesheet" />
		
		<!-- Intégration de la librairie jQuery (Content Delivery Network) dans le document HTML //-->
		<script src="javascript/jquery/3.1.1/jquery.min.js"></script>
		<!-- Intégration de la librairie UI de jQuery : ajoute des fonctionnalités à jQuery en matière d'interface utilisateur //-->
		<script src="javascript/jquery/ui/1.12.1/jquery-ui.min.js"></script>

	</head>
	
	<body>
		<?php
			if(strlen($message)){
				echo "<h2>" . $message . "</h2>";
			}
		?>
			<form id="contact" method="post" action="traiter.php">
				<fieldset>
					<legend>Contactez-nous</legend>
					
					<div class="form-group">
						<label for="sujets">Sujet (*) :</label>
						<select name="sujets" size="1" id="sujets" class="required" data-label="Sujet">
							<!--  A terme, prévoir l'alimentation automatique du select à partir de données dynamiques -->
							<?php
								echo toSelectOptions($sujets); // Utiliser une fonction pour afficher la liste des options
							?>
						</select>
						<div class="erreur" id="error-sujet"></div>
					</div>
					
					<div class="form-group">
						<label for="nom">Votre nom(*) :</label>
						<div>
							<input type="text" id="nom" name="nom" value="" placeholder="Nom" size="30" maxlength="255" class="required"  data-label="Nom" />
							<div class="erreur" id="error-nom"></div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="email">Votre email(*) :</label>
						<input type="email" id="email" name="email" value="" placeholder="Adresse e-mail" size="30" maxlength="150" class="required"  data-label="Adresse de courrier électronique" />
						<div class="erreur" id="error-email"></div>
					</div>
					
					<div class="form-group">
						<label for="objet">Précisez votre demande :</label>
						<textarea name="objet" id="objet" cols="30" rows="5" value="" placeholder="Votre demande" data-label="Objet de votre message"></textarea>
					</div>
					
					<div class="erreur" id="errors"></div>
					
					<div class="button-group">
						<button type="submit" name="valider">Valider</button>
					</div>
				</fieldset>
			</form>
			
			<!-- Intégration des scripts de contrôle de formulaire //-->
			<script src="javascript/check_form.js"></script>
	</body>
</html>