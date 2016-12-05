/**
* @name checkOnSubmit.js : Contrôle d'un formulaire à la validation
**/
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