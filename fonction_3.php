<?php
/**
 * Utiliser une fonction avec deux paramètres
 **/

/**
 * @name ajouterTexte($entree, $type)
 * @param string $entree : Chaine en entrée à "styliser"
 * @param string $type : modificateur du format de sortie de la chaîne
 *	Peut prendre la valeur : "g" => <strong>
 *	Peut prendre la valeur "i" => <em>
 *	Peut prendre la valeur "gi" => <strong><em>
 * @usage $maChaine = "Bonjour " . ajouterTexte("g")
 **/
function ajouterTexte($entree, $type){
	if($type == "g")
		return "<strong>" . $entree . "</strong>";
		elseif($type == "i") {
			return "<em>" . $entree . "</em>";
		} elseif($type == "gi"){
			return "<strong><em>" . $entree . "</em></strong>";
		}

		// Attention, si jamais c'est autre chose que les types attendus, on retourne juste la chaîne
		return $entree;
}

/**
 * Début du traitement du script PHP
 **/
$monTexte = "Bonjour " . ajouterTexte("Tout le monde", "g") . "<br />";
echo $monTexte; // Affichage sur le navigateur : Bonjour -WebDev

$autreTexte = "Les " . ajouterTexte("Développeurs", "i") . " commencent à avoir mal à la tête !<br />";
echo $autreTexte;

$dernierTexte = ajouterTexte("La fonction", "gi") . " avec deux paramètres <br />";
echo $dernierTexte;

echo "L'entrée d'origine " . $entree . " n'existe pas !";