<?php
/**
* @name formulaire.php : Permet la gestion d'un formulaire simple
**/

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
		
		<!-- Intégration de la librairie jQuery (Content Delivery Network) dans le document HTML //-->
		<script src="javascript/jquery/3.1.1/jquery.min.js"></script>
	</head>
	
	<body>
		<form id="contact" method="post" action="">
			<fieldset>
				<legend>Contactez-nous</legend>
				
				<div class="form-group">
					<label>Sujet (*) :</label>
					<select name="sujets" size="1" id="sujets" class="required" data-label="Sujet">
						<!--  A terme, prévoir l'alimentation automatique du select à partir de données dynamiques -->
						<?php
							echo toSelectOptions($sujets); // Utiliser une fonction pour afficher la liste des options
						?>
					</select>
					<div class="erreur" id="error-sujet"></div>
				</div>
				
				<div class="form-group">
					<label>Votre nom(*) :</label>
					<input type="text" id="nom" name="nom" value="" placeholder="Nom" size="30" maxlength="255" class="required"  data-label="Nom" />
					<div class="erreur" id="error-nom"></div>
				</div>
				
				<div class="form-group">
					<label>Votre email(*) :</label>
					<input type="email" id="email" name="email" value="" placeholder="Adresse e-mail" size="30" maxlength="150" class="required"  data-label="Adresse de courrier électronique"/>
					<div class="erreur" id="error-email"></div>
				</div>
				
				<div class="form-group">
					<label>Précisez votre demande :</label>
					<textarea name="objet" id="objet" cols="30" rows="5" value="" placeholder="Votre demande" class="required"  data-label="Objet de votre message"></textarea>
				</div>
				
				<div class="erreur" id="errors"></div>
				
				<div class="button-group">
					<button type="submit" name="valider">Valider</button>
				</div>
			</fieldset>
		</form>
		
		<!-- Intégration des scripts de contrôle de formulaire //-->
		<script>
			// En passant par la gestion des événements jquery
			$("#contact").on("submit", function(){ // A la survenue de l'évément "submit" sur l'élément dont l'ID est contact, on traite plusieurs opérations
				var messages = new String; // Stocke les messages d'erreur
				var formulaireValide = true;
				console.log("L'utilisateur a validé le formulaire !");
				// En jQuery on peut récupérer une collection d'éléments simplement par un nom de classe
				$(".required").each(function(){ // boucle sur tous les éléments du document qui portent la classe .required, en exécutant une fonction à chaque fois
					console.log("Contrôle du champ : " + $(this).attr("id"));
					if($(this).val() == ""){
						messages += "Le champ " + $(this).attr("data-label") + " n'est pas rempli.<br />";
						formulaireValide = false;
					}
				});
				
				// En fin de boucle each, on a contrôlé tous les champs qui disposent de la classe .required
				if(!formulaireValide){
					// Si le formulaire n'est pas valide, on affiche les erreurs dans la DIV concernées
					$("#errors").html(messages);
				}
				
				return formulaireValide;
			});
			
			// Fonction verifierFormulaire()
			function verifierFormulaire(){
				var field = null; // Définition de la variable
				var errorDiv = null; // Variable stockant l'objet DIV pour l'affichage du message d'erreur
				var formulaireValide = false; // Par défaut donc booléen et faux
				var messages = new String; // Stocke les messages d'erreur
				
				// Commençons par vérifier si une valeur a été saisie dans le champ nom
				field = $("#nom"); // jQuery
				if(field.val() == ""){
					messages += "Le champ Nom ne peut pas être vide<br />";
				}
				// On continue avec le champ e-mail...
				field = $("#email");
				if(field.val() == ""){
					messages += "Le champ Email ne peut pas être vide<br />";
				}
				
				// Vérifier que l'utilisateur a sélectionné une ligne dans la liste
				field = $("#sujets");
				var selectedOption = field.selectedIndex; // La propriété selectedIndex retourne l'indice de la ligne sélectionnée
				if(field.val() == ""){ 
					errorDiv = document.getElementById("error-sujet");
					messages += "Vous devez sélectionner un sujet dans la liste";
				}
				
				// En fin de parcours, on affiche les erreurs dans la DIV concernées
				errorDiv = document.getElementById("errors");
				errors.innerHTML = messages;
				
				return formulaireValide; // Empêchera la soumission du formulaire
			}
		</script>
	</body>
</html>