<?php
/**
 * Utiliser une fonction avec paramètre
 **/

/**
 * @name ajouterTexte($type)
 * @param string $type : modificateur du format de sortie de la chaîne
 *	Peut prendre la valeur : "g" => <strong>
 *	Peut prendre la valeur "i" => <em>
 *	Peut prendre la valeur "gi" => <strong><em>
 * @usage $maChaine = "Bonjour " . ajouterTexte("g")
 **/
function ajouterTexte($type){
	if($type == "g")
		return "<strong>WebDev</strong>";
		elseif($type == "i") {
			return "<em>WebDev</em>";
		} elseif($type == "gi"){
			return "<strong><em>WebDev</em></strong>";
		}

		// Attention, si jamais c'est autre chose que les types attendus, on retourne juste la chaîne
		return "WebDev";
}

/**
 * Début du traitement du script PHP
 **/
$monTexte = "Bonjour " . ajouterTexte("g") . "<br />";
echo $monTexte; // Affichage sur le navigateur : Bonjour -WebDev

$autreTexte = "Les " . ajouterTexte("i") . " commencent à avoir mal à la tête !<br />";
echo $autreTexte;

$dernierTexte = ajouterTexte("gi") . " avec un paramètre incorrect. <br />";
echo $dernierTexte;