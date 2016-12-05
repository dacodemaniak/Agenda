/**
* check_form.js : Contrôle de formulaire
**/

/**
// L'événement "perte du focus" : "blur"
$(".required").on("blur", function(){
		var formulaireValide = true;
		// Vérifions l'ensemble de tous les champs requis...
		console.log("Sortie du champ " + $(this).attr("id"));
		// Boucler sur tous les champs requis...
		$(".required").each(function(){
				if($(this).val() == ""){
					// Valeur non saisie... le formulaire n'est pas valide
					formulaireValide = false;
				}
			}
		);
		// En fin de parcours, si tous les champs sont remplis, on peut activer le bouton de validation
		if(formulaireValide){
			$("#valider").removeAttr("disabled");
		}		
	}
);

$(".required").on("keyup", function(){
		if($(this).val() == ""){
			$("#valider").attr("disabled", "disabled");
		}
	}
);
**/

// Gère l'événement keyup : touche relachée sur le champ
$(".required").on("keyup", function(){ // Intercepte l'événement touche relâchée sur un champ .required
	var formulaireValide = true;
		$(".required").each(function(){
				if($(this).val() == ""){
					// Il y a un champ vide encore...
					formulaireValide = false;
				}
			}
		);
		if(formulaireValide){
			// Les champs sont tous remplis
			// On s'assure que le champ Année contient bien 4 caractères
			if($("#annee").val().length == 4){
				if(!isNaN($("#annee").val())){ // isNaN() vrai si la valeur n'est pas un numérique
					$("#valider").removeAttr("disabled");
				} else {
					$("#valider").attr("disabled", "disabled");
				}
			} else {
				$("#valider").attr("disabled", "disabled");
			}
		} else {
			// Le formulaire n'est pas valide
			$("#valider").attr("disabled", "disabled");
		}
		return formulaireValide;
	}
);

/**
$(".required").on("keyup", function(){
	var formulaireValide = true;
	if($(this).val() == ""){
		$("#valider").attr("disabled", "disabled");
	} else {
		if($(this).attr("id") == "annee"){
			if($(this).val().length < 4){
				console.log("Longueur du champ : " + $(this).val().length);
				$("#valider").attr("disabled", "disabled");
			} else {
				$(".required").each(function(){
						if($(this).val() == ""){
							// Valeur non saisie... le formulaire n'est pas valide
							formulaireValide = false;
						}
					}
				);
				// En fin de parcours, si tous les champs sont remplis, on peut activer le bouton de validation
				if(formulaireValide){
					$("#valider").removeAttr("disabled");
				}			
			}
		} else {
			$(".required").each(function(){
					if($(this).val() == ""){
						// Valeur non saisie... le formulaire n'est pas valide
						formulaireValide = false;
					}
				}
			);
			// En fin de parcours, si tous les champs sont remplis, on peut activer le bouton de validation
			if(formulaireValide){
				$("#valider").removeAttr("disabled");
			}		
		}
	}
}
);


// En passant par la gestion des événements jquery
$("form").on("submit", function(){ // A la survenue de l'évément "submit" sur l'élément dont l'ID est contact, on traite plusieurs opérations
	var messages = new String; // Stocke les messages d'erreur
	var formulaireValide = true;
	console.log("L'utilisateur a validé le formulaire !");
	// En jQuery on peut récupérer une collection d'éléments simplement par un nom de classe
	$(".required").each(function(){ // boucle sur tous les éléments du document qui portent la classe .required, en exécutant une fonction à chaque fois
			console.log("Contrôle du champ : " + $(this).attr("id"));
			if($(this).val() == ""){
				messages += "Le champ " + $(this).attr("data-label") + " n'est pas rempli.<br />";
				var label = $("[for=" + $(this).attr("id") + "]");
				$(label).addClass("error"); // La cible est exactement le label du champ concerné
				// Trouver dans les ancêtres du champ courant, l'élément dont la classe est form-group
				$(this).parents(".form-group").effect("shake");
				formulaireValide = false;
			}
		});
				
		// En fin de boucle each, on a contrôlé tous les champs qui disposent de la classe .required
		if(!formulaireValide){
			// Si le formulaire n'est pas valide, on affiche les erreurs dans la DIV concernées
			$("#errors").html(messages);
			$("#errors").slideDown("fast");
		}
				
		return formulaireValide;
});
**/