<?php
/**
* @name index_compte_rc1.php : Affiche le tableau de l'ensemble de données utilisateurs en utilisant la mega fonction
* (Vue)
* @see libs/tableIndex.inc.php
**/

/**
*	Inclusion des librairies nécessaires pour l'affichage des données
**/
include("libs/db.inc.php");
include("libs/tableIndex.inc.php");

/**
* Appeler la méga fonction : afficheIndex()
**/
$colonnes = array(
	array("th" => "Identifiant", "colonne" => "utilisateur_id"),
	array("th" => "Nom", "colonne" => "nom"),
	array("th" => "Prénom", "colonne" => "prenom"),
	array("th" => "E-Mail", "colonne" => "email"),
);

$index = afficheIndex("utilisateurs", $colonnes, "update_compte.php");
echo $index;
