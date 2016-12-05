<?php
/**
* Utiliser une fonction simple
**/

/**
* @name ajouterTexte()
* @usage $maChaine = "Bonjour " . ajouterTexte()
**/
function ajouterTexte(){
	return "<strong>WebDev</strong>";
}

/**
* Début du traitement du script PHP
**/
$monTexte = "Bonjour " . ajouterTexte();
echo $monTexte; // Affichage sur le navigateur : Bonjour -WebDev

$autreTexte = "Les " . ajouterTexte() . " commencent à avoir mal à la tête !";
echo $autreTexte;